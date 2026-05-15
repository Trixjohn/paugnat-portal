<?php

/**
 * Return all responses as JSON
 * Allows frontend JavaScript to properly parse responses
 */
header('Content-Type: application/json');

/**
 * Load Composer autoloader and required files
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/mailconfig.php';
require_once __DIR__ . '/../app/models/Database.php';
require_once __DIR__ . '/../app/models/Messages.php';

/**
 * Import PHPMailer classes
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Allow only POST requests
 * Prevents direct browser access using GET
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);

    exit;
}

/**
 * Retrieve and sanitize form input
 */
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

/**
 * Validate user input
 * Ensures fields are not empty and email is valid
 */
if (
    $name === '' ||
    $email === '' ||
    $message === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)
) {

    echo json_encode([
        'success' => false,
        'message' => 'Invalid input'
    ]);

    exit;
}

/**
 * Save message to database
 */
$msgModel = new Messages();

$success = $msgModel->save($name, $email, $message);

/**
 * Stop execution if database save fails
 */
if (!$success) {

    echo json_encode([
        'success' => false,
        'message' => 'Failed to save message'
    ]);

    exit;
}

/**
 * Initialize PHPMailer
 */
$mail = new PHPMailer(true);

try {

    /**
     * Configure SMTP settings
     */
    $mail->isSMTP();
    $mail->Host       = MAIL_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = MAIL_USERNAME;
    $mail->Password   = MAIL_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = MAIL_PORT;

    /**
     * Configure sender and recipient information
     */
    $mail->setFrom(MAIL_USERNAME, MAIL_FROM_NAME);
    $mail->addAddress(MAIL_TO);
    $mail->addReplyTo($email, $name);

    /**
     * Configure email content
     */
    $mail->isHTML(false);
    $mail->Subject = 'PAUGNAT Contact: ' . $name;
    $mail->Body    = "Name: $name\nEmail: $email\n\n$message";

    /**
     * Send email
     */
    $mail->send();

    /**
     * Return success response
     */
    echo json_encode([
        'success' => true,
        'message' => 'Message sent successfully'
    ]);

} catch (Exception $e) {

    /**
     * Email failed but database save succeeded
     */
    echo json_encode([
        'success' => true,
        'message' => 'Saved but email failed'
    ]);
}

exit;

?>