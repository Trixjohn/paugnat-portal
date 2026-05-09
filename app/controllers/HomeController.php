<?php

/**
 * HomeController
 * Handles loading of the homepage view
 */

class HomeController {

    /**
     * Displays the home page
     */
    public function index() {

        // Load home view
        include __DIR__ . '/../views/home.php';
    }
}

?>