<?php

class Comment
{
    public $conn;

    public function __construct()
    { // Hàm khởi tạo kết nối đối tượng
        $this->conn = connectDB();
    }

    public function getAllBinhLuan()
    {
        try {
            $sql = 'SELECT binh_luans.*, san_phams.ten_san_pham, tai_khoans.ho_ten
FROM binh_luans
INNER JOIN san_phams ON binh_luans.san_pham_id = san_phams.id
INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id;';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteBinhLuan($id)
    {
        try {
            $sql = 'DELETE FROM binh_luans WHERE id = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
