<?php
// if(isset($_GET['det_repo_id'])){
// 		$id = $_GET['det_repo_id'];
// 		$query = "SELECT request_tbl.request_id, telephone, request_tbl.name, department_tbl.department_name, equipment_tbl.equipment_name, equipment_tbl.equipment_code, request_tbl.use_date, status.status_name, request_date 
// 		FROM request_tbl 
// 		INNER JOIN equipment_tbl ON request_tbl.equipment_id = equipment_tbl.equipment_id 
// 		INNER JOIN department_tbl ON request_tbl.department_id = department_tbl.department_id 
// 		INNER JOIN status ON request_tbl.status_id = status.status_id WHERE request_id='$id' limit 1";

// 		$output = $mysqli->query($query);
		
// 		while($row = $output->fetch_array()){
// 	    $name = $row['name'];
// 	    $phone = $row['telephone'];
// 		$equipment = $row['equipment_name'];
// 		$department = $row['department_name'];
// 		$use_date = $row['use_date'];
// 		$status = $row['status_name'];
// 		$request_id = $row['request_id'];
// 		}
		
//   }
//  if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    	// Check if the update button was clicked
//    	if (isset($_POST['edit_report'])) {
//    		// Retrieve values from the form
//    		$fstatus = $mysqli->escape_string($_POST['status']);
//    		$fmy_id = $mysqli->escape_string($_POST['my_id']);

//    		$final_sql = $mysqli->query("UPDATE `request_tbl` SET `status_id` = '$fstatus'  WHERE `request_id` = '$fmy_id'");
   		
   		?>
         <!-- <script>
//           alert('update Successful!');
//     </script>-->
 	<?php  
// 		echo '<script>alert("Update Succesfully")</script>';
//    		echo '<script>window.location.href="detailed_report.php";</script>';
//    	}

//    }
  ?>

<?php

$name = $phone = $equipment = $department = $use_date = $status = $request_id = "";

if (isset($_GET['det_repo_id'])) {
    $id = $_GET['det_repo_id'];
    $query = "SELECT request_tbl.request_id, request_tbl.telephone, request_tbl.name, department_tbl.department_name, 
              GROUP_CONCAT(equipment_tbl.equipment_name SEPARATOR ', ') AS equipment_names, 
              request_tbl.use_date, status.status_name, request_tbl.request_date 
              FROM request_tbl 
              INNER JOIN request_equipment ON request_tbl.request_id = request_equipment.request_id 
              INNER JOIN equipment_tbl ON request_equipment.equipment_id = equipment_tbl.equipment_id 
              INNER JOIN department_tbl ON request_tbl.department_id = department_tbl.department_id 
              INNER JOIN `status` ON request_tbl.status_id = status.status_id 
              WHERE request_tbl.request_id = ? 
              GROUP BY request_tbl.request_id
              LIMIT 1";

    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $phone = $row['telephone'];
        $equipment = $row['equipment_names'];
        $department = $row['department_name'];
        $use_date = $row['use_date'];
        $status = $row['status_name'];
        $request_id = $row['request_id'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit_report'])) {
        $fstatus = $mysqli->escape_string($_POST['status']);
        $fmy_id = $mysqli->escape_string($_POST['my_id']);

        $final_sql = $mysqli->query("UPDATE `request_tbl` SET `status_id` = '$fstatus'  WHERE `request_id` = '$fmy_id'");
        if ($final_sql) {
            echo '<script>alert("Update Successfully")</script>';
            echo '<script>window.location.href="detailed_report.php";</script>';
        } else {
            echo '<script>alert("Update Failed")</script>';
        }
    }
}
?>
