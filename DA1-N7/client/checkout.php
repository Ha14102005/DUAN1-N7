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

$user_id = $_SESSION['user_id'];

// Lấy giỏ hàng của người dùng
$cart_sql = "
    SELECT ci.*, p.name, p.price, p.image_src 
    FROM cart_item ci 
    JOIN product p ON ci.product_id = p.id 
    WHERE ci.cart_id IN (SELECT cart_id FROM cart WHERE user_id = ? AND status = 'pending')
";
$stmt = $conn->prepare($cart_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();

$total = 0;

// Xử lý khi người dùng xác nhận đặt hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    $recipient_address = $_POST['recipient_address'];
    $recipient_phone = $_POST['recipient_phone'];
    $payment_method = $_POST['payment_method'];

    // Kiểm tra thông tin giao hàng
    if (empty($recipient_address) || empty($recipient_phone) || empty($payment_method)) {
        $error = "Vui lòng nhập đầy đủ thông tin giao hàng!";
    } else {
        // Tính tổng giá trị đơn hàng
        foreach ($cart_items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Tạo đơn hàng mới trong bảng orders
        $order_sql = "
            INSERT INTO orders 
            (user_id, total_price, status, created_at) 
            VALUES (?, ?, 'pending', NOW())
        ";
        $stmt = $conn->prepare($order_sql);
        $stmt->bind_param("id", $user_id, $total);
        $stmt->execute();

        $order_id = $stmt->insert_id;

        // Lưu chi tiết đơn hàng vào bảng order_items
        foreach ($cart_items as $item) {
            $order_item_sql = "
                INSERT INTO order_items 
                (order_id, product_id, quantity, price, recipient_address, recipient_phone, order_date, payment_method, total_price, order_status) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?, 'pending')
            ";
            $stmt = $conn->prepare($order_item_sql);
            $stmt->bind_param(
                "đ",
                $order_id,
                $item['product_id'],
                $item['quantity'],
                $item['price'],
                $recipient_address,
                $recipient_phone,
                $payment_method,
                $total
            );
            $stmt->execute();
        }

        // Cập nhật trạng thái giỏ hàng
        $update_cart_sql = "UPDATE cart SET status = 'completed' WHERE user_id = ? AND status = 'pending'";
        $stmt = $conn->prepare($update_cart_sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Xóa giỏ hàng cũ
        $delete_cart_items_sql = "DELETE FROM cart_item WHERE cart_id IN (SELECT cart_id FROM cart WHERE user_id = ? AND status = 'completed')";
        $stmt = $conn->prepare($delete_cart_items_sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Chuyển hướng đến trang thành công
        $_SESSION['order_success'] = [
            'order_id' => $order_id,
            'total_price' => $total
        ];
        header("Location: success.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Hàng</title>
    <link rel="stylesheet" href="style_checkout.css">
</head>

<body>

    <div class="boxcenter">
        <h2>Đặt Hàng</h2>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($cart_items->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($item = $cart_items->fetch_assoc()) {
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><img src="<?php echo $item['image_src']; ?>" alt="" width="100px"></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>Tổng cộng:</strong></td>
                        <td><strong><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</strong></td>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p>Giỏ hàng của bạn trống!</p>
        <?php endif; ?>

        <form method="post" action="" class="checkout-form">
            <label for="recipient_address">Địa chỉ giao hàng:</label>
            <input type="text" name="recipient_address" id="recipient_address" required>

            <label for="recipient_phone">Số điện thoại:</label>
            <input type="text" name="recipient_phone" id="recipient_phone" required>

            <label for="payment_method">Phương thức thanh toán:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="cash">Thanh toán khi nhận hàng</option>
                <option value="online">Thanh toán online</option>
            </select>

            <button type="submit" name="confirm_order">Xác nhận đặt hàng</button>
        </form>
    </div>

</body>

</html>

<?php
$conn->close();
?>
