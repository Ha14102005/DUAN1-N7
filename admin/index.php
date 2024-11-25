<?php
//Base URL
include_once "../commons/env.php";
include_once "../commons/function.php";


// 1. Nhúng các file cần thiết
include_once "controller/CategoryController.php";
include_once "model/Category.php";
include_once "controller/ProductController.php";
include_once "model/Product.php";
include_once "model/ProductQuery.php";
include_once "controller/OrderController.php";
include_once "model/Order.php";




// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    
    //Category
    'list-category' => (new AdminDanhMucControler())->listDanhMuc(),
    'form-add-category'=>(new AdminDanhMucControler())->formAddDanhMuc(),
    'add-category'=>(new AdminDanhMucControler())->postAddDanhMuc(),
    'form-edit-category'=>(new AdminDanhMucControler())->formEditDanhMuc(),
    'edit-category'=>(new AdminDanhMucControler())->postEditDanhMuc(),
    'delete-category'=>(new AdminDanhMucControler())->deleteDanhMuc(),

    //Product
    'list-product'=>(new ProductController())->showList(),
    'add-product'=>(new ProductController())->showCreate(),
    'detail-product'=>(new ProductController())->showDetail($id),
    'update-product'=>(new ProductController())->showUpdate($id),
    'delete-product'=>(new ProductController())->delete($id),

    //Order
    'list-order' => (new AdminDonHangControler())->listDonHang(),
    'detail-order'=>(new AdminDonHangControler())->detailDonHang(),
    'form-edit-order'=>(new AdminDonHangControler())->formEditDonHang(),
    'edit-order'=>(new AdminDonHangControler())->postEditDonHang(),
    
};
