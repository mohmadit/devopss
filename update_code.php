<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

$id = $_POST['id'];
$code_name = $_POST['code_name'];
$code_text = $_POST['code_text'];

$query = "UPDATE coding SET code_name = ?, code_text = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssi", $code_name, $code_text, $id);

if ($stmt->execute()) {
    echo "تم تحديث الكود بنجاح";
} else {
    echo "فشل في تحديث الكود";
}
?>
