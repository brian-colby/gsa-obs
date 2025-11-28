<?php
    session_start();
   if(!isset($_SESSION['App_Log_Access'])){
     header("location: ../index.php");
   }
    require_once '../includes/admin-header.php'; 
    require "php_admin_script/connect_function.php";
    require "php_admin_script/count.php";
    error_reporting(0);
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
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Report</a></li>
              <li class="breadcrumb-item active">Report (Returned) </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- start with the number cards -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
				<div style="float: right;" >
                  <form class="form-inline my-2 my-lg-0" role="search" action="<?=$_SERVER['SCRIPT_NAME'];?>" method="post">
					  <input class="form-control mr-sm-2" type="search"  aria-label="Search" name="txtKeyword">
					  <button class="btn btn-outline-primary mr-sm-2" type="submit" name="search"><i class="fa fa-search"></i></button>
					</form>
                </div>
                <h3 class="card-title">Reports</h3>
				
              </div>
              <!-- /.card-header -->
			  
              <div class="card-body">
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
                  
                  <?php require "php_admin_script/rpt_rt_back_script.php";?>

				
              </div>
              <!-- /.card-body -->
			  
            </div>
            <!-- /.card -->
</div>
</div>
</div>

        </div>
        <!-- /.row -->
    </section>
    <!-- end of number cards -->

</div>
<?php
    require_once '../includes/admin-footer.php';
?>