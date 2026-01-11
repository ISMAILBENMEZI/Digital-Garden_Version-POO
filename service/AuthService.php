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

    public function login(User $user)
    {
        $userFind = $this->userRepo->findByEmail($user);
       
    
        if (!$userFind || !password_verify($user->getPassword(), $userFind->getPassword())) {
            throw new Exception("Email or password incorrect");
        }
        
        
        
        return $userFind;
    }

    public function register(User $user)
    {
        try {
            $FindUser = $this->userRepo->findByEmail($user);
          
        if (!$FindUser) 
            return $this->userRepo->addUser($user);
        return false;
        } catch (\Throwable $th) {
            echo $th;
        }
        
    }
}
