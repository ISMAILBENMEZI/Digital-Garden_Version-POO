<?php
session_start();

require_once '../database/DataBaseConnection.php';
require_once '../Repository/UserRepository.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$db = new DataBaseConnection();


$userRepo = new UserRepository($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int) $_POST['user_id'];
    $newStatut = $_POST['statut'];

    $allowed = ['pending', 'active', 'blocked'];
    if (in_array($newStatut, $allowed)) {
        $userRepo->updateStatut($userId, $newStatut);
    }

    header('Location: dashboard.php');
    exit;
}

$users = $userRepo->getAllUsers();
