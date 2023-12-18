<?php

require_once 'config.php';

class Database {
    private $conn;
    public function __construct() {
        // The global keyword in PHP is used to bring a variable declared
        // outside of a function into the function's scope

        global $host, $username, $password, $database;

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function __destruct() {
        $this->conn = null;
    }
}
