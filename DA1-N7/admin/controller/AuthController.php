<?php

class AuthController
{
    public $modelAdmin;

    public function __construct()
    {
        $this->modelAdmin = new Admin(); // Initialize the Admin model
    }

    public function getUserById($id)
    {
        // Kiểm tra nếu ID là hợp lệ
        if (!$id) {
            $_SESSION['error'] = "ID không hợp lệ!";
            header("Location: " . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri");
            exit();
        }

        // Gọi model để lấy thông tin người dùng theo ID
        $user = $this->modelAdmin->getAllTaiKhoan($id);

        // Kiểm tra xem có tìm thấy người dùng không
        if (!$user) {
            $_SESSION['error'] = "Không tìm thấy người dùng!";
            header("Location: " . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri");
            exit();
        }

        return $user; // Trả về thông tin người dùng
    }

    // Display the list of admin accounts
    public function danhSachQuanTri()
    {
        // Gọi phương thức trong model để lấy tất cả tài khoản quản trị
        $listQuanTri = $this->modelAdmin->getAllTaiKhoan();

        // Truyền dữ liệu vào view
        require_once './view/user/quantri/listQuanTri.php';
    }
    // Trong controller AuthController.php hoặc controller của bạn
    public function danhSachKhachHang() {
        $listKhachHang = $this->modelAdmin->getAllTaiKhoanKhachHang(); // Lấy tất cả tài khoản khách hàng
        require_once './view/user/khachhang/listKhachHang.php'; // Chuyển dữ liệu tới view
    }

    // Display the form to add an admin account
    public function formAddQuanTri()
    {
        require_once './view/user/quantri/addQuanTri.php';
    }

    // Handle adding a new admin account
    public function postAddQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['user_name'] ?? '';
            $password = password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT); // Hash the password
            $full_name = $_POST['full_name'] ?? '';
            $sex = $_POST['sex'] ?? 'other';
            $email_user = $_POST['email_user'] ?? '';
            $address = $_POST['address'] ?? '';
            $phone_user = $_POST['phone_user'] ?? '';
            $role = $_POST['role'] ?? 'viewer';
            $img_user = '';

            // Handle image upload
            if (isset($_FILES['img_user']) && $_FILES['img_user']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "../../uploads/";
                $target_file = $target_dir . basename($_FILES["img_user"]["name"]);
                if (move_uploaded_file($_FILES["img_user"]["tmp_name"], $target_file)) {
                    $img_user = basename($_FILES["img_user"]["name"]);
                }
            }

            // // Add user to the database
            // $this->modelAdmin->adduser([
            //     'user_name' => $user_name,
            //     'password' => $password,
            //     'full_name' => $full_name,
            //     'sex' => $sex,
            //     'email_user' => $email_user,
            //     'address' => $address,
            //     'phone_user' => $phone_user,
            //     'img_user' => $img_user,
            //     'role' => $role,
            //     'register_date' => date('Y-m-d H:i:s'),
            //     'last_login' => null
            // ]);

            // Redirect to the admin account list
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        }
    }


    // Display the form to edit an admin account
    public function formEditQuanTri($id)
    {
        if (!$id) {
            header("Location: " . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri");
            exit();
        }

        $admin = $this->modelAdmin->getAllTaiKhoan($id); // Fetch admin data by ID
        if (!$admin) {
            $_SESSION['error'] = "Admin not found!";
            header("Location: " . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri");
            exit();
        }

        require_once './view/user/quantri/formEditQuanTri.php';
    }




    // Handle editing an admin account
    public function postEditQuanTri($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $role = $_POST['role'] ?? 'Admin';
            $create_at = $_POST['create_at'] ?? 1; // Default: Active

            // Validate input
            if (empty($username) || empty($email) || empty($phone)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: " . BASE_URL_ADMIN . "?act=form-sua-quan-tri&id_quantri=" . $id);
                exit();
            }

            // Update admin details
            $this->modelAdmin->getDetailTaiKhoan($id, $username, $email, $phone, $role, $create_at);

            // Redirect to admin list
            header("Location: " . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri");
            exit();
        }
    }




    // Display the login form
    public function formLogin()
    {
        require_once './view/auth/formLogin.php';
    }

    // Handle login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validate input
            if (empty($email) || empty($password)) {
                $_SESSION["error"] = "Email and password are required!";
                header("Location: " . BASE_URL_ADMIN . "?act=login-admin");
                exit();
            }

            // Check login credentials
            $user = $this->modelAdmin->checkLogin($email, $password);

            if ($user) {
                // Successful login
                $_SESSION['user_admin'] = $user;
                header("Location: " . BASE_URL_ADMIN);
                exit();
            } else {
                // Login failed
                $_SESSION["error"] = "Invalid email or password!";
                header("Location: " . BASE_URL_ADMIN . "?act=login-admin");
                exit();
            }
        }
    }

    // Handle logout
    public function logout()
    {
        if (isset($_SESSION["user_admin"])) {
            unset($_SESSION["user_admin"]);
        }
        header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
        exit();
    }
}