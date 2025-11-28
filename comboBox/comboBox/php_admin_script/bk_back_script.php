    <?php
        // Pagination settings
    //     $limit = 10; // Number of entries to show in a page.
    //     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    //     $start_from = ($page - 1) * $limit;

    //     // Search functionality
    //     $search = '';
    //     if (isset($_POST['txtKeyword'])) {
    //         $search = $_POST['txtKeyword'];
    //     } elseif (isset($_GET['txtKeyword'])) {
    //         $search = $_GET['txtKeyword'];
    //     }

    //     $searchSql = "SELECT request_tbl.request_id, request_tbl.name, department_tbl.department_name, 
    //     GROUP_CONCAT(equipment_tbl.equipment_name SEPARATOR ', ') AS equipment_names, 
    //     request_tbl.use_date, request_tbl.start_time, request_tbl.end_time, status.status_name, request_tbl.request_date 
    //     FROM request_tbl 
    //     INNER JOIN request_equipment ON request_tbl.request_id = request_equipment.request_id 
    //     INNER JOIN equipment_tbl ON request_equipment.equipment_id = equipment_tbl.equipment_id 
    //     INNER JOIN department_tbl ON request_tbl.department_id = department_tbl.department_id 
    //     INNER JOIN `status` ON request_tbl.status_id = status.status_id 
    //     WHERE CONCAT(request_tbl.name, equipment_tbl.equipment_name, request_tbl.use_date, 
    //     request_tbl.request_date, department_tbl.department_name, status.status_name) LIKE '%".$search."%' 
    //     GROUP BY request_tbl.request_id
    //     ORDER BY request_tbl.request_date DESC LIMIT ?,?";
                    
    //     $searchQuery = $mysqli->prepare($searchSql);
    //     $searchQuery->bind_param('ii', $start_from, $limit);
    //     $searchQuery->execute();
    //     $result = $searchQuery->get_result();

    //     $totalSql = 'SELECT COUNT(*) AS total FROM `request_tbl` 
    //     INNER JOIN `request_equipment` ON request_tbl.request_id = request_equipment.request_id
    //     INNER JOIN `equipment_tbl` ON request_equipment.equipment_id = equipment_tbl.equipment_id 
    //     WHERE CONCAT(request_tbl.name, request_tbl.use_date, request_tbl.request_date, equipment_tbl.equipment_name) LIKE "%'.$search.'%"';
    //     $totalQuery = $mysqli->query($totalSql);
    //     $totalRows = $totalQuery->fetch_row()[0];
    //     $totalPages = ceil($totalRows / $limit);

    // ?>
             <!-- <tbody> -->
                 <?php
    //             while ($row = $result->fetch_assoc()) {
    //               // Determine button color based on status_id
    //             //   $button_color = '';
    //             //   switch ($row['status_id']) {
    //             //       case '0000000001':
    //             //           $button_color = 'background-color: #FFD700; color: white;'; // Yellow
    //             //           break;
    //             //       case '0000000002':
    //             //           $button_color = 'background-color: #0B6E4F; color: white;'; // Green
    //             //           break;
    //             //       case '0000000003':
    //             //           $button_color = 'background-color: #0000FF; color: white;'; // Blue
    //             //           break;
    //             //       case '0000000004':
    //             //           $button_color = 'background-color: #FF0000; color: white;'; // Red
    //             //           break;
    //             //       case '0000000005':
    //             //           $button_color = 'background-color: #808080; color: white;'; // Gray
    //             //           break;
    //             //       default:
    //             //           $button_color = 'background-color: #000000; color: white;'; // Black (default fallback)
    //             //           break;
    //             //   }
    //                 echo "<tr>
    //                         <td>{$row['name']}</td>
    //                         <td>{$row['equipment_names']}</td>
    //                         <td>{$row['department_name']}</td>
    //                         <td>{$row['use_date']}</td>
    //                         <td>{$row['start_time']}</td>
    //                         <td>{$row['end_time']}</td>
    //                         <td>{$row['request_date']}</td>
    //                         <td>";
    //                         $status_color_id = $row['status_id'];
    //                         if ($status_color_id === 0000000001) {
    //                             echo "<button class='status-btn bx bx' style='background-color: #FFD700; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
    //                         } elseif ($status_color_id === 0000000002) {
    //                             echo "<button class='status-btn bx bx' style='background-color: #0B6E4F; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
    //                         } elseif ($status_color_id === 0000000003) {
    //                             echo "<button class='status-btn bx bx' style='background-color: #0000FF; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
    //                         } elseif ($status_color_id === 0000000004) {
    //                             echo "<button class='status-btn bx bx' style='background-color: #FF0000; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
    //                         } elseif ($status_color_id === 0000000005) {
    //                             echo "<button class='status-btn bx bx' style='background-color: #808080; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
    //                         }
    //                        echo " </td>
    //                        <td>
    //                           <a href='edit_booking.php?book_id={$row['request_id']}'><button class='status-btn ' style='background-color: #007bff; color: white; border-radius: 8px; margin-left: 5px;'><i class='fa fa-pencil' aria-hidden='true'>Edit</i></button></a>
    //                           <button class='status-btn bx bx-x'  style='background-color: #ff0000; color: white; border-radius: 8px; margin-left: 5px; '><i class='fa fa-trash' aria-hidden='true'></i></button>
    //                         </td>
    //                       </tr>";
    //             }
    //             ?>
             <!-- </tbody>
         </table>
         <br>
             <nav aria-label="Page navigation example">
                 <ul class="pagination"> -->
                     <?php
    //                 for ($i = 1; $i <= $totalPages; $i++) {
    //                     $activeClass = ($i == $page) ? 'active' : '';
    //                     echo "<li class='page-item {$activeClass}'><a class='page-link' href='?page={$i}&txtKeyword=" . urlencode($search) . "'>{$i}</a></li>";
    //                 }
    //                 ?>
                 <!-- </ul>
             </nav> -->

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

        $searchSql = "SELECT request_tbl.request_id, request_tbl.name, department_tbl.department_name, 
        GROUP_CONCAT(equipment_tbl.equipment_name SEPARATOR ', ') AS equipment_names, 
        request_tbl.use_date, request_tbl.start_time, request_tbl.end_time, status.status_name, request_tbl.request_date 
        FROM request_tbl 
        INNER JOIN request_equipment ON request_tbl.request_id = request_equipment.request_id 
        INNER JOIN equipment_tbl ON request_equipment.equipment_id = equipment_tbl.equipment_id 
        INNER JOIN department_tbl ON request_tbl.department_id = department_tbl.department_id 
        INNER JOIN `status` ON request_tbl.status_id = status.status_id 
        WHERE CONCAT(request_tbl.name, equipment_tbl.equipment_name, request_tbl.use_date, 
        request_tbl.request_date, department_tbl.department_name, status.status_name) LIKE '%".$search."%' 
        GROUP BY request_tbl.request_id
        ORDER BY request_tbl.request_date DESC LIMIT ?,?";
                    
        $searchQuery = $mysqli->prepare($searchSql);
        $searchQuery->bind_param('ii', $start_from, $limit);
        $searchQuery->execute();
        $result = $searchQuery->get_result();

        $totalSql = 'SELECT COUNT(*) AS total FROM `request_tbl` 
        INNER JOIN `request_equipment` ON request_tbl.request_id = request_equipment.request_id
        INNER JOIN `equipment_tbl` ON request_equipment.equipment_id = equipment_tbl.equipment_id 
        WHERE CONCAT(request_tbl.name, request_tbl.use_date, request_tbl.request_date, equipment_tbl.equipment_name) LIKE "%'.$search.'%"';
        $totalQuery = $mysqli->query($totalSql);
        $totalRows = $totalQuery->fetch_row()[0];
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
                        <td>{$row['start_time']}</td>
                        <td>{$row['end_time']}</td>
                        <td>{$row['request_date']}</td>
                        <td>
                        ";
                        $status_color_id = $row['status_name'];
                        if ($status_color_id === 'Request Pending') {
                            echo "<button class='status-btn bx bx' style='background-color: #FFA500; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
                        } elseif ($status_color_id === 'Approved') {
                            echo "<button class='status-btn bx bx' style='background-color: #28A745; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
                        } elseif ($status_color_id === 'In-Use') {
                            echo "<button class='status-btn bx bx' style='background-color: #007BFF; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
                        } elseif ($status_color_id === 'Declined') {
                            echo "<button class='status-btn bx bx' style='background-color: #DC3545; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
                        } elseif ($status_color_id === 'Returned') {
                            echo "<button class='status-btn bx bx' style='background-color: #6C757D; color: white; border-radius: 8px; margin-left: 5px;'>{$row['status_name']}</button>";
                        }
                       echo " </td>
                       <td>
                          <a href='edit_booking.php?book_id={$row['request_id']}'><button class='status-btn ' style='background-color: #007bff; color: white; border-radius: 8px; margin-left: 5px;'><i class='fa fa-pen' aria-hidden='true'></i></button></a>
                          <a href='php_admin_script/del_book_script.php?book_id={$row['request_id']}'><button class='status-btn ' style='background-color: #ff0000; color: white; border-radius: 8px; margin-left: 5px;'><i class='fa fa-trash' aria-hidden='true'></i></button></a>
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