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
    <title>إدارة الخطط الزمنية</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <h2 class="mt-4">إدارة الخطط الزمنية</h2>
        
        <!-- جدول العرض -->
        <h3 class="mt-4">قائمة الخطط الزمنية</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم الخطة الزمنية</th>
                    <th>رقم المشروع</th>
                    <th>الهدف</th>
                    <th>تاريخ الاستحقاق</th>
                </tr>
            </thead>
            <tbody id="timelinesTable">
                <!-- البيانات سيتم إضافتها هنا عبر JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // تحميل البيانات عند تحميل الصفحة
            loadTimelines();
        });

        // تحميل قائمة الخطط الزمنية
        function loadTimelines() {
            $.get('view_timelines.php', function (data) {
                const timelines = JSON.parse(data);
                let timelinesTable = '';
                timelines.forEach(timeline => {
                    timelinesTable += `
                        <tr>
                            <td>${timeline.id}</td>
                            <td>${timeline.project_id}</td>
                            <td>${timeline.milestone}</td>
                            <td>${timeline.due_date}</td>
                        </tr>
                    `;
                });
                $('#timelinesTable').html(timelinesTable);
            });
        }
    </script>
</body>
</html>
