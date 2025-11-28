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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Equipment </li>
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
                <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
                  Add New Equipment
                </button>
				<div style="float: right;" >
                  <form class="form-inline my-2 my-lg-0" role="search" action="<?=$_SERVER['SCRIPT_NAME'];?>" method="post">
					  <input class="form-control mr-sm-2" type="search"  aria-label="Search" name="txtKeyword">
					  <button class="btn btn-outline-primary mr-sm-2" type="submit" name="search"><i class="fa fa-search"></i></button>
					</form>
                </div>
                <h3 class="card-title"> Equipment</h3>
                <div class="modal fade" id="modal-xl">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-edit"> </i> Add New Equipment </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="card card-primary card-outline card-outline-tabs">
						  <div class="card-header p-0 border-bottom-0">
							<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
							  <li class="nav-item">
								<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Equipment Information</a>
							  </li>
							</ul>
						  </div>
						  <div class="card-body">
							<div class="tab-content" id="custom-tabs-four-tabContent">
							  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
							  <form method="post" action="<?=$_SERVER['SCRIPT_NAME'];?>">
									  <div class="row card-body">
                      <div class="form-group col-4">
                        <label for="equipment-name">Equipment Name:</label>
                        <input type="text" class="form-control" name="equipment-name" id="equipment-name" required>
                      </div>
                      <div class="form-group col-4">
                        <label for="equip-number">Equipment Code:</label>
                        <input type="text" class="form-control" name="equip-number" id="equip-number" required>
                      </div>
                      <div class="form-group col-4">
                        <label for="availability">Availability:</label>
                        <input type="number" class="form-control" name="availability" id="availability" required>
                      </div>
									  </div>
							  </div>
							  
							</div>
						  </div>
						  <!-- /.card -->
						  
						</div>
                        
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="sub_equip">Save</button>
                      </div>
                    </div>
            </form>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
				
              </div>
              <!-- /.card-header -->
			  
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>Equipment Name</th>
                      <th>Equipment Code</th>
                      <th>Availability</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <?php require "php_admin_script/eqp_back_script.php";?>
				
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