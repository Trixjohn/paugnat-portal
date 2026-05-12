<?php

/**
 * Return JSON response for frontend (fetch API)
 * Ensures consistent API output format
 */
header("Content-Type: application/json");

/**
 * Load Colleges model (handles DB operations)
 */
require_once __DIR__ . '/../app/models/Colleges.php';

try {

    /**
     * Initialize Colleges model
     */
    $model = new Colleges();

    /**
     * Retrieve college ID from POST request
     * This is required for delete operation
     */
    $id = intval($_POST["id"] ?? 0);

    /**
     * Validate ID
     * Prevents accidental or empty delete requests
     */
    if ($id <= 0) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid college ID"
        ]);
        exit();
    }


    /**
     *  Delete college record from database
     */
    $result = $model->deleteCollege($id);

    /**
     * Return operation result to frontend
     */
    echo json_encode([
        "success" => $result,
        "message" => $result ? "College deleted successfully" : "Failed to delete college"
    ]);

} catch (Throwable $e) {

    /**
     * Catch unexpected server/database errors
     * Useful for debugging during development
     */
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}