<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../app/models/Database.php';
require_once __DIR__ . '/../app/models/Events.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid event ID']);
    exit;
}

$events = new Events();
$success = $events->deleteEvent($id);

echo json_encode([
    'success' => $success,
    'message' => $success ? 'Event deleted.' : 'Failed to delete event.'
]);
?>