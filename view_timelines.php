<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

$query = "SELECT * FROM timelines";
$result = $conn->query($query);

$timelines = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $timelines[] = $row;
    }
}

echo json_encode($timelines);

$conn->close();
?>
