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

if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    $cart_id = $_SESSION['cart_id'];

    // Xóa sản phẩm khỏi giỏ hàng
    $stmt = $conn->prepare("DELETE FROM cart_details WHERE cart_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $cart_id, $product_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: cart.php");
exit();
