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
    <title>إدارة المستخدمين</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">إدارة المستخدمين</h2>
        
        <!-- نموذج الإضافة -->
        <form id="addUserForm">
            <div class="form-group">
                <label for="username">اسم المستخدم:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">الدور:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="project_manager">مدير المشروع</option>
                    <option value="development_team">فريق التطوير</option>
                    <option value="quality_assurance_team">فريق الجودة</option>
                    <option value="operations_team">فريق العمليات</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">إضافة مستخدم</button>
        </form>

        <!-- جدول العرض -->
        <h3 class="mt-4">قائمة المستخدمين</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم المستخدم</th>
                    <th>اسم المستخدم</th>
                    <th>الدور</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="usersTable">
                <!-- البيانات سيتم إضافتها هنا عبر JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // تحميل البيانات عند تحميل الصفحة
            loadUsers();

            // إضافة مستخدم
            $('#addUserForm').submit(function (event) {
                event.preventDefault();
                const userData = {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    role: $('#role').val()
                };
                $.post('add_user.php', userData, function (response) {
                    alert(response);
                    loadUsers();
                });
            });
        });

        // تحميل قائمة المستخدمين
        function loadUsers() {
            $.get('view_users.php', function (data) {
                const users = JSON.parse(data);
                let usersTable = '';
                users.forEach(user => {
                    usersTable += `
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.username}</td>
                            <td>${user.role}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editUser(${user.id})">تعديل</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">حذف</button>
                            </td>
                        </tr>
                    `;
                });
                $('#usersTable').html(usersTable);
            });
        }

        // تعديل مستخدم
        function editUser(id) {
            // هنا يمكنك إضافة كود التعديل حسب متطلباتك
            alert('تعديل مستخدم: ' + id);
        }

        // حذف مستخدم
        function deleteUser(id) {
            if (confirm('هل أنت متأكد من حذف هذا المستخدم؟')) {
                $.post('delete_user.php', { id: id }, function (response) {
                    alert(response);
                    loadUsers();
                });
            }
        }
    </script>
</body>
</html>
