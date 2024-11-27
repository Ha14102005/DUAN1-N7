<?php include('./view/layout/header.php'); ?>

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
                            <h1>Danh sách tài khoản khách hàng</h1> <!-- Cập nhật tiêu đề -->
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
                                            <?php foreach ($listKhachHang as $key => $user) { ?>
                                                <tr>
                                                    <td> <?= $key + 1 ?> </td>
                                                    <td> <?= htmlspecialchars($user['username'] ?? 'N/A') ?> </td>
                                                    <td> <?= htmlspecialchars($user['phone'] ?? 'N/A') ?> </td>
                                                    <td> <?= htmlspecialchars($user['email'] ?? 'N/A') ?> </td>
                                                    <td>
                                                        <?= isset($user['create_at']) ? ($user['create_at'] == 1 ? 'Active' : 'Inactive') : 'Inactive' ?>
                                                    </td>
                                                    <td> <?= htmlspecialchars($user['role'] ?? 'N/A') ?> </td>
                                                    <td>
                                                        <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> <!-- Đảm bảo URL đúng -->
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

        <?php include "./view/layout/footer.php" ?>
    </div>
</body>

</html>