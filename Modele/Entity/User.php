<?php
namespace Modele\Entity;
use InvalidArgumentException;

class User{
    private $id;
    private $userName;
    private $password;
    private $email;
    private $role;
    private $statut;
    
    public function __construct($userName , $password, $email,$role = 'user', $statut = "pending")
    {
       $this->userName = $userName;
       $this->password = $password;
       $this->role = $role;
       $this->statut = $statut;
       $this->email = $email;
    }
   
   public function getId(){
    return $this->id;
   }
   public function getRole(){
    return $this->role;
   }
    public function getUserName(){
        return $this->userName;
    }
   public function getPassword(){
      return $this->password;
   }
    public function getEmail()
    {
        return $this->email;
    }

    public function setUserName($value){
        $this->userName = $value;
    }

    public function setId($id){
        if($id > 0){
            $this->id = $id;
        }else{
            throw new InvalidArgumentException('id doit etre positive');
        }
    }
}