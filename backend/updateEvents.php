<?php

header('Content-Type: application/json');
error_reporting(0);


require_once __DIR__ . '/../app/models/Database.php';
require_once __DIR__ . '/../app/models/Events.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['eventName']) ? trim($_POST['eventName']) : '';
$date = isset($_POST['eventDate']) ? trim($_POST['eventDate']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$type = isset($_POST['eventType']) ? trim($_POST['eventType']) : '';
$startTime = isset($_POST['startTime']) ? trim($_POST['startTime']) : '';
$endTime = isset($_POST['endTime']) ? trim($_POST['endTime']) : '';
$location = isset($_POST['location']) ? trim($_POST['location']) : '';
$status = isset($_POST['status']) ? trim($_POST['status']) : '';
$maxParticipants = isset($_POST['maxParticipants']) ? intval($_POST['maxParticipants']) : 0;
$imagePath = '';

if (isset($_FILES['eventImage']) && $_FILES['eventImage']['error'] === UPLOAD_ERR_OK) {
    $fileName = time() . '_' . basename($_FILES['eventImage']['name']);
    $target = __DIR__ . '/../images/events/' . $fileName;

    move_uploaded_file($_FILES['eventImage']['tmp_name'], $target);

    $imagePath = 'images/events/' . $fileName;
}

if ($name === '' || $date === '') {
    echo json_encode(['success' => false, 'message' => 'Missing data']);
    exit;
}

$events = new Events();

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

echo json_encode([
    'success' => true,
    'message' => $id > 0 ? 'Event updated successfully' : 'Event created successfully',
    'id' => $eventId
]);
exit;


?>