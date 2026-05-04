<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../app/models/Colleges.php';

try {
    $name = trim($_POST["college_name"] ?? "");

    if ($name === "") {
        echo json_encode(["success" => false, "message" => "College name cannot be empty."]);
        exit();
    }

    $model = new Colleges();
    $ok = $model->addCollege($name);

    echo json_encode([
        "success" => $ok,
        "message" => $ok ? "College \"$name\" added successfully." : "Failed to add college. It may already exist."
    ]);

} catch (Throwable $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
