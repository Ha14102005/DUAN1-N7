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

a {
    color: #337ab7;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th {
    background-color: #f9f9f9;
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

table td {
    padding: 10px;
    border: 1px solid #ddd;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #eaeaea;
}

img {
    display: block;
    margin: auto;
}

.navigation {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #f0f0f0;
    border-bottom: 1px solid #ddd;
}

.navigation a {
    margin-right: 10px;
}

table td.description {
    max-height: 120px;
    overflow-y: auto;
    display: -webkit-box;
    -webkit-line-clamp: 3; 

}



table td img {
    height: 100px; 
    width: 100px; 
    object-fit: cover;
    border-radius: 4px;
}
    </style>
</head>

<body>
    <!-- 1.Tiêu đề trang -->
    <h3>Trang Danh Sách Sản Phẩm</h3>


    <!-- 2.Khu vực điều hướng -->
    <div>
        <a href="?act=product-create">Trang tạo mới</a>
    </div>

    <!-- 3.Khu vực bảng dữ liệu -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mô tả chi tiết</th>
                <th>Giá Bán</th>
                <th>Hình Ảnh</th>
                <th>Số Lượng Còn</th>
                <th>Ngày Nhập</th>
                <th>Tương tác</th>
            </tr>
        </thead>

        <tbody>
            <?php  foreach( $danhSachObjectProduct as $product) {?>
            <tr>
                <td> <?= $product->id ?> </td>
                <td> <?= $product->name ?> </td>
                <td class="description"> <?= $product->description ?> </td>
                <td> <?= $product->price ?> </td>
                <td> 
                    <div style="height: 60px; width: 60px;">
                    <img style="max-height: 100%; max-width: 100%;" src="<?= BASE_URL.$product->image_src ?>" alt="">
                    </div>
                    
                </td>

                <td> <?= $product->stock ?> </td>
                <td> <?= $product->created_date ?> </td>
                <td> 
                    <a href="?act=product-detail&id=<?= $product->id ?>"> Xem</a>
                    <a href="?act=product-update&id=<?= $product->id ?>"> Sửa </a>
                    <a href="?act=product-delete&id=<?= $product->id ?>"onclick="return confirm('Bạn có chắc chắn xoá?')"> Xoá </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>