<?php
include 'db.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role'];

$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

if ($conn->query($query) === TRUE) {
    echo "User added successfully.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
