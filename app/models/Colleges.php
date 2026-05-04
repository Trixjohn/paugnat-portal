<?php

require_once __DIR__ . '/Database.php';

class Colleges {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllColleges() {

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


    public function updatePoints($id, $points) {
        $stmt = $this->db->prepare("UPDATE colleges SET points = points + ? WHERE id = ?");
        $stmt->bind_param("ii", $points, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function addCollege($name) {
        $stmt = $this->db->prepare("INSERT INTO colleges (name, points) VALUES (?, 0)");
        $stmt->bind_param("s", $name);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteCollege($id) {
        $stmt = $this->db->prepare("DELETE FROM colleges WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $affected = $this->db->affected_rows;
        $stmt->close();
        return $result && $affected > 0;
    }
}

?>