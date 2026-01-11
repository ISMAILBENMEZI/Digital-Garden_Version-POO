<?php

class adminController {
    private $adminService;
    public function __construct()
    {
       
        $this->adminService = new AdminService();
    }

public function checkRole(){
    $isAdmin = $this->adminService->isAdmin();
    if(!$isAdmin){
        header('Location: login.php');
        exit;
    }
    header('Location: dashboard.php');
    exit;
}

public function updateStatut(){
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int) $_POST['user_id'];
    $newStatut = $_POST['statut'];
    $this->adminService->updateStatut($userId , $newStatut);
    header('Location: dashboard.php');
    exit;
}
}
public function getAllUsers(){
   $users = $userRepo->getAllUsers();
}

}



