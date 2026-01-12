<?php

namespace service;

use Modele\Entity\User;
use Modele\Repository\UserRepository;

class AuthService
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function login(User $user)
    {
        $founduser = $this->userRepo->findByEmail($user);

        if ($founduser && password_verify($user->getPassword(), $founduser->password)) {
            return $founduser;
        }
        return false;
    }

    public function register(User $user)
    {

        $FindUser = $this->userRepo->findByEmail($user);

        if (!$FindUser)
            return $this->userRepo->addUser($user);
        return false;
    }
}
