<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

$task_id = $_GET['task_id'];

$query = "SELECT * FROM coding WHERE task_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $task_id);
$stmt->execute();
$result = $stmt->get_result();

$codes = [];
while ($row = $result->fetch_assoc()) {
    $codes[] = $row;
}

echo json_encode($codes);
?>
