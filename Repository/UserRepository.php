<?php

class UserRepository
{
    private $conn;

    public function __construct(DataBaseConnection $db)
    {
        $this->conn = $db->getConnection();
    }
    
    public function addUser(User $user)
    {
        try {
            $query = "SELECT * FROM user where email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":email" => $user->email]);
            $isUserAvailable = $stmt->fetchColumn();

            if ($isUserAvailable == 0) {
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
