<?php
include 'db.php';

$query = "SELECT * FROM tasks";
$result = $conn->query($query);
$tasks = array();

while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

echo json_encode($tasks);
?>
