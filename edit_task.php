<?php
include 'db.php';

$id = $_POST['id'];
$task_name = $_POST['task_name'];
$description = $_POST['description'];
$status = $_POST['status'];

$query = "UPDATE tasks SET task_name='$task_name', description='$description', status='$status' WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Task updated successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
