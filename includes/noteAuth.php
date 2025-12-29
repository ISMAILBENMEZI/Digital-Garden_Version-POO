<?php
include "../config/database.php";
session_start();

if (isset($_POST['addNote']) || isset($_POST['UpdateNote'])) {
    addAndUpdateNote($conn);
}

if (isset($_POST['delete'])) {
    deleteNote($conn);
}

if (isset($_POST['viewNote'])) {
    $notes = afficheTheNotes($conn);
    $_SESSION['notes'] = $notes;
    header("location:../dashboard.php");
    exit();
}

if (isset($_POST['raingNote'])) {
    $notes = afficheNoteRaing($conn);
    $_SESSION['notes'] = $notes;
    header("location:../dashboard.php");
    exit();
}

if (isset($_POST['modify'])) {
    $note_id = $_POST['note_id'];

    $query = "SELECT * FROM note WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $note_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $note = $result->fetch_assoc();

    if ($note) {
        $_SESSION['updateNoteId'] = $note['id'];
        $_SESSION['updateNoteTitle'] = $note['title'];
        $_SESSION['updateNoteContent'] = $note['content'];
    }

    header("location: ../notes.php?theme_id=" . $theme_id);
    exit();
}

function addAndUpdateNote($conn)
{
    $note_id = $_POST['note_id'] ?? null;
    $theme_Id = $_POST['theme_id'];
    $note_Title = $_POST['Title'];
    $note_Content = $_POST['Content'];
    $note_Rating = $_POST['rating'];
    $note_Date = date("y-m-d");

    if (empty($note_Title) || empty($note_Content)) {
        $_SESSION["noteError"] = "Please fill in all experience fields";
        header("location: ../notes.php");
        exit();
    }

    if ($note_id) {
        $query = "UPDATE note SET title = ? , content = ? , importance = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $note_Title, $note_Content, $note_Rating, $note_id);
        $stmt->execute();

        unset($_SESSION['updateNoteTitle'], $_SESSION['updateNoteContent'], $_SESSION['updateNoteId']);
        $_SESSION['success'] = "Note updated successfully";

        header("location:../dashboard.php");
        exit();
    }

    $query = "INSERT INTO note(title ,content ,importance , creation_date,theme_id) VALUES(?,?,?,?,?);";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisi", $note_Title, $note_Content, $note_Rating, $note_Date, $theme_Id);

    $stmt->execute();

    $_SESSION['success'] = 'Note created successfully';
    header("location:../dashboard.php");
    exit();
}

function deleteNote($conn)
{
    $note_Id = $_POST['note_id'];

    $query = "DELETE FROM note WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $note_Id);
    $stmt->execute();

    $_SESSION['success'] = 'Note deleted successfully';
    header("location:../dashboard.php");
    exit();
}


function afficheTheNotes($conn)
{
    $theme_Id = $_POST['theme_id'];

    $query = "SELECT * FROM note WHERE theme_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $theme_Id);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function afficheNoteRaing($conn)
{
    $theme_Id = $_POST['theme_id'];

    $query = "SELECT * FROM note WHERE theme_id = ? ORDER BY importance DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $theme_Id);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
