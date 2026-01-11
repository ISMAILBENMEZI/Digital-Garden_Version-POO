<?php

namespace Controller;

use service\AuthService;
use Exception;
use InvalidArgumentException;
use Modele\Entity\User;
session_start();
class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login()
    {
        var_dump($_SERVER['REQUEST_METHOD']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $user = new User( "",$_POST['password'],$_POST['email']);
                $authUser = $this->authService->login($user);
                $_SESSION['user'] = [
                    'id' => $authUser->getId(),
                    'name' => $authUser->getUserName(),
                    'role' => $authUser->getRole(),
                ];
               
                if($authUser->getRole() === 'admin'){
                   header('Location: /Digital-Garden_Version-POO/view/public/dashboard.php');
                }else{
                    header('Location: /Digital-Garden_Version-POO/view/public/userDashboard.php');
                }
                
                exit;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // require '../includes/header.php';
        // require '../views/auth/login.php';
        // require '../includes/footer.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createAccount'])) {

            $userName = trim($_POST['userName'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmpassword = $_POST['confirmPassword'] ?? '';

            if (empty($userName) || empty($email) || empty($password) || empty($confirmpassword))
                throw new InvalidArgumentException("Please fill in all required fields.");

            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                throw new InvalidArgumentException("Invalid email format");

            if ($password !== $confirmpassword) {
                throw new InvalidArgumentException("Passwords do not match.");
            }

            if (strlen($password) < 8) {
                throw new InvalidArgumentException("Password must be at least 8 characters long.");
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $user = new User(
                $userName,
                $password,
                $email
            );

            try {
                $CreatedUser =  $this->authService->register($user);
                if ($CreatedUser) {
                    $_SESSION['user'] = $CreatedUser;
                    $_SESSION['success'] = "Account created successfully";
                    header('Location: /Digital-Garden_Version-POO/view/public/accountPending.php');
                    exit;
                }
               $_SESSION['error'] = 'This user already exists';
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }
        }
    }
}
