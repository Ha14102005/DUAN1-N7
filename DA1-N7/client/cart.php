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

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Khi người dùng gửi form thêm sản phẩm, mã kiểm tra sự kiện add_to_cart.
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1;

    // Kiểm tra giỏ hàng "pending" của người dùng
    $cart_check = "SELECT * FROM cart WHERE user_id = ? AND status = 'pending'";
    $stmt = $conn->prepare($cart_check);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $cart_result = $stmt->get_result();
    //Nếu giỏ hàng chưa tồn tại, tạo một giỏ hàng mới và lưu lại cart_id.
    if ($cart_result->num_rows > 0) {
        $cart = $cart_result->fetch_assoc();
        $cart_id = $cart['cart_id'];
    } else {
        $cart_insert = "INSERT INTO cart (user_id, created_at) VALUES (?, NOW())";
        $stmt = $conn->prepare($cart_insert);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $cart_id = $stmt->insert_id;
    }

    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    $cart_item_check = "SELECT * FROM cart_item WHERE cart_id = ? AND product_id = ?";
    $stmt = $conn->prepare($cart_item_check);
    $stmt->bind_param("ii", $cart_id, $product_id);
    $stmt->execute();
    $cart_item_result = $stmt->get_result();
    //Nếu sản phẩm đã tồn tại:
    if ($cart_item_result->num_rows > 0) {
        $cart_item_update = "UPDATE cart_item SET quantity = quantity + 1 WHERE cart_id = ? AND product_id = ?";
        $stmt = $conn->prepare($cart_item_update);
        $stmt->bind_param("ii", $cart_id, $product_id);
        $stmt->execute();
    } else {//Nếu sản phẩm dã tồn tại
        $price_query = "SELECT price FROM product WHERE id = ?";
        $stmt = $conn->prepare($price_query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $price_result = $stmt->get_result();
        $price = $price_result->fetch_assoc()['price'];

        $cart_item_insert = "INSERT INTO cart_item (cart_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($cart_item_insert);
        $stmt->bind_param("iiid", $cart_id, $product_id, $quantity, $price);
        $stmt->execute();
    }
}

// Xử lý tăng/giảm số lượng sản phẩm
if (isset($_POST['update_quantity'])) {
    $cart_item_id = $_POST['cart_item_id'];
    $action = $_POST['action'] ?? '';

    // Kiểm tra biến action trước khi thực hiện
    if ($action === 'increase') {
        $update_query = "UPDATE cart_item SET quantity = quantity + 1 WHERE id = ?";
    } elseif ($action === 'decrease') {
        $update_query = "UPDATE cart_item SET quantity = GREATEST(quantity - 1, 1) WHERE id = ?";
    }
       //GREATEST(quantity - 1, 1): Đảm bảo số lượng không nhỏ hơn 1.
    if (isset($update_query)) { // Kiểm tra xem $update_query có được gán hay không
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("i", $cart_item_id);
        $stmt->execute();
    }
}
// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_POST['delete_item'])) {
    $cart_item_id = $_POST['cart_item_id'];

    $delete_query = "DELETE FROM cart_item WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $cart_item_id);
    $stmt->execute();
}


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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="../style/style_cart.css">
</head>

<body>

    <div class="boxcenter">
        <h2>Giỏ Hàng Của Bạn</h2>

        <?php if ($cart_items->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    while ($cart_item = $cart_items->fetch_assoc()) {
                        $subtotal = $cart_item['price'] * $cart_item['quantity'];
                        $total += $subtotal;
                    ?>
                        <tr>                         
                            <td><img src="<?php echo $cart_item['image_src']; ?>" alt="" class="main-image"></td>
                            <td><?php echo $cart_item['name']; ?></td>
                            <td><?php echo number_format($cart_item['price'], 0, ',', '.'); ?> VNĐ</td>
                            <td>
                                <div class="quantity-control">
                                    <form method="POST" action="" style="display: inline;">
                                        <input type="hidden" name="cart_item_id" value="<?php echo $cart_item['id']; ?>">
                                        <input type="hidden" name="action" value="decrease">
                                        <button type="submit" name="update_quantity" class="button">-</button>
                                    </form>
                                    <input type="text" value="<?php echo $cart_item['quantity']; ?>" readonly>
                                    <form method="POST" action="" style="display: inline;">
                                        <input type="hidden" name="cart_item_id" value="<?php echo $cart_item['id']; ?>">
                                        <input type="hidden" name="action" value="increase">
                                        <button type="submit" name="update_quantity" class="button">+</button>
                                    </form>
                                </div>
                            </td>
                            <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="cart_item_id" value="<?php echo $cart_item['id']; ?>">
                                    <button type="submit" name="delete_item" class="button" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</button>
                                </form>
                            </td>

                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4">Tổng cộng:</td>
                        <td><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <a href="/DUAN1/DA1-N7/client/checkout.php" class="button">Đặt hàng</a>
        <?php else: ?>
            <p>Giỏ hàng của bạn đang trống!</p>
        <?php endif; ?>
    </div>

</body>

</html>

<?php
$conn->close();
?>