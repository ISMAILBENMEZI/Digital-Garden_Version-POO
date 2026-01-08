<?php
class AuthController {
    private AuthService $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->authService->login($_POST['email'], $_POST['password']);
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

    public function register() {
        if (isset($_POST['createAccount'])) {
        
        $userName = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmpassword = $_POST['confirmPassword'];

        try {
            $this->authService->register($userName, $email, $password ,$confirmpassword);
           header('Location: ../view/public/accountPending.php'); 
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    

    require  '/includes/header.php';
    require '/views/auth/register.php';
    require '/includes/footer.php';
        

    }
}
}

