<?php
include 'db.php';
session_start();

$name = $_POST['name'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$created_by = $_SESSION['user_id'];

$query = "INSERT INTO projects (name, description, start_date, end_date, created_by) VALUES ('$name', '$description', '$start_date', '$end_date', '$created_by')";

if ($conn->query($query) === TRUE) {
    echo "Project added successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
