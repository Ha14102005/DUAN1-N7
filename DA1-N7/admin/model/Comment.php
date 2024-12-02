<?php

class Comment
{
    public $conn;

    public function __construct()
    { 
        // Hàm khởi tạo kết nối đối tượng
        $this->conn = connectDB();
    }

    /**
     * Lấy tất cả bình luận kèm thông tin sản phẩm và người dùng.
     */
    public function getAllBinhLuan()
{
    try {
        $sql = 'SELECT comments.*,
                       product.name AS product_name, 
                       users.username AS user_name
                FROM comments
                INNER JOIN product ON comments.product_id = product.id
                INNER JOIN users ON comments.user_id = users.user_id;';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Throwable $th) {
        // Ghi log lỗi và hiển thị thông tin
        error_log($th->getMessage());
        echo "Lỗi: " . $th->getMessage();
        return false;
    }
}

    /**
     * Xóa bình luận theo comment_id.
     */
    public function deleteBinhLuan($comment_id)
    {
        try {
            $sql = 'DELETE FROM comments WHERE comment_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' =>$comment_id
            ]);
            return true;
        } catch (\Throwable $th) {
            // Ghi log lỗi (nếu cần)
            error_log($th->getMessage());
            return false;
        }
    }
}