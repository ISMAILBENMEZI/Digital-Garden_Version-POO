<?php
namespace Modele\Repository;
use Database\DataBaseConnection;
use Modele\Entity\note;

class noteRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getConnection();
    }

    public function addOrUpdateNote(Note $note)
    {
        if ($note->id) {
            $query = "UPDATE note SET title = :title , content = :content, importance = :importance WHERE id = :id";

            $stmt = $this->conn->prepare($query);

            $stmt->execute([
                ":title" => $note->title,
                ":content" => $note->content,
                ":importance" => $note->rating,
                ":id" => $note->id,
            ]);

            unset($_SESSION['updateNoteId'], $_SESSION['updateNoteTitle'],  $_SESSION['updateNoteContent'], $_SESSION['theme_id']);
            $_SESSION['success'] = "Note updated successfully";
            unset($_SESSION['notes']);
            header("location:../public/userDashboard.php");
            exit();
        }

        $query = "INSERT INTO note(title , content , importance , theme_id) VALUES(:title , :content, :importance , :theme_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ":title" => $note->title,
            ":content" => $note->content,
            ":importance" => $note->rating,
            ":theme_id" => $note->theme_id
        ]);

        $_SESSION['success'] = 'Note created successfully';
        unset($_SESSION['notes']);
        header("location:../public/userDashboard.php");
        exit();
    }
}
