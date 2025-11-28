<?php
// Get the total number of records from our table "request_tbl" that match the search keyword.
$total_pages_query = $mysqli->query('SELECT COUNT(*) AS total FROM `request_tbl` 
    INNER JOIN `request_equipment` ON request_tbl.request_id = request_equipment.request_id
    INNER JOIN `equipment_tbl` ON request_equipment.equipment_id = equipment_tbl.equipment_id 
    WHERE CONCAT(request_tbl.name, request_tbl.use_date, request_tbl.request_date, equipment_tbl.equipment_name) LIKE "%'.$strKeyword.'%"');
$total_pages = $total_pages_query->fetch_assoc()['total'];

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 8;

if(isset($_POST["txtKeyword"])){
    $strKeyword = $_POST["txtKeyword"];
}
if(isset($_GET["txtKeyword"])){
    $strKeyword = $_GET["txtKeyword"];
}

if($lquery = $mysqli->prepare("SELECT request_tbl.request_id, request_tbl.name, department_tbl.department_name, 
    GROUP_CONCAT(equipment_tbl.equipment_name SEPARATOR ', ') AS equipment_names, 
    request_tbl.use_date, status.status_name, request_tbl.request_date 
    FROM request_tbl 
    INNER JOIN request_equipment ON request_tbl.request_id = request_equipment.request_id 
    INNER JOIN equipment_tbl ON request_equipment.equipment_id = equipment_tbl.equipment_id 
    INNER JOIN department_tbl ON request_tbl.department_id = department_tbl.department_id 
    INNER JOIN status ON request_tbl.status_id = status.status_id 
    WHERE CONCAT(request_tbl.name, equipment_tbl.equipment_name, request_tbl.use_date, 
    request_tbl.request_date, department_tbl.department_name, status.status_name) LIKE '%".$strKeyword."%' 
    GROUP BY request_tbl.request_id
    ORDER BY request_tbl.request_date DESC LIMIT ?,?")){

    // Calculate the page to get the results we need from our table.
    $calc_page = ($page - 1) * $num_results_on_page;
    $lquery->bind_param('ii', $calc_page, $num_results_on_page);
    $lquery->execute(); 

    // Get the results...
    $result = $lquery->get_result();

    while($row = $result->fetch_assoc()){
?>
<tr>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['equipment_names'];?></td>
    <td><?php echo $row['use_date'];?></td>
    <td><?php echo $row['department_name'];?></td>
    <td><button class="status-btn bx bx" style="background-color: #0000FF; color: white; border-radius: 8px; margin-left: 5px;"><?php echo $row['status_name'];?></button></td>
    <td><?php echo $row['request_date'];?></td>
</tr>
<?php
    }
}
?>