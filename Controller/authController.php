<?php
include './database/DataBaseConnection.php';

class AuthController {
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }
  public function Login ($email , $password){
    $sql = "
        SELECT 
            u.id,
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

    if(!$user){
        return false;
    }

    if(password_verify($password, $user->password)){
       unset($user->password);
       return $user;
  
        
    }

        throw new InvalidArgumentException("password inccorect");
        
        return false;
}
}
