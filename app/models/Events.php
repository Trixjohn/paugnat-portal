<?php

class Events {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllEvents() {
        $result = $this->db->query("SELECT id, eventName, eventDate FROM events ORDER BY eventDate ASC");

        $events = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }

        return $events;
    }

    public function saveEvent($id, $name, $date) {
        if ($id > 0) {
            $stmt = $this->db->prepare(
                "UPDATE events SET eventName = ?, eventDate = ? WHERE id = ?"
            );
            $stmt->bind_param("ssi", $name, $date, $id);
        } else {
            $stmt = $this->db->prepare(
                "INSERT INTO events (eventName, eventDate) VALUES (?, ?)"
            );
            $stmt->bind_param("ss", $name, $date);
        }

        $stmt->execute();
        $eventId = $id > 0 ? $id : $this->db->insert_id;
        $stmt->close();

        return $eventId;
    }

    public function deleteEvent($id) {
        $this->db->query("DELETE FROM eventImages WHERE eventId = $id");

        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>