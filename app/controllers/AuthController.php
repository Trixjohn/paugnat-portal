<?php

/**
 * AuthController
 * Handles admin authentication (login process)
 */

require_once __DIR__ . '/../models/Admins.php';

class AuthController {

    /**
     * Handles login request (GET + POST)
     * - Shows login page
     * - Processes login form submission
     */
    public function login() {

        // Start session for authentication handling
        session_start();

        // Holds login error message (if any)
        $error = "";

        /**
         * Check if form is submitted
         * Only process login when request method is POST
         */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Get and sanitize input values
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            // Validate input fields
            if (empty($username) || empty($password)) {
                $error = "Please fill in all fields";
            } else {

                // Load Admin model
                $adminModel = new Admins();

                // Authenticate user credentials
                $admin = $adminModel->authenticate($username, $password);

                if ($admin) {

                    // Store admin session data
                    $_SESSION["admin_id"] = $admin["id"];
                    $_SESSION["admin_username"] = $admin["username"];

                    // Redirect to dashboard after successful login
                    header("Location: dashboard.php");
                    exit();

                } else {
                    $error = "Invalid credentials";
                }
            }
        }

        /**
         * Load login view
         * Error variable is available for display in view
         */
        include __DIR__ . '/../views/login.php';
    }
}

?>