<!-- header -->
<?php include(__DIR__ . '/../layout/header.php'); ?>



<body class="hold-transition sidebar-mini">

  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <!-- navbar -->
    <?php include(__DIR__ . '/../layout/navbar.php'); ?>
    
    <!-- sidebar -->
    <?php include(__DIR__ . '/../layout/sidebar.php'); ?>

    <!-- content -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Chỉnh sửa đơn hàng-<?= $DonHang['order_code'] ?></h1>
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
                <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sửa đơn hàng</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN .'?act=edit-order'?>" method="post">
                <!-- gửi ngầm id -->
                <input type="text" name="id" value="<?=$DonHang['order_id'] ?>" hidden>
                
                <div class="card-body">
                  <div class="form-group">
                    <label>Tên Người Nhận</label>
                    <input type="text" class="form-control" name="recipient_name" value="<?=$DonHang['recipient_name'] ?>"placeholder="Nhập tên người nhận">
                    <?php
                    if(isset($errors['recipient_name'])){?>
                      <p class="text-danger"><?=$errors['recipient_name']?></p>
                    <?php }?>
                  </div>
                  <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="recipient_phone" value="<?=$DonHang['recipient_phone'] ?>"placeholder="Nhập sđt người nhận">
                    <?php
                    if(isset($errors['recipient_phone'])){?>
                      <p class="text-danger"><?=$errors['recipient_phone']?></p>
                    <?php }?>
                  </div> <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="recipient_email" value="<?=$DonHang['recipient_email'] ?>"placeholder="Nhập email người nhận">
                    <?php
                    if(isset($errors['recipient_email'])){?>
                      <p class="text-danger"><?=$errors['recipient_email']?></p>
                    <?php }?>
                  </div> <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea class="form-control" name="recipient_address" placeholder="Nhập địa chỉ người nhận"><?=$DonHang['recipient_address'] ?></textarea>
                    <?php
                    if(isset($errors['recipient_address'])){?>
                      <p class="text-danger"><?=$errors['recipient_address']?></p>
                    <?php }?>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
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

    <!-- Code injected by live-server -->
    <!-- footer -->
    <?php include(__DIR__ . '/../layout/footer.php'); ?>
    <!-- end footer -->
</body>

</html>