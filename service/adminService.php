<?php

namespace service;

use Modele\Entity\User;
use Modele\Repository\UserRepository;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class adminService
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function getAllUsers(User $user)
    {
        $FindUsers = $this->userRepo->getAllUsers($user);

        if (!$FindUsers)
            return false;
        return $FindUsers;
    }

    public function updateStatut(User $user)
    {
        $FindUsers = $this->userRepo->updateStatut($user);

        if ($FindUsers)
            return $FindUsers;
        return false;
    }
}
