<?php

include 'User.php';

class Garden extends User {
    private $status;
    public function getRole()
    {
       return 'user';
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    

}