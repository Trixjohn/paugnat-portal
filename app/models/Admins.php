<?php

require_once __DIR__ . '/Database.php';

/**
 * Class Admins
 * Handles admin authentication logic
 */
class Admins
{
    /** @var mysqli $db Database connection instance */
    private $db;

    /**
     * Constructor
     * Initializes database connection
     */
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Authenticate admin user
     *
     * @param string $username
     * @param string $password
     * @return array|false Returns admin data if valid, otherwise false
     */
    public function authenticate($username, $password)
    {
        // Prepare query to safely fetch admin by username
        $stmt = $this->db->prepare("SELECT id, username, password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Get query result
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();

            // Verify password hash
            if (password_verify($password, $admin["password"])) {
                return $admin;
            }
        }

        // Authentication failed
        return false;
    }
}

?>