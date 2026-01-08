<?php

class AuthService {
    public UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function login(string $email, string $password) {
        $user = $this->userRepo->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            throw new Exception("Email or password incorrect");
        }
        $_SESSION['user'] = $user;
    }
    public function register($userName, $email, $password ,$confirmpassword){
      try {
        
        if (empty($userName) || empty($email) || empty($password) || empty($confirmpassword))
            throw new InvalidArgumentException("Please fill in all required fields.");

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new InvalidArgumentException("Invalid email format");

        if ($password === $confirmpassword) {
            
            $passwordH = password_hash($password, PASSWORD_DEFAULT);

            $user = new User(
                userName: $userName,
                password: $passwordH,
                email: $email
            );

            $this->userRepo->addUser($user);
            $_SESSION['success'] = "Account created successfully";
            $_SESSION['userName'] = $userName;
            
        } else {
            throw new InvalidArgumentException("Passwords do not match. Please try again.");
        }
    } catch (RuntimeException $error) {
        $errorMessage = $error->getMessage();
        echo $error;
    }
}
    }
