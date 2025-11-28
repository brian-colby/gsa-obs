<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="icon" type="image/png" href="../assets/icons/gsa-logo.png"/>
  <script>  
//user-defined function to download CSV file  
function downloadCSV(csv, filename) {  
    var csvFile;  
    var downloadLink;  
     
    //define the file type to text/csv  
    csvFile = new Blob([csv], {type: 'text/csv'});  
    downloadLink = document.createElement("a");  
    downloadLink.download = filename;  
    downloadLink.href = window.URL.createObjectURL(csvFile);  
    downloadLink.style.display = "none";  
  
    document.body.appendChild(downloadLink);  
    downloadLink.click();  
}  
  
//user-defined function to export the data to CSV file format  
function exportTableToCSV(filename) {  
   //declare a JavaScript variable of array type  
   var csv = [];  
   var rows = document.querySelectorAll("table tr");  
   
   //merge the whole data in tabular form   
   for(var i=0; i<rows.length; i++) {  
    var row = [], cols = rows[i].querySelectorAll("td, th");  
    for( var j=0; j<cols.length; j++)  
       row.push(cols[j].innerText);  
    csv.push(row.join(","));  
   }   
   //call the function to download the CSV file  
   downloadCSV(csv.join("\n"), filename);  
}  
</script> 

<!-- CSS for ICS Treeview -->
<style>
    ul, #myUL {
      list-style-type: none;
    }

    #myUL {
      margin: 0;
      padding: 0;
    }

    .caret {
      cursor: pointer;
      -webkit-user-select: none; /* Safari 3.1+ */
      -moz-user-select: none; /* Firefox 2+ */
      -ms-user-select: none; /* IE 10+ */
      user-select: none;
    }

    .caret::before {
      content: "\25B6";
      color: black;
      display: inline-block;
      margin-right: 6px;
    }

    .caret-down::before {
      -ms-transform: rotate(90deg); /* IE 9 */
      -webkit-transform: rotate(90deg); /* Safari */
      transform: rotate(90deg);  
    }
    

    .nested {
      display: none;
    }

    .active {
      display: block;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../assets/icons/gsa-logo.png" alt="GSA 360" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="admin-dashboard.php" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <!-- <span class="badge badge-warning navbar-badge">15</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Admin Actions</span>
          <div class="dropdown-divider"></div>
          <a href="../includes/logout.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
          
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin-dashboard.php" class="brand-link">
      <img src="../assets/icons/gsa-logo.png" alt="GSA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GSA 360 Webstore</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/icons/user.png" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php if(isset($_SESSION['user'])){echo $_SESSION['user'];} ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="admin-dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-object-group"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../page/adoption.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adoption</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/entity.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/prefix.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Prefix</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/sector.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sector</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/committee.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Committee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/subcommittee.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SubCommittee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/sdg.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SDG</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/working-group.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Working Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/ics.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ICS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/standard.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Standard 
                <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../page/standard.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Standard</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../page/upload-pdf.php" class="nav-link">
                    <i class="far fa-square nav-icon"></i>
                    <p>Upload Standard (PDF)</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../page/upload-text.php" class="nav-link">
                    <i class="far fa-square nav-icon"></i>
                    <p>Upload Standard (Text)</p>
                  </a>
                </li>
                </ul>
              </li>
			        <li class="nav-item">
                <a href="../page/keyword.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keyword</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/publishing.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Publish</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/language.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Language</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/version.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Version</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/price.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Price</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/permission.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permission</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/reference.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reference</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/stage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../page/stage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stage</p>
                </a>
              </li>
            </ul>
          </li>
          <!--<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../paages/bank-reports.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Reports</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="loans.php" class="nav-link">
              <i class="nav-icon fas fa-minus-square" aria-hidden="true"></i>
              <p>
                Loans
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../paages/tax-schedule.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tax Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../paages/percentages.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Percentages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../paages/user-login.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users Managment</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="sim.php" class="nav-link">
              <i class="nav-icon fas fa-users" aria-hidden="true"></i>
              <p>
                Simulation
              </p>
            </a>
          </li>-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>