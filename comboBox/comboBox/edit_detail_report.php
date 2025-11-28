<?php
    session_start();
   if(!isset($_SESSION['App_Log_Access'])){
     header("location: ../index.php");
   }
    require_once '../includes/staff-header.php'; 
    require "php_admin_script/connect_function.php";
    require "php_admin_script/edit_detail_report_script.php";
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
              <li class="breadcrumb-item">Report (Returned)</li>
              <li class="breadcrumb-item active">Edit Report (Returned) </li>
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
                            <h3 class="card-title">Edit Report Data (Returned)</h3>
                            <button style="float: right;" type="button" class="btn btn-primary">
                                Edit Report (Returned)
                            </button>
                        </div>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Report Information</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                        <form action="<?= $_SERVER['SCRIPT_NAME']; ?>" method="post">
                                            <input type="hidden" name="my_id" value="<?php echo $request_id; ?>"/>
                                            <div class="row card-body">
                                                <div class="form-group col-6">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" value="<?php echo $name; ?>" readonly>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="department">Department</label>
                                                    <input type="text" class="form-control" name="department" id="department" value="<?php echo $department; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row card-body">
                                                <div class="form-group col-6">
                                                    <label for="date-In-Use">Date in Use</label>
                                                    <input type="text" class="form-control" id="date-In-Use" value="<?php echo $use_date; ?>" readonly>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="equipment">Equipment</label>
                                                    <input type="text" class="form-control" name="equipment" id="equipment" value="<?php echo $equipment; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row card-body">
                                                <div class="form-group col-6">
                                                    <label for="contact">Contact</label>
                                                    <input type="text" class="form-control" id="contact" value="<?php echo $phone; ?>" readonly>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="inputStatus">Status</label>
                                                    <select id="inputStatus" class="form-control" name="status">
                                                        <option style="color:aquamarine" selected value="<?php echo $row['status_id']; ?>"><?php echo $status; ?></option>
                                                        <?php
                                                        $status_script = $mysqli->query("SELECT `status_id`, `status_name` FROM `equipments`.`status`");
                                                        while ($row_status = $status_script->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $row_status['status_id']; ?>"><?php echo $row_status['status_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="submit" name="edit_report" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
</div>
<?php 
    require_once '../includes/staff-footer.php';
?>