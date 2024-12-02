<?php
class StatisticsModel
{
    function pdo_query($sql, $params = [])
    {
        $conn = connectDB(); // Kết nối cơ sở dữ liệu
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function pdo_query_value($sql, $params = [])
    {
        $conn = connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    // Thống kê tổng quan theo danh mục
    function loadall_statis()
    {
        $sql = "SELECT c.category_id AS idcate, c.Name AS namecate, 
                       COUNT(p.id) AS pro_quantity, 
                       MIN(p.price) AS min_price, 
                       MAX(p.price) AS max_price, 
                       AVG(p.price) AS avg_price
                FROM product p 
                LEFT JOIN categories c ON c.category_id = p.category_id
                GROUP BY c.category_id 
                ORDER BY c.category_id DESC";
        return $this->pdo_query($sql);
    }



    // Tính doanh thu theo trạng thái
    function doanhthu_theo_trangthai($interval)
    {
        $sql = "SELECT SUM(o.total_amount) 
            FROM orders o 
            WHERE o.status_id IN (6, 8, 9) 
            AND o.order_date >= NOW() - INTERVAL $interval";
        return $this->pdo_query_value($sql);
    }

    function ngay()
    {
        return $this->doanhthu_theo_trangthai('1 DAY');
    }

    function tuan()
    {
        return $this->doanhthu_theo_trangthai('1 WEEK');
    }

    function thang()
    {
        return $this->doanhthu_theo_trangthai('1 MONTH');
    }

    function nam()
    {
        return $this->doanhthu_theo_trangthai('1 YEAR');
    }

    // Thống kê tổng quan
    function thongke_tongquan()
    {
        $sql = "SELECT COUNT(order_id) AS total_orders, SUM(total_amount) AS total_revenue 
                FROM orders 
                WHERE status_id IN (5, 6)";
        return $this->pdo_query($sql);
    }
}
