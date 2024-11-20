<?php

class AuthController
{
    public $modelAdmin;

    public function __construct() // Thêm dấu cách giữa 'function' và '__construct'
    {
        $this->modelAdmin = new Admin();
    }

    public function danhsachQuanTri()
    {
        $listQuantri = $this->modelAdmin->getAllTaiKhoan(1); // Xóa dấu cách thừa
      require_once './view/user/quantri/listQuanTri.php';
    }
    public function formAddQuanTri(){
        require_once './view/user/quantri/addQuanTri.php';

}
public function postAddQuanTri()  {
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //lay ra du lieu
        $username =$_POST['username'];
        $email =$_POST['email'];

        //tao mang chua du lieu
        $errors=[];
        if(empty($username)){
            $errors['username']='Tên không được để trống';
        }
        if(empty($email)){
            // đặt password mặc định
            $password = password_hash('12345',PASSWORD_BCRYPT );
            // khai báo chức vụ
            $role_id=1;
            $this->modelAdmin->iseruser($username,$email,$password,$role_id) ;
            $errors['email']='Email không được để trống';
        $_SESSION['error'] = $errors;
        //neu khong co loi
            header('location:'. BASE_URL_ADMIN .'?act=list-tai-khoan-quan-tri');
            exit();
        }else{
        $_SESSION['flash'] = true;
        header('location'. BASE_URL_ADMIN .'?act=form-them-quan-tri');
            exit();
    }  
}
}
public function formEditQuanTri(){
    $id_quan_tri = $GET('id_quan_tri');
    $quantri=$this->modelAdmin->getAllQuanTri($quan_tri_id);
    //  var_dump($quantri);die;
    require_once './view/user/quantri/editQuanTri.php';
}
public function postEditQuanTri() {
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $username =$_POST['username'] ?? '';
        $email =$_POST['email'] ??'';
        // tạo 1 mảng trống để chứa dữ liệu
        $errors = [];
        if(empty($username)){
            $errors['username']= 'Tên không được để trống';
}
if(empty($email)){
    $errors['email']= 'Email không được để trống';
}
$_SESSION['error'] = $errors;
if(empty($errors)){
    $this -> modelAdmin->updateuser($quan_tri_id , $username , $email );
    header('location :'. BASE_URL_ADMIN .'?act=list-tai-khoan-quan-tri');
    exit();
}else{
    $_SESSION['flash'] = true;
    header('location :'. BASE_URL_ADMIN .'?act=form-sua-quan-tri&id_quan_tri'.$quan_tri_id);
    exit();
}
}
}
}