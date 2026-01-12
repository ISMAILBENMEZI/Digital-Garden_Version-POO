<?php

namespace Controller;

use service\AuthService;
use Exception;
use InvalidArgumentException;
use Modele\Entity\User;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ((empty($email) || empty($password)))
                throw new InvalidArgumentException("Please fill in all required fields.");

            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                throw new InvalidArgumentException("Invalid email format");

            if (strlen($password) < 8)
                throw new InvalidArgumentException("Password must be at least 8 characters long.");


            $user = new User(
                userName: null,
                password: $password,
                email: $email,
                imageUrl: null
            );
            try {
                $userResult = $this->authService->login($user);
                if ($userResult) {
                    $_SESSION['user'] = $userResult;
                    $_SESSION['success'] = "Welcome back " . $_SESSION['user']->name;
                    if ($userResult->statut === "pending")
                        return "pending";
                    elseif ($userResult->statut === "blocked")
                        return "blocked";
                    elseif ($userResult->statut === "active") {
                        if ($userResult->role_id == 1) return "user"; 
                        if ($userResult->role_id == 2) return "admin";
                        if ($userResult->role_id == 3) return "Moderator";
                    } else
                        $_SESSION['error'] = 'error. Please try again later.';
                }
                $_SESSION['error'] = 'Email or password incorrect';
                return false;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createAccount'])) {

            $userName = trim($_POST['userName'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $imageUrl = $_POST['image_url'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmpassword = $_POST['confirmPassword'] ?? '';

            if (empty($userName) || empty($email) || empty($imageUrl) || empty($password) || empty($confirmpassword))
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
                $email,
                $imageUrl
            );

            try {
                $CreatedUser =  $this->authService->register($user);
                if ($CreatedUser) {
                    $_SESSION['user'] = $CreatedUser;
                    $_SESSION['success'] = "Account created successfully";
                    header('Location: /Digital-Garden_Version-POO/view/public/accountPending.php');
                    exit;

                    // header("Location: /Digital-Garden_Version-POO/UserDashboard");
                    // exit;
                }
                $_SESSION['error'] = 'This user already exists';
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }
        }
    }
}
