<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        h3 {
            margin: 0;
            padding: 10px;
            background-color: #f0f0f0;
            border-bottom: 1px solid #ddd;
        }

        form {
            width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        form div {
            margin-bottom: 16px;
        }

        form span {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #218838;
        }

        form a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }

        form a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- 1. Tiêu đề trang -->
    <h3>Trang Chỉnh sửa Sản Phẩm</h3>

    <!-- 2. Form nhập liệu -->
    <form action="" method="POST">
        <!-- Khu vực nhập tên -->
        <div>
            <span>Nhập Tên:</span>
            <input type="text" name="name" value="<?= $product->name ?>">
        </div>

        <!-- Khu vực nhập mô tả chi tiết -->
        <div>
            <span>Nhập Mô tả chi tiết sản phẩm:</span>
            <input type="text" name="description" value="<?= $product->description ?>">
        </div>

        <!-- Khu vực nhập giá -->
        <div>
            <span>Nhập Giá:</span>
            <input type="number" name="price" value="<?= $product->price ?>">
        </div>

        <!-- Khu vực nhập số lượng còn -->
        <div>
            <span>Nhập Số lượng còn:</span>
            <input type="number" name="stock" value="<?= $product->stock ?>">
        </div>

        <!-- Khu vực nhập ảnh -->
        <div>
            <span>Đường Dẫn Ảnh:</span>
            <input type="text" name="image_src" value="<?= $product->image_src ?>">
        </div>

        <!-- Khu vực nhập ngày tạo -->
        <div>
            <span>Nhập Ngày Tạo:</span>
            <input type="date" name="created_date" value="<?= $product->created_date ?>">
        </div>

        <!-- Khu vực button submit và điều hướng -->
        <div>
            <a href="?act=product-list">Quay Lại</a>
            <button type="submit" name="submitForm">Lưu lại</button>
        </div>

        <!-- Khu vực thông báo lỗi và thành công -->
        <div class="error">
            <?= $thongBaoLoi ?>
        </div>
        <div class="success">
            <?= $thongBaoThanhCong ?>
        </div>
    </form>
</body>
</html>