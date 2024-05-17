<?php
include 'db.php';

$id = $_POST['id'];

$query = "DELETE FROM releases WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Release deleted successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
