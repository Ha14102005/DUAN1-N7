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

// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}

// Xử lý thông tin sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $product_sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $conn->prepare($product_sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product_result = $stmt->get_result();

    if ($product_result->num_rows > 0) {
        $product = $product_result->fetch_assoc();
    } else {
        echo "Sản phẩm không tồn tại.";
        exit();
    }

    // Xử lý lưu đơn hàng
    if (isset($_POST['confirm_buy'])) {
        // Lấy thông tin từ form
        $recipient_name = $_POST['recipient_name'];
        $recipient_email = $_POST['recipient_email'];
        $recipient_phone = $_POST['recipient_phone'];
        $recipient_address = $_POST['recipient_address'];
        $quantity = (int)$_POST['quantity']; // Đảm bảo là số nguyên
        $price = (float)$product['price'];
        $total_amount = $quantity * $price; // Tính tổng tiền dựa trên số lượng
        $order_date = date("Y-m-d H:i:s");

        // Lưu vào bảng orders
        $order_sql = "INSERT INTO orders (order_code, user_id, recipient_name, recipient_email, recipient_phone, recipient_address, order_date, total_amount, payment_method_id, status_id)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $order_code = "ORD-" . uniqid();
        $payment_method_id = 1; // Giả định thanh toán COD
        $status_id = 1; // Giả định trạng thái 'Chờ xác nhận'
        $stmt = $conn->prepare($order_sql);
        $stmt->bind_param("sisssssiii", $order_code, $user_id, $recipient_name, $recipient_email, $recipient_phone, $recipient_address, $order_date, $total_amount, $payment_method_id, $status_id);
        $stmt->execute();
        $order_id = $stmt->insert_id;

        // Lưu chi tiết đơn hàng vào bảng order_items.Lệnh thêm và liệt kê
        $order_item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                           VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($order_item_sql);
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt->execute();

        // Lưu thông tin đơn hàng vào SESSION
        $_SESSION['order_success'] = [
            'order_id' => $order_code,
            'total_amount' => $total_amount
        ];

        // Chuyển hướng đến trang success.php
        header("Location: success.php");
        $conn->close();
        exit();
    }
} else {
    echo "Dữ liệu không hợp lệ.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua ngay</title>
    <link rel="stylesheet" href="../style/style_buynow.css">
    <script>
        // Cập nhật tổng tiền tự động khi số lượng thay đổi
        function updateTotalAmount() {
            const price = parseFloat(document.getElementById('product_price').value);
            const quantity = parseInt(document.getElementById('quantity').value);
            const totalAmount = price * quantity;
            document.getElementById('total_amount').innerText = totalAmount.toLocaleString('vi-VN') + " VNĐ";
        }
    </script>
</head>

<body>
    <h2>Mua ngay sản phẩm</h2>
    <h3>Thông tin sản phẩm:</h3>
    <h3>Tên sản phẩm: <?php echo $product['name']; ?></h3>
    <h3>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</h3>
    <img src="<?php echo $product['image_src']; ?>" alt="<?php echo $product['name']; ?>" width="200px">

    <h3>Nhập thông tin nhận hàng:</h3>
    <form method="post" action="">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <input type="hidden" id="product_price" value="<?php echo $product['price']; ?>">

        <label for="recipient_name">Họ tên người nhận:</label>
        <input type="text" name="recipient_name" id="recipient_name" required><br><br>

        <label for="recipient_email">Email:</label>
        <input type="email" name="recipient_email" id="recipient_email" required><br><br>

        <label for="recipient_phone">Số điện thoại:</label>
        <input type="text" name="recipient_phone" id="recipient_phone" required><br><br>

        <label for="recipient_address">Địa chỉ:</label>
        <textarea name="recipient_address" id="recipient_address" required></textarea><br><br>

        <label for="quantity">Số lượng:</label>
        <input type="number" name="quantity" id="quantity" min="1" value="1" required onchange="updateTotalAmount()"><br><br>

        <p>Tổng tiền: <span id="total_amount"><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</span></p>

        <button type="submit" name="confirm_buy">Xác nhận mua</button>
    </form>
</body>

</html>
