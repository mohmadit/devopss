<?php
include 'db.php';

$id = $_POST['id'];

$query = "DELETE FROM users WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "User deleted successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
