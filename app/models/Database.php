<?php

/**
 * Class Database
 * Singleton pattern for managing a single database connection
 */
class Database
{
    /** @var Database|null Singleton instance */
    private static $instance = null;

    /** @var mysqli Database connection */
    private $conn;

    /**
     * Private constructor
     * Prevents direct instantiation and initializes DB connection
     */
    private function __construct()
    {
        // Database credentials
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "paugnatDb";

        // Create MySQL connection (initial connection without DB selected yet)
        $this->conn = new mysqli($host, $user, $password);

        // Check connection error
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Create database if it doesn't exist
        $this->conn->query("CREATE DATABASE IF NOT EXISTS `$database`");

        // Select the database for use
        $this->conn->select_db($database);

        // Set proper character encoding
        $this->conn->set_charset("utf8mb4");
    }

    /**
     * Get singleton instance of Database
     *
     * @return Database
     */
    public static function getInstance()
    {
        // Create instance only if it doesn't exist yet
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    /**
     * Get active database connection
     *
     * @return mysqli
     */
    public function getConnection()
    {
        return $this->conn;
    }
}

?>