<?php

require_once __DIR__ . '/Database.php';

class Colleges {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        // Ensure table exists
        $this->ensureTableExists();

        $sql = "SELECT id, name, points FROM colleges ORDER BY points DESC, name ASC";
        $result = $this->db->query($sql);
        $colleges = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $colleges[] = $row;
            }
        }
        return $colleges;
    }

    private function ensureTableExists() {
        $sql = "CREATE TABLE IF NOT EXISTS colleges (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL UNIQUE,
            points INT DEFAULT 0
        )";
        $this->db->query($sql);

        // Insert default data if empty
        $check = $this->db->query("SELECT COUNT(*) as count FROM colleges");
        if ($check && $check->fetch_assoc()['count'] == 0) {
            $this->db->query("INSERT INTO colleges (name, points) VALUES
('College of Engineering', 150),
('College of Science', 120),
('College of Business', 100),
('College of Education', 90),
('College of Arts', 80)");
        }
    }

    public function updatePoints($id, $points) {
        $stmt = $this->db->prepare("UPDATE colleges SET points = points + ? WHERE id = ?");
        $stmt->bind_param("ii", $points, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}

?>