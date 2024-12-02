<?php

switch ($act) {
    // Category
    case 'list-category':
        (new AdminDanhMucControler())->listDanhMuc();
        break;
    case 'form-add-category':
        (new AdminDanhMucControler())->formAddDanhMuc();
        break;
    case 'add-category':
        (new AdminDanhMucControler())->postAddDanhMuc();
        break;
    case 'form-edit-category':
        (new AdminDanhMucControler())->formEditDanhMuc();
        break;
    case 'edit-category':
        (new AdminDanhMucControler())->postEditDanhMuc();
        break;
    case 'delete-category':
        (new AdminDanhMucControler())->deleteDanhMuc();
        break;

    // Product
    case 'list-product':
        (new ProductController())->showList();
        break;
    case 'add-product':
        (new ProductController())->showCreate();
        break;
    case 'detail-product':
        (new ProductController())->showDetail($id);
        break;
    case 'update-product':
        (new ProductController())->showUpdate($id);
        break;
    case 'delete-product':
        (new ProductController())->delete($id);
        break;

    // Statistics
    case 'thong-ke':
        (new StatisticsController())->showStatistics();
        break;

    // User management
    case 'list-tai-khoan-quan-tri':
        (new AuthController())->danhSachQuanTri();
        break;
    case 'form-them-quan-tri':
        (new AuthController())->formAddQuanTri();
        break;
    case 'add-user': // Fixed routing for add-user
        (new AuthController())->postAddQuanTri();
        break;
    case 'form-sua-quan-tri':
        (new AuthController())->formEditQuanTri($id);
        break;
    case 'sua-quan-tri':
        (new AuthController())->postEditQuanTri($id);
        break;
    case 'list-tai-khoan-khach-hang':
        (new AuthController())->danhSachKhachHang();
        break;

    // Login and logout
    case 'login-admin':
        (new AuthController())->formLogin();
        break;
    case 'check-login-admin':
        (new AuthController())->login();
        break;
    case 'logout-admin':
        (new AuthController())->logout();
        break;

    // Bình luận
    case 'binh-luan':
        (new BinhLuanController())->getAllBinhLuan();
        break;

    // Default case
    case '/':
        (new AuthController())->formLogin();
        break;
    default:
        throw new Exception("Invalid action: $act");
}
?>
