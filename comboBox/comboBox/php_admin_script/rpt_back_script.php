<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Pagination settings
$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Search functionality
$search = '';
if (isset($_POST['txtKeyword'])) {
    $search = $_POST['txtKeyword'];
} elseif (isset($_GET['txtKeyword'])) {
    $search = $_GET['txtKeyword'];
}

$searchSql = "SELECT request_tbl.request_id, request_tbl.name, department_tbl.department_name, 
GROUP_CONCAT(equipment_tbl.equipment_name SEPARATOR ', ') AS equipment_names, 
request_tbl.use_date, status.status_name, request_tbl.request_date 
FROM request_tbl 
INNER JOIN request_equipment ON request_tbl.request_id = request_equipment.request_id 
INNER JOIN equipment_tbl ON request_equipment.equipment_id = equipment_tbl.equipment_id 
INNER JOIN department_tbl ON request_tbl.department_id = department_tbl.department_id 
INNER JOIN `status` ON request_tbl.status_id = status.status_id 
WHERE CONCAT(request_tbl.name, equipment_tbl.equipment_name, request_tbl.use_date, 
request_tbl.request_date, department_tbl.department_name, status.status_name) LIKE ? 
AND status.status_name = 'In-Use'
GROUP BY request_tbl.request_id
ORDER BY request_tbl.request_date DESC LIMIT ?, ?";

$searchQuery = $mysqli->prepare($searchSql);
if (!$searchQuery) {
    die("Prepare failed: " . $mysqli->error);
}

$searchKeyword = '%' . $search . '%';
$searchQuery->bind_param('sii', $searchKeyword, $start_from, $limit);
if (!$searchQuery->execute()) {
    die("Execute failed: " . $searchQuery->error);
}

$result = $searchQuery->get_result();

$totalSql = 'SELECT COUNT(DISTINCT request_tbl.request_id) AS total FROM `request_tbl` 
INNER JOIN `request_equipment` ON request_tbl.request_id = request_equipment.request_id
INNER JOIN `equipment_tbl` ON request_equipment.equipment_id = equipment_tbl.equipment_id 
INNER JOIN `status` ON request_tbl.status_id = status.status_id
WHERE CONCAT(request_tbl.name, request_tbl.use_date, request_tbl.request_date, equipment_tbl.equipment_name) LIKE ?
AND status.status_name = "In-Use"';

$totalQuery = $mysqli->prepare($totalSql);
if (!$totalQuery) {
    die("Prepare failed: " . $mysqli->error);
}

$totalQuery->bind_param('s', $searchKeyword);
if (!$totalQuery->execute()) {
    die("Execute failed: " . $totalQuery->error);
}

$totalResult = $totalQuery->get_result();
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

?>

<tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['equipment_names']}</td>
                <td>{$row['department_name']}</td>
                <td>{$row['use_date']}</td>
                <td>{$row['request_date']}</td>
                <td><button class='status-btn bx bx' #0B6E4F style='background-color: #90ee90; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button></td>
                <td>
                  <a href='edit_simple_report.php?sim_repo_id={$row['request_id']}'><button class='status-btn bx bx bx-pen' style='background-color: #007bff; color: white; border-radius: 8px; margin-left: 5px;'><i class='fa fa-pen' aria-hidden='true'></i></button></a>
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