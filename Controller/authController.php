<?php

namespace Controller;
use service\AuthService;
use Exception;
use Modele\Entity\User;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(User $user)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->authService->login($user);
                header('Location: ../view/public/dashboard.php');
                exit;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require '../includes/header.php';
        require '../views/auth/login.php';
        require '../includes/footer.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_POST['createAccount'])) {

            $userName = trim($_POST['userName'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmpassword = $_POST['confirmPassword']?? '';

            try {
                $this->authService->register($userName, $email, $password, $confirmpassword);
                header('Location: /Digital-Garden_Version-POO/view/public/accountPending.php');
                exit;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }
        }
    }
}
