<?php
include 'db.php';
session_start();

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$role = isset($_POST['role']) ? $_POST['role'] : '';

if (empty($username) || empty($password) || empty($role)) {
    die("All fields are required.");
}

$query = "SELECT id, password, role FROM users WHERE username = ? AND role = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $username, $role);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $hashed_password, $user_role);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $user_role;

        switch ($user_role) {
            case 'project_manager':
                echo 'project_manager';
                break;
            case 'development_team':
                echo 'development_team';
                break;
            case 'operations_team':
                echo 'operations_team';
                break;
            case 'quality_team':
                echo 'quality_team';
                break;
            default:
                echo 'Invalid role.';
        }
    } else {
        echo 'Invalid password.';
    }
} else {
    echo 'User not found.';
}

$stmt->close();
$conn->close();
?>
