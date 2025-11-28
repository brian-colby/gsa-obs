<?php
    session_start();
   if(!isset($_SESSION['App_Log_Access'])){
     header("location: ../index.php");
   }
    require_once '../includes/admin-header.php'; 
    require "php_admin_script/connect_function.php";
    include "php_admin_script/count.php";

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php if($NoErows > 0){echo $NoErows;}else{ echo '0';}?></h3>

                <p>Number of Equipments</p>
              </div>
              <div class="icon">
                <i class="ion ion-people"></i>
              </div>
              <a href="equipment.php" class="small-box-footer">More data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php if($AvErows > 0){echo $AvErows;}else{ echo '0';}?></h3>

                <p>Availabile Equipment</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="equipment.php" class="small-box-footer">More data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php if($numrows > 0){echo $numrows;}else{ echo '0';}?></h3>
				
                <p>Number of Requests</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="dashboard.php" class="small-box-footer">More data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php if($AcErows > 0){echo $AcErows;}else{ echo '0';}?></h3>

                <p>Active Equipments</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="equipment.php" class="small-box-footer">More data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

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
                <h3 class="card-title"> </h3>
              </div>
              <!-- /.card-header -->
			  
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Equipment</th>
                    <th>Date in Use</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Request Date</th>
                  </tr>
                  </thead>

                  <?php require "php_admin_script/dsh_back_script.php";?>
				
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