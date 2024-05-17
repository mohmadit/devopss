<?php
include 'db.php';
session_start();

$version = $_POST['version'];
$description = $_POST['description'];
$project_id = $_POST['project_id'];
$created_by = $_SESSION['user_id'];

$query = "INSERT INTO releases (version, description, project_id, created_by) VALUES ('$version', '$description', '$project_id', '$created_by')";

if ($conn->query($query) === TRUE) {
    echo "Release added successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
