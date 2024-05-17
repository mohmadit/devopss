<?php
include 'db.php';

$query = "SELECT * FROM releases";
$result = $conn->query($query);
$releases = array();

while ($row = $result->fetch_assoc()) {
    $releases[] = $row;
}

echo json_encode($releases);
?>
