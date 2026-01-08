<?php
session_start();
use Modele\Repository\UserRepository;
use Modele\Entity\User;

if (isset($_POST['createAccount'])) {
    try {
        $userName = trim($_POST['userName']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirmpassword = trim($_POST['confirmPassword']);

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

        
            $repo = new UserRepository();

            $repo->addUser($user);
            $_SESSION['success'] = "Account created successfully";
            $_SESSION['userName'] = $userName;

            header("location:../public/accountPending.php");
            exit();
        } else {
            throw new InvalidArgumentException("Passwords do not match. Please try again.");
        }
    } catch (RuntimeException $error) {
        $errorMessage = $error->getMessage();
        echo $error;
    }
}
