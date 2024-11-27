<?php

case 'list_user':

if (isset($_SESSION['admin'])) {
$listuser = loadall_user();
render(
'list_user',
['listuser' => $listuser]
);
} else {
header("location: Thongke.php?act=login");
}

break;
// chỉnh sửa user
case 'edit_user':

if (isset($_SESSION['admin'])) {
if (isset($_GET['id_user']) && ($_GET['id_user'] > 0)) {
$id_user = $_GET['id_user'];
$user = loadone_user($id_user);
}
render(
'update_user',
['user' => $user]
);
} else {
header("location: Thongke.php?act=login");
}

break;
case 'update_user':
if (isset($_POST['btn_update']) && ($_POST['btn_update'])) {
$id_user = $_POST['id_user'];
$user_name = $_POST['user_name'];
$full_name = $_POST['full_name'];
$email_user = $_POST['email_user'];
$password = $_POST['password'];
$role = $_POST['role'];
update_user($id_user, $user_name, $full_name, $email_user, $password, $role);
echo '<script>alert("Cập nhật tài khoản thành công!")</script>';
}
header('location: Thongke.php?act=list_user');
break;
// Xóa người dùng
case 'delete-user':
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $id_user = intval($_GET['id']);
        delete_user($id_user); // Hàm xóa user trong model
        echo '<script>alert("Xóa tài khoản thành công!");</script>';
    }
    header("Location: " . BASE_URL_ADMIN . "?act=list-user");
    exit;
