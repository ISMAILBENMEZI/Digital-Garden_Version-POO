<?php

namespace Modele\Entity;

include 'User.php';

class Garden extends User {
    private $status;
    public function getRole()
    {
       return 'User';
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    

}