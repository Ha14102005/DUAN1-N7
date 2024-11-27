<?php
session_start();
// Base URL
include_once "../commons/env.php";
include_once "../commons/function.php";

// Include necessary files
include_once "controller/CategoryController.php";
include_once "model/Category.php";
include_once "controller/ProductController.php";
include_once "model/Product.php";
include_once "model/ProductQuery.php";
include_once "controller/AuthController.php";
include_once "model/Admin.php";
include_once 'controller/StatController.php';

// Get the action and ID from URL
$act = $_GET['act'] ?? '/';
$id = $_GET['id'] ?? null;

if ($act !== 'login-admin' && $act !== 'check-login-admin') {
    checkLoginAdmin();
}

// Routing logic
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

    //Thống kê
    'thong-ke' => (new StatController())->showStatistics(),


    // User management
    'list-tai-khoan-quan-tri' => (new AuthController())->danhSachQuanTri(),
    'form-them-quan-tri' => (new AuthController())->formAddQuanTri(),
    'add-user' => (new AuthController())->postAddQuanTri(), // Fixed routing for add-user
    'form-sua-quan-tri' => (new AuthController())->formEditQuanTri($id),
    'sua-quan-tri' => (new AuthController())->postEditQuanTri($id),
    'list-tai-khoan-khach-hang' => (new AuthController())->danhSachKhachHang(),

    // Login and logout
    'login-admin' => (new AuthController())->formLogin(),
    'check-login-admin' => (new AuthController())->login(),
    'logout-admin' => (new AuthController())->logout(),

    // Default case
    '/' => (new AuthController())->formLogin(),
    default => throw new Exception("Invalid action: $act"), // Handles undefined actions
};
