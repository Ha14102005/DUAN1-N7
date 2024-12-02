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
        // var_dump($listBinhLuan);die;
        
        
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
    public function deleteBinhLuan($id)
       
    {
        $id=$_GET['id_binh_luan='];
        $result = $this->modelBinhLuan->deleteBinhLuan($id);
        if ($result) {
            // Xóa thành công, chuyển hướng về danh sách
            header('location:'. BASE_URL_ADMIN .'?act=binh-luan');
        } else {
            // Xóa thất bại, hiển thị thông báo lỗi
            echo "Không thể xóa bình luận!";
        }
    }
}