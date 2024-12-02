<?php
class StatisticsController
{
    public function showStatistics()
    {
        include_once 'model/StatisticsModel.php';
        $statModel = new StatisticsModel();

        $statis = $statModel->loadall_statis();
        $doanhthuNgay = $statModel->ngay();
        $doanhthuTuan = $statModel->tuan();
        $doanhthuThang = $statModel->thang();
        $doanhthuNam = $statModel->nam();
        $tongquan = $statModel->thongke_tongquan();

        require_once 'view/statistics/statisticsView.php';
    }
}
?>
