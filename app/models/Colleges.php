<?php

require_once __DIR__ . '/Database.php';

/**
 * Class Colleges
 * Handles retrieval and updating of college data
 */
class Colleges
{
    /** @var mysqli $db Database connection instance */
    private $db;

    /**
     * Constructor
     * Initializes database connection
     */
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get all colleges ordered by points (leaderboard style)
     *
     * @return array List of all colleges
     */
    public function getAllColleges()
    {
        // SQL query to fetch all college details
        $sql = "
            SELECT 
                id,
                name,
                code,
                description,
                deanName,
                email,
                phone,
                building,
                establishedYear,
                points,
                status,
                createdAt,
                updatedAt
            FROM colleges
            ORDER BY points DESC, name ASC
        ";

        // Execute query
        $result = $this->db->query($sql);

        $colleges = [];

        // Convert result set into array
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $colleges[] = $row;
            }
        }

        return $colleges;
    }

    /**
     * Update college points (adds value to existing points)
     *
     * @param int $id College ID
     * @param int $points Points to add
     * @return bool True if update successful
     */
    public function updatePoints($id, $points)
    {
        // Prepared statement to safely update points
        $stmt = $this->db->prepare("
            UPDATE colleges
            SET points = points + ?
            WHERE id = ?
        ");

        $stmt->bind_param("ii", $points, $id);

        // Execute update query
        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }
}

?>