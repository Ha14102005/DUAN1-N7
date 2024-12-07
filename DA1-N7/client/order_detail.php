<?php
session_start();

// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy order_id từ URL
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    die("Không tìm thấy đơn hàng.");
}
$order_id = intval($_GET['order_id']);

// Truy vấn chi tiết đơn hàng
$order_sql = "
    SELECT o.*, os.status_name
    FROM orders o
    JOIN order_status os ON o.status_id = os.status_id
    WHERE o.order_id = ? AND o.user_id = ?";
$stmt = $conn->prepare($order_sql);
$stmt->bind_param("ii", $order_id, $_SESSION['user_id']);
$stmt->execute();
$order_result = $stmt->get_result();

if ($order_result->num_rows === 0) {
    die("Không tìm thấy đơn hàng.");
}

$order = $order_result->fetch_assoc();

// Truy vấn chi tiết các sản phẩm trong đơn hàng
$order_items_sql = "
    SELECT oi.*, p.name AS product_name, p.image_src
    FROM order_items oi
    JOIN product p ON oi.product_id = p.id
    WHERE oi.order_id = ?";
$stmt_items = $conn->prepare($order_items_sql);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$order_items_result = $stmt_items->get_result();

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="../style/style_orderdetail.css">
</head>
<body>
    <div class="boxcenter">
        <h2>Chi tiết đơn hàng: <?php echo htmlspecialchars($order['order_code']); ?></h2>
        <p>Ngày đặt hàng: <?php echo htmlspecialchars($order['order_date']); ?></p>
        <p>Trạng thái: <?php echo htmlspecialchars($order['status_name']); ?></p>
        <p>Người nhận: <?php echo htmlspecialchars($order['recipient_name']); ?></p>
        <p>Email người nhận: <?php echo htmlspecialchars($order['recipient_email']); ?></p>
        <p>Điện thoại người nhận: <?php echo htmlspecialchars($order['recipient_phone']); ?></p>
        <p>Địa chỉ giao hàng: <?php echo htmlspecialchars($order['recipient_address']); ?></p>
        <p>Tổng tiền: <?php echo number_format($order['total_amount'], 0, ',', '.'); ?> VNĐ</p>

        <h3>Sản phẩm trong đơn hàng</h3>
        <?php if ($order_items_result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = $order_items_result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($item['image_src']); ?>" alt="Hình ảnh sản phẩm" width="100"></td>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                            <td><?php echo number_format($item['quantity'] * $item['price'], 0, ',', '.'); ?> VNĐ</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có sản phẩm nào trong đơn hàng này.</p>
        <?php endif; ?>

        <a href="view_orders.php" class="button">Quay lại danh sách đơn hàng</a>
    </div>
</body>

</html>

<?php
$stmt->close();
$stmt_items->close();
$conn->close();
?>
