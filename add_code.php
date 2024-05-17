<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

$task_id = $_POST['task_id'];
$code_name = $_POST['code_name'];
$code_text = $_POST['code_text'];

$query = "INSERT INTO coding (task_id, code_name, code_text) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $task_id, $code_name, $code_text);

if ($stmt->execute()) {
    echo "تم إضافة الكود بنجاح";
} else {
    echo "فشل في إضافة الكود";
}
?>
