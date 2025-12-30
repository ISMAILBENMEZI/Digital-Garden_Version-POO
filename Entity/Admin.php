<?php
include 'User.php';

class Admin extends User {
   public function getRole()
   {
    return "Admin";
   }
   public function canMange(){
    return true;
   }
}

