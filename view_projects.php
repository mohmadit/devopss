<?php
include 'db.php';

$query = "SELECT * FROM projects";
$result = $conn->query($query);
$projects = array();

while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

echo json_encode($projects);
?>
