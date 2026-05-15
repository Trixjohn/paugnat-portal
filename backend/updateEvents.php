<?php

/**
 * Return all responses as JSON
 * Allows frontend JavaScript to properly process responses
 */
header('Content-Type: application/json');

/**
 * Hide PHP warnings/notices from breaking JSON responses
 */
error_reporting(0);

/**
 * Load required models
 */
require_once __DIR__ . '/../app/models/Database.php';
require_once __DIR__ . '/../app/models/Events.php';

/**
 * Allow only POST requests
 * Prevents direct browser access using GET
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);

    exit;
}

/**
 * Retrieve and sanitize form data
 */
$id                = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name              = isset($_POST['eventName']) ? trim($_POST['eventName']) : '';
$date              = isset($_POST['eventDate']) ? trim($_POST['eventDate']) : '';
$description       = isset($_POST['description']) ? trim($_POST['description']) : '';
$type              = isset($_POST['eventType']) ? trim($_POST['eventType']) : '';
$startTime         = isset($_POST['startTime']) ? trim($_POST['startTime']) : '';
$endTime           = isset($_POST['endTime']) ? trim($_POST['endTime']) : '';
$location          = isset($_POST['location']) ? trim($_POST['location']) : '';
$status            = isset($_POST['status']) ? trim($_POST['status']) : '';
$maxParticipants   = isset($_POST['maxParticipants'])
    ? intval($_POST['maxParticipants'])
    : 0;

/**
 * Default image path
 * Remains empty if no image is uploaded
 */
$imagePath = '';

/**
 * Handle event image upload
 */
if (
    isset($_FILES['eventImage']) &&
    $_FILES['eventImage']['error'] === UPLOAD_ERR_OK
) {

    /**
     * Generate unique image filename
     */
    $fileName = time() . '_' . basename($_FILES['eventImage']['name']);

    /**
     * Define upload destination
     */
    $target = __DIR__ . '/../images/events/' . $fileName;

    /**
     * Move uploaded file to target directory
     */
    move_uploaded_file($_FILES['eventImage']['tmp_name'], $target);

    /**
     * Store relative image path
     */
    $imagePath = 'images/events/' . $fileName;
}

/**
 * Validate required fields
 */
if ($name === '' || $date === '') {

    echo json_encode([
        'success' => false,
        'message' => 'Missing data'
    ]);

    exit;
}

/**
 * Initialize Events model
 */
$events = new Events();

/**
 * Save or update event
 */
$eventId = $events->saveEvent(
    $id,
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

/**
 * Insert new image to eventImage table
 */

if (!empty($imagePath)) {
    $events->saveEventImage($eventId, $imagePath);
}

/**
 * Return success response
 */
echo json_encode([
    'success' => true,
    'message' => $id > 0
        ? 'Event updated successfully'
        : 'Event created successfully',
    'id' => $eventId
]);

exit;

?>