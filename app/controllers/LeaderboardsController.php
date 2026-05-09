<?php

/**
 * LeaderboardsController
 * Handles loading of the leaderboard page
 * (Data is handled separately via JS or backend API)
 */

class LeaderboardsController {

    /**
     * Displays leaderboard page
     */
    public function index() {

        // Load leaderboard view
        include __DIR__ . '/../views/leaderboards.php';
    }
}

?>