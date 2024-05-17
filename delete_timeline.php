<?php
include 'db.php';

$id = $_POST['id'];

$query = "DELETE FROM timelines WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Timeline deleted successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
