<?php

/**
 * Return all responses as JSON
 * Allows frontend JavaScript to properly process event data
 */
header('Content-Type: application/json');

/**
 * Load required models
 */
require_once __DIR__ . '/../app/models/Database.php';
require_once __DIR__ . '/../app/models/Events.php';

/**
 * Initialize Events model
 */
$events = new Events();

/**
 * Retrieve all events from database
 */
$data = $events->getAllEvents();

/**
 * Return events data as JSON response
 */
echo json_encode($data);

?>