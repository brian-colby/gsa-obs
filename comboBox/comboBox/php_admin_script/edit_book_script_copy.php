<?php
session_start();
require "connect_function.php";

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

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['edit_book'])) {
    $statusId = $mysqli->real_escape_string($_POST['status']);
    $requestId = $mysqli->real_escape_string($_POST['my_id']);

    // Update the status in the database
    $updateQuery = "UPDATE `request_tbl` SET `status_id` = ? WHERE `request_id` = ?";
    $stmt = $mysqli->prepare($updateQuery);
    $stmt->bind_param("ii", $statusId, $requestId);
    $updateSuccess = $stmt->execute();

    // Check if the update was successful
    if ($updateSuccess) {
        // Retrieve the status name for the updated status
        $statusQuery = "SELECT `status_name` FROM `status` WHERE `status_id` = ?";
        $stmt = $mysqli->prepare($statusQuery);
        $stmt->bind_param("i", $statusId);
        $stmt->execute();
        $stmt->bind_result($statusName);
        $stmt->fetch();
        $stmt->close();

        // Prepare message based on status
        $message = '';
        $statusType = '';

        if ($statusId == 4) {
            // Status is 'Declined'
            $statusType = 'Declined';
            $message = 'Your request for equipment has been Declined.';
        }elseif ($statusId == 5) {
            // Status is 'Returned'
            $statusType = 'Returned';
            $message = 'Thank you for returning the equipment.';
        } elseif ($statusId == 3) {
            // Status is 'In-use'
            $statusType = 'In-Use';
            $message = 'Equipment In-Use.';
        } elseif ($statusId == 1) {
            // Status is 'Request Pending'
            $statusType = 'Request Pending';
            $message = 'Equipment Request on Pending .';
        }
        else {
            // Status is 'Approved'
            $statusType = 'Approved';
            $message = 'Your request for equipment has been Approved.';
        }

        // Retrieve phone number and other details
        $telNumQuery = "
            SELECT 
                rt.name,
                GROUP_CONCAT(et.equipment_name) AS equipments,
                rt.telephone,
                rt.request_date
            FROM 
                request_tbl rt
            JOIN 
                request_equipment re ON rt.request_id = re.request_id
            JOIN 
                equipment_tbl et ON re.equipment_id = et.equipment_id
            WHERE 
                rt.request_id = ?
            GROUP BY 
                rt.request_id";

        $stmt = $mysqli->prepare($telNumQuery);
        $stmt->bind_param("i", $requestId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $telephoneNumber = $row['telephone'];
            $equipmentName = $row['equipments']; 
            $requestDate = $row['request_date'];
            $fullMessage = 'Hello ' . $name . ', ' . $message . ' Equipment: ' . $equipmentName . ' submitted on ' . $requestDate . '.';

            // SMSOnlineGH API credentials
            $apiKey = 'e39baff3ff20a4c52d260099465db73264b1dc4fd8356c0de98f3aeadb3473b2';
            $url = 'https://api.smsonlinegh.com/v5/message/sms/send';
 
            // Data to be sent to the API
            $data = array(
                'text' => $fullMessage,
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

            // Execute cURL session and get the response
            $response = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            // Handle the response
            if ($http_status == 200 || $http_status == 201) {
                $_SESSION['status_title'] = "Good Job!";
                $_SESSION['status'] = "Equipment Request $statusType!";
                $_SESSION['status_code'] = "success";
                header("Location: ../bookings.php");
                exit();
            } else {
                echo "Error sending SMS: $error";
                echo "HTTP Status Code: $http_status";
                echo "Response: $response";
            }
        } else {
            $_SESSION['status_title'] = "Error!";
            $_SESSION['status'] = "No phone number found for the given ID!";
            $_SESSION['status_code'] = "danger";
            header("Location: ../bookings.php");
            exit();
        }
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    $stmt->close();
}
?>

