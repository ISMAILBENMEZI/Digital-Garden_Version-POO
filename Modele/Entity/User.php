<?php
namespace User;
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

    public function __get($property){
        return $this->$property;
    }


    public function setId($id){
        if($id > 0){
            $this->id = $id;
        }else{
            throw new InvalidArgumentException('id doit etre positive');
        }
    }
}