<?php
session_start();

class Database {
    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;port=3306;dbname=duan1", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    // Lấy thông tin sản phẩm từ bảng `product`
    public function getProduct($product_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute(['id' => $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo đơn hàng mới trong bảng `orders`
    public function createOrder($user_id, $total_amount)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO orders (user_id, total_amount, status, created_at) 
            VALUES (:user_id, :total_amount, 'pending', NOW())
        ");
        $stmt->execute(['user_id' => $user_id, 'total_amount' => $total_amount]);
        return $this->pdo->lastInsertId();
    }

    // Thêm sản phẩm vào bảng `order_items`
    public function addOrderItem($order_id, $product_id, $quantity, $price)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO order_items (order_id, product_id, quantity, price) 
            VALUES (:order_id, :product_id, :quantity, :price)
        ");
        return $stmt->execute([
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price
        ]);
    }

    // Cập nhật số lượng tồn kho của sản phẩm trong bảng `product`
    public function updateStock($product_id, $quantity)
    {
        $stmt = $this->pdo->prepare("UPDATE product SET stock = stock - :quantity WHERE id = :product_id");
        $stmt->execute(['quantity' => $quantity, 'product_id' => $product_id]);
    }
}

// Khởi tạo đối tượng Database
$db = new Database();

// Xử lý thanh toán
if (isset($_POST['checkout'])) {
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; // Giả lập user_id là 1 nếu chưa đăng nhập

    $product = $db->getProduct($product_id);

    if ($product && $product['stock'] >= $quantity) {
        $total_amount = $product['price'] * $quantity;

        // Tạo đơn hàng mới
        $order_id = $db->createOrder($user_id, $total_amount);

        // Thêm sản phẩm vào bảng `order_items`
        if ($order_id) {
            $db->addOrderItem($order_id, $product_id, $quantity, $product['price']);
            $db->updateStock($product_id, $quantity);

            echo "Đặt hàng thành công!<br>";
            echo "Tên sản phẩm: " . $product['name'] . "<br>";
            echo "Giá: " . number_format($product['price'], 0, ',', '.') . " VND<br>";
            echo "Số lượng: " . $quantity . "<br>";
            echo "Tổng cộng: " . number_format($total_amount, 0, ',', '.') . " VND<br>";
        } else {
            echo "Lỗi khi tạo đơn hàng.";
        }
    } else {
        echo "Sản phẩm không tồn tại hoặc không đủ số lượng.";
    }
} else {
    echo "Dữ liệu không hợp lệ.";
}
?>
