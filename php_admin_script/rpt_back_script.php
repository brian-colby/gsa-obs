<?php
// Get the total number of records from our table "request_tbl".
$total_pages = $mysqli->query('SELECT `request_tbl`.*, equipment_tbl.equipment_name, equipment_tbl.equipment_code, status.status_name, department_tbl.`department_name` 
FROM `request_tbl` 
JOIN equipment_tbl ON request_tbl.equipment_id = equipment_tbl.equipment_id
JOIN `department_tbl` ON request_tbl.department_id = department_tbl.department_id
JOIN `status` ON request_tbl.status_id = status.status_id WHERE CONCAT(`name`,`use_date`,`request_date`) LIKE "%'.$strKeyword.'%"')->num_rows;
				  
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

  // Number of results to show on each page.
  $num_results_on_page = 8;

  if(isset($_POST["txtKeyword"])){
      
      $strKeyword = $_POST["txtKeyword"];
      
  }
  if(isset($_GET["txtKeyword"])){
      
      $strKeyword = $_GET["txtKeyword"];
      
  }
  if($lquery = $mysqli->prepare("SELECT `request_tbl`.*, equipment_tbl.equipment_name, equipment_tbl.equipment_code, status.status_name, department_tbl.`department_name` 
  FROM `request_tbl` 
  JOIN equipment_tbl ON request_tbl.equipment_id = equipment_tbl.equipment_id
  JOIN `department_tbl` ON request_tbl.department_id = department_tbl.department_id
  JOIN `status` ON request_tbl.status_id = status.status_id WHERE CONCAT(`name`,`use_date`,`request_date`) LIKE '%".$strKeyword."%' ORDER BY `request_date` ASC LIMIT ?,?")){
  
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
	<td><?php echo $row['equipment_name'];?></td>
	<td><?php echo $row['department_name'];?></td>
	<td><?php echo $row['use_date'];?></td>
	<td><?php echo $row['request_date'];?></td>
	<td><?php echo $row['status_name'];?></td>
	<td><button class="status-btn bx bx bx-check"  style="background-color: #00ff5e; color: white; border-radius: 8px; margin-left: 5px; "></button>
									
    	<button class="status-btn bx bx-x"  style="background-color: #ff0000; color: white; border-radius: 8px; margin-left: 5px; "></button>
	</td>
</tr>
<?php
  }
}
?>	
                            <!-- Add more rows as needed -->
                        </tbody>
						
					</table>
				</div>
				
			</div>
		
