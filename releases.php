

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
    <title>إدارة الإصدارات</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">إدارة الإصدارات</h2>
        
        <!-- نموذج الإضافة -->
        <form id="addReleaseForm">
            <div class="form-group">
                <label for="version">الإصدار:</label>
                <input type="text" class="form-control" id="version" name="version" required>
            </div>
            <div class="form-group">
                <label for="description">الوصف:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="project_id">رقم المشروع:</label>
                <input type="number" class="form-control" id="project_id" name="project_id" required>
            </div>
            <button type="submit" class="btn btn-primary">إضافة إصدار</button>
        </form>

        <!-- جدول العرض -->
        <h3 class="mt-4">قائمة الإصدارات</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم الإصدار</th>
                    <th>الإصدار</th>
                    <th>الوصف</th>
                    <th>رقم المشروع</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="releasesTable">
                <!-- البيانات سيتم إضافتها هنا عبر JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // تحميل البيانات عند تحميل الصفحة
            loadReleases();

            // إضافة إصدار
            $('#addReleaseForm').submit(function (event) {
                event.preventDefault();
                const releaseData = {
                    version: $('#version').val(),
                    description: $('#description').val(),
                    project_id: $('#project_id').val()
                };
                $.post('add_release.php', releaseData, function (response) {
                    alert(response);
                    loadReleases();
                });
            });
        });

        // تحميل قائمة الإصدارات
        function loadReleases() {
            $.get('view_releases.php', function (data) {
                const releases = JSON.parse(data);
                let releasesTable = '';
                releases.forEach(release => {
                    releasesTable += `
                        <tr>
                            <td>${release.id}</td>
                            <td>${release.version}</td>
                            <td>${release.description}</td>
                            <td>${release.project_id}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editRelease(${release.id})">تعديل</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteRelease(${release.id})">حذف</button>
                            </td>
                        </tr>
                    `;
                });
                $('#releasesTable').html(releasesTable);
            });
        }

        // تعديل إصدار
        function editRelease(id) {
            // هنا يمكنك إضافة كود التعديل حسب متطلباتك
            alert('تعديل إصدار: ' + id);
        }

        // حذف إصدار
        function deleteRelease(id) {
            if (confirm('هل أنت متأكد من حذف هذا الإصدار؟')) {
                $.post('delete_release.php', { id: id }, function (response) {
                    alert(response);
                    loadReleases();
                });
            }
        }
    </script>
</body>
</html>
