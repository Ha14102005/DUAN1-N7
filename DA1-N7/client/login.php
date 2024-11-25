<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

// Kết nối cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lấy thông tin người dùng từ cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT user_id, username, email, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $db_username, $email, $hashed_password, $role);

    // Kiểm tra người dùng và mật khẩu
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // Lưu thông tin vào session khi đăng nhập thành công
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            // Chuyển hướng về trang chính sau khi đăng nhập thành công
            header("Location: /DUAN1/DA1-N7");
            exit;
        } else {
            $error_message = "Mật khẩu không đúng!";
        }
    } else {
        $error_message = "Tên người dùng không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Đăng nhập</div>
                <div class="card-body">
                    <!-- Form đăng nhập -->
                    <form method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </form>

                    <?php if (isset($error_message)): ?>
                        <!-- Hiển thị thông báo lỗi nếu có -->
                        <div class="alert alert-danger mt-3">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <div class="text-center mt-3">
                        <a href="register.php">Chưa có tài khoản? Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
