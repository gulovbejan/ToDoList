<?php

class ConnectDb {
    // Hold the class instance.
    private static $instance = null;
    private $conn;
    
    // Database configuration
    private $host = 'MySQL-5.7';
    private $user = 'root'; 
    private $pass = ''; 
    private $name = 'db_todo_list'; 
    private $port = '3306';

    // Private constructor to prevent multiple instances
    private function __construct() 
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->name}", $this->user, $this->pass, [
              
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]);
        } catch (PDOException $e) {
            // Handle connection error
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    // Public method to get the instance of the class
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ConnectDb();
        }
     
        return self::$instance;
    }
    
    // Method to get the PDO connection
    public function getConnection() {
        return $this->conn;
    }
}

// Usage example:
$db = ConnectDb::getInstance();
$conn = $db->getConnection();
?>
