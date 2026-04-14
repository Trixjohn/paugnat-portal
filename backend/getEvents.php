<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../app/models/Database.php';

$db = Database::getInstance()->getConnection();
$db->query("CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL
)");

$result = $db->query("SELECT id, event_name, event_date FROM events ORDER BY event_date ASC");
$events = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);
?>