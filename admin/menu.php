<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel | DataTables</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>/assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= BASE_URL_ADMIN ?>" class="brand-link">
            <img src="<?= BASE_URL_ADMIN ?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">ADMIN-LapAZ</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= BASE_URL_ADMIN ?>/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"> ADMIN</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Products -->
                    <li class="nav-item">
                        <a href="<?= BASE_URL_ADMIN . '?act=list-product' ?>" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Danh sách sản phẩm</p>
                        </a>
                    </li>
                    <!-- Categories -->
                    <li class="nav-item">
                        <a href="<?= BASE_URL_ADMIN . '?act=list-category' ?>" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Danh mục sản phẩm</p>
                        </a>
                    </li>
                    <!-- Orders -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Quản lí đơn hàng</p>
                        </a>
                    </li>
                    <!-- Stats -->
                    <li class="nav-item">
                        <a href="./thongke.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Thống kê</p>
                        </a>
                    </li>

                    <!-- Account Management -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Quản lý tài khoản <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <!-- Submenu -->
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri' ?>" class="nav-link">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>Tài khoản quản trị</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang' ?>" class="nav-link">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>Tài khoản khách hàng</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= BASE_URL_ADMIN ?>" class="nav-link">Home</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
            </li>

            <!-- Fullscreen -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <!-- Control Sidebar -->
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL_ADMIN .'?act=logout-admin' ?>" onclick="return confirm('Đăng xuất tài khoản')">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Quản lí admin</strong> - Ph54478
    </footer>

</div>

<!-- jQuery -->
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= BASE_URL_ADMIN ?>/assets/dist/js/adminlte.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>
</html>
