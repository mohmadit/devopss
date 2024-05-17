<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المشاريع</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">إدارة المشاريع</h2>
        
        <!-- جدول العرض -->
        <h3 class="mt-4">قائمة المشاريع</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم المشروع</th>
                    <th>اسم المشروع</th>
                    <th>الوصف</th>
                    <th>تاريخ البدء</th>
                    <th>تاريخ الانتهاء</th>
                </tr>
            </thead>
            <tbody id="projectsTable">
                <!-- البيانات سيتم إضافتها هنا عبر JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // تحميل البيانات عند تحميل الصفحة
            loadProjects();
        });

        // تحميل قائمة المشاريع
        function loadProjects() {
            $.get('view_projects.php', function (data) {
                const projects = JSON.parse(data);
                let projectsTable = '';
                projects.forEach(project => {
                    projectsTable += `
                        <tr>
                            <td>${project.id}</td>
                            <td>${project.name}</td>
                            <td>${project.description}</td>
                            <td>${project.start_date}</td>
                            <td>${project.end_date}</td>
                        </tr>
                    `;
                });
                $('#projectsTable').html(projectsTable);
            });
        }
    </script>
</body>
</html>
