<?php

namespace service;
use Modele\Entity\User; 
use Modele\Repository\UserRepository;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class AuthService {
    public UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function login(User $user) {
        $userV = $this->userRepo->findByEmail($user);
        if (!$userV || !password_verify($userV->getPassword(), $user->getPassword())) {
            throw new Exception("Email or password incorrect");
        }
    }

    public function register($userName, $email, $password ,$confirmpassword){
      
        if (empty($userName) || empty($email) || empty($password) || empty($confirmpassword))
            throw new InvalidArgumentException("Please fill in all required fields.");

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new InvalidArgumentException("Invalid email format");

        if ($password !== $confirmpassword) {
             throw new InvalidArgumentException("Passwords do not match.");
        }

        $passwordH = password_hash($password, PASSWORD_DEFAULT);

        $user = new User(
             $userName, 
             $passwordH,
             $email
        );
    
        $this->userRepo->addUser($user);
        
        $_SESSION['success'] = "Account created successfully";
        $_SESSION['userName'] = $userName;
    }
}