<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../app/models/Colleges.php';

try {
    $id = intval($_POST["id"] ?? 0);

    if ($id <= 0) {
        echo json_encode(["success" => false, "message" => "No college selected."]);
        exit();
    }

    $model = new Colleges();
    $ok = $model->deleteCollege($id);

    echo json_encode([
        "success" => $ok,
        "message" => $ok ? "College deleted successfully." : "College not found or already deleted."
    ]);

} catch (Throwable $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
