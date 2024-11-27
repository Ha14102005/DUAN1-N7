<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Kiểm tra nếu có POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_name = isset($_POST['recipient_name']) ? $_POST['recipient_name'] : '';
    $recipient_email = isset($_POST['recipient_email']) ? $_POST['recipient_email'] : '';
    $recipient_phone = isset($_POST['recipient_phone']) ? $_POST['recipient_phone'] : '';
    $recipient_address = isset($_POST['recipient_address']) ? $_POST['recipient_address'] : '';
    $payment_method_id = isset($_POST['payment_method_id']) ? $_POST['payment_method_id'] : '';

    // Kiểm tra các trường bắt buộc
    if (
        empty($recipient_name) || empty($recipient_email) ||
        empty($recipient_phone) || empty($recipient_address) ||
        empty($payment_method_id)
    ) {
        $error = "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Lấy giỏ hàng của người dùng
        $cart_query = "
            SELECT ci.product_id, ci.quantity, p.price 
            FROM cart_item ci 
            JOIN product p ON ci.product_id = p.id 
            WHERE ci.cart_id IN (SELECT cart_id FROM cart WHERE user_id = ? AND status = 'pending')
        ";
        $stmt = $conn->prepare($cart_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $cart_items = $stmt->get_result();

        if ($cart_items->num_rows > 0) {
            // Tính tổng giá trị đơn hàng
            $total_amount = 0;
            $cart_data = [];
            while ($item = $cart_items->fetch_assoc()) {
                $subtotal = $item['quantity'] * $item['price'];
                $total_amount += $subtotal;
                $cart_data[] = $item;
            }

            // Tạo đơn hàng trong bảng `orders`
            $order_query = "
                INSERT INTO orders 
                (order_code, user_id, recipient_name, recipient_email, recipient_phone, recipient_address, order_date, total_amount, payment_method_id, status_id) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?)
            ";
            $order_code = uniqid('ORD');
            $status_id = 1; // Trạng thái mặc định (chờ xử lý)
            $stmt = $conn->prepare($order_query);
            $stmt->bind_param(
                "sissssdii",
                $order_code,
                $user_id,
                $recipient_name,
                $recipient_email,
                $recipient_phone,
                $recipient_address,
                $total_amount,
                $payment_method_id,
                $status_id
            );
            if (!$stmt->execute()) {
                $error = "Lỗi khi tạo đơn hàng: " . $stmt->error;
            } else {
                $order_id = $stmt->insert_id;

                // Thêm chi tiết sản phẩm vào `order_items`
                $order_item_query = "
INSERT INTO order_items (order_id, product_id, quantity, price) 
VALUES (?, ?, ?, ?)
";
                $stmt = $conn->prepare($order_item_query);
                foreach ($cart_data as $item) {
                    $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
                    if (!$stmt->execute()) {
                        $error = "Lỗi khi thêm chi tiết sản phẩm: " . $stmt->error;
                        break;
                    }
                }


                // Xóa giỏ hàng sau khi đặt hàng
                $clear_cart_query = "
                    DELETE FROM cart_item 
                    WHERE cart_id IN (SELECT cart_id FROM cart WHERE user_id = ? AND status = 'pending')
                ";
                $stmt = $conn->prepare($clear_cart_query);
                $stmt->bind_param("i", $user_id);
                if (!$stmt->execute()) {
                    $error = "Lỗi khi xóa giỏ hàng: " . $stmt->error;
                } else {
                    // Chuyển hướng đến trang thành công
                    $_SESSION['order_success'] = [
                        'order_id' => $order_id,
                        'total_amount' => $total_amount,
                    ];
                    header("Location: success.php");
                    exit();
                }
            }
        } else {
            $error = "Giỏ hàng của bạn trống!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../style/style_checkout.css">
</head>

<body>
    <div class="boxcenter">
        <h2>Đặt Hàng</h2>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php
        // Lấy giỏ hàng của người dùng
        $cart_query = "
            SELECT ci.product_id, ci.quantity, p.price, p.image_src, p.name 
            FROM cart_item ci 
            JOIN product p ON ci.product_id = p.id 
            WHERE ci.cart_id IN (SELECT cart_id FROM cart WHERE user_id = ? AND status = 'pending')
        ";
        $stmt = $conn->prepare($cart_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $cart_items = $stmt->get_result();

        if ($cart_items->num_rows > 0): ?>
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
                    $total = 0;
                    while ($item = $cart_items->fetch_assoc()):
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
                    <?php endwhile; ?>
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
            <label for="recipient_name">Họ và tên:</label>
            <input type="text" name="recipient_name" id="recipient_name" required>

            <label for="recipient_email">Email:</label>
            <input type="email" id="recipient_email" name="recipient_email" required>

            <label for="recipient_phone">Số điện thoại:</label>
            <input type="text" name="recipient_phone" id="recipient_phone" required>

            <label for="recipient_address">Địa chỉ giao hàng:</label>
            <input type="text" name="recipient_address" id="recipient_address" required>

            <label for="payment_method_id">Phương thức thanh toán:</label>
            <select name="payment_method_id" id="payment_method_id" required>
                <option value="1">Thanh toán khi nhận hàng</option>
                <option value="2">Thanh toán online</option>
            </select>

            <button type="submit" name="confirm_order">Xác nhận đặt hàng</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>