<!-- header -->
<?php include(__DIR__ . '/../layout/header.php'); ?>
<!-- navbar -->
<?php include(__DIR__ . '/../layout/navbar.php'); ?>
<!-- sidebar -->
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Quản lí danh mục</h1>
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
                  <!-- Nút thêm danh mục -->
                  <a href="<?= BASE_URL_ADMIN . '?act=form-add-category' ?>">
                    <button class='btn btn-success'>Thêm danh mục</button>
                  </a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                      <!-- <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap"> <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Copy</span></button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>CSV</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button>
                          <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true"><span>Column visibility</span><span class="dt-down-arrow"></span></button></div>
                        </div>
                      </div> -->
                      <!-- <div class="col-sm-12 col-md-6">
                        <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div>
                      </div> -->
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                          <thead>
                            <tr>
                              <th rowspan="1" colspan="1">STT</th>
                              <th rowspan="1" colspan="1">Tên danh mục</th>
                              <th rowspan="1" colspan="1">Mô tả</th>
                              <th rowspan="1" colspan="1">Thao tác</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- <?php //if (empty($listDanhMuc)): 
                                  ?>
                            <tr>
                              <td colspan="4" style="text-align: center;">No categories available</td>
                            </tr>
                            <?php //else: 
                            ?> -->
                            <?php foreach ($listDanhMuc as $key => $danhmuc): ?>
                              <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $danhmuc['name'] ?></td>
                                <td><?= $danhmuc['description'] ?></td>
                                <td>
                                  <a href="<?= BASE_URL_ADMIN . '?act=form-edit-category&id_category=' . $danhmuc['id'] ?>">
                                    <button class='btn btn-warning'>Sửa</button>
                                  </a>

                                  <a href="<?= BASE_URL_ADMIN . '?act=delete-category&id_category=' . $danhmuc['id'] ?>" onclick="return confirm('Bạn chắc muốn xoá phân loại này chứ?')">
                                  <button class='btn btn-danger'>Xoá</button>
                                  </a>
                                </td>
                              </tr>
                            <?php endforeach ?>
                            <?php //endif; 
                            ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th rowspan="1" colspan="1">STT</th>
                              <th rowspan="1" colspan="1">Tên danh mục</th>
                              <th rowspan="1" colspan="1">Mô tả</th>
                              <th rowspan="1" colspan="1">Thao tác</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                      </div>
                      <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                          <ul class="pagination">
                            <li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                            <li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                            <li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                          </ul>
                        </div>
                      </div>
                    </div> -->
                  </div>
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

    <!-- Code injected by live-server -->
    <!-- footer -->
    <?php include(__DIR__ . '/../layout/footer.php'); ?>
    <!-- end footer -->
</body>

</html>