<?php
session_start();
require "php_admin_script/connect_function.php";

if (!empty($_POST['dateid']) && !empty($_POST['equipid'])) {
    $date = $_POST['dateid'];
    $equip = $_POST['equipid'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $status_in_use = "In-Use";
    $status_approved = "Approved";

    $sql = "SELECT `request_tbl`.*, status.status_name FROM request_tbl
    JOIN `status` ON request_tbl.status_id = status.status_id
    WHERE use_date = ? AND equipment_id = ? AND (status_name = ? OR status_name = ?) AND (
        (start_time < ? AND end_time > ?) OR
        (start_time < ? AND end_time > ?) OR
        (start_time >= ? AND end_time <= ?)
    )";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sissssssss', $date, $equip, $status_in_use, $status_approved, $end_time, $start_time, $start_time, $end_time, $start_time, $end_time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<span style='color:#ff0000'>This Equipment has already been booked for the selected date</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color:#ff'>This Equipment is available for booking</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }
}
?>