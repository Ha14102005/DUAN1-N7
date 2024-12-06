<?php include "./view/layout/header.php"; ?>
<?php include "./view/layout/navbar.php"; ?>
<?php include "./view/layout/sidebar.php"; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Quản lý bình luận</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Tài Khoản</th>
                                <th>Nội Dung</th>
                                <th>Ngày Đăng</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listComment as $key => $comment): ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= htmlspecialchars($comment['product_name']); ?></td>
                                    <td><?= htmlspecialchars($comment['user_name']); ?></td>
                                    <td><?= htmlspecialchars($comment['content']); ?></td>
                                    <td><?= htmlspecialchars($comment['created_at']); ?></td>
                                    <td>
                                        <form method="POST" action="?act=delete-binh-luan">
                                            <input type="hidden" name="comment_id" value="<?= $comment['comment_id']; ?>">
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include "./view/layout/footer.php"; ?>
