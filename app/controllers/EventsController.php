<?php

/**
 * EventsController
 * Handles loading of events page data
 * Fetches events and their related images from database
 */

require_once __DIR__ . '/../models/Database.php';

class EventsController {

    /**
     * Displays events page with event data
     */
    public function index() {

        // Start session safely
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is admin (used in view)
        $isAdmin = isset($_SESSION["admin_id"]);

        // Get database connection
        $db = Database::getInstance()->getConnection();

        /**
         * Fetch all events ordered by date
         */
        $result = $db->query("SELECT * FROM events ORDER BY eventDate ASC");

        $events = [];

        /**
         * Process each event row
         */
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                /**
                 * Fetch event images for this event
                 */
                $imgResult = $db->query(
                    "SELECT imagePath FROM eventImages WHERE eventId = " . intval($row['id'])
                );

                $row['images'] = [];

                if ($imgResult) {
                    while ($img = $imgResult->fetch_assoc()) {
                        $row['images'][] = $img['imagePath'];
                    }
                }

                /**
                 * Fallback:
                 * Use single imagePath if no related images exist
                 */
                if (empty($row['images']) && !empty($row['imagePath'])) {
                    $row['images'][] = $row['imagePath'];
                }

                $events[] = $row;
            }
        }

        /**
         * Load events view
         */
        include __DIR__ . '/../views/events.php';
    }
}

?>