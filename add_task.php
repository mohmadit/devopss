<?php
include 'db.php';
session_start();

$project_id = $_POST['project_id'];
$task_name = $_POST['task_name'];
$description = $_POST['description'];
$assigned_to = $_POST['assigned_to'];
$status = 'pending';

$query = "INSERT INTO tasks (project_id, task_name, description, assigned_to, status) VALUES ('$project_id', '$task_name', '$description', '$assigned_to', '$status')";

if ($conn->query($query) === TRUE) {
    echo "Task added successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
