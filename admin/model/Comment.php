<?php
class Comment
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    /**
     * Lấy tất cả bình luận kèm thông tin sản phẩm và người dùng.
     */
    public function getAllBinhLuan()
    {
        try {
            $sql = 'SELECT comments.comment_id, comments.content, comments.created_at,
                           product.name AS product_name,
                           users.username AS user_name
                    FROM comments
                    INNER JOIN product ON comments.product_id = product.id
                    INNER JOIN users ON comments.user_id = users.user_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    /**
     * Xóa bình luận theo comment_id.
     */
    public function deleteBinhLuan($comment_id)
    {
        try {
            $sql = "DELETE FROM comments WHERE comment_id = :comment_id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':comment_id' => $comment_id]);
        } catch (Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
?>
