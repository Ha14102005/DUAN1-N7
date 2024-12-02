<!-- header  -->
<?php include "./view/layout/header.php" ?>
  <!-- Navbar -->
  <?php include "./view/layout/navbar.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "./view/layout/sidebar.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lí bình luận</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                  <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Tài Khoản</th>
                    <th>Nội Dung</th>
                    <th>Ngày Đăng</th>
                    <th>Thao Tác</th>
                
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listBinhLuan as $key => $BinhLuan): ?>
                    <tr>
                      <td><?php echo $key+1 ?></td>
                      <td><?php echo $BinhLuan['product_name']; ?></td>
                      <td><?php echo $BinhLuan['user_name']; ?></td>
                      <td><?php echo $BinhLuan['content']; ?></td>
                      <td><?php echo $BinhLuan['created_at'] ;?></td>

                      <td>   
                        <a href="<?= BASE_URL . '?act=delete_binh_luan&id_binh_luan='.$BinhLuan['comment_id'] ?>"><button class="btn btn-danger">Xóa</button></a>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                   
                  <tfoot>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include "./view/layout/footer.php"; ?>
<!-- end footer  -->
<!-- Page specific script -->

</body>
</html>