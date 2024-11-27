<?php include(__DIR__ . '/../layout/header.php'); ?>
<!-- navbar -->
<?php include(__DIR__ . '/../layout/navbar.php'); ?>
<!-- sidebar -->
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<h2>Thống kê sản phẩm theo danh mục</h2>
<table>
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

<h2>Doanh thu trong ngày: <?= number_format($doanhthuNgay, 0) ?></h2>
<h2>Doanh thu trong tuần: <?= number_format($doanhthuTuan, 0) ?></h2>
<h2>Doanh thu trong tháng: <?= number_format($doanhthuThang, 0) ?></h2>
<h2>Doanh thu trong năm: <?= number_format($doanhthuNam, 0) ?></h2>
