<?php
include 'db.php';

$query = "SELECT * FROM users";
$result = $conn->query($query);
$users = array();

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>
