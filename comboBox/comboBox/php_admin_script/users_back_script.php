<?php
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

$searchSql = "SELECT * FROM users 
              WHERE CONCAT(`name`,`email`) LIKE '%$search%' 
              ORDER BY `date_created` DESC 
              LIMIT ?, ?";
              
$searchQuery = $mysqli->prepare($searchSql);
$searchQuery->bind_param('ii', $start_from, $limit);
$searchQuery->execute();
$result = $searchQuery->get_result();

$totalSql = "SELECT COUNT(*) FROM users 
             WHERE CONCAT(`name`,`email`) LIKE '%$search%'";
$totalQuery = $mysqli->query($totalSql);
$totalRows = $totalQuery->fetch_row()[0];
$totalPages = ceil($totalRows / $limit);

?>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['date_created']}</td>
                            <td>{$row['date_created']}</td>
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
        

