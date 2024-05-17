<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

$project_id = $_POST['project_id'];
$milestone = $_POST['milestone'];
$due_date = $_POST['due_date'];
$created_by = $_SESSION['user_id'];

// استخدام المعاملات الآمنة لمنع حقن SQL
$stmt = $conn->prepare("INSERT INTO timelines (project_id, milestone, due_date, created_by) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issi", $project_id, $milestone, $due_date, $created_by);

if ($stmt->execute()) {
    echo "Timeline added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
