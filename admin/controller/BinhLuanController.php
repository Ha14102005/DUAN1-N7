<?php
// admin/controller/BinhLuanController.php
class BinhLuanController
{
    public $modelBinhLuan;

    public function __construct()
    {
        $this->modelBinhLuan = new Comment();
    }
    public function getAllBinhLuan()
    {
        $listBinhLuan = $this->modelBinhLuan->getAllBinhLuan();

        // Kiểm tra xem danh sách bình luận có phải là mảng không
        if (is_array($listBinhLuan) && count($listBinhLuan) > 0) {
            // Truyền dữ liệu đến view
            require_once './view/binhluan/listBinhLuan.php';
        } else {
            // Nếu không có dữ liệu, truyền mảng rỗng vào view
            $listBinhLuan = [];
            require_once './view/binhluan/listBinhLuan.php';
        }
    }
}