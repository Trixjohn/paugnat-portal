<?php

class Events {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllEvents() {
        $result = $this->db->query("
            SELECT 
                id,
                eventName,
                description,
                eventType,
                eventDate,
                startTime,
                endTime,
                location,
                status,
                maxParticipants,
                imagePath
            FROM events 
            ORDER BY eventDate ASC
        ");

        $events = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }

        return $events;
    }

    public function saveEvent($id, $name, $description, $type, $date, $startTime, $endTime, $location, $status, $maxParticipants, $imagePath) {

        if ($id > 0) {
            // UPDATE
            $stmt = $this->db->prepare("
                UPDATE events 
                SET eventName = ?, description = ?, eventType = ?, eventDate = ?, 
                    startTime = ?, endTime = ?, location = ?, status = ?, 
                    maxParticipants = ?, imagePath = ?
                WHERE id = ?
            ");

            $stmt->bind_param(
                "ssssssssisi",
                $name,
                $description,
                $type,
                $date,
                $startTime,
                $endTime,
                $location,
                $status,
                $maxParticipants,
                $imagePath,
                $id
            );

        } else {
            // INSERT
            $stmt = $this->db->prepare("
                INSERT INTO events 
                (eventName, description, eventType, eventDate, startTime, endTime, location, status, maxParticipants, imagePath)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "ssssssssis",
                $name,
                $description,
                $type,
                $date,
                $startTime,
                $endTime,
                $location,
                $status,
                $maxParticipants,
                $imagePath
            );
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