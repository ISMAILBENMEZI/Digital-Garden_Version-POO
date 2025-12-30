<?php

class DataBaseConnection{
   private $conn;
   private $host = "localhost";
   private $user = "root";
   private $db = "DIGITAL_GARDEN";
   private $pass = "";

   public function __construct()
   {
    $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db;", $this->user, $this->pass);
   }
   public function getConnection(){
    return $this->conn;
   }
}
