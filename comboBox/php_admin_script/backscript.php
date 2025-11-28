<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $mysqli->escape_String($_POST['name']);
    $telephone = $mysqli->escape_String($_POST['telephone']);
    $equipment_id = $mysqli->escape_String($_POST['equipment']);
    $department_id = $mysqli->escape_String($_POST['department']);
	$status_id = 0000000001;
    
    // Retrieve date array
    $date_array = $_POST['date'];
    
    // Prepare and execute insert query for each date
    foreach ($date_array as $date) {
        $use_date = $date; // Assuming date format matches database format
        
        // Insert query
        $insert_query = "INSERT INTO `equipments`.`request_tbl`
            (`name`, `telephone`, `equipment_id`, `department_id`, `use_date`, `status_id`)
            VALUES ('$name', '$telephone', '$equipment_id', '$department_id', '$use_date', '$status_id')";
        
        // Execute query
        if ($mysqli->query($insert_query) === TRUE) {
            echo "New record inserted successfully.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $mysqli->error;
        }
    }
}
?>
