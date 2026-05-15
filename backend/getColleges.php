<?php

/**
 * Return all responses as JSON
 * Allows frontend JavaScript to properly parse data
 */
header("Content-Type: application/json");

/**
 * Load Colleges model
 */
require_once __DIR__ . '/../app/models/Colleges.php';

try {

    /**
     * Initialize Colleges model
     */
    $collegesModel = new Colleges();

    /**
     * Retrieve all colleges from database
     */
    $colleges = $collegesModel->getAllColleges();

    /**
     * Return colleges data as JSON response
     */
    echo json_encode($colleges);

} catch (Throwable $e) {

    /**
     * Return error response if something fails
     */
    echo json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>