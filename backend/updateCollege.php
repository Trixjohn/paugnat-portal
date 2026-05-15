<?php

/**
 * Return JSON response for frontend fetch()
 */
header("Content-Type: application/json");

/**
 * Load Colleges model
 */
require_once __DIR__ . '/../app/models/Colleges.php';

try {

    /**
     * Initialize model
     */
    $model = new Colleges();

    /**
     * Get college ID (REQUIRED for update)
     */
    $id = intval($_POST["id"] ?? 0);

    /**
     * Validate ID
     * Prevent updating without selecting a college
     */
    if ($id <= 0) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid college ID"
        ]);
        exit();
    }

    /**
     * Collect updated data
     */
    $data = [
        "name" => $_POST["name"] ?? "",
        "code" => $_POST["code"] ?? "",
        "description" => $_POST["description"] ?? "",
        "deanName" => $_POST["deanName"] ?? "",
        "email" => $_POST["email"] ?? "",
        "phone" => $_POST["phone"] ?? "",
        "building" => $_POST["building"] ?? "",
        "establishedYear" => $_POST["establishedYear"] ?? null,
        "points" => intval($_POST["points"] ?? 0),
        "status" => $_POST["status"] ?? "active"
    ];

    /**
     * Call update function in model
     */
    $result = $model->updateCollege($id, $data);

    /**
     * Return response
     */
    echo json_encode([
        "success" => $result,
        "message" => $result ? "College updated successfully" : "Failed to update college"
    ]);

} catch (Throwable $e) {

    /**
     * Catch server errors
     */
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}