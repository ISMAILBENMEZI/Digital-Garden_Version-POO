<?php
session_start();

require_once './Controller/AuthController.php';
require_once './database/DataBaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $errors = [];

    if ($email === '' || $password === '') {
        $errors[] = "Tous les champs sont obligatoires.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        exit;
    }

    $db = new DataBaseConnection();
    $auth = new AuthController($db);

    $user = $auth->login($email, $password);

    if (!$user) {
        $_SESSION['errors'] = ["Email ou mot de passe incorrect."];
        header('Location: login.php');
        exit;
    }

   
    
    $_SESSION['user'] = [
        'id' => $user->id,
        'email' => $user->email
    ];

    header('Location: dashboard.php');
    exit;
}


