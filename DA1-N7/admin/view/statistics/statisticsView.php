<?php include(__DIR__ . '/../layout/header.php'); ?>
<!-- navbar -->
<?php include(__DIR__ . '/../layout/navbar.php'); ?>
<!-- sidebar -->
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Thống kê sản phẩm theo danh mục</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                    <th>Tên danh mục</th>
                    <th>Số lượng sản phẩm</th>
                    <th>Giá thấp nhất</th>
                    <th>Giá cao nhất</th>
                    <th>Giá trung bình</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($statis as $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['namecate']) ?></td>
                        <td><?= $row['pro_quantity'] ?></td>
                        <td><?= number_format($row['min_price'], 0) ?></td>
                        <td><?= number_format($row['max_price'], 0) ?></td>
                        <td><?= number_format($row['avg_price'], 0) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            
    <!-- Doanh thu -->
    <div class="mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="alert alert-info text-center">
                    <h4>Doanh thu ngày</h4>
                    <p><?= number_format($doanhthuNgay, 0) ?> VND</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-success text-center">
                    <h4>Doanh thu  tuần</h4>
                    <p><?= number_format($doanhthuTuan, 0) ?> VND</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning text-center">
                    <h4>Doanh thu  tháng</h4>
                    <p><?= number_format($doanhthuThang, 0) ?> VND</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-danger text-center">
                    <h4>Doanh thu  năm</h4>
                    <p><?= number_format($doanhthuNam, 0) ?> VND</p>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>


<?php include("./view/layout/footer.php"); ?>