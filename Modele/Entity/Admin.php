<?php

namespace Modele\Entity;
use Modele\Entity\User;

class Admin extends User {
   public function getRole()
   {
    return "Admin";
   }
   public function setStatusUser(){
    return true;
   }
}

