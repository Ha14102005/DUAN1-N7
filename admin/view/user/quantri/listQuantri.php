<?php include('./view/layout/header.php'); ?>


<?php
//include_once "../DA1-N7/admin/controller/ProductController.php";
//include_once "../DA1-N7/admin/model/Product.php";
?>



<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- navbar -->
<?php include('./view/layout/navbar.php'); ?>
<!-- sidebar -->
<?php include('./view/layout/sidebar.php'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Quản lí tài khoản quản trị viên</h1>
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
                                <div class="card-header">
                                    <a href="<?= BASE_URL_ADMIN . '?act=add-user' ?>">
                                        <button class='btn btn-success'>Thêm tài khoản</button>
                                    </a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Trạng Thái</th>                                              
                                                <th>Chức vụ</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listQuanTri as $user) { ?>
                                                <tr>
                                                    <td> <?= $key+1 ?> </td>
                                                    <td> <?= $user['username']?> </td>
                                                    <td> <?= $user['email']?> </td>
                                                    <td> <?= $user['phone']?> </td>
                                                    <td> <?= $user['role']?> </td>
                                                    <td> <?= $user['create_at']==1?'Active' : 'Inactive'?> </td>
                                                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quantri=' . $user['id'] ?>"></a>
                                                        <a href="?act=update-user&id=<?= $user->id ?>"> Sửa </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
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

</body>