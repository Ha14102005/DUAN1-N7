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
    <h3>Trang Chi Tiết Sản Phẩm</h3>

    <!-- 2. Form nhập liệu -->
    <form action="" method="POST">
        <!-- Khu vực nhập tên -->
        <div style="margin-bottom: 16px;">
            <span>Nhập Tên:</span>
            <input type="text" name="name" value="<?= $product->name ?>" disabled>
        </div>

        <!-- Khu vực nhập Thông tin chi tiết sản phẩm -->
        <div style="margin-bottom: 16px;">
            <span>Nhập Thông tin chi tiết sản phẩm:</span>
            <input type="text" name="description" value="<?= $product->description ?>" disabled>
        </div>

        <!-- Khu vực nhập giá -->
        <div style="margin-bottom: 16px;">
            <span>Nhập Giá:</span>
            <input type="number" name="price" value="<?= $product->price ?>" disabled>
        </div>

        <div style="margin-bottom: 16px;">
            <span>Nhập Số lượng còn lại trong kho:</span>
            <input type="number" name="stock" value="<?= $product->stock ?>" disabled>
        </div>

        <!-- Khu vực nhập ảnh -->
        <div style="margin-bottom: 16px;">
            <span>Đường Dẫn Ảnh:</span>
            <input type="text" name="image_src" value="<?= $product->image_src ?>" disabled>
        </div>

        <!-- Khu vực nhập ngày tạo -->
        <div style="margin-bottom: 16px;">
            <span>Nhập Ngày Nhập:</span>
            <input type="date" name="created_date" value="<?= $product->created_date ?>" disabled>
        </div>

        <!-- Khu vực button submit và điều hướng -->
        <div style="margin-bottom: 16px;">
            <a href="?act=product-list">Quay Lại</a>
        </div>

        <!-- Khu vực thông báo lỗi và thành công -->


    </form>




</body>

</html>