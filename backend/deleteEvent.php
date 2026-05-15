<?php

/**
 * Return all responses as JSON
 * Prevents browser from treating output as HTML
 */
header('Content-Type: application/json');

/**
 * Hide PHP errors from direct browser output
 * Prevents malformed JSON responses
 */
ini_set('display_errors', 0);
error_reporting(0);

try {

    /**
     * Load required models
     */
    require_once __DIR__ . '/../app/models/Database.php';
    require_once __DIR__ . '/../app/models/Events.php';

    /**
     * Allow only POST requests
     * Prevents direct URL access using GET
     */
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        echo json_encode([
            'success' => false,
            'message' => 'Invalid request method'
        ]);

        exit;
    }

    /**
     * Get event ID from submitted form data
     * Default value is 0 if ID is missing
     */
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    /**
     * Validate event ID
     * Event ID must be greater than 0
     */
    if ($id <= 0) {

        echo json_encode([
            'success' => false,
            'message' => 'Invalid event ID'
        ]);

        exit;
    }

    /**
     * Initialize Events model
     */
    $events = new Events();

    /**
     * Attempt to delete the selected event
     */
    $success = $events->deleteEvent($id);

    /**
     * Return operation result to frontend
     */
    echo json_encode([
        'success' => $success,
        'message' => $success
            ? 'Event deleted.'
            : 'Failed to delete event.'
    ]);

} catch (Throwable $e) {

    /**
     * Catch unexpected server-side errors
     */
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}