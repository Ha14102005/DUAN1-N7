<?php

class Admin
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllTaiKhoan()
    {
        $sql = "SELECT * FROM users WHERE role = 'admin'"; // Truy vấn lấy tất cả tài khoản admin
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(); // Trả về danh sách tài khoản quản trị viên
    }

    // Trong model Admin.php hoặc model tương ứng của bạn
    public function getAllTaiKhoanKhachHang() {
        $sql = "SELECT * FROM users WHERE role = 'user'"; // Giả sử 'role' là cột xác định quyền của người dùng
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách khách hàng dưới dạng mảng
    }

    public function insertuser($username,$email,$phone,$password,$role_id) {
        try {
            $sql = 'INSERT INTO `users` (`username,email,phone,password,role_id`) 
                    VALUES (`:username,:email,:phone,:password,:role_id`)';

            $stmt=$this->conn->prepare($sql);

            $stmt->execute(
                [
                    ':username'=>$username,
                    ':email'=>$email,
                    ':phone' =>$phone,
                    ':password'=>$password,
                    ':role_id'=>$role_id
                ]
            );
            return true;
        } catch (Exception $e) {
            echo 'lỗi' .$e->getMessage();
        }
    }
    public function getDetailTaiKhoan($id) {
        try {
            $sql = 'SELECT * FROM users WHERE id =:id';

            $stmt=$this->conn->prepare($sql);

            $stmt->execute(
                [
                    ':id'=>$id
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'lỗi' .$e->getMessage();
        }
    }
    public function checkLogin($email, $password) {
        try {
            $sql = 'SELECT * FROM users WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]); // Dùng ':email'
            $users = $stmt ->fetch();
            if ($users && password_verify($password , $users['password'])){
                if($users['role_id']==1){
                    if($users['created_at']== 1){
                        return $users['email'];
                }else{
                    return "Tai khoan bi cam";
                } 
        }else{
            return "Tai khoan khong co quyen dang nhap";
        }
    }else{
        return "Loi khi dang nhap";
    }
        }catch (\Throwable $e) {
            echo "loi". $e->getMessage();
            return false;
        }
    }
    public function deleteKhachHangById($id) {
        $sql = "DELETE FROM khach_hang WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
   
}

    