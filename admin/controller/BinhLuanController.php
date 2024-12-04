<?php
class BinhLuanController
{
    private $modelBinhLuan;

    public function __construct()
    {
        $this->modelBinhLuan = new Comment();
    }

    /**
     * Hiển thị danh sách bình luận.
     */
    public function getAllBinhLuan()
    {
        $listBinhLuan = $this->modelBinhLuan->getAllBinhLuan();
        require_once './view/binhluan/listBinhLuan.php';
    }

    /**
     * Xóa bình luận.
     */
    public function deleteBinhLuan()
    {
        $comment_id = $_POST['comment_id'] ?? null;

        if ($comment_id && $this->modelBinhLuan->deleteBinhLuan($comment_id)) {
            header('Location: ?act=binh-luan');
            exit();
        } else {
            echo "Không thể xóa bình luận!";
        }
    }
}
?>
