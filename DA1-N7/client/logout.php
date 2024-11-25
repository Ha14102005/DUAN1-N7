<?php
session_start();  // Khởi tạo session
session_unset();  // Xóa tất cả biến session
session_destroy();  // Hủy session

header("Location: ../index.php");  // Chuyển hướng về trang chủ sau khi đăng xuất
exit();
?>
