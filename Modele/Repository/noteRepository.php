<?php

namespace Modele\Repository;

use Database\DataBaseConnection;
use Modele\Entity\note;
use PDO;
use RuntimeException;
use PDOException;

class noteRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getConnection();
    }


    function affichaeNote(note $note)
    {
        $query = "SELECT * FROM note WHERE  theme_id = :theme_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":theme_id" => $note->getThemeId()]);
        $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function addNote(note $note)
    {
        try {
            $query = "INSERT INTO note(title , content , importance , theme_id) VALUES(:title , :content, :importance , :theme_id)";

            $stmt = $this->conn->prepare($query);

            $result = $stmt->execute([
                ":title" => $note->getTitle(),
                ":content" => $note->getContent(),
                ":importance" => $note->getRating(),
                ":theme_id" => $note->getThemeId()
            ]);
            return $result;
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }

    public function UpdateNote(Note $note)
    {
        try {
            $query = "UPDATE note SET title = :title , content = :content, importance = :importance WHERE id = :id";

            $stmt = $this->conn->prepare($query);

            $result =  $stmt->execute([
                ":title" => $note->getTitle(),
                ":content" => $note->getContent(),
                ":importance" => $note->getRating(),
                ":id" => $note->getId(),
            ]);
            return $result;
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }


    public function findNoteById(Note $note)
    {
        try {
            $query = "SELECT * FROM note WHERE  id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ":id" => $note->getId(),
            ]);

            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }

    public function deleteNoteById(note $note)
    {
        try {
            $query = "DELETE FROM note WHERE  id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $note->getId()]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }

    function ratingNote(note $note)
    {
        $query = "SELECT * FROM note WHERE theme_id = :theme_id ORDER BY importance DESC";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute([":theme_id" => $note->getThemeId()]);
        $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}
