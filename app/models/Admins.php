<?php

require_once __DIR__ . '/Database.php';

class Admins {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function authenticate($username, $password) {
        $this->ensureTableExists();

        $stmt = $this->db->prepare("SELECT id, username, password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin["password"])) {
                return $admin;
            }
        }
        return false;
    }

    private function ensureTableExists() {
        $sql = "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )";
        if (!$this->db->query($sql)) {
            die("Failed to create admins table: " . $this->db->error);
        }

        // Insert default admin if not exists
        $check = $this->db->query("SELECT COUNT(*) as count FROM admins WHERE username = 'admin'");
        if ($check && $check->fetch_assoc()['count'] == 0) {
            $hashedPassword = password_hash('admin', PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            if (!$stmt) {
                die("Prepare failed: " . $this->db->error);
            }
            $username = 'admin';
            $stmt->bind_param("ss", $username, $hashedPassword);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
            $stmt->close();
        }
    }
}

?>