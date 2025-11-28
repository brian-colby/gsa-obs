<?php
// Get the total number of records from our table "request_tbl".
$total_pages = $mysqli->query('SELECT `request_tbl`.*, (`equipment_tbl`.`equipment_code`) AS `EquipCode`, (`equipment_tbl`.`equipment_name`) AS `EquipName`, (`department_tbl`.`department_name`) AS `DeptName`,(`status_tbl`.`status_name`) AS `StatName` FROM `request_tbl`
			  JOIN `equipment_tbl` 
			  ON `request_tbl`.equipment_id = `equipment_tbl`.equipment_id
			  JOIN `department_tbl` 
			  ON `request_tbl`.department_id = `department_tbl`.department_id
			  JOIN `status_tbl` 
			  ON `request_tbl`.status_id = `status_tbl`.status_id
			  WHERE CONCAT(`name`,`use_date`,`EquipCode`,`EquipName`,`DeptName`,`StatName`) LIKE "%'.$strKeyword.'%"')->num_rows;
				  
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

  // Number of results to show on each page.
  $num_results_on_page = 8;

  if(isset($_POST["txtKeyword"])){
      
      $strKeyword = $_POST["txtKeyword"];
      
  }
  if(isset($_GET["txtKeyword"])){
      
      $strKeyword = $_GET["txtKeyword"];
      
  }
  if($lquery = $mysqli->prepare("SELECT `request_tbl`.*, (`equipment_tbl`.`equipment_code`) AS `EquipCode`, (`equipment_tbl`.`equipment_name`) AS `EquipName`, (`department_tbl`.`department_name`) AS `DeptName`,(`status_tbl`.`status_name`) AS `StatName` FROM `request_tbl`
			  JOIN `equipment_tbl` 
			  ON `request_tbl`.equipment_id = `equipment_tbl`.equipment_id
			  JOIN `department_tbl` 
			  ON `request_tbl`.department_id = `department_tbl`.department_id
			  JOIN `status_tbl` 
			  ON `request_tbl`.status_id = `status_tbl`.status_id
			  WHERE CONCAT(`name`,`use_date`,`EquipCode`,`EquipName`,`DeptName`,`StatName`) LIKE '%".$strKeyword."%' ORDER BY `request_date` ASC LIMIT ?,?")){
  
  // Calculate the page to get the results we need from our table.
  $calc_page = ($page - 1) * $num_results_on_page;
  $lquery->bind_param('ii', $calc_page, $num_results_on_page);
  $lquery->execute(); 
  
  // Get the results...
  $result = $lquery->get_result();
  
  while($row = $result->fetch_assoc()){

?>
<tr>
	<th scope="row"><?php echo $row['request_id'];?></th>
	<td><?php echo $row['name'];?></td>
	<td><?php echo $row['EquipName'];?></td>
	<td><?php echo $row['EquipCode'];?></td>
	<td><?php echo $row['use_date'];?></td>
	<td><?php echo $row['DeptName'];?></td>
	<td><span class="badge me-1 bg-danger"><?php echo $row['StatName'];?></span></td>
</tr>

<?php
  }
}
?>	