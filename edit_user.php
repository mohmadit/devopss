<?php
include 'db.php';

$id = $_POST['id'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role'];

$query = "UPDATE users SET username='$username', password='$password', role='$role' WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "User updated successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
