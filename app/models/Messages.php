<?php

/**
 * Class Messages
 * Handles saving contact/messages from users
 */
class Messages
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
     * Save a new message into the database
     *
     * @param string $name Sender name
     * @param string $email Sender email
     * @param string $message Message content
     * @return bool True if insert successful
     */
    public function save($name, $email, $message)
    {
        // Prepare insert statement for safety (prevents SQL injection)
        $stmt = $this->db->prepare(
            "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)"
        );

        // Bind parameters to query
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute and return result
        return $stmt->execute();
    }
}

?>