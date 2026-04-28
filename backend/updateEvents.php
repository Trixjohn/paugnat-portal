<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../app/models/Database.php';

$db = Database::getInstance()->getConnection();
$db->query("CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL
)");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$event_name = isset($_POST['event_name']) ? trim($_POST['event_name']) : '';
$event_date = isset($_POST['event_date']) ? trim($_POST['event_date']) : '';

if ($event_name === '' || $event_date === '') {
    echo json_encode(['success' => false, 'message' => 'Please provide event name and date.']);
    exit;
}

if ($id > 0) {
    $stmt = $db->prepare('UPDATE events SET eventName = ?, eventDate = ? WHERE id = ?');
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $db->error]);
        exit;
    }
    $stmt->bind_param('ssi', $event_name, $event_date, $id);
    $stmt->execute();
    $success = $stmt->affected_rows >= 0;
    $stmt->close();
    $message = $success ? 'Event updated successfully.' : 'No changes were made.';
} else {
    $stmt = $db->prepare('INSERT INTO events (eventName, eventDate) VALUES (?, ?)');
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $db->error]);
        exit;
    }
    $stmt->bind_param('ss', $event_name, $event_date);
    $success = $stmt->execute();
    $message = $success ? 'Event created successfully.' : 'Failed to create event.';
    $stmt->close();
}

echo json_encode(['success' => $success, 'message' => $message]);
?>
