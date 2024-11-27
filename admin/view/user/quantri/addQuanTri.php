<?php
// Include necessary files
include_once "../../layout/header.php";
?>

<!-- Add Bootstrap CSS in the head section -->
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJp3t7zZqXwnlSckbwJ0wQp6LVG8kWuhgHP1XbRmfd+XrTjYhjC5yYDb2w3z" crossorigin="anonymous">
</head>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Thêm Tài Khoản Quản Trị</h4>
        </div>
        <div class="card-body">
        <form action="<?= BASE_URL_ADMIN . '?act=add-user' ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="user_name">Tên đăng nhập:</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" required placeholder="Nhập tên đăng nhập">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group">
                    <label for="full_name">Họ và tên:</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" required placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label for="sex">Giới tính:</label>
                    <select name="sex" id="sex" class="form-control">
                        <option value="male">Nam</option>
                        <option value="female">Nữ</option>
                        <option value="other">Khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email_user">Email:</label>
                    <input type="email" name="email_user" id="email_user" class="form-control" required placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" name="address" id="address" class="form-control" required placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label for="phone_user">Số điện thoại:</label>
                    <input type="text" name="phone_user" id="phone_user" class="form-control" required placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="img_user">Hình ảnh:</label>
                    <input type="file" name="img_user" id="img_user" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role">Chức vụ:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3">Thêm</button>
                <a href="<?= 'http://localhost/da1/DA1-N7/admin/view/user/quantri/listQuanTri.php'
 ?>" class="btn btn-secondary mt-3">Quay lại</a>
<!--            </form>-->
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and Popper.js (needed for certain Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb90E4RJKF0tM5n4x6V6QWl6EhrPnY5tLQlmAZ8kL2JRU7Yq5h" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0dp5Tsz0tcB0cthHqG07gkX57z6r59HkUkmSgqL8e1RdyqzR" crossorigin="anonymous"></script>

<?php
include_once "../../layout/footer.php";
?>
