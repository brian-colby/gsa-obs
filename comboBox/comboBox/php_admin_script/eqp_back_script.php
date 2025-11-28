<?php
// Pagination settings
$limit = 8; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Search functionality
$search = '';
if (isset($_POST['txtKeyword'])) {
    $search = $_POST['txtKeyword'];
} elseif (isset($_GET['txtKeyword'])) {
    $search = $_GET['txtKeyword'];
}

$searchSql = "SELECT * FROM equipment_tbl 
              WHERE CONCAT(`equipment_name`,`equipment_code`,`equipment_availability`) LIKE '%$search%' 
              ORDER BY equipment_id ASC 
              LIMIT ?, ?";
              
$searchQuery = $mysqli->prepare($searchSql);
$searchQuery->bind_param('ii', $start_from, $limit);
$searchQuery->execute();
$result = $searchQuery->get_result();

$totalSql = "SELECT COUNT(*) FROM equipment_tbl 
             WHERE CONCAT(`equipment_name`,`equipment_code`,`equipment_availability`) LIKE '%$search%'";
$totalQuery = $mysqli->query($totalSql);
$totalRows = $totalQuery->fetch_row()[0];
$totalPages = ceil($totalRows / $limit);

?>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['equipment_name']}</td>
                            <td>{$row['equipment_code']}</td>
                            <td>{$row['equipment_availability']}</td>
                            <td><a href='edit_equipment.php?equip_id={$row['equipment_id']}'><button class='status-btn bx bx-x'  style='background-color: #007bff; color: white; border-radius: 8px; margin-left: 5px; '><i class='fas fa-pen' aria-hidden='true'></i></button></a>
									
    	                      <button class='status-btn bx bx-x'  style='background-color: #ff0000; color: white; border-radius: 8px; margin-left: 5px; '><i class='fa fa-trash' aria-hidden='true'></i></button>
                            
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $totalPages; $i++) {
                        $activeClass = ($i == $page) ? 'active' : '';
                        echo "<li class='page-item {$activeClass}'><a class='page-link' href='?page={$i}&txtKeyword=" . urlencode($search) . "'>{$i}</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        
