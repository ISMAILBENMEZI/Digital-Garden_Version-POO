<?php
namespace Modele\Repository;

use Database\DataBaseConnection;
use PDO;
use InvalidArgumentException;
use Modele\Entity\User;
use PDOException;
use RuntimeException;

class UserRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getConnection();
    }

    public function findByEmail($email){
      $sql = "
        SELECT 
            u.id,
            u.name,
            u.email,
            u.password,
            u.statut,
            r.status AS role
        FROM user u
        JOIN roles r ON u.role_id = r.id
        WHERE u.email = :email
        LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":email" => $email
        ]);


        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$user) {
            return false;
        }
         return $user;

        }
       
  

    public function addUser(User $user)
    {
        try {
            $isUserAvailable = $this->findByEmail($user->email);

            if (!$isUserAvailable) {
                $query = "INSERT INTO user(name , password, email,statut) VALUES(:name , :password , :email, :statut)";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([
                    ":name" => $user->userName,
                    ":password" => $user->password,
                    ":email" => $user->email,
                    ":statut" => $user->statut
                ]);

                $userId = $this->conn->lastInsertId();
                $user->setId($userId);
                
            } else {
                throw new InvalidArgumentException("This user already exists");
            }
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }
    public function getAllUsers()
    {
        $sql = "
            SELECT id , name , email , statut FROM user where role_id = 1
        ";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateStatut(int $userId, string $statut)
    {
        $sql = "UPDATE user SET statut = :statut WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':statut' => $statut,
            ':id' => $userId
        ]);
    }
}
