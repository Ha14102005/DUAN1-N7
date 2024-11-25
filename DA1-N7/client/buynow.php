<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $product_query = "SELECT id, name, price FROM product WHERE id = ?";
    $stmt = $conn->prepare($product_query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    if (!$product) {
        die("Sản phẩm không tồn tại.");
    }

    if (isset($_POST['confirm_order'])) {
        $recipient_name = $_POST['recipient_name'];
        $recipient_email = $_POST['recipient_email'];
        $recipient_phone = $_POST['recipient_phone'];
        $recipient_address = $_POST['recipient_address'];
        $quantity = $_POST['quantity'];

        $total_price = $product['price'] * $quantity;

        $order_query = "INSERT INTO orders 
                        (user_id, recipient_name, recipient_email, recipient_phone, recipient_address, order_date, total_amount, payment_method_id, status_id) 
                        VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?)";
        $stmt = $conn->prepare($order_query);
        $payment_method_id = 1; // Default payment method
        $status_id = 1; // Default pending status
        $stmt->bind_param(
            "issssdii",
            $user_id,
            $recipient_name,
            $recipient_email,
            $recipient_phone,
            $recipient_address,
            $total_price,
            $payment_method_id,
            $status_id
        );
        $stmt->execute();

        $order_id = $stmt->insert_id;

        $order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price, total_price) 
                             VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($order_item_query);
        $stmt->bind_param("iiidd", $order_id, $product_id, $quantity, $product['price'], $total_price);
        $stmt->execute();

        $_SESSION['order_success'] = [
            'order_id' => $order_id,
            'total_price' => $total_price,
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
    <title>Mua Ngay</title>
</head>

<body>
    <div class="boxcenter">
        <h2>Mua Ngay</h2>

        <form method="post" action="">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <div>
                <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                <p>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</p>
            </div>

            <label for="quantity">Số lượng:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" required>

            <label for="recipient_name">Tên người nhận:</label>
            <input type="text" name="recipient_name" required>

            <label for="recipient_email">Email:</label>
            <input type="email" name="recipient_email" required>

            <label for="recipient_phone">Số điện thoại:</label>
            <input type="text" name="recipient_phone" required>

            <label for="recipient_address">Địa chỉ giao hàng:</label>
            <input type="text" name="recipient_address" required>

            <button type="submit" name="confirm_order">Xác nhận</button>
        </form>
    </div>
</body>

</html>
