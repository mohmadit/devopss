


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
        <!-- نموذج الإضافة -->
        <form id="addProjectForm">
            <div class="form-group">
                <label for="name">اسم المشروع:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">الوصف:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="start_date">تاريخ البدء:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">تاريخ الانتهاء:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <button type="submit" class="btn btn-primary">إضافة مشروع</button>
        </form>

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
                    <th>الإجراءات</th>
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

            // إضافة مشروع
            $('#addProjectForm').submit(function (event) {
                event.preventDefault();
                const projectData = {
                    name: $('#name').val(),
                    description: $('#description').val(),
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val()
                    
                };
                $.post('add_project.php', projectData, function (response) {
                    alert(response);
                    loadProjects();
                });
            });
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
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editProject(${project.id})">تعديل</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteProject(${project.id})">حذف</button>
                            </td>
                        </tr>
                    `;
                });
                $('#projectsTable').html(projectsTable);
            });
        }

        // تعديل مشروع
        function editProject(id) {
            // هنا يمكنك إضافة كود التعديل حسب متطلباتك
            alert('تعديل مشروع: ' + id);
        }

        // حذف مشروع
        function deleteProject(id) {
            if (confirm('هل أنت متأكد من حذف هذا المشروع؟')) {
                $.post('delete_project.php', { id: id }, function (response) {
                    alert(response);
                    loadProjects();
                });
            }
        }
    </script>
</body>
</html>
