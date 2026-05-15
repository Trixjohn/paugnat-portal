<?php

/**
 * API response header for frontend fetch()
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
     * Collect POST data safely
     * These match your table columns
     */
    $data = [
        "name" => $_POST["name"] ?? "",
        "code" => $_POST["code"] ?? "",
        "description" => $_POST["description"] ?? "",
        "deanName" => $_POST["deanName"] ?? "",
        "email" => $_POST["email"] ?? "",
        "phone" => $_POST["phone"] ?? "",
        "building" => $_POST["building"] ?? "",
        "establishedYear" => intval($_POST["establishedYear"] ?? 0),
        "points" => intval($_POST["points"] ?? 0),
        "status" => $_POST["status"] ?? "active"
    ];

    /**
     * Call model function
     */
    $result = $model->createCollege($data);

    /**
     * Return JSON response
     */
    echo json_encode([
        "success" => $result,
        "message" => $result ? "College created successfully" : "Failed to create college"
    ]);

} catch (Throwable $e) {

    /**
     * Debug-safe error response
     */
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}