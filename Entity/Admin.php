<?php
include 'User.php';

class Admin extends User {
   public function getRole()
   {
    return "admin";
   }
   public function canMange(){
    return true;
   }
}

