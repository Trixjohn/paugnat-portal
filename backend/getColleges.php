<?php
header("Content-Type: application/json");
include "db.php";

$sql = "SELECT id, name, points FROM colleges ORDER BY points DESC, name ASC";
$result = $conn->query($sql);

$colleges = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $colleges[] = $row;
    }
}

echo json_encode($colleges);
$conn->close();
?>