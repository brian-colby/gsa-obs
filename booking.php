<?php
session_start();
// if(!isset($_SESSION['App_Log_Access'])){
// 	header("location: index.php");
//   }
error_reporting(0);
require "php_admin_script/connect_function.php";
include "php_admin_script/count.php"
?>
<!DOCTYPE html><!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2023 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
--><!-- Breadcrumb-->
<html lang="en">
  <head>
    <!-- <base href="./../"> -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>IT Equipments Request</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/gsa-logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/gsa-logo.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/gsa-logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/gsa-logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/gsa-logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/gsa-logo.png">
    <link rel="manifest" href="assets/img/gsa-logo.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/img/gsa-logo.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="css/examples.css" rel="stylesheet">
    <link rel="canonical" href="https://coreui.io/docs/content/tables/">
  </head>
  <body>
    <!-- <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/img/gsa-logo.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="index.html">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg> Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>
      </ul>
    </div> -->
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
        <div class="container-fluid">
          <!-- <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg></a> -->
          <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="index.php">Check Availability</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php">Book Equipment</a></li>
          </ul>
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/gsa-logo.png" alt="gsaLogo"></div>
              </a>
            </li>
          </ul>
        </div>
      </header>
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <!-- cards -->
            <div class="example">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-1010" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop"></use>
                      </svg>Equipments Count</a></li>
                </ul>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1010">
                    <div class="row">
                      <div class="col-sm-6 col-md-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="text-medium-emphasis text-end mb-4">
                              <svg class="icon icon-xxl">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop"></use>
                              </svg>
                            </div>
                            <div class="fs-4 fw-semibold"><?php if($laptop_rows > 0){echo $laptop_rows;}else{ echo '0';}?> Laptops</div><small class="text-medium-emphasis text-uppercase fw-semibold">AVAILABLE</small>
                            <div class="progress progress-thin mt-3 mb-0">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.col-->
                      <div class="col-sm-6 col-md-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="text-medium-emphasis text-end mb-4">
                              <svg class="icon icon-xxl">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-monitor"></use>
                              </svg>
                            </div>
                            <div class="fs-4 fw-semibold"><?php if($projector_rows > 0){echo $projector_rows;}else{ echo '0';}?> Projectors</div><small class="text-medium-emphasis text-uppercase fw-semibold">AVAILABLE</small>
                            <div class="progress progress-thin mt-3 mb-0">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.col-->
                      <div class="col-sm-6 col-md-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="text-medium-emphasis text-end mb-4">
                              <svg class="icon icon-xxl">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-voice-over-record"></use>
                              </svg>
                            </div>
                            <div class="fs-4 fw-semibold"><?php if($speaker_rows > 0){echo $speaker_rows;}else{ echo '0';}?> Speaker</div><small class="text-medium-emphasis text-uppercase fw-semibold">AVAILABLE</small>
                            <div class="progress progress-thin mt-3 mb-0">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.col-->
                      <div class="col-sm-6 col-md-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="text-medium-emphasis text-end mb-4">
                              <svg class="icon icon-xxl">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-devices"></use>
                              </svg>
                            </div>
                            <div class="fs-4 fw-semibold"><?php if($pointer_rows > 0){echo $pointer_rows;}else{ echo '0';}?> Pointers</div><small class="text-medium-emphasis text-uppercase fw-semibold">AVAILABLE</small>
                            <div class="progress progress-thin mt-3 mb-0">
                              <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.col-->
                    </div>
                    <!-- /.row-->
                  </div>
                </div>
              </div>
            <!-- Ends Card --><br>
          <div class="car"></div>
          <div class="card mb-4">
            <div class="card-header"><strong>Records Data</strong></div>
            <div class="card-body">
              <p class="text-medium-emphasis small">This shows the data of all records in the system.</p>
              <div class="example">
                <!-- <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-1000" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                      </svg>Preview</a></li>
                  <li class="nav-item"><a class="nav-link" href="https://coreui.io/docs/content/tables/#overview" target="_blank">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-code"></use>
                      </svg>Code</a></li>
                </ul> -->
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Equipment</th>
                          <th scope="col">Equipment Code</th>
                          <th scope="col">Date</th>
                          <th scope="col">Department</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php include "Admin Equipment Booking/php_admin_script/booking_script.php"?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <!-- <div><a href="#">CoreUI </a><a href="#">Bootstrap Admin Template</a> © 2024 creativeLabs.</div> -->
        <div class="ms-auto">Powered by&nbsp;<a href="#">Software Development Team</a></div>
      </footer>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script>
    </script>

  </body>
</html>