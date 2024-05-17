<?php
include 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = "UPDATE projects SET name='$name', description='$description', start_date='$start_date', end_date='$end_date' WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Project updated successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
