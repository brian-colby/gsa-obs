<?php
// Initialize the keyword for search
$strKeyword = "";
if(isset($_POST["txtKeyword"])){
    $strKeyword = $_POST["txtKeyword"];
}
if(isset($_GET["txtKeyword"])){
    $strKeyword = $_GET["txtKeyword"];
}

// Get the total number of records that match the search keyword.
$total_pages_query = $mysqli->query('SELECT COUNT(*) AS total 
    FROM `equipments`.`request_tbl` 
    INNER JOIN `equipments`.`request_equipment` ON `equipments`.`request_tbl`.`request_id` = `equipments`.`request_equipment`.`request_id`
    INNER JOIN `equipments`.`equipment_tbl` ON `equipments`.`request_equipment`.`equipment_id` = `equipments`.`equipment_tbl`.`equipment_id` 
    INNER JOIN `equipments`.`department_tbl` ON `equipments`.`request_tbl`.`department_id` = `equipments`.`department_tbl`.`department_id`
    INNER JOIN `equipments`.`status` ON `equipments`.`request_tbl`.`status_id` = `equipments`.`status`.`status_id`
    WHERE CONCAT(`equipments`.`request_tbl`.`name`, `equipments`.`equipment_tbl`.`equipment_name`, `equipments`.`request_tbl`.`use_date`, `equipments`.`request_tbl`.`request_date`, `equipments`.`department_tbl`.`department_name`, `equipments`.`status`.`status_name`) 
    LIKE "%'.$strKeyword.'%"');
$total_pages = $total_pages_query->fetch_assoc()['total'];

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 8;

if($lquery = $mysqli->prepare("SELECT `equipments`.`request_tbl`.`request_id`, `equipments`.`request_tbl`.`name`, `equipments`.`department_tbl`.`department_name`, 
    GROUP_CONCAT(`equipments`.`equipment_tbl`.`equipment_name` SEPARATOR ', ') AS `equipment_names`, 
    `equipments`.`request_tbl`.`use_date`, `equipments`.`status`.`status_name`, `equipments`.`request_tbl`.`request_date`, `equipments`.`status`.`status_id` 
    FROM `equipments`.`request_tbl` 
    INNER JOIN `equipments`.`request_equipment` ON `equipments`.`request_tbl`.`request_id` = `equipments`.`request_equipment`.`request_id` 
    INNER JOIN `equipments`.`equipment_tbl` ON `equipments`.`request_equipment`.`equipment_id` = `equipments`.`equipment_tbl`.`equipment_id` 
    INNER JOIN `equipments`.`department_tbl` ON `equipments`.`request_tbl`.`department_id` = `equipments`.`department_tbl`.`department_id` 
    INNER JOIN `equipments`.`status` ON `equipments`.`request_tbl`.`status_id` = `equipments`.`status`.`status_id` 
    WHERE CONCAT(`equipments`.`request_tbl`.`name`, `equipments`.`equipment_tbl`.`equipment_name`, `equipments`.`request_tbl`.`use_date`, `equipments`.`request_tbl`.`request_date`, `equipments`.`department_tbl`.`department_name`, `equipments`.`status`.`status_name`) 
    LIKE ? 
    GROUP BY `equipments`.`request_tbl`.`request_id`
    ORDER BY `equipments`.`request_tbl`.`request_date` DESC LIMIT ?,?")){

    // Calculate the page to get the results we need from our table.
    $calc_page = ($page - 1) * $num_results_on_page;
    $searchKeyword = '%'.$strKeyword.'%';
    $lquery->bind_param('sii', $searchKeyword, $calc_page, $num_results_on_page);
    $lquery->execute(); 

    // Get the results...
    $result = $lquery->get_result();

    while($row = $result->fetch_assoc()){
        // Determine button color based on status_id
        $button_color = '';
        switch ($row['status_id']) {
            case 1:
                $button_color = 'background-color: #FFD700; color: white;'; // Yellow
                break;
            case 2:
                $button_color = 'background-color: #0B6E4F; color: white;'; // Green
                break;
            case 3:
                $button_color = 'background-color: #0000FF; color: white;'; // Blue
                break;
            case 4:
                $button_color = 'background-color: #FF0000; color: white;'; // Red
                break;
            case 5:
                $button_color = 'background-color: #808080; color: white;'; // Gray
                break;
            default:
                $button_color = 'background-color: #000000; color: white;'; // Black (default fallback)
                break;
        }
?>
<tr>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['equipment_names'];?></td>
    <td><?php echo $row['department_name'];?></td>
    <td><?php echo $row['use_date'];?></td>
    <td><?php echo $row['request_date'];?></td>
    <td><button class="status-btn bx bx" style="<?php echo $button_color; ?> border-radius: 8px; margin-left: 5px;"><?php echo $row['status_name'];?></button></td>
    <td>
        <a href="edit_booking.php?book_id=<?php echo $row['request_id'];?>">
        <button class="status-btn bx bx-pencil" style="background-color: #007bff; color: white; border-radius: 8px; margin-left: 5px;"></button></a>
        <button class="status-btn bx bx-x" style="background-color: #ff0000; color: white; border-radius: 8px; margin-left: 5px;"></button>
    </td>
</tr>
<?php
    }
}
?> 