<?php
// Get the total number of records from our table "request_tbl".
$total_pages = $mysqli->query('SELECT * FROM `equipment_tbl` WHERE CONCAT(`equipment_name`,`equipment_code`,`equipment_availability`) LIKE "%'.$strKeyword.'%"')->num_rows;
				  
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

  // Number of results to show on each page.
  $num_results_on_page = 8;

  if(isset($_POST["txtKeyword"])){
      
      $strKeyword = $_POST["txtKeyword"];
      
  }
  if(isset($_GET["txtKeyword"])){
      
      $strKeyword = $_GET["txtKeyword"];
      
  }
  if($lquery = $mysqli->prepare("SELECT * FROM `equipment_tbl` WHERE CONCAT(`equipment_name`,`equipment_code`,`equipment_availability`) LIKE '%".$strKeyword."%' ORDER BY `equipment_id` ASC LIMIT ?,?")){
  
  // Calculate the page to get the results we need from our table.
  $calc_page = ($page - 1) * $num_results_on_page;
  $lquery->bind_param('ii', $calc_page, $num_results_on_page);
  $lquery->execute(); 
  
  // Get the results...
  $result = $lquery->get_result();
  
  while($row = $result->fetch_assoc()){

?>
<tr>
	<td><?php echo $row['equipment_name'];?></td>
	<td><?php echo $row['equipment_code'];?></td>
	<td><?php echo $row['equipment_availability'];?></td>
	<td><button class="status-btn bx bx bx-pencil" onclick="openEditModal('Projector')"  style="background-color: #007bff; color: white; border-radius: 8px; margin-left: 5px; "></button>
									
    	<button class="status-btn bx bx-x"  style="background-color: #ff0000; color: white; border-radius: 8px; margin-left: 5px; "></button>
	</td>
</tr>
<?php
  }
}
?>	