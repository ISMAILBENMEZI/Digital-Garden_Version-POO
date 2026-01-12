<?php

namespace Controller;

use Modele\Entity\User;
use service\adminService;

class adminController
{

    private adminService $adminService;

    public function __construct()
    {
        $this->adminService = new adminService();
    }

    public function getAllUsers()
    {
        $user = new User(
            userName: null,
            password: null,
            email: null,
            imageUrl: null
        );
        $users = $this->adminService->getAllUsers($user);
        if ($users) {
            $_SESSION['users'] = $users;
            return true;
        }
        return false;
    }

    public function updateStaut()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id =    $_POST['user_id'];
            $statut = $_POST['statut'];
            $allowed = ['pending', 'active', 'blocked'];
            $user = new User(
                userName: null,
                password: null,
                email: null,
                imageUrl: null,
                id: $id,
                role: "user",
                statut: $statut
            );
            if (in_array($statut, $allowed)) {
                $result = $this->adminService->updateStatut($user);
                if ($result) {
                    $_SESSION['success'] = 'update statut successfull';
                    return true;
                }
                $_SESSION['error'] = 'error. Please try again later.';
                return false;
            }
        }
    }
}
