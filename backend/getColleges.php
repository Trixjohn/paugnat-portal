<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../app/models/Colleges.php';

try {
    $collegesModel = new Colleges();
    $colleges = $collegesModel->getAll();
    echo json_encode($colleges);
} catch (Throwable $e) {
    echo json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>