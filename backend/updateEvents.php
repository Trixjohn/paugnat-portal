<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../app/models/Database.php';
require_once __DIR__ . '/../app/models/Events.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['eventName']) ? trim($_POST['eventName']) : '';
$date = isset($_POST['eventDate']) ? trim($_POST['eventDate']) : '';

if ($name === '' || $date === '') {
    echo json_encode(['success' => false, 'message' => 'Missing data']);
    exit;
}

$events = new Events();
$eventId = $events->saveEvent($id, $name, $date);

echo json_encode([
    'success' => true,
    'message' => $id > 0 ? 'Event updated successfully' : 'Event created successfully',
    'id' => $eventId
]);
exit;


?>