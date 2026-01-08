<?php
session_start();

use Modele\Repository\UserRepository;


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$userRepo = new UserRepository();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int) $_POST['user_id'];
    $newStatut = $_POST['statut'];

    $allowed = ['pending', 'active', 'blocked'];
    if (in_array($newStatut, $allowed)) {
        $userRepo->updateStatut($userId, $newStatut);
        $_SESSION['message'] = 'update statut successfull';
    }

    header('Location: dashboard.php');
    exit;
}

$users = $userRepo->getAllUsers();
