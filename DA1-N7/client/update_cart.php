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
    $cart_item_id = $_POST['cart_item_id'];

    // Xóa sản phẩm khỏi giỏ hàng
    $stmt = $conn->prepare("DELETE FROM cart_item WHERE id = ?");
    $stmt->bind_param("i", $cart_item_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: cart.php");
exit();
?>
