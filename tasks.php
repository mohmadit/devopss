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
        
        <!-- نموذج الإضافة -->
        <form id="addTaskForm">
            <div class="form-group">
                <label for="project_id">رقم المشروع:</label>
                <input type="number" class="form-control" id="project_id" name="project_id" required>
            </div>
            <div class="form-group">
                <label for="task_name">اسم المهمة:</label>
                <input type="text" class="form-control" id="task_name" name="task_name" required>
            </div>
            <div class="form-group">
                <label for="description">الوصف:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="assigned_to">مخصص لـ:</label>
                <input type="number" class="form-control" id="assigned_to" name="assigned_to" required>
            </div>
            <div class="form-group">
                <label for="status">الحالة:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending">قيد الانتظار</option>
                    <option value="in_progress">قيد التنفيذ</option>
                    <option value="completed">مكتمل</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">إضافة مهمة</button>
        </form>

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
                    <th>الإجراءات</th>
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
            // تحميل البيانات عند تحميل الصفحة
            loadTasks();

            // إضافة مهمة
            $('#addTaskForm').submit(function (event) {
                event.preventDefault();
                const taskData = {
                    project_id: $('#project_id').val(),
                    task_name: $('#task_name').val(),
                    description: $('#description').val(),
                    assigned_to: $('#assigned_to').val(),
                    status: $('#status').val()
                };
                $.post('add_task.php', taskData, function (response) {
                    alert(response);
                    loadTasks();
                });
            });
        });

        // تحميل قائمة المهام
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
                            <td>${task.status}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editTask(${task.id})">تعديل</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteTask(${task.id})">حذف</button>
                            </td>
                        </tr>
                    `;
                });
                $('#tasksTable').html(tasksTable);
            });
        }

        // تعديل مهمة
        function editTask(id) {
            // هنا يمكنك إضافة كود التعديل حسب متطلباتك
            alert('تعديل مهمة: ' + id);
        }

        // حذف مهمة
        function deleteTask(id) {
            if (confirm('هل أنت متأكد من حذف هذه المهمة؟')) {
                $.post('delete_task.php', { id: id }, function (response) {
                    alert(response);
                    loadTasks();
                });
            }
        }
    </script>
</body>
</html>
