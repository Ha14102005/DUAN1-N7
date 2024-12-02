<?php include(__DIR__ . '/../layout/header.php'); ?>



<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <!-- navbar -->
        <?php include(__DIR__ . '/../layout/navbar.php'); ?>

        <!-- sidebar -->
        <?php include(__DIR__ . '/../layout/sidebar.php'); ?>

        <!-- content -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Update sản phẩm</h1>
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
                            <div class="card">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Update</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <!-- Tên -->
                                            <div class="form-group">
                                                <label for="name">Tên sản phẩm</label>
                                                <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($product->name) ?>">
                                            </div>
                                            <!-- Chi tiết -->
                                            <div class="form-group">
                                                <label for="description">Thông tin chi tiết sản phẩm</label>
                                                <input type="text" class="form-control" name="description" id="description" value="<?= htmlspecialchars($product->description) ?>">
                                            </div>
                                            <!-- Khu vực nhập giá -->
                                            <div class="form-group">
                                                <label for="price">Giá sản phẩm</label>
                                                <input type="number" class="form-control" name="price" id="price" value="<?= htmlspecialchars($product->price) ?>">
                                            </div>
                                            <!-- Khu vực nhập số lượng sản phẩm còn trong kho -->
                                            <div class="form-group">
                                                <label for="stock">Số lượng tồn kho</label>
                                                <input type="number" class="form-control" name="stock" id="stock" value="<?= htmlspecialchars($product->stock) ?>">
                                            </div>

                                            <!-- Khu vực nhập ảnh -->
                                            <div class="form-group">
                                                <span>Đường dẫn ảnh</span>
                                                <input type="text" name="image" value="<?= htmlspecialchars($product->image_src) ?>">

                                                <div class="form-control">
                                                    <input type="file" class="" name="file_upload">
                                                </div>
                                            </div>
                                            <!-- Khu vực nhập ngày tạo -->
                                            <div class="form-control">
                                                <span>Nhập Ngày Nhập:</span>
                                                <input type="date" name="created_date" value="<?= htmlspecialchars($product->created_date) ?>">
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                        <?php if (!empty($thongBaoLoi)) : ?>
                                            <div class="p-3 mb-2 bg-danger text-white">
                                                <?= htmlspecialchars($thongBaoLoi) ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($thongBaoThanhCong)) : ?>
                                            <div class="p-3 mb-2 bg-success text-white">
                                                <?= htmlspecialchars($thongBaoThanhCong) ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="card-footer">
                                            <a href="<?= BASE_URL_ADMIN .'?act=list-product' ?>"><button class="btn btn-warning" type="button">Quay lại</button></a>
                                                
                                            <button type="submit" name="submitForm" class="btn btn-primary" require="Bạn có chắc muốn sửa sản phẩm này không?">Sửa</button>
                                        </div>
                                        <!-- Khu vực thông báo lỗi và thành công -->

                                    </form>
                                </div>
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




        <?php
        //footer
        include "./view/layout/footer.php"
        ?>
    </div>


</body>

</html>