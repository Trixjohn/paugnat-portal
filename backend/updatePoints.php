<?php

/**
 * Return JSON response for frontend consumption
 * Ensures output is readable by JavaScript fetch()
 */
header("Content-Type: application/json");

/**
 * Load Colleges model
 */
require_once __DIR__ . '/../app/models/Colleges.php';

try {

    /**
     * Retrieve and sanitize input data
     * - id: college identifier
     * - points: points to add/subtract
     */
    $id = intval($_POST["id"] ?? 0);
    $points = intval($_POST["points"] ?? 0);

    /**
     * Validate input
     * Prevent invalid or empty updates
     */
    if ($id <= 0 || $points === 0) {

        echo json_encode([
            "success" => false,
            "message" => "Invalid input"
        ]);

        exit();
    }

    /**
     * Initialize Colleges model
     */
    $model = new Colleges();

    /**
     * Update college points in database
     */
    $ok = $model->updatePoints($id, $points);

    /**
     * Return operation result
     */
    echo json_encode([
        "success" => $ok,
        "message" => $ok ? "Points updated" : "Update failed"
    ]);

} catch (Throwable $e) {

    /**
     * Handle unexpected server errors
     */
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}