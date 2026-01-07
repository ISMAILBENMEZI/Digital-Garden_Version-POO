<?php

class DataBaseConnection{
   private static $conn;
   private static $host = "localhost";
   private static $user = "root";
   private static $db = "DIGITAL_GARDEN";
   private static $pass = "";
   
   private function __clone(){}
   private function __construct(){}

   public static function getConnection(){
      if(self::$conn == null){
         self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db , self::$user, self::$pass,[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
      }
    return self::$conn;
   }
}
