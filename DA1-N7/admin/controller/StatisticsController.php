<?php
// controller/StatController.php
class StatisticsController
{
public function showStatistics()
{
// Logic để lấy dữ liệu thống kê và render ra view
include_once 'model/StatisticsModel.php';
$statModel = new StatisticsModel();

$statis = $statModel->loadall_statis();
$doanhthuNgay = $statModel->ngay();
$doanhthuTuan = $statModel->tuan();
$doanhthuThang = $statModel->thang();
$doanhthuNam = $statModel->nam();

require_once 'view/statistics/statisticsView.php'; // Hiển thị kết quả
}
}