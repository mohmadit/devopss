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
    <title>إدارة التقارير</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">إدارة التقارير</h2>
        
        <!-- نموذج الإضافة -->
        <form id="addReportForm">
            <div class="form-group">
                <label for="report">التقرير:</label>
                <textarea class="form-control" id="report" name="report" required></textarea>
            </div>
            <div class="form-group">
                <label for="submitted_by">مقدم التقرير (رقم المستخدم):</label>
                <input type="number" class="form-control" id="submitted_by" name="submitted_by" required>
            </div>
            <button type="submit" class="btn btn-primary">إضافة تقرير</button>
        </form>

        <!-- جدول العرض -->
        <h3 class="mt-4">قائمة التقارير</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم التقرير</th>
                    <th>التقرير</th>
                    <th>مقدم التقرير</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="reportsTable">
                <!-- البيانات سيتم إضافتها هنا عبر JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // تحميل البيانات عند تحميل الصفحة
            loadReports();

            // إضافة تقرير
            $('#addReportForm').submit(function (event) {
                event.preventDefault();
                const reportData = {
                    report: $('#report').val(),
                    submitted_by: $('#submitted_by').val()
                };
                $.post('add_report.php', reportData, function (response) {
                    alert(response);
                    loadReports();
                });
            });
        });

        // تحميل قائمة التقارير
        function loadReports() {
            $.get('view_reports.php', function (data) {
                const reports = JSON.parse(data);
                let reportsTable = '';
                reports.forEach(report => {
                    reportsTable += `
                        <tr>
                            <td>${report.id}</td>
                            <td>${report.report}</td>
                            <td>${report.submitted_by}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editReport(${report.id})">تعديل</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteReport(${report.id})">حذف</button>
                            </td>
                        </tr>
                    `;
                });
                $('#reportsTable').html(reportsTable);
            });
        }

        // تعديل تقرير
        function editReport(id) {
            // هنا يمكنك إضافة كود التعديل حسب متطلباتك
            alert('تعديل تقرير: ' + id);
        }

        // حذف تقرير
        function deleteReport(id) {
            if (confirm('هل أنت متأكد من حذف هذا التقرير؟')) {
                $.post('delete_report.php', { id: id }, function (response) {
                    alert(response);
                    loadReports();
                });
            }
        }
    </script>
</body>
</html>
