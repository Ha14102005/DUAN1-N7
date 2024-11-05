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

    // Truy vấn để lấy danh sách sản phẩm
    $sql = "SELECT * FROM product";
    $products = $conn->query($sql);

    // Truy vấn để lấy top 5 sản phẩm hot
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
            <div class="account-button">
                <img src="slide/icon.png" alt="Account" width="20px">
                <span><a href="cart.php">Giỏ hàng</a></span>
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
            <li><a href="">Laptop gaming</a></li>
            <li><a href="">Laptop văn phòng</a></li>
            <li><a href="">Phụ kiện</a></li>
            <li><a href="#">Tuyển dụng</a></li>
        </nav>
        <div class="row mb">
            <div class="boxleft mr">
                <div class="row mb search-results">
                    <!-- Danh sách sản phẩm -->
                    <?php
                    if ($products->num_rows > 0) {
                        while ($product = $products->fetch_assoc()) {
                    ?>
                            <div class="product-item">
                                <img src="upload/<?php echo $product['image_src']; ?>" alt="<?php echo $product['name']; ?>" width="150px">
                                <h4><?php echo $product['name']; ?></h4>
                                <p>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</p>
                                <p>Còn lại: <?php echo $product['stock']; ?> sản phẩm</p>
                                <button>Thêm vào giỏ hàng</button>
                                <button>Mua ngay</button>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>Không có sản phẩm nào.</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="boxright">
                <!-- Bảng Tài Khoản -->
                <div class="box">
                    <div class="boxtitle">Tài Khoản</div>
                    <div class="boxcontent formtaikhoan">
                        <form action="login.php" method="post">
                            <div class="row mb10">
                                Tên Đăng nhập
                                <input type="text" name="user" required>
                            </div>
                            <div class="row mb10">
                                Mật Khẩu<br>
                                <input type="password" name="pass" required>
                            </div>
                            <div class="row mb10">
                                <input type="checkbox"> Ghi nhớ tài khoản?
                            </div>
                            <div class="row mb10">
                                <input type="submit" value="Đăng nhập">
                            </div>
                        </form>
                        <li><a href="#">Quên mật khẩu</a></li>
                        <li><a href="register.php">Đăng kí thành viên</a></li>
                    </div>
                </div>

                <!-- Bảng Top sản phẩm hot -->
                <div class="box">
                    <div class="boxtitle">Top sản phẩm hot</div>
                    <div class="boxcontent">
                        <?php
                        if ($top_products->num_rows > 0) {
                            while ($top_product = $top_products->fetch_assoc()) {
                        ?>
                                <div class="top-product">
                                    <img src="images/<?php echo $top_product['image_src']; ?>" alt="<?php echo $top_product['name']; ?>" width="50px">
                                    <h4><?php echo $top_product['name']; ?></h4>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>Không có sản phẩm hot nào.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <!-- Nội dung footer -->
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
    Mời bạn truy cập trang quản trị. <a href="admin">Click here</a>
</div>