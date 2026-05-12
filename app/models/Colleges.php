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
    public function createCollege($data)
    {
        /**
         * Prepare INSERT statement for creating a new college record
         * All fields from the colleges table are included
         */
        $stmt = $this->db->prepare("
            INSERT INTO colleges
            (name, code, description, deanName, email, phone, building, establishedYear, points, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        /**
         * Bind parameters to prevent SQL injection
         * "s" = string, "i" = integer, "d" = double (not used here but kept standard)
         */
        $stmt->bind_param(
            "ssssssssds",
            $data['name'],
            $data['code'],
            $data['description'],
            $data['deanName'],
            $data['email'],
            $data['phone'],
            $data['building'],
            $data['establishedYear'],
            $data['points'],
            $data['status']
        );

        /**
         * Execute query
         * Returns TRUE if successful, FALSE if failed
         */
        $result = $stmt->execute();

        /**
         * Close statement to free memory
         */
        $stmt->close();

        return $result;
    }


        public function updateCollege($id, $data)
    {
        /**
         * Prepare UPDATE statement for full college record update
         * Updates ALL fields except ID
         */
        $stmt = $this->db->prepare("
            UPDATE colleges
            SET name = ?, 
                code = ?, 
                description = ?, 
                deanName = ?, 
                email = ?, 
                phone = ?, 
                building = ?, 
                establishedYear = ?, 
                points = ?, 
                status = ?
            WHERE id = ?
        ");

        /**
         * Bind parameters in correct order
         * NOTE: last parameter is ID (integer)
         */
        $stmt->bind_param(
            "ssssssssisi",
            $data['name'],
            $data['code'],
            $data['description'],
            $data['deanName'],
            $data['email'],
            $data['phone'],
            $data['building'],
            $data['establishedYear'],
            $data['points'],
            $data['status'],
            $id
        );

        /**
         * Execute update query
         */
        $result = $stmt->execute();

        /**
         * Close statement
         */
        $stmt->close();

        return $result;
    }

        public function deleteCollege($id)
    {
        /**
         * Prepare DELETE query
         * Removes a college permanently using ID
         */
        $stmt = $this->db->prepare("
            DELETE FROM colleges
            WHERE id = ?
        ");

        /**
         * Bind ID parameter
         */
        $stmt->bind_param("i", $id);

        /**
         * Execute query
         */
        $result = $stmt->execute();

        /**
         * Close statement
         */
        $stmt->close();

        return $result;
    }

       
}

?>


