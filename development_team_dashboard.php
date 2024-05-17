<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'development_team') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>واجهة تحكم فريق التطوير</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">مرحبا بك، فريق التطوير</h2>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="">التحكم</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="viewtimeline.php">عرض الخطة الزمنية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewproject.php">عرض المشاريع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewtask.php">عرض المهام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="code.php">الكود</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php">التقارير</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="releases.php">الإصدارات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="requirment.php">المتطلبات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">تسجيل الخروج</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
