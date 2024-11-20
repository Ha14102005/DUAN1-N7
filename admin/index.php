<?php
// Base URL
include_once "../commons/env.php";
include_once "../commons/function.php";

// Nhúng các file cần thiết
include_once "controller/CategoryController.php";
include_once "model/Category.php";
include_once "controller/ProductController.php";
include_once "model/Product.php";
include_once "model/ProductQuery.php";
include_once "controller/AuthController.php";
include_once "model/Admin.php";

// Lấy giá trị act từ URL
$act = $_GET['act'] ?? '/';
$id = $_GET['id'] ?? null;

// Route
match ($act) {
    // Category
    'list-category' => (new AdminDanhMucControler())->listDanhMuc(),
    'form-add-category' => (new AdminDanhMucControler())->formAddDanhMuc(),
    'add-category' => (new AdminDanhMucControler())->postAddDanhMuc(),
    'form-edit-category' => (new AdminDanhMucControler())->formEditDanhMuc(),
    'edit-category' => (new AdminDanhMucControler())->postEditDanhMuc(),
    'delete-category' => (new AdminDanhMucControler())->deleteDanhMuc(),

    // Product
    'list-product' => (new ProductController())->showList(),
    'add-product' => (new ProductController())->showCreate(),
    'detail-product' => (new ProductController())->showDetail($id),
    'update-product' => (new ProductController())->showUpdate($id),
    'delete-product' => (new ProductController())->delete($id),

    // Quản lý tài khoản
    'list-tai-khoan-quan-tri' => (new AuthController())->danhSachQuanTri($id),
    'form-them-quan-tri' => (new AuthController())->formAddQuanTri($id),
    'form-them-quan-tri' => (new AuthController())->postAddQuanTri($id),
    'form-sua-quan-tri' => (new AuthController())->formEditQuanTri($id),
    'sua-quan-tri' => (new AuthController())->postEditQuanTri($id),

};
