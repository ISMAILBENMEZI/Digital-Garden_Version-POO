<?php
session_start();
require_once './database/DataBaseConnection.php';
require './Repository/UserRepository.php';
require_once './Controller/AuthController.php';


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
        header('Location: public/login.php');
        exit;
    }

    $db = DataBaseConnection::getConnection();
    $auth = new AuthController($db);

    $user = $auth->login($email, $password);

    if (!$user) {
        $_SESSION['errors'] = ["Email ou mot de passe incorrect."];
        header('Location: public/login.php');
        exit;
    }

   
    
    $_SESSION['user'] = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->role
    ];
    
    if ($user->statut === "pending") {
        header('Location: public/accountPending.php');
        exit;
    } else if ($user->role === 'user') {
        header('Location: public/userDashboard.php');
        exit;
    } else {
        header('Location: ./public/dashboard.php');
        exit;
    }
}
