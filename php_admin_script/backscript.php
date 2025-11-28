<?php
session_start();
// DB connection 
include "connect_function.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $name = $mysqli->real_escape_string($_POST['name']);
    $telephone = $mysqli->real_escape_string($_POST['telephone']);
    $department_id = $mysqli->real_escape_string($_POST['department']);
    $status_id = 1; // Use an appropriate status ID value
    $start_time = $mysqli->real_escape_string($_POST['start_time']);
    $end_time = $mysqli->real_escape_string($_POST['end_time']);
    $status_in_use = "In-Use";
    $status_approved = "Approved";

    function formatPhoneNumber($phone_number){
        // if 0
        if (substr($phone_number,0,1) === '0'){
            $phone_number = '+233'. substr($phone_number,1);
        }
        return $phone_number;
    }
    $new_phone = formatPhoneNumber($telephone);

    // Retrieve date and equipment arrays
    $date_array = $_POST['date'];
    $equipment_array = $_POST['equipment'];

    $availability_error = false;

    foreach ($date_array as $date) {
        $use_date = $mysqli->real_escape_string($date);

        foreach ($equipment_array as $equipment_id) {
            $equipment_id = $mysqli->real_escape_string($equipment_id);
            
            // Check the availability of the equipments
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
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $availability_error = true;
                break 2; // Exit both loops
            }
        }
    }

    if ($availability_error) {
        $_SESSION['status_title'] = "Bad News!";
        $_SESSION['status'] = "The equipment is not available for the requested time.";
        $_SESSION['status_code'] = "error";
        header("location:../index.php?availabilityError");
    } else {
        foreach ($date_array as $date) {
            $use_date = $mysqli->real_escape_string($date);

            // Insert request into request_tbl
            $insert_query = "INSERT INTO `equipments`.`request_tbl`
                (`name`, `telephone`, `department_id`, `use_date`, `status_id`, `start_time`, `end_time`)
                VALUES ('$name', '$new_phone', '$department_id', '$use_date', '$status_id', '$start_time', '$end_time')";

            // Execute query and get the last inserted ID
            if ($mysqli->query($insert_query) === TRUE) {
                $request_id = $mysqli->insert_id;

                // Insert each equipment ID into request_equipment
                foreach ($equipment_array as $equipment_id) {
                    $equipment_id = $mysqli->real_escape_string($equipment_id);
                    $insert_equipment_query = "INSERT INTO `equipments`.`request_equipment` (request_id, equipment_id)
                                               VALUES ('$request_id', '$equipment_id')";

                    if ($mysqli->query($insert_equipment_query) !== TRUE) {
                        echo "Error: " . $insert_equipment_query . "<br>" . $mysqli->error;
                    }
                }

                $_SESSION['status_title'] = "Good News!";
                $_SESSION['status'] = "Equipment(s) Booked Successfully.";
                $_SESSION['status_code'] = "success";
                header("location:../index.php?availabilitySuccessful");
                // header("location: index-success.php");
            } else {
                echo "Error: " . $insert_query . "<br>" . $mysqli->error;
            }
        }
    }
}
?>
