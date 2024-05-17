<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">تسجيل الدخول</h2>
        <form id="loginForm">
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
                    <option value="project_manager">project_manager</option>
                    <option value="development_team">development_team</option>
                    <option value="operations_team">operations_team</option>
                    <option value="quality_team">quality_team</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (event) {
                event.preventDefault();
                const loginData = {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    role: $('#role').val()
                };
                $.post('login_action.php', loginData, function (response) {
                    response = response.trim();  // تأكد من إزالة المسافات البيضاء
                    if (response === 'project_manager') {
                        window.location.href = 'project_manager_dashboard.php';
                    } else if (response === 'development_team') {
                        window.location.href = 'development_team_dashboard.php';
                    } else if (response === 'operations_team') {
                        window.location.href = 'operations_team_dashboard.php';
                    } else if (response === 'quality_team') {
                        window.location.href = 'quality_team_dashboard.php';
                    } else {
                        alert(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
