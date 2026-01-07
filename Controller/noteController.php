<?php
include "../database/DataBaseConnection.php";
require_once "../Entity/Note.php";
require_once "../Repository/noteRepository.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = DataBaseConnection::getConnection();


if (isset($_POST['addNote']) || isset($_POST['UpdateNote'])) {
    $title = $_POST['Title'];
    $id = $_POST['note_id'] ?? null;
    $rating = $_POST['rating'];
    $Content = $_POST['Content'];
    $theme_Id = $_POST['theme_id'];

    if (empty($title) || empty($rating) || empty($Content) || empty($theme_Id)) {
        $_SESSION['errors'] = "Please fill in all experience fields";
        header("Location: ../public/note.php");
        exit();
    }

    $note = new Note(
        title: $title,
        content: $Content,
        rating: $rating,
        theme_id: $theme_Id,
        id: $id
    );


    $repo = new noteRepository();

    $repo->addOrUpdateNote($note);
}

if (isset($_POST['viewNote'])) {
    $theme_id = $_POST['theme_id'];
    $notes = affichaeNote($theme_id, $conn);
    $_SESSION['notes'] = $notes;
    header("Location: ../public/userDashboard.php");
    exit();
}

if (isset($_POST['modify'])) {
    $id = $_POST['note_id'];

    $query = "SELECT * FROM note WHERE  id = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ":id" => $id,
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $_SESSION['updateNoteId'] = $result['id'];
        $_SESSION['updateNoteContent']  = $result['content'];
        $_SESSION['updateNoteTitle'] = $result['title'];
        $_SESSION['theme_id'] = $result['theme_id'];
    }
    header("location: ../public/note.php");
    exit();
}

if (isset($_POST['delete'])) {
    $note_id = $_POST['note_id'];
    deleteNote($note_id, $conn);
}

if (isset($_POST['raingNote'])) {
    $theme_id = $_POST['theme_id'];
    $notes = ratingNote($theme_id, $conn);
    $_SESSION['notes'] = $notes;
    header("Location: ../public/userDashboard.php");
    exit();
}

function affichaeNote($theme_id, $conn)
{
    $query = "SELECT * FROM note WHERE  theme_id = :theme_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([":theme_id" => $theme_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteNote($note_id, $conn)
{
    $query = "DELETE FROM note WHERE  id = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute([":id" => $note_id]);
    $_SESSION['success'] = "Note deleted successfully";
    unset($_SESSION['notes']);
    header("location: ../public/userDashboard.php");
    exit();
}

function ratingNote($theme_id, $conn)
{
    $query = "SELECT * FROM note WHERE theme_id = :theme_id ORDER BY importance DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute([":theme_id" => $theme_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
