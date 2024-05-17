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
    <title>إدارة المهام</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">إدارة المهام</h2>
        
        <!-- جدول العرض -->
        <h3 class="mt-4">قائمة المهام</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم المهمة</th>
                    <th>رقم المشروع</th>
                    <th>اسم المهمة</th>
                    <th>الوصف</th>
                    <th>مخصص لـ</th>
                    <th>الحالة</th>
                    <th>تعديل الحالة</th>
                    <th>الترميز</th> <!-- إضافة عمود الترميز -->
                </tr>
            </thead>
            <tbody id="tasksTable">
                <!-- البيانات سيتم إضافتها هنا عبر JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            loadTasks();
        });

        function loadTasks() {
            $.get('view_tasks.php', function (data) {
                const tasks = JSON.parse(data);
                let tasksTable = '';
                tasks.forEach(task => {
                    tasksTable += `
                        <tr>
                            <td>${task.id}</td>
                            <td>${task.project_id}</td>
                            <td>${task.task_name}</td>
                            <td>${task.description}</td>
                            <td>${task.assigned_to}</td>
                            <td id="status-${task.id}">${task.status}</td>
                            <td><button class="btn btn-primary btn-sm" onclick="editTaskStatus(${task.id})">تعديل</button></td>
                            <td><a href="code.php?task_id=${task.id}" class="btn btn-success btn-sm">الترميز</a></td> <!-- زر الترميز -->
                        </tr>
                    `;
                });
                $('#tasksTable').html(tasksTable);
            });
        }

        function editTaskStatus(id) {
            const currentStatus = $(`#status-${id}`).text();
            const newStatus = prompt(`يرجى إدخال الحالة الجديدة للمهمة ${id}:`, currentStatus);
            if (newStatus !== null) {
                $.post('update_task_status.php', { id: id, status: newStatus }, function (response) {
                    if (response === 'success') {
                        $(`#status-${id}`).text(newStatus);
                    } else {
                        alert('فشل في تحديث الحالة');
                    }
                });
            }
        }
    </script>
</body>
</html>
