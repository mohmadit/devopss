<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

$id = $_POST['id'];

$query = "DELETE FROM coding WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "تم حذف الكود بنجاح";
} else {
    echo "فشل في حذف الكود";
}
?>
