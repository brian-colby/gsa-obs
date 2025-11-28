<?php 
session_start();
require ("php_script/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Lesley Yamoah-Arkhurst">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>IT Equipments Request</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/gsa-logo.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/gsa-logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/gsa-logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/gsa-logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/gsa-logo.png">
    <link rel="manifest" href="assets/img/gsa-logo.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/img/gsa-logo.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="css/vendors/simplebar.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="css/examples.css" rel="stylesheet">
    <link rel="canonical" href="https://coreui.io/docs/components/modal/">
  
  </head>
  <body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                  <h3>Check Equipment Availability</h3>
                  <p class="text-medium-emphasis">Fill the form to check if the equipment is available...</p>
				<form method="post" action="availabilitySearch.php">
                  <div class="input-group mb-3"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop"></use>
                      </svg></span>
                    <!-- <input class="form-control" type="text" placeholder="Username"> -->
                    <select class="form-select" name="equipment_name" aria-label="Default select example"> 
                      <option selected="" disabled="" value="">Select Equipment</option>
                        <?php $equip_script = $mysqli->query("SELECT `equipment_id`, `equipment_name` FROM equipments.equipment_tbl"); 
                          while ($row_equipment = $equip_script->fetch_assoc()){
                        ?>
                        <option  value="<?php echo $row_equipment['equipment_id'];?>"><?php echo $row_equipment['equipment_name'];?></option>
                        <?php 
                         }
                        ?>
                    </select>
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                      </svg></span>
                    <input class="form-control" type="date" name="date" placeholder="Desired Date">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text"> Start Time </span>
                    <input class="form-control" type="time" name="start_time" placeholder="Desired Time">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text"> End Time </span>
                    <input class="form-control" type="time" name="end_time" placeholder="Desired Time">
                  </div>
                  <div class="row">
                    <div class="d-grid gap-2">
                      <button class="btn btn-primary px-4" name="search_avail" type="submit">Check Availability</button>
                    </div>
				</form>
                    <div style="margin-top: 1em;" class="col-12 text-end">
                     <!-- <a href="booking.php"><button class="btn btn-link px-0" type="button">View Records</button></a>-->
					  <a href="../booking/index.php"><button class="btn btn-link px-0" type="button">Go Back</button></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card col-md-5 text-white bg-primary py-5">
                <div class="card-body text-center">
                  <div>
                    <h2>Book Equipment</h2>
                    <p>If the equipment you want to book is available, click the button to book now! </p>
                    <button class="btn btn-lg btn-outline-light mt-3" type="button" data-coreui-toggle="modal" data-coreui-target="#exampleModalLive">Book Equipment Now!</button>
                    <hr>
                    <a href="comboBox/index.php"><button class="btn btn-lg btn-outline-light mt-3" type="button">Admin Login</button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
   <!-- modal -->
   <div class="tab-content rounded-bottom">
        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
          <div class="modal fade" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" style="color: black;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLiveLabel">Equipment Booking Request</h5>
                  <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                  <form class="row g-3 needs-validation" novalidate="" method="post" action="php_admin_script/backscript.php">
                    <div class="col-md-12">
                      <label class="form-label" for="fname">Full Name</label>
                      <input class="form-control" id="fname" type="text" name="name" required>
                      <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-md-12">
                      <label class="form-label" for="telephone">Telephone</label>
                      <input class="form-control" id="telephone" type="text" name="telephone" required>
                      <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-md-12 container101">
                      <label class="form-label" for="dateid">Date Needed</label>
                      <input class="form-control" id="dateId" name="date[]" type="date" required>
                      <div class="valid-feedback">Looks good!</div>
                        <!-- <button class="btn btn-outline-info" type="button">Info</button> -->
                    </div>
                    <div class="col-md-3 ">
                        <button class="add_form_field btn btn-outline-info" type="button">Add Date</button>
                    </div>
                    <div class="col-md-12">
                    <div class="col-md-6 container101">
                      <label class="form-label" for="start_time">Start Time</label>
                      <input class="form-control" id="start_time" name="start_time" type="time" required>
                      <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-md-6 container101">
                      <label class="form-label" for="end_time">End Time</label>
                      <input class="form-control" id="end_time" name="end_time" type="time" required>
                      <div class="valid-feedback">Looks good!</div>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="equipid">Equipment</label>
                        <div class="d-flex">
                          <select class="form-select" id="equipId" onBlur="checkDateAndEquipmentAvailability()" name="equipment[]" required multiple>
                            <!-- <option selected="" disabled="" value="">Choose...</option> -->
                            <?php $equip_script = $mysqli->query("SELECT `equipment_id`, `equipment_name` FROM equipments.equipment_tbl"); 
                              while ($row_equipment = $equip_script->fetch_assoc()){
                            ?>
                            <option value="<?php echo $row_equipment['equipment_id'];?>"><?php echo $row_equipment['equipment_name'];?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="invalid-feedback">Please select a valid state.</div>
                      </div>
                    <div class="col-md-12">
                      <label class="form-label" for="departId">Department</label>
                      <select class="form-select" id="departId" name="department" required>
                        <option selected="" disabled="" value="">Choose...</option>
                        <?php $dept_script = $mysqli->query("SELECT `department_id`, `department_name` FROM equipments.department_tbl"); 
                          while ($row_department = $dept_script->fetch_assoc()){
                        ?>
                        <option  value="<?php echo $row_department['department_id'];?>"><?php echo $row_department['department_name'];?></option>
                        <?php 
                         }
                        ?>
                      </select>
                      <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                   <span id="user-date-availability-status"></span>
                   
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit" id="submit">Submit Request</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal end -->
    </div>
    
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#equipId').select2({
          placeholder: 'Choose...',
          width: '100%',
          dropdownParent: $('#exampleModalLive')
        });
      });

      let max_fields = 5; 
      let wrapper = $(".container101");
      let add_button = $(".add_form_field");

      let x = 1;
      $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
          x++;
          $(wrapper).append('<div><input class="form-control" id="dateId" name="date[]" type="date" required=""/><a href="#" class="delete">Delete</a></div>');
        } else {
          alert('You Reached the limits');
        }
      });

      $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
      });
    </script> 
    <script>
      // Ajax Query to check the availablity of equipment before submission
      function checkDateAndEquipmentAvailability(){
          $("#loaderIcon").show();
          jQuery.ajax({
              url: "check_available.php",
              data: {
                  dateid: $("#dateId").val(),
                  equipid: $("#equipId").val(),
                  start_time: $("#start_time").val(), 
                  end_time: $("#end_time").val()
              },
              type: "POST",
              success:function(data){
                  $("#user-date-availability-status").html(data);
                  $("#loaderIcon").hide();
              },
              error:function(){}
          });
      }
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- for alerts -->
    <?php
    if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
        // echo $_SESSION['status'];?>
        <script>
            swal.fire(
                '<?php echo $_SESSION['status_title'];?>',
                '<?php echo $_SESSION['status'];?>',
                '<?php echo $_SESSION['status_code'];?>'
            )
        </script>
        <?php
            unset($_SESSION['status']);
        }
        ?>
    <!-- end of alerts -->
  </body>
</html>