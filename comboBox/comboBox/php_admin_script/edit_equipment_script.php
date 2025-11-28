<?php
if(isset($_GET['equip_id'])){
		$id = $_GET['equip_id'];
		$query = "SELECT * FROM `equipment_tbl` WHERE equipment_id ='$id' limit 1";

		$output = $mysqli->query($query);
		
		while($row = $output->fetch_array()){
	    $equip_name = $row['equipment_name'];
	    $equip_code = $row['equipment_code'];
		$equip_avail = $row['equipment_availability'];
		}
		
  }
 
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if the update button was clicked
    if (isset($_POST['edit_equip'])) {
        // Retrieve values from the form
        $EQUIP_NAME = $mysqli->escape_string($_POST['equipment_name']);
        $EQUIP_NUMBER = $mysqli->escape_string($_POST['equip_number']);
        $EQUIP_AVAIL = $mysqli->escape_string($_POST['availability']);
        $fmy_id = $mysqli->escape_string($_POST['my_id']);

        // Prepare and execute the query
        $query = "UPDATE `equipment_tbl` SET `equipment_name` = '$EQUIP_NAME', `equipment_code` = '$EQUIP_NUMBER', `equipment_availability` = '$EQUIP_AVAIL' WHERE `equipment_tbl`.`equipment_id` = '$fmy_id'";
        $result = $mysqli->query($query);

        // Check if the query was successful
        if ($result) {
             echo '<script>alert("Update Successfully")</script>';
             echo '<script>window.location.href="equipment.php";</script>';
			
        } else {
            // Debugging information
            echo "Error: " . $mysqli->error;
        }
    }
}
  ?>