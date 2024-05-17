<?php
include 'db.php';
session_start();

$report = $_POST['report'];
$submitted_by = $_SESSION['user_id'];

$query = "INSERT INTO reports (report, submitted_by) VALUES ('$report', '$submitted_by')";

if ($conn->query($query) === TRUE) {
    echo "Report added successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
