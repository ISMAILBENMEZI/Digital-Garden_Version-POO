<?php

include 'User.php';

class Garden extends User {
    public function getRole()
    {
       return 'User';
    }

}