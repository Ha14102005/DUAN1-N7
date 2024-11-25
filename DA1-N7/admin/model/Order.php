<?php 
class AdminDonHang{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    
    public function getAllDonHang() {
        try {
            $sql='SELECT orders.*,order_status.status_name
                    FROM orders
                    INNER JOIN order_status ON orders.status_id=order_status.status_id
                ';

            $stmt=$this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (Exception $e) {
            echo 'lỗi' .$e->getMessage();
        }
    }
    
    public function getDetailDonHang($id) {
        try {
            $sql = 'SELECT orders.*,order_status.status_name,users.*
                    FROM orders
                    INNER JOIN order_status ON orders.status_id=order_status.status_id
                    INNER JOIN users ON orders.user_id=users.user_id
                    WHERE order_id =:id
                    ';

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
    public function getProductDonHang($id) {
        try {
            $sql = 'SELECT DISTINCT order_items.*,product.name
            FROM order_items
            INNER JOIN product ON order_items.product_id=product.id
            WHERE order_id =:id';

            $stmt=$this->conn->prepare($sql);

            $stmt->execute(
                [
                    ':id'=>$id
                ]
            );
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'lỗi' .$e->getMessage();
        }
    }

    public function updateDonHang($id,$name,$phone,$email,$address) {
        try {
            $sql = 'UPDATE orders SET `recipient_name`=:ten,`recipient_email`=:mail,`recipient_phone`=:dienthoai,`recipient_address`=:diachi WHERE `order_id`=:id';


            $stmt=$this->conn->prepare($sql);

            $stmt->execute(
                [
                    ':ten'=>$name,
                    ':dienthoai'=>$phone,
                    ':mail'=>$email,
                    ':diachi'=>$address,
                    ':id'=>$id,
                ]
            );
            return true;
        } catch (Exception $e) {
            echo 'lỗi' .$e->getMessage();
        }
    }
    
}

?>