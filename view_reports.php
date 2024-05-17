<?php
include 'db.php';

$query = "SELECT * FROM reports";
$result = $conn->query($query);
$reports = array();

while ($row = $result->fetch_assoc()) {
    $reports[] = $row;
}

echo json_encode($reports);
?>
