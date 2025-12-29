<?php

session_start();
if (isset($page) && $page === 'dashboard') {
    include "config/database.php";
} else {
    include "../config/database.php";
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location:../index.php ");
    exit();
}

if (isset($_POST['addTheme']) || isset($_POST['updateTheme'])) {
    addAndUpdateTheme($conn);
}

if (isset($_POST['modify'])) {
    $id = $_POST['id'];
    $user_id = $_SESSION['userId'];

    $query = "SELECT * FROM theme WHERE id = ? AND  user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $theme = $result->fetch_assoc();

    if ($theme) {
        $_SESSION['updateId'] = $theme['id'];
        $_SESSION['updateTitle'] = $theme['Title'];
        $_SESSION['updateColor'] = $theme['Color'];
    }

    header("location: ../themes.php");
    exit();
}

if (isset($_POST['delete'])) {
    deleteThemeInDatabaseById($conn);
}


function addAndUpdateTheme($conn)
{

    $id = $_POST['id'] ?? null;
    $title = $_POST['Title'] ?? '';
    $color = $_POST['color'] ?? '';
    $user_id = $_SESSION['userId'];

    if (empty($title) || empty($color)) {
        $_SESSION["themesMessage"] = "Please fill in all experience fields";
        header("Location: ../themes.php");
        exit();
    }

    if ($id) {

        $query = "UPDATE theme SET Color = ? , Title = ? WHERE id = ? AND  user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $color, $title, $id, $user_id);
        $stmt->execute();

        unset($_SESSION['updateId'], $_SESSION['updateTitle'], $_SESSION['updateColor'], $_SESSION['Update']);
        $_SESSION['success'] = "Theme updated successfully";

        header("location:../dashboard.php");
        exit();
    }

    $query = "INSERT INTO theme(Title , Color , user_id) VALUES(?,?,?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $title, $color, $user_id);
    $stmt->execute();

    $_SESSION['success'] = 'Theme created successfully';
    header("location:../dashboard.php");
    exit();
}

function deleteThemeInDatabaseById($conn)
{
    $query = "DELETE FROM theme WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();

    $_SESSION['success'] = "Theme deleted successfully";
    header("location:../dashboard.php");
    exit();
}


function affichaeTheTheme($conn)
{
    $user_id = $_SESSION['userId'];
    $query = "SELECT * FROM theme WHERE user_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}



