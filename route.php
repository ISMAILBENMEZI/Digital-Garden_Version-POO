<?php

if(isset($_POST['createAccount'])){
    header('Location: Controller/authController.php');
    exit;
}