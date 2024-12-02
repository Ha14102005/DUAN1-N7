<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu ID sản phẩm tồn tại trong URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn sản phẩm
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = $conn->query($sql);

    // Kiểm tra nếu tìm thấy sản phẩm
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit;
    }
} else {
    echo "Không có sản phẩm nào được chọn.";
    exit;
}

// Lấy bình luận cho sản phẩm
$sql_comments = "
    SELECT 
        c.content, 
        c.created_at, 
        u.username 
    FROM comments c
    JOIN users u ON c.user_id = u.user_id
    WHERE c.product_id = $id
    ORDER BY c.created_at DESC
";
$result_comments = $conn->query($sql_comments);

// Xử lý việc gửi bình luận
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_content'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $comment_content = $_POST['comment_content'];

        // Thêm bình luận vào cơ sở dữ liệu
        $sql_insert_comment = "INSERT INTO comments (user_id, product_id, content, created_at) 
                               VALUES ($user_id, $id, '$comment_content', NOW())";
        if ($conn->query($sql_insert_comment) === TRUE) {
            header("Location: detail_product.php?id=$id"); // Tải lại trang để xem bình luận mới
        } else {
            echo "Lỗi khi thêm bình luận: " . $conn->error;
        }
    } else {
        echo "Bạn phải đăng nhập để bình luận.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" href="../style/style_detail.css">
</head>

<body>
    <div class="boxcenter">
        <div class="row mb header">
            <img src="../slide/FPT_Polytechnic.png" alt="" width="180px">
            <form action="" method="get">
                <input type="text" name="query" required placeholder="Nhập máy tính, phụ kiện... cần tìm">
                <button type="submit">Tìm kiếm</button>
            </form>
            <div class="account-user">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="../client/logout.php" method="post" style="display:inline-block;">
                        <button type="submit" class="button"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
                    </form>
                <?php else: ?>
                    <a href="../client/login.php" class="button"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                    <a href="../client/register.php" class="button"><i class="fas fa-user-plus"></i> Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="product-detail">
            <div class="product-images">
                <img src="<?php echo $product['image_src']; ?>" alt="<?php echo $product['name']; ?>" class="main-image">
            </div>
            <div class="product-info">
                <h1><?php echo $product['name']; ?></h1>
                <p><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</p>
                <p><strong>Mô tả:</strong> <?php echo $product['description']; ?></p>
                <p><strong>Số lượng còn lại:</strong> <?php echo $product['stock']; ?> sản phẩm</p>
                <p><strong>Ngày nhập kho:</strong> <?php echo date("d/m/Y", strtotime($product['created_date'])); ?></p>
            </div>
            <div>
                <form action="cart.php" method="post" style="display:inline-block;">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" name="add_to_cart">Thêm vào giỏ hàng</button>
                </form>
                <form action="buynow.php" method="post" style="display:inline-block;">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" name="buy_now">Mua ngay</button>
                </form>
            </div>
        </div>

        <!-- Bình luận -->
        <div class="comments-section">
            <h2>Bình luận</h2>

            <?php if ($result_comments->num_rows > 0): ?>
                <?php while ($comment = $result_comments->fetch_assoc()): ?>
                    <div class="comment">
                        <p><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong></p>
                        <p><?php echo htmlspecialchars($comment['content']); ?></p>
                        <p class="timestamp"><?php echo date("d/m/Y H:i", strtotime($comment['created_at'])); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Chưa có bình luận nào cho sản phẩm này.</p>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="" method="POST">
                    <textarea name="comment_content" required placeholder="Viết bình luận của bạn..." rows="4"></textarea>
                    <button type="submit">Gửi bình luận</button>
                </form>
            <?php else: ?>
                <p>Vui lòng <a href="../client/login.php">đăng nhập</a> để bình luận.</p>
            <?php endif; ?>
        </div>

    </div>

    <div class="footer">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>Thông tin công ty</h3>
                        <p>LaptopStore.vn</p>
                        <p>CÔNG TY CỔ PHẦN VIỆT NAM</p>
                        <p> Quận Long Biên, Thành phố Hà Nội, Việt Nam</p>
                        <p>SĐT: 024.9999.9999</p>
                        <p>Website: laptop88.vn</p>
                        <p>Sở KHĐT TP. Hà Nội cấp</p>
                    </div>
                    <div class="col">
                        <h3>Về LaptopStore.vn</h3>
                        <ul>
                            <li>Giới thiệu chung</li>
                            <li>Tuyển dụng</li>
                            <li>Liên hệ</li>
                        </ul>
                    </div>
                    <div class="col">
                        <h3>Chính sách</h3>
                        <ul>
                            <li>Chính sách mua hàng từ xa - kiểm hàng</li>
                            <li>Chính sách đặt cọc sản phẩm</li>
                            <li>Chính sách giao nhận - đổi trả</li>
                            <li>Hướng dẫn thanh toán trực tuyến</li>
                            <li>Chính sách bảo hành</li>
                            <li>Chính sách bảo mật thông tin</li>
                            <li>Quy trình tiếp nhận và giải quyết khiếu nại</li>
                            <li>Thỏa thuận sử dụng và quy định giao dịch chung</li>
                        </ul>
                    </div>
                    <div class="col">
                        <h3>Thanh toán</h3>
                        <ul>
                            <li>Thanh toán trực tuyến (Internet Banking)</li>
                            <li>Thanh toán khi nhận hàng (COD)</li>
                            <li>Hướng dẫn thanh toán VNPay</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="social">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-google-plus-g"></a>
            </div>
        </footer>
    </div>
</body>

</html>

<?php
$conn->close();
?>