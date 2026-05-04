<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../app/models/Database.php';
require_once __DIR__ . '/../app/models/Events.php';

$events = new Events();
$data = $events->getAllEvents();

echo json_encode($data);
?>