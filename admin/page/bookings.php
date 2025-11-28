<?php
session_start();
if(!isset($_SESSION['App_Log_Access'])){
	header("location: index.php");
  }
error_reporting(0);
require_once '../includes/admin-header.php';
require "../background_script/connect_function.php";
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div> -->
          <div class="col-sm-6">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="bookings.php">Booking</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- start with the number cards -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="search-bar">
                            <form action="<?=$_SERVER['SCRIPT_NAME'];?>" method="post">
                            <input type="search" name="txtKeyword" placeholder="Search Reports...">
                            <button type="submit" name="search"><i class='bx bx-search'></i></button>
                            </form>
                        </div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Equipment</th>
                    <th>Department</th>
                    <th>Date in Use</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php require "../background_script/bk_back_script.php";?>
                  </tbody>
                </table>
                <br/>
                <?php if (ceil($total_pages / $limit) > 0): ?>
                  <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-end">
                  <?php if ($page > 1): ?>
                  <li class="page-item"><a class="page-link" href="adoption.php?page=<?php echo $page-1 ?>">Prev</a></li>
                  <?php endif; ?>

                  <?php if ($page > 3): ?>
                  <li class="page-item"><a class="page-link" href="adoption.php?page=1">1</a></li>
                  <li class="page-item">...</li>
                  <?php endif; ?>

                  <?php if ($page-2 > 0): ?><li class="page-item"><a href="adoption.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
                  <?php if ($page-1 > 0): ?><li class="page-item"><a href="adoption.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

                  <li class="page-item active"><a class="page-link" href="adoption.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                  <?php if ($page+1 < ceil($total_pages / $limit)+1): ?><li class="page-item"><a class="page-link" href="adoption.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
                  <?php if ($page+2 < ceil($total_pages / $limit)+1): ?><li class="page-item"><a class="page-link" href="adoption.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

                  <?php if ($page < ceil($total_pages / $limit)-2): ?>
                  <li class="page-item">...</li>
                  <li class="page-item"><a class="page-link" href="adoption.php?page=<?php echo ceil($total_pages / $limit) ?>"><?php echo ceil($total_pages / $limit) ?></a></li>
                  <?php endif; ?>

                  <?php if ($page < ceil($total_pages / $limit)): ?>
                  <li class="page-item"><a class="page-link" href="adoption.php?page=<?php echo $page+1 ?>">Next</a></li>
                  <?php endif; ?>
                </ul>
                </nav>
                <?php endif; ?>
              </div>
              <!-- /.card-body -->
			  
            </div>
            <!-- /.card -->
</div>
</div>
</div>
</section>
    <!-- end of number cards -->


</div>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
<?php
    require_once '../includes/admin-footer.php';
?>