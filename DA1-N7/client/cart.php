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

// Kiểm tra xem người dùng có đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "Vui lòng đăng nhập để xem giỏ hàng của bạn.";
    exit();
}

// Thêm sản phẩm vào giỏ hàng
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1;

    // Kiểm tra xem giỏ hàng đã tồn tại chưa
    $cart_sql = "SELECT * FROM cart WHERE user_id = $user_id AND status = 'pending'";
    $cart_result = $conn->query($cart_sql);

    if ($cart_result->num_rows == 0) {
        // Tạo mới giỏ hàng nếu chưa có
        $conn->query("INSERT INTO cart (user_id, status, created_at) VALUES ($user_id, 'pending', NOW())");
        $cart_id = $conn->insert_id;
    } else {
        // Lấy ID giỏ hàng hiện có
        $cart = $cart_result->fetch_assoc();
        $cart_id = $cart['cart_id'];
    }

    // Kiểm tra xem sản phẩm đã có trong giỏ chưa
    $cart_item_sql = "SELECT * FROM cart_item WHERE cart_id = $cart_id AND product_id = $product_id";
    $cart_item_result = $conn->query($cart_item_sql);

    if ($cart_item_result->num_rows > 0) {
        // Tăng số lượng nếu sản phẩm đã tồn tại trong giỏ hàng
        $conn->query("UPDATE cart_item SET quantity = quantity + 1 WHERE cart_id = $cart_id AND product_id = $product_id");
    } else {
        // Thêm sản phẩm mới vào giỏ hàng
        $conn->query("INSERT INTO cart_item (cart_id, product_id, quantity) VALUES ($cart_id, $product_id, $quantity)");
    }
}

// Hiển thị sản phẩm trong giỏ hàng
$cart_items_sql = "
    SELECT p.id, p.name, p.price, p.image_src, ci.quantity 
    FROM cart_item ci
    JOIN product p ON ci.product_id = p.id
    JOIN cart c ON ci.cart_id = c.cart_id
    WHERE c.user_id = $user_id AND c.status = 'pending'
";
$cart_items = $conn->query($cart_items_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="style/style_cart.css">
</head>
<body>
    <h1>Giỏ Hàng Của Bạn</h1>

    <?php if ($cart_items->num_rows > 0): ?>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Thao tác</th>
            </tr>
            <?php $total = 0; ?>
            <?php while ($item = $cart_items->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> VNĐ</td>
                    <td>
                        <form action="update_cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="remove">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php $total += $item['price'] * $item['quantity']; ?>
            <?php endwhile; ?>
            <tr>
                <td colspan="3">Tổng cộng</td>
                <td><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</td>
                <td></td>
            </tr>
        </table>
    <?php else: ?>
        <p>Giỏ hàng của bạn đang trống.</p>
    <?php endif; ?>

    <a href="index.php">Tiếp tục mua hàng</a>

    <?php $conn->close(); ?>
</body>
</html>
