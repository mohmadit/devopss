<?php
include 'db.php';

// إضافة كود
if (isset($_POST['add_code'])) {
    $task_id = $_POST['task_id'];
    $code_name = $_POST['code_name'];
    $code_text = $_POST['code_text'];

    $sql = "INSERT INTO coding (task_id, code_name, code_text) VALUES ('$task_id', '$code_name', '$code_text')";
    if ($conn->query($sql) === TRUE) {
        echo "New code added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// تعديل كود
if (isset($_POST['update_code'])) {
    $id = $_POST['id'];
    $code_name = $_POST['code_name'];
    $code_text = $_POST['code_text'];

    $sql = "UPDATE coding SET code_name='$code_name', code_text='$code_text' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Code updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// حذف كود
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $sql = "DELETE FROM coding WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Code deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// عرض الأكواد
$sql = "SELECT c.id, t.task_name, c.code_name, c.code_text FROM coding c JOIN tasks t ON c.task_id = t.id";
$result = $conn->query($sql);

$codes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $codes[] = $row;
    }
}
?>
