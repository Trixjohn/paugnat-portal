<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "paugnat_db2";

        // First connect without database
        $this->conn = new mysqli($host, $user, $password);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Create database if not exists
        $this->conn->query("CREATE DATABASE IF NOT EXISTS $database");

        // Now connect to the database
        $this->conn->close();
        $this->conn = new mysqli($host, $user, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection to database failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>