<?php

namespace Modele\Entity;

use InvalidArgumentException;

class User
{
    private $id;
    private $userName;
    private $password;
    private $email;
    private $imageUrl;
    private $role;
    private $statut;

    public function __construct($userName, $password, $email, $imageUrl, $role = 'user', $statut = "pending")
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->role = $role;
        $this->statut = $statut;
        $this->email = $email;
        $this->imageUrl= $imageUrl;
    }
<<<<<<< HEAD
   
   public function getId(){
    return $this->id;
   }
   public function getRole(){
    return $this->role;
   }
    public function getUserName(){
        return $this->userName;
=======

    public function getImgUrl() {
        return $this->imageUrl;
    }

    public function getId()
    {
        return $this->id;
>>>>>>> 3c8b4d6a3bf629f2737d5e8f380ccc36d8c36c58
    }
   public function getPassword(){
      return $this->password;
   }
    public function getEmail()
    {
        return $this->email;
    }

<<<<<<< HEAD
    public function setUserName($value){
        $this->userName = $value;
=======
    public function getName()
    {
        return $this->userName;
>>>>>>> 3c8b4d6a3bf629f2737d5e8f380ccc36d8c36c58
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function gdetRole()
    {
        return $this->role;
    }


    public function setId($id)
    {
        if ($id > 0) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException('id doit etre positive');
        }
    }
}
