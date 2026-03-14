<?php
header("Content-Type: application/json");
include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method"
    ]);
    exit();
}

$id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
$points = isset($_POST["points"]) ? intval($_POST["points"]) : 0;

if ($id <= 0 || $points == 0) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid input"
    ]);
    exit();
}

$stmt = $conn->prepare("UPDATE colleges SET points = points + ? WHERE id = ?");

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Prepare failed: " . $conn->error
    ]);
    exit();
}

$stmt->bind_param("ii", $points, $id);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Points updated successfully"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Execute failed: " . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>