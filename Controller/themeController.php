<?php
use Database\DataBaseConnection;
use Modele\Entity\Theme;
use Modele\Repository\themeRepository;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = DataBaseConnection::getConnection();

if (isset($_POST['addTheme']) || isset($_POST['updateTheme'])) {
    $id = $_POST['id'] ?? null;
    $user_id = $_SESSION['user']['id'];
    $title = $_POST['Title'] ?? '';
    $color = $_POST['color'] ?? '';

    if (empty($title) || empty($color)) {
        $_SESSION['errors'] = "Please fill in all experience fields";
        header("Location: ../public/theme.php");
        exit();
    }

    $theme = new Theme(
        title: $title,
        color: $color,
        user_id: $user_id,
        id:$id
    );
   
    $repo = new themeRepository();
    $repo->addOrUpdateTheme($theme);
}

if (isset($_POST['modify'])) {
    $id = $_POST['id'];
    $user_id = $_SESSION['user']['id'];

    $query = "SELECT * FROM theme WHERE  id = :id AND user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":id" => $id,
        ":user_id" => $user_id
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $_SESSION['updateId'] = $result['id'];
        $_SESSION['updateTitle'] = $result['name'];
        $_SESSION['updateColor'] = $result['Color'];
    }
    header("location: ../public/theme.php");
    exit();
}

if (isset($_POST['delete'])) {
    deleteThemeById($conn);
}

function affichaeTheme($conn)
{
    $user_id = $_SESSION['user']['id'];
    $query = "SELECT * FROM theme WHERE user_id = :user_id";

    $stmt = $conn->prepare($query);
    $stmt->execute([":user_id" => $user_id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}

function deleteThemeById($conn)
{
    $query = "DELETE FROM theme WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute([":id" => $_POST['id']]);

    $_SESSION['success'] = "Theme deleted successfully";
    header("location: ../public/userDashboard.php");
    exit();
}
