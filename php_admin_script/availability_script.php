<?php
// Establish a database connection (update with your credentials)
require "connect_function.php";

// Process form submission
if (isset($_POST['search_avail'])) {
    $equipment = $mysqli->real_escape_string($_POST['equipment_name']); // Sanitize user input
    $desiredDate = $mysqli->real_escape_string($_POST['date']); // Sanitize user input

    // Query the database (joining tables)
    $sql = "SELECT request_tbl.name, request_tbl.use_date, equipment_tbl.equipment_name, equipment_tbl.equipment_code, status.status_name
            FROM request_tbl
            LEFT JOIN equipment_tbl ON request_tbl.equipment_id = equipment_tbl.equipment_id
            LEFT JOIN status ON request_tbl.status_id = status.status_id
            WHERE equipment_tbl.equipment_name = '$equipment' AND request_tbl.use_date = '$desiredDate'";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Display availability results in an HTML table
       
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['equipment_name'] . '</td>';
            echo '<td>' . $row['equipment_code'] . '</td>';
            echo '<td>' . $row['use_date'] . '</td>';
            echo '<td><span class="badge me-1 bg-danger">' . $row['status_name'] . '</span></td>';
            echo '</tr>';
        }
     
    } else {
        echo "No results found.";
    }
}

// Close the database connection
$mysqli->close();
?>
