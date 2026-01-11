<?php

namespace Controller;

use Modele\Entity\Note;
use Modele\Repository\noteRepository;
use service\noteService;
use PDO;

class noteController
{
    private noteService $noteService;

    public function __construct()
    {
        $this->noteService = new noteService();
    }


    public function affichaeNote()
    {
        $theme_id = $_POST['theme_id'];
        if (empty($theme_id)) {
            $_SESSION['error'] = 'error. Please try again later.';
            exit();
        }

        $note = new Note(
            title: null,
            content: null,
            rating: null,
            theme_id: $theme_id,
            id: null
        );

        $result = $this->noteService->affichaeNote($note);
        $_SESSION['ratingTheme_id'] = $_POST['theme_id'];
        return $result;
    }

    public function addOrUpdateNote()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['addNote']) || isset($_POST['UpdateNote']))) {
            $title = $_POST['Title'];
            $id = $_POST['note_id'] ?? null;
            $rating = $_POST['rating'] ?? 0;
            $Content = $_POST['Content'];
            $theme_Id = $_POST['theme_id'];
        }

        if (empty($title) || empty($Content) || empty($theme_Id)) {
            $_SESSION['error'] = "Please fill in all text fields";
            header("Location: /Digital-Garden_Version-POO/view/public/note.php?theme_id=$theme_Id");
            exit();
        }

        if (strlen($title) > 255) {
            $_SESSION['error'] = "Title is too long (Max 255 chars)";
            header("Location: /Digital-Garden_Version-POO/view/public/note.php?theme_id=$theme_Id");
            exit();
        }

        $note = new Note(
            title: $title,
            content: $Content,
            rating: $rating,
            theme_id: $theme_Id,
            id: $id
        );

        $result = $this->noteService->addOrUpdateNote($note);

        if ($result === "update") {
            unset($_SESSION['updateNoteId'], $_SESSION['updateNoteTitle'],  $_SESSION['updateNoteContent'], $_SESSION['theme_id']);
            $_SESSION['success'] = "Note updated successfully";
        } elseif ($result === "add") {
            $_SESSION['success'] = 'Note created successfully';
        } else {
            $_SESSION['error'] = 'error. Please try again later.';
        }
    }

    public function findNoteByid()
    {
        if (isset($_POST['modify'])) {
            $id = $_POST['note_id'];

            $note = new Note(
                title: null,
                content: null,
                rating: null,
                theme_id: null,
                id: $id
            );

            $foundNote = $this->noteService->findNoteById($note);

            if ($foundNote) {
                $_SESSION['updateNoteId'] = $foundNote->id;
                $_SESSION['updateNoteContent']  = $foundNote->content;
                $_SESSION['updateNoteTitle'] = $foundNote->title;
                $_SESSION['theme_id'] = $foundNote->theme_id;
            }
        }
    }

    public function deleteNoteById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $id = $_POST['note_id'];

            $note = new Note(
                title: null,
                content: null,
                rating: null,
                theme_id: null,
                id: $id
            );

            $deleteResult = $this->noteService->deleteNoteById($note);
            if ($deleteResult) {
                $_SESSION['success'] = "Note deleted successfully!";
            } else {
                $_SESSION['error'] = "Could not delete Note.";
            }
        }
    }

    public function ratingNote()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['raingNote'])) {
            $theme_id = $_POST['theme_id'];

            $note = new Note(
                title: null,
                content: null,
                rating: null,
                theme_id: $theme_id,
                id: null
            );

            $result = $this->noteService->ratingNote($note);
            return $result;
        }
    }
}
