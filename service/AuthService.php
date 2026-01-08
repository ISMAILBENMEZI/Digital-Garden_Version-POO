<?php

namespace service;

use Modele\Entity\User;
use Modele\Repository\UserRepository;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class AuthService
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    // public function login(string $email, string $password)
    // {
    //     $user = $this->userRepo->findByEmail($email);
    //     if (!$user || !password_verify($password, $user->password)) {
    //         throw new Exception("Email or password incorrect");
    //     }
    //     $_SESSION['user'] = $user;
    // }

    public function register(User $user)
    {

        $FindUser = $this->userRepo->findByEmail($user);

        if (!$FindUser) 
            return $this->userRepo->addUser($user);
        return false;
    }
}
