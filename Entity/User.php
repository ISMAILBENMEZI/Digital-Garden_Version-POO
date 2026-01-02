<?php

abstract class User{
    protected $id;
    protected $userName;
    protected $password;
    protected $email;
    protected $statut;
    protected $role;
    
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
    
    abstract public function getRole();
}
    