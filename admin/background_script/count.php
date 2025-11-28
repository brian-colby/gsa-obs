<?php
$NoE = $mysqli->query("SELECT * FROM `equipment_tbl`");
    $NoErows = $NoE->num_rows;

$AvE = $mysqli->query("SELECT * FROM `equipment_tbl` WHERE `equipment_availability` > 0");
    $AvErows = $AvE->num_rows;

$AcE = $mysqli->query("SELECT * FROM `equipment_tbl` WHERE `equipment_availability` = 0");
    $AcErows = $AcE->num_rows;

$sql = $mysqli->query("SELECT * FROM `request_tbl`");
	$numrows = $sql->num_rows;


    if($_SERVER['REQUEST_METHOD'] == "POST"){
    
        if(isset($_POST['sub_equip'])){
            
            $EQUIP_NAME = $mysqli->escape_string($_POST['equipment-name']);
            $EQUIP_NUMBER = $mysqli->escape_string($_POST['equip-number']);
            $AVAILABILITY = $mysqli->escape_string($_POST['availability']);
            
            // Check if the user with that email or phone already exists
            $result = $mysqli->query("SELECT * FROM `equipment_tbl` WHERE equipment_code='$EQUIP_NUMBER'") or die($mysqli->error);
            
            // Check if the rows returned are more than 0
            if ($result->num_rows > 0) {
                echo '<script>alert("Equipment Already Exists!");</script>';
            } else {
                $insertQuery = "INSERT INTO `equipment_tbl`(`equipment_name`, `equipment_code`, `equipment_availability`) VALUES('$EQUIP_NAME', '$EQUIP_NUMBER', '$AVAILABILITY')";
                
                if ($mysqli->query($insertQuery)) {
                    // echo '<script>window.location.href="../paages/dashboard-success.php";</script>';
                echo '<script>alert("Equipment Added Successfully!!");</script>';

                } else {
                    echo "Error: " . $insertQuery . "<br>" . $mysqli->error;
                }
            }
        }
    }
?>
