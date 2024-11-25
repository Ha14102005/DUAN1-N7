<!-- <!DOCTYPE html>
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
</head> -->

<!-- header -->
<?php include(__DIR__ . '/../layout/header.php'); ?>



<body class="hold-transition sidebar-mini">

  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <!-- navbar -->
    <?php include(__DIR__ . '/../layout/navbar.php'); ?>
    
    <!-- sidebar -->
    <?php include(__DIR__ . '/../layout/sidebar.php'); ?>

    <!-- content -->



    <div hidden>
        <!-- 2. Form nhập liệu -->
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Khu vực nhập tên -->
            <div style="margin-bottom: 16px;">
                <span>Nhập Tên:</span>
                <input type="text" name="name" value="<?= $product->name ?>">
            </div>

            <!-- Khu vực nhập thông tin chi tiết sản phẩm -->
            <div style="margin-bottom: 16px;">
                <span>Nhập Thông tin chi tiết sản phẩm:</span>
                <input type="text" name="description" value="<?= $product->description ?>">
            </div>


            <!-- Khu vực nhập giá -->
            <div style="margin-bottom: 16px;">
                <span>Nhập Giá:</span>
                <input type="number" name="price" value="<?= $product->price ?>">
            </div>

            <!-- Khu vực nhập số lượng sản phẩm còn trong kho -->
            <div style="margin-bottom: 16px;">
                <span>Nhập số lượng sản phẩm còn trong kho:</span>
                <input type="number" name="stock" value="<?= $product->stock ?>">
            </div>

            <!-- Khu vực nhập ảnh -->
            <div style="margin-bottom: 16px;">
                <span>Đường Dẫn Ảnh:</span>
                <input type="text" name="image" value="<?= $product->image_src ?>">

                <div>
                    <span>Chọn ảnh</span>
                    <input type="file" name="file_upload">
                </div>
            </div>

            <!-- Khu vực nhập ngày tạo -->
            <div style="margin-bottom: 16px;">
                <span>Nhập Ngày Nhập:</span>
                <input type="date" name="created_date" value="<?= $product->created_date ?>">
            </div>

            <!-- Khu vực button submit và điều hướng -->
            <div style="margin-bottom: 16px;">
                <a href="?act=product-list">Quay Lại</a>
                <button type="submit" name="submitForm">Tạo Mới</button>
            </div>

            <!-- Khu vực thông báo lỗi và thành công -->
            <div style="color: red;">
                <?= $thongBaoLoi ?>
            </div>
            <div style="color: green;">
                <?= $thongBaoThanhCong ?>
            </div>

        </form>



    </div>



    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Quản lí sản phẩm</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">DataTables</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Quick Example</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <!-- Tên -->
                                        <div class="form-group">
                                            <label for="name">Tên sản phẩm</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?= $product->name ?>">
                                        </div>
                                        <!-- Chi tiết -->
                                        <div class="form-group">
                                            <label for="description">Thông tin chi tiết sản phẩm</label>
                                            <input type="text" class="form-control" name="description" id="description" value="<?= $product->description ?>">
                                        </div>
                                        <!-- Khu vực nhập giá -->
                                        <div class="form-group">
                                            <label for="price">Giá sản phẩm</label>
                                            <input type="number" class="form-control" name="price" id="price" value="<?= $product->price ?>">
                                        </div>
                                        <!-- Khu vực nhập số lượng sản phẩm còn trong kho -->
                                        <div class="form-group">
                                            <label for="stock">Số lượng tồn kho</label>
                                            <input type="number" class="form-control" name="stock" id="stock" value="<?= $product->stock ?>">
                                        </div>

                                        <!-- Khu vực nhập ảnh -->
                                        <div class="form-group">
                                            <span>Đường dẫn ảnh</span>
                                            <input type="text" name="image" value="<?= $product->image_src ?>">

                                            <div class="form-control">
                                                <input type="file" class="" name="file_upload">
                                            </div>
                                        </div>
                                        <!-- Khu vực nhập ngày tạo -->
                                        <div class="form-control">
                                            <span>Nhập Ngày Nhập:</span>
                                            <input type="date" name="created_date" value="<?= $product->created_date ?>">
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div>
                                        <!-- mẫu input -->
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <a href="<?= BASE_URL_ADMIN . '?act=list-product' ?>">
                                            <button class="btn btn-warning">Quay lại</button>
                                        </a>
                                        <button type="submit" name="submitForm" class="btn btn-primary">Tạo Mới</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->







</body>
<?php
//footer
include "./view/layout/footer.php"
?>

<!-- </html> -->