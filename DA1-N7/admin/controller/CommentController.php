<?php
class CommentController
{
    private $modelComment;

    public function __construct()
    {
        $this->modelComment = new Comment();
    }

    /**
     * Hiển thị danh sách bình luận.
     */
    public function getAllComment()
    {
        $listComment = $this->modelComment->getAllComment();
        require_once './view/comment/listComment.php';
    }

    /**
     * Xóa bình luận.
     */
    public function deleteComment()
    {
        $comment_id = $_POST['comment_id'] ?? null;

        if ($comment_id && $this->modelComment->deleteComment($comment_id)) {
            header('Location: ?act=binh-luan');
            exit();
        } else {
            echo "Không thể xóa bình luận!";
        }
    }
}
?>
