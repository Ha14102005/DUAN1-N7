
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
                <a href="<?= BASE_URL . '?act=form-add-danh-muc' ?>"><button class="btn btn-success">Thêm Danh Mục</button></a>
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
                      <td><?php echo $BinhLuan['ten_san_pham']; ?></td>
                      <td><?php echo $BinhLuan['ho_ten']; ?></td>
                      <td><?php echo $BinhLuan['noi_dung']; ?></td>
                      <td><?php echo $BinhLuan['ngay_dang'] ;?></td>

                      <td>
                        <a href="<?= BASE_URL . '?act=form-edit-binh_luan&idbinh_luanc='.$BinhLuan['id'] ?>"><button class="btn btn-warning">Sửa</button></a>
                        <a href="<?= BASE_URL . '?act=delete-binh_luan&id_binh_luan='.$BinhLuan['id'] ?>"><button class="btn btn-danger">Xóa</button></a>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
