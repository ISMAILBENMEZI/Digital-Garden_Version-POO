<?php

namespace Modele\Repository;

use Database\DataBaseConnection;
use Modele\Entity\Theme;
use PDOException;
use RuntimeException;
use PDO;

class themeRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getConnection();
    }

    public function affichaeTheme(Theme $theme)
    {
        $query = "SELECT * FROM theme WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":user_id" => $theme->getUserId()]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function addTheme(Theme $theme)
    {
        try {
            $query = "INSERT INTO theme(name , Color ,status ,user_id) VALUES(:name,:Color,:status,:user_id)";

            $stmt = $this->conn->prepare($query);
            $result =  $stmt->execute([
                ":name" => $theme->getTitle(),
                ":Color" => $theme->getColor(),
                ":status" => $theme->getStatus(),
                ":user_id" => $theme->getUserId()
            ]);
            return $result;
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }

    public function findThemeById(Theme $theme)
    {
        try {
            $query = "SELECT * FROM theme WHERE  id = :id AND user_id = :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ":id" => $theme->getId(),
                ":user_id" => $theme->getUserId()
            ]);

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }

    public function UpdateTheme(Theme $theme)
    {
        try {
            $query = "UPDATE theme SET Color = :Color , name = :name, status = :status WHERE id = :id AND  user_id = :user_id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([
                ":Color" => $theme->getColor(),
                ":name" => $theme->getTitle(),
                ":status" => $theme->getStatus(),
                ":id" => $theme->getId(),
                ":user_id" => $theme->getUserId()
            ]);
            return $result;
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }

    public function deleteThemeById(Theme $theme)
    {
        try {
            $query = "DELETE FROM theme WHERE id = :id AND user_id = :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(
                [
                    ":id" => $theme->getId(),
                    ":user_id" => $theme->getUserId()
                ]
            );

            return $stmt->rowCount() > 0;
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }

    public function publicThemes()
    {
        try {
            $query = "
                SELECT 
                    t.*, 
                    u.name AS author_name, 
                    u.img AS author_img
                FROM theme t
                JOIN user u ON t.user_id = u.id
                WHERE t.status = 'public'
            ";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (PDOException $error) {
            throw new RuntimeException("Database error: " . $error->getMessage());
        }
    }
}
