<?php
    session_start();
   if(!isset($_SESSION['App_Log_Access'])){
     header("location: ../index.php");
   }
    require_once '../includes/staff-header.php'; 
    require "php_admin_script/connect_function.php";
    require "php_admin_script/edit_equipment_script.php";
    error_reporting(0);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Equipment</li>
              <li class="breadcrumb-item active">Edit Equipment </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Equipment Data</h3>
                <button style="float: right;" type="button" class="btn btn-primary" >
                  Edit Equipment
                </button>
			</div>
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
                    <form action="<?=$_SERVER['SCRIPT_NAME'];?>" method="post">
                        <input type="hidden" name="my_id" value="<?php echo $request_id;?>"/>
                        <div class="row card-body">
                            <div class="form-group col-4">
                                <label for="equipment-name">Equipment Name:</label>
                                <input type="text" class="form-control" name="equipment_name" id="equipment-name" value="<?php echo $equip_name;?>" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="equip-number">Equipment Code:</label>
                                <input type="text" class="form-control" name="equip_number" id="equip-number" value="<?php echo $equip_code;?>" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="availability">Availability:</label>
                                <input type="number" class="form-control" name="availability" id="availability" value="<?php echo $equip_avail;?>" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" name="edit_equip" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>

                </div>
              </div>
              <!-- /.card -->
            </div>

                    <!-- /.modal-content -->
             
              
            </div>
            <!-- /.card -->
</div>
</div>
</div>
</section>
</div>
<?php 
    require_once '../includes/staff-footer.php';
?>