<?php
class Admin
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    
    public function getAllTaiKhoan($role_id) {
        try {
            $sql='SELECT * FROM users WHERE role_id= :role_id';

            $stmt=$this->conn->prepare($sql);

            $stmt->execute([':role_id=>$role_id']);

            return $stmt->fetchAll();

        } catch (Exception $e) {
            echo 'lỗi' .$e->getMessage();
        }
    }

    public function insertuser($username,$email,$phone,$password,$role_id) {
        try {
            $sql = 'INSERT INTO `users` (`username,email,password,role_id`) 
                    VALUES (`:username,:email,:password,:role_id`)';

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
}