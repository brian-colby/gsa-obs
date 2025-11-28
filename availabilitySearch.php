<?php
session_start();
// DB connection 
include "php_admin_script/connect_function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Get the inputs from the POST request
  $equipment_id = $mysqli->escape_string($_POST['equipment_name']);
  $use_date = $mysqli->escape_string($_POST['date']);
  $start_time = $mysqli->escape_string($_POST['start_time']);
  $end_time = $mysqli->escape_string($_POST['end_time']);
  $status_in_use = "In-Use";
  $status_approved = "Approved";

  $sql = "SELECT request_tbl.request_id, request_tbl.name, equipment_tbl.equipment_name, equipment_tbl.equipment_code, request_tbl.use_date, status.status_name 
          FROM request_tbl 
          INNER JOIN request_equipment ON request_tbl.request_id = request_equipment.request_id
          INNER JOIN equipment_tbl ON request_equipment.equipment_id = equipment_tbl.equipment_id 
          INNER JOIN status ON request_tbl.status_id = status.status_id 
          WHERE request_equipment.equipment_id = ? AND request_tbl.use_date = ? AND (status.status_name = ? OR status.status_name = ?) AND (
            (request_tbl.start_time < ? AND request_tbl.end_time > ?) OR
            (request_tbl.start_time < ? AND request_tbl.end_time > ?) OR
            (request_tbl.start_time >= ? AND request_tbl.end_time <= ?)
          )";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("isssssssss", $equipment_id, $use_date, $status_in_use, $status_approved, $end_time, $start_time, $start_time, $end_time, $start_time, $end_time);
  $stmt->execute();

  // Debugging lines
  error_log($stmt->error);
  error_log($sql);

  // You need to store the result temporarily before fetching all for debugging
  $result = $stmt->get_result();
  error_log(json_encode($result->fetch_all(MYSQLI_ASSOC)));

  if ($result->num_rows > 0) {
      $_SESSION['status_title'] = "Bad News!";
      $_SESSION['status'] = "The equipment is not available for the requested time.";
      $_SESSION['status_code'] = "error";
      header("location:index.php?availabilityError");
  } else {
      $_SESSION['status_title'] = "Good News!";
      $_SESSION['status'] = "The equipment is available for the requested time.";
      $_SESSION['status_code'] = "success";
      header("location:index.php?availabilitySuccessful");
  }


  $stmt->close();
}
$mysqli->close();
?>
