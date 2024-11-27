<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="style/style_index.css">
</head>

<body>
    <?php
    // Kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "duan1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy danh sách sản phẩm theo category_id hoặc hiển thị tất cả
    if (isset($_GET['category_id'])) {
        $category_id = intval($_GET['category_id']);
        $sql = "SELECT * FROM product WHERE category_id = $category_id";
    } else {
        $sql = "SELECT * FROM product";
    }
    $products = $conn->query($sql);

    // Lấy danh sách sản phẩm mới nhất (5 sản phẩm)
    $top_sql = "SELECT * FROM product ORDER BY created_date DESC LIMIT 5";
    $top_products = $conn->query($top_sql);
    ?>

    <div class="boxcenter">
        <div class="row mb header">
            <img src="slide/FPT_Polytechnic.png" alt="" width="180px">
            <form action="" method="get">
                <input type="text" name="query" required placeholder="Nhập máy tính, phụ kiện... cần tìm">
                <button type="submit">Tìm kiếm</button>
            </form>

            <?php
            // Tìm kiếm sản phẩm
            if (isset($_GET['query'])) {
                $query = $_GET['query'];
                $sql = "SELECT * FROM product WHERE name LIKE '%$query%'";
                $products = $conn->query($sql);
            }
            ?>

            <?php
            session_start();
            $is_logged_in = isset($_SESSION['user_id']);
            ?>
            <div class="account-user">
                <?php if ($is_logged_in): ?>
                    <!-- Hiển thị nút Đăng xuất -->
                    <form action="client/logout.php" method="post" style="display:inline-block;">
                        <button type="submit" class="button"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
                    </form>
                <?php else: ?>
                    <!-- Hiển thị nút Đăng nhập và Đăng ký -->
                    <a href="client/login.php" class="button"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                    <a href="client/register.php" class="button"><i class="fas fa-user-plus"></i> Đăng ký</a>
                <?php endif; ?>
            </div>

            <div class="account-button">
                <img src="slide/icon.png" alt="Account" width="20px">
                <span><a href="client/cart.php">Giỏ hàng</a></span>
            </div>
            <div class="account-button">
                <img src="slide/icon2.png" alt="Account" width="20px">
                <span><a href="client/view_orders.php">Đơn hàng</a></span>
            </div>
        </div>

        <div class="row mb banner">
            <img src="slide/silde1.jpg" alt="Slide 1" class="active">
            <img src="slide/silde2.jpg" alt="Slide 2">
            <img src="slide/silde3.jpg" alt="Slide 3">
            <img src="slide/silde4.jpg" alt="Slide 4">
            <img src="slide/slide5.jpg" alt="Slide 5">
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>

        <nav>
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="index.php?category_id=2">Laptop gaming</a></li>
            <li><a href="index.php?category_id=1">Laptop văn phòng</a></li>
            <li><a href="index.php?category_id=3">Laptop đồ hoạ-kỹ thuật</a></li>
            <li><a href="index.php?category_id=4">Phụ kiện</a></li>
            <li><a href="#">Tuyển dụng</a></li>
        </nav>

        <div class="row mb">
            <div class="boxleft mr">
                <div class="row mb search-results">
                    <?php
                    if ($products->num_rows > 0) {
                        while ($product = $products->fetch_assoc()) {
                    ?>
                            <div class="product-item">
                                <a href="client/detail_product.php?id=<?php echo $product['id']; ?>">
                                    <img src="<?php echo $product['image_src']; ?>" alt="<?php echo $product['name']; ?>" width="150px">
                                    <h4><?php echo $product['name']; ?></h4>
                                </a>
                                <p> <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</p>
                                <div>
                                    <form action="client/cart.php" method="post" style="display:inline-block;">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" name="add_to_cart">Thêm vào giỏ hàng</button>
                                    </form>
                                    <form action="client/buynow.php" method="post" style="display:inline-block;">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" name="buy_now">Mua ngay</button>
                                    </form>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>Không có sản phẩm nào.</p>";
                    }
                    ?>
                </div>
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
            </div>
    <?php
    $conn->close();
    ?>
    <script>
        let slideIndex = 0;

        function showSlides(n) {
            let slides = document.querySelectorAll(".banner img");
            if (n === undefined) {
                slideIndex++;
            } else {
                slideIndex = n;
            }

            if (slideIndex >= slides.length) {
                slideIndex = 0;
            }

            if (slideIndex < 0) {
                slideIndex = slides.length - 1;
            }

            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slides[slideIndex].style.display = "block";
            setTimeout(showSlides, 3000);
        }

        function plusSlides(n) {
            showSlides(slideIndex + n);
        }

        showSlides();
    </script>
    
</body>
</html>
<div>
        Mời bạn truy cập trang quản trị. <a href="admin/?act=list-product">Click here</a>
    </div>