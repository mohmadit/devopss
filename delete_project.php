<?php
include 'db.php';

$id = $_POST['id'];

$query = "DELETE FROM projects WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Project deleted successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
