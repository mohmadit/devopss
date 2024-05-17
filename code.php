<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

$task_id = isset($_GET['task_id']) ? $_GET['task_id'] : 0; // التحقق من وجود task_id وتعيين قيمة افتراضية

// استرجاع اسم المهمة
$query = "SELECT task_name FROM tasks WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $task_id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();
$task_name = $task ? $task['task_name'] : "Task Not Found"; // التحقق من وجود النتيجة وتعيين قيمة افتراضية في حال عدم العثور على المهمة
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الأكواد</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">إدارة الأكواد للمهمة: <?php echo htmlspecialchars($task_name); ?></h2>
        
        <!-- نموذج إضافة الكود -->
        <form id="addCodeForm">
            <div class="form-group">
                <label for="code_name">اسم الكود:</label>
                <input type="text" class="form-control" id="code_name" name="code_name" required>
            </div>
            <div class="form-group">
                <label for="code_text">نص الكود:</label>
                <textarea class="form-control" id="code_text" name="code_text" required></textarea>
            </div>
            <input type="hidden" id="task_id" name="task_id" value="<?php echo htmlspecialchars($task_id); ?>">
            <button type="submit" class="btn btn-primary">إضافة كود</button>
        </form>

        <!-- جدول العرض -->
        <h3 class="mt-4">قائمة الأكواد</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم الكود</th>
                    <th>اسم الكود</th>
                    <th>نص الكود</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="codesTable">
                <!-- البيانات ستتم إضافتها هنا عبر JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            loadCodes();

            $('#addCodeForm').submit(function (event) {
                event.preventDefault();
                const codeData = {
                    task_id: $('#task_id').val(),
                    code_name: $('#code_name').val(),
                    code_text: $('#code_text').val()
                };
                $.post('add_code.php', codeData, function (response) {
                    alert(response);
                    loadCodes();
                });
            });
        });

        function loadCodes() {
            const task_id = $('#task_id').val();
            $.get('view_codes.php', { task_id: task_id }, function (data) {
                const codes = JSON.parse(data);
                let codesTable = '';
                codes.forEach(code => {
                    codesTable += `
                        <tr>
                            <td>${code.id}</td>
                            <td>${code.code_name}</td>
                            <td>${code.code_text}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editCode(${code.id})">تعديل</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteCode(${code.id})">حذف</button>
                            </td>
                        </tr>
                    `;
                });
                $('#codesTable').html(codesTable);
            });
        }

        function editCode(id) {
            const code_name = prompt('أدخل اسم الكود الجديد:');
            const code_text = prompt('أدخل نص الكود الجديد:');
            if (code_name !== null && code_text !== null) {
                $.post('update_code.php', { id: id, code_name: code_name, code_text: code_text }, function (response) {
                    alert(response);
                    loadCodes();
                });
            }
        }

        function deleteCode(id) {
            if (confirm('هل أنت متأكد من حذف هذا الكود؟')) {
                $.post('delete_code.php', { id: id }, function (response) {
                    alert(response);
                    loadCodes();
                });
            }
        }
    </script>
</body>
</html>
