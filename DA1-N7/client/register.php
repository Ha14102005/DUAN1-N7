<?php
$servername = "localhost";
$db_username = "root"; 
$db_password = ""; 
$dbname = "duan1";

// Tạo kết nối
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý khi nhận POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['user']);
    $pass = trim($_POST['pass']);
    
    // Mã hóa mật khẩu
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    
    // Kiểm tra xem tên người dùng đã tồn tại chưa
    $stmt = $conn->prepare("SELECT user_id FROM user_registration WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.";
    } else {
        // Lưu thông tin đăng ký vào cơ sở dữ liệu
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $user, $hashed_pass);
        if ($stmt->execute()) {
            // Chuyển hướng đến trang đăng nhập
            header("Location: login.php");
            exit();
        } else {
            echo "Đăng ký thất bại. Vui lòng thử lại.";
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/style_register.css">
</head>
<body>
    <div class="boxcenter">
        <div class="row mb header">
            <h1>Đăng ký</h1>
        </div>
        <div class="row mb">
            <form action="register.php" method="post">
                <div class="row mb10">
                    Tên Đăng nhập
                    <input type="text" name="user" id="" required>
                </div>
                <div class="row mb10">
                    Mật Khẩu<br>
                    <input type="password" name="pass" id="" required>
                </div>
                <div class="row mb10">
                    <input type="submit" value="Đăng ký">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
