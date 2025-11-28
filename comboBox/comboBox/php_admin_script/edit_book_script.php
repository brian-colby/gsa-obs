<?php
if(isset($_GET['book_id'])){
		$id = $_GET['book_id'];
		$query = "SELECT request_tbl.request_id, telephone, request_tbl.name, department_tbl.department_name, 
		GROUP_CONCAT(equipment_tbl.equipment_name SEPARATOR ', ') AS equipment_names, request_tbl.use_date, 
		status.status_name, request_tbl.request_date, status.status_id 
		FROM request_tbl 
		INNER JOIN request_equipment ON request_tbl.request_id = request_equipment.request_id 
		INNER JOIN equipment_tbl ON request_equipment.equipment_id = equipment_tbl.equipment_id 
		INNER JOIN department_tbl ON request_tbl.department_id = department_tbl.department_id 
		INNER JOIN status ON request_tbl.status_id = status.status_id 
		WHERE request_tbl.request_id='$id' 
		GROUP BY request_tbl.request_id LIMIT 1";

		$output = $mysqli->query($query);
		
		while($row = $output->fetch_array()){
	    $name = $row['name'];
	    $phone = $row['telephone'];
		$equipment = $row['equipment_names'];
		$department = $row['department_name'];
		$use_date = $row['use_date'];
		$status = $row['status_name'];
		$request_id = $row['request_id'];
		}
		
  }

  ?>
  <?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if the update button was clicked
    if (isset($_POST['edit_book'])) {
        // Retrieve values from the form
        $fstatus = $mysqli->escape_string($_POST['status']);
        $fmy_id = $mysqli->escape_string($_POST['my_id']);

        $final_sql = $mysqli->query("UPDATE `request_tbl` SET `status_id` = '$fstatus' WHERE `request_id` = '$fmy_id'");

        if ($final_sql === TRUE) {
            // Retrieve phone number and other details to send SMS
            $tel_num_Query = "SELECT request_tbl.request_id, request_tbl.name, request_tbl.telephone, department_tbl.department_name, 
			GROUP_CONCAT(equipment_tbl.equipment_name SEPARATOR ', ') AS equipment_names, 
			request_tbl.use_date, request_tbl.start_time, request_tbl.end_time, status.status_name, request_tbl.request_date 
			FROM request_tbl 
			INNER JOIN request_equipment ON request_tbl.request_id = request_equipment.request_id 
			INNER JOIN equipment_tbl ON request_equipment.equipment_id = equipment_tbl.equipment_id 
			INNER JOIN department_tbl ON request_tbl.department_id = department_tbl.department_id 
			INNER JOIN `status` ON request_tbl.status_id = status.status_id 
			WHERE request_id = '$fmy_id'";

            $phoneNumberQuery = $mysqli->query($tel_num_Query);

            if ($phoneNumberQuery->num_rows > 0) {
                $row = $phoneNumberQuery->fetch_assoc();
                $Name = $row['name'];
                $telephoneNumber = $row['telephone'];
                $equipmentName = $row['equipment_names'];
                $requestDate = $row['request_date'];
                $message = 'Hello ' . $Name . ', Your request for ' . $equipmentName . ' submitted on ' . $requestDate . ' has been approved.';

                // SMSOnlineGH API credentials
                $apiKey = 'e39baff3ff20a4c52d260099465db73264b1dc4fd8356c0de98f3aeadb3473b2';

                // SMSOnlineGH API URL
                $url = 'https://api.smsonlinegh.com/v5/message/sms/send';

                // Data to be sent to the API
                $data = array(
                    'text' => $message,
                    'type' => 0, // GSM default
                    'sender' => 'GSA-OBS',
                    'destinations' => [$telephoneNumber]
                );

                // Initialize cURL session
                $ch = curl_init();

                // Set cURL options
                $headers = array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'Authorization: key ' . $apiKey
                );
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

                // Disable SSL certificate verification 
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                // Optionally, set CA bundle path if you have it
                // curl_setopt($ch, CURLOPT_CAINFO, '/path/to/cacert.pem');

                // Execute cURL session and get the response
                $response = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $error = curl_error($ch);
                curl_close($ch);

                // Handle the response
                if ($http_status == 200 || $http_status == 201) {
                    echo '<script>alert("Update Successfully and SMS sent.")</script>';
					$_SESSION['status_title'] = "Good Job!";
                    $_SESSION['status'] = "Equipment Approved Successfully!";
                    $_SESSION['status_code'] = "success";
                    header("location:../bookings.php");
                } else {
                    echo "Error sending SMS: $error";
                    echo "HTTP Status Code: $http_status";
                    echo "Response: $response";
                }
            } else {
				$_SESSION['status_title'] = "Error!";
                $_SESSION['status'] = "No phone number found for the given ID!";
                $_SESSION['status_code'] = "danger";
                header("location:../bookings.php");
                // echo '<script>alert("No phone number found for the given ID.")</script>';
            }

            echo '<script>window.location.href="bookings.php";</script>';
        } else {
			$_SESSION['status_title'] = "Error!";
            $_SESSION['status'] = "No rows updated!";
            $_SESSION['status_code'] = "danger";
			header("location:../bookings.php");
            // echo '<script>alert("Update Failed")</script>';
            // echo '<script>window.location.href="bookings.php";</script>';
        }
    }
}
?>
