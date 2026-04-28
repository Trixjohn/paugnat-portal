<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "paugnatDb";

        $this->conn = new mysqli($host, $user, $password);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->conn->query("CREATE DATABASE IF NOT EXISTS `$database`");

        $this->conn->select_db($database);
        $this->conn->set_charset("utf8mb4");
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>