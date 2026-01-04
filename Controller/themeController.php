<?php
include "../database/DataBaseConnection.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$db = new DataBaseConnection();
$conn = $db->getConnection();

if (isset($_POST['addTheme']) || isset($_POST['updateTheme'])) {
    addOrUpdateTheme($conn);
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

function addOrUpdateTheme($conn)
{
    $id = $_POST['id'] ?? null;
    $user_id = $_SESSION['user']['id'];
    $title = $_POST['Title'] ?? '';
    $color = $_POST['color'] ?? '';

    if (empty($title) || empty($color)) {
        $_SESSION['errors'] = "Please fill in all experience fields";
        header("Location: ../themes.php");
        exit();
    }

    if ($id) {
        $query = "UPDATE theme SET Color = :Color , name = :name WHERE id = :id AND  user_id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ":Color" => $color,
            ":name" => $title,
            ":id" => $id,
            ":user_id" => $user_id
        ]);

        unset($_SESSION['updateId'], $_SESSION['updateTitle'], $_SESSION['updateColor'], $_SESSION['Update']);
        $_SESSION['success'] = "Theme updated successfully";
        header("location:../public/userDashboard");
        exit();
    }

    $query = "INSERT INTO theme(name , Color , user_id) VALUES(:name,:Color,:user_id)";

    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":name" => $title,
        ":Color" => $color,
        ":user_id" => $user_id
    ]);

    $_SESSION['success'] = 'Theme created successfully';
    header("location:../public/userDashboard");
    exit();
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
    $stmt->execute([":id"=>$_POST['id']]);

    $_SESSION['success'] = "Theme deleted successfully";
    header("location:../public/userDashboard");
    exit();
}
