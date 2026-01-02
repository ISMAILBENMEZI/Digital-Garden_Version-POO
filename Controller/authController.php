<?php
include './database/DataBaseConnection.php';

class AuthController {
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }
  public function Login ($email , $password){
    $sql = "select email , password from user where email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
     ":email" => $email
    ]);
    
  
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    if(!$user){
        return false;
    }
    if(!(password_verify($user->password , $password))){
        return false;
    }
    return $user;
  }
}

$db = new DataBaseConnection();


$auth = new AuthController($db);

$user = $auth->Login("oussama@gmail." ,"11111");

if($user) {
    echo 'ok';
}else {
   echo 'error';
}
