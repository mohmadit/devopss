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
        <!-- نموذج الإضافة -->
        <form id="addTimelineForm">
            <div class="form-group">
                <label for="project_id">رقم المشروع:</label>
                <input type="number" class="form-control" id="project_id" name="project_id" required>
            </div>
            <div class="form-group">
                <label for="milestone">الهدف:</label>
                <input type="text" class="form-control" id="milestone" name="milestone" required>
            </div>
            <div class="form-group">
                <label for="due_date">تاريخ الاستحقاق:</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <button type="submit" class="btn btn-primary">إضافة خطة زمنية</button>
        </form>

        <!-- جدول العرض -->
        <h3 class="mt-4">قائمة الخطط الزمنية</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم الخطة الزمنية</th>
                    <th>رقم المشروع</th>
                    <th>الهدف</th>
                    <th>تاريخ الاستحقاق</th>
                    <th>الإجراءات</th>
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

            // إضافة خطة زمنية
            $('#addTimelineForm').submit(function (event) {
                event.preventDefault();
                const timelineData = {
                    project_id: $('#project_id').val(),
                    milestone: $('#milestone').val(),
                    due_date: $('#due_date').val()
                };
                $.post('add_timeline.php', timelineData, function (response) {
                    alert(response);
                    loadTimelines();
                });
            });
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
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editTimeline(${timeline.id})">تعديل</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteTimeline(${timeline.id})">حذف</button>
                            </td>
                        </tr>
                    `;
                });
                $('#timelinesTable').html(timelinesTable);
            });
        }
s
        // تعديل خطة زمنية
        function editTimeline(id) {
            // هنا يمكنك إضافة كود التعديل حسب متطلباتك
            alert('تعديل خطة زمنية: ' + id);
        }

        // حذف خطة زمنية
        function deleteTimeline(id) {
            if (confirm('هل أنت متأكد من حذف هذه الخطة الزمنية؟')) {
                $.post('delete_timeline.php', { id: id }, function (response) {
                    alert(response);
                    loadTimelines();
                });
            }
        }
    </script>
</body>
</html>
