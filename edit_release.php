<?php
include 'db.php';

$id = $_POST['id'];
$version = $_POST['version'];
$description = $_POST['description'];
$project_id = $_POST['project_id'];

$query = "UPDATE releases SET version='$version', description='$description', project_id='$project_id' WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "Release updated successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
