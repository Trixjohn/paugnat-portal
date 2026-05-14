<?php


/**
 * Class Events
 * Handles event CRUD operations (Create, Read, Update, Delete)
 */
class Events
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
     * Get all events ordered by date (ascending)
     *
     * @return array List of events
     */
    public function getAllEvents()
    {
        // Fetch all event records
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
                maxParticipants
            FROM events 
            ORDER BY eventDate ASC
        ");

        $events = [];

        // Convert result set into array
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }

        return $events;
    }

    /**
     * Create or update an event
     *
     * If ID exists → UPDATE
     * If ID is 0 → INSERT
     *
     * @return int Event ID (existing or newly created)
     */
    public function saveEvent(
        $id,
        $name,
        $description,
        $type,
        $date,
        $startTime,
        $endTime,
        $location,
        $status,
        $maxParticipants
    ) {

        if ($id > 0) {

            // UPDATE existing event
            $stmt = $this->db->prepare("
                UPDATE events 
                SET eventName = ?, description = ?, eventType = ?, eventDate = ?, 
                    startTime = ?, endTime = ?, location = ?, status = ?, 
                    maxParticipants = ?
                WHERE id = ?
            ");

            $stmt->bind_param(
                "sssssssssii",
                $name,
                $description,
                $type,
                $date,
                $startTime,
                $endTime,
                $location,
                $status,
                $maxParticipants,
                $id
            );

        } else {

            // INSERT new event
            $stmt = $this->db->prepare("
                INSERT INTO events 
                (eventName, description, eventType, eventDate, startTime, endTime, location, status, maxParticipants)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "ssssssssi",
                $name,
                $description,
                $type,
                $date,
                $startTime,
                $endTime,
                $location,
                $status,
                $maxParticipants
            );
        }

        // Execute query
        $stmt->execute();

        if ($stmt->error) {
                die($stmt->error);
        }

        // Get correct event ID
        $eventId = $id > 0 ? $id : $this->db->insert_id;

        $stmt->close();

        return $eventId;
    }

        public function saveEventImage($eventId, $imagePath)
    {
        $stmt = $this->db->prepare("
            INSERT INTO eventImages (eventId, imagePath)
            VALUES (?, ?)
        ");

        $stmt->bind_param("is", $eventId, $imagePath);

        $stmt->execute();

        $stmt->close();
    }

    /**
     * Delete event and its related images
     *
     * @param int $id Event ID
     * @return bool True if deletion successful
     */
    public function deleteEvent($id)
    {
        // Remove event images first
        $stmt = $this->db->prepare("DELETE FROM eventImages WHERE eventId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Delete event record
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}

?>