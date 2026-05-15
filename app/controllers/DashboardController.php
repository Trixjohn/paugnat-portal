<?php

/**
 * DashboardController
 * Handles access to admin dashboard page
 * Ensures only logged-in admins can view it
 */

require_once __DIR__ . '/../models/Colleges.php';

class DashboardController {

    /**
     * Displays dashboard page
     * Also checks if admin is authenticated
     */
    public function index() {

        // Start session for authentication check
        session_start();

        /**
         * Access control:
         * Redirect to login page if admin is not logged in
         */
        if (!isset($_SESSION["admin_id"])) {
            header("Location: login.php");
            exit();
        }

        /**
         * Load dashboard view
         */
        include __DIR__ . '/../views/dashboard.php';
    }
}

?>