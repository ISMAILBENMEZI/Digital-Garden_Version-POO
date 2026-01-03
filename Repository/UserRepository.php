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
                $query = "INSERT INTO roles(user_id , status) VALUES(:user_id , :status)";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([
                    ":user_id" => $user->id,
                    ":status" => $user->role
                ]);
            } else {
                throw new InvalidArgumentException("This user already exists");
            }
        } catch (PDOException $error) {
            throw new RuntimeException("Database error. Please try again later.");
        }
    }
}
