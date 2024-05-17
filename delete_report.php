<?php
include 'db.php';

$id = $_POST['id'];

$query = "DELETE FROM reports WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Report deleted successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
