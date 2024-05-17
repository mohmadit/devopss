<?php
include 'db.php';

$id = $_POST['id'];
$milestone = $_POST['milestone'];
$due_date = $_POST['due_date'];

$query = "UPDATE timelines SET milestone='$milestone', due_date='$due_date' WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Timeline updated successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
