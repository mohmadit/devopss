<?php
include 'db.php';

$id = $_POST['id'];
$report = $_POST['report'];

$query = "UPDATE reports SET report='$report' WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Report updated successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
