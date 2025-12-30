<?php

 abstract class User {
    protected $id;
    protected $username;
    protected $password;
    protected $roles = [];
    
    public function __construct($username , $password)
    {
       $this->username = $username;
       $this->password = $password;
    }

    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }

    public function setId($id){
        if($id > 0){
            $this->id = $id;
        }else{
            throw new InvalidArgumentException('id doit etre positive');
        }
    }
    public function ADRoles(){
        
    }
}
    