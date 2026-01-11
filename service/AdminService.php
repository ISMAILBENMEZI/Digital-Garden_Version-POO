<?php
use Modele\Repository\UserRepository;
class AdminService {
    private $userRepo;
    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }
    public function isAdmin(){
      if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        return false;
     }
     return true;
    }
    public function updateStatut($userId, $statut){
        $allowed = ['pending', 'active', 'blocked'];
    if (in_array($statut, $allowed)) {
        $this->userRepo->updateStatut($userId, $statut);
        
    }
    }

}