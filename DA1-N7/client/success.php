<?php
session_start();

if (!isset($_SESSION['order_success'])) {
    header("Location: cart.php");
    exit();
}

// Lấy thông tin từ phiên làm việc
$order_id = $_SESSION['order_success']['order_id'] ?? '';
$total_amount = $_SESSION['order_success']['total_amount'] ?? 0;

// Xóa thông tin khỏi phiên để tránh refresh lại trang
unset($_SESSION['order_success']);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Hàng Thành Công</title>
    <link rel="stylesheet" href="style_success.css">
</head>

<body>
    <div class="boxcenter">
        <h2>Đặt Hàng Thành Công!</h2>
        <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xử lý.</p>
        <p><strong>Mã đơn hàng:</strong> <?php echo htmlspecialchars($order_id); ?></p>
        <p><strong>Tổng tiền:</strong> <?php echo number_format($total_amount, 0, ',', '.'); ?> VNĐ</p>
        <p>Đơn hàng của bạn sẽ được giao trong vòng 3-5 ngày làm việc.</p>
        <p>Vui lòng giữ liên lạc để nhân viên giao hàng có thể liên hệ.</p>

        <a href="../index.php" class="button">Tiếp tục mua sắm</a>
        <a href="view_orders.php" class="button">Xem đơn hàng của bạn</a>
    </div>
</body>

</html>
