<?php
session_start();

// Kiểm tra xem người dùng có đến trang này hợp lệ không
if (!isset($_SESSION['order_success'])) {
    header("Location: cart.php");
    exit();
}

// Lấy thông tin từ phiên làm việc
$order_id = $_SESSION['order_success']['order_id'] ?? '';
$total_price = $_SESSION['order_success']['total_price'] ?? 0;

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
        <p><strong>Tổng tiền:</strong> <?php echo number_format($total_price, 0, ',', '.'); ?> VNĐ</p>
        <p>Đơn hàng của bạn sẽ được giao trong vòng 3-5 ngày làm việc.</p>
        <p>Vui lòng giữ liên lạc để nhân viên giao hàng có thể liên hệ.</p>

        <a href="DA1-N7/index.php" class="button">Tiếp tục mua sắm</a>
        <a href="" class="button">Xem đơn hàng của bạn</a>
    </div>
</body>
<div class="footer">
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h3>Thông tin công ty</h3>
                            <p>LaptopStore.vn</p>
                            <p>CÔNG TY CỔ PHẦN VIỆT NAM</p>
                            <p> Quận Long Biên, Thành phố Hà Nội, Việt Nam</p>
                            <p>SĐT: 024.9999.9999</p>
                            <p>Website: laptop88.vn</p>
                            <p>Sở KHĐT TP. Hà Nội cấp</p>
                        </div>
                        <div class="col">
                            <h3>Về LaptopStore.vn</h3>
                            <ul>
                                <li>Giới thiệu chung</li>
                                <li>Tuyển dụng</li>
                                <li>Liên hệ</li>
                            </ul>
                        </div>
                        <div class="col">
                            <h3>Chính sách</h3>
                            <ul>
                                <li>Chính sách mua hàng từ xa - kiểm hàng</li>
                                <li>Chính sách đặt cọc sản phẩm</li>
                                <li>Chính sách giao nhận - đổi trả</li>
                                <li>Hướng dẫn thanh toán trực tuyến</li>
                                <li>Chính sách bảo hành</li>
                                <li>Chính sách bảo mật thông tin</li>
                                <li>Quy trình tiếp nhận và giải quyết khiếu nại</li>
                                <li>Thỏa thuận sử dụng và quy định giao dịch chung</li>
                            </ul>
                        </div>
                        <div class="col">
                            <h3>Thanh toán</h3>
                            <ul>
                                <li>Thanh toán trực tuyến (Internet Banking)</li>
                                <li>Thanh toán khi nhận hàng (COD)</li>
                                <li>Hướng dẫn thanh toán VNPay</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="social">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-google-plus-g"></a>
                </div>
            </footer>
</html>
