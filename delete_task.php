<?php
include 'db.php';

$id = $_POST['id'];

$query = "DELETE FROM tasks WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Task deleted successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
