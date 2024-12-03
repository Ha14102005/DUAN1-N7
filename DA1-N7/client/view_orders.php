<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: client/login.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách đơn hàng của người dùng
$user_id = $_SESSION['user_id'];
$order_sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($order_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của bạn</title>
    <link rel="stylesheet" href="../style/style_vieworder.css">
</head>

<body>
    <div class="boxcenter">
        <h2>Đơn hàng của bạn</h2>
        <?php if ($order_result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $order_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_code']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo number_format($order['total_amount'], 0, ',', '.'); ?> VNĐ</td>
                            <td>
                                <?php
                                // Hiển thị trạng thái đơn hàng
                                switch ($order['status_id']) {
                                    case 1:
                                        echo "Chờ xác nhận";
                                        break;
                                    case 2:
                                        echo "Đang xử lý";
                                        break;
                                    case 3:
                                        echo "Đang giao";
                                        break;
                                    case 4:
                                        echo "Hoàn thành";
                                        break;
                                    case 5:
                                        echo "Đã hủy";
                                        break;
                                    default:
                                        echo "Không xác định";
                                }
                                ?>
                            </td>
                            <td>
                              <a href="order_detail.php?order_id=<?php echo $order['order_id']; ?>" class="button">Xem chi tiết</a>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Bạn chưa có đơn hàng nào.</p>
        <?php endif; ?>
        <a href="../index.php" class="button">Tiếp tục mua sắm</a>
    </div>
</body>

</html>

<?php
$conn->close();
?>
