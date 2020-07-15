<?php
include 'includes/control.php';
include 'includes/head.php';
include 'modal.php';
?>
<body>
  <style>.card .card-header .dropdown{line-height:1}.card .card-header .dropdown .dropdown-menu{line-height:1.5}.card .card-header[data-toggle=collapse]{text-decoration:none;position:relative;padding:.75rem 3.25rem .75rem 1.25rem}.card .card-header[data-toggle=collapse]::after{position:absolute;right:0;top:0;padding-right:1.725rem;line-height:51px;font-weight:900;content:'\f107';font-family:'Font Awesome 5 Free';color:#d1d3e2}.card .card-header[data-toggle=collapse].collapsed{border-radius:.35rem}.card .card-header[data-toggle=collapse].collapsed::after{content:'\f105'}.chart-bar{position:relative;height:10rem;width:100%}@media (min-width:768px){.chart-bar{height:20rem}}</style>
  <div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div href="dashboard.php" class="sidebar-heading">JUST 4 U CO. LTD.</div>
      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action bg-light text-primary">Dashboard</a>
        <a href="#reserveSubmenu" class="list-group-item list-group-item-action bg-light" data-toggle="collapse">Reservation<i style="margin-top: 5px;" class="fa fa-angle-down float-right"></i></a>
        <div style="text-indent: 4px;" class="collapse show" id="reserveSubmenu">
          <a href="pending.php" class="list-group-item list-group-item-action">Pending</a>
          <a href="approve.php" class="list-group-item list-group-item-action">Approved</a>
          <a href="finish.php" class="list-group-item list-group-item-action">Finished</a>
        </div>
        <a href="client.php" class="list-group-item list-group-item-action bg-light">Clients</a>
        <a href="#menuSubmenu" class="list-group-item list-group-item-action bg-light" data-toggle="collapse">Menus<i style="margin-top: 5px;" class="fa fa-angle-down float-right"></i></a>
        <div style="text-indent: 4px;" class="collapse show" id="menuSubmenu">
          <a href="menu.php" class="list-group-item list-group-item-action">Manage Menu</a>
          <a href="cat.php" class="list-group-item list-group-item-action">Manage Categories</a>
        </div>
        <a href="package.php" class="list-group-item list-group-item-action bg-light">Packages</a>
        <a href="event.php" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="gallery.php" class="list-group-item list-group-item-action bg-light">Gallery</a>
        <a href="message.php" class="list-group-item list-group-item-action bg-light">Messages</a>
        <a href="payment.php" class="list-group-item list-group-item-action bg-light">Payments</a>
        <a href="report.php" class="list-group-item list-group-item-action bg-light">Reports</a>
      </div>
    </div>

    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-light" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
        <a class="navbar-brand font-weight-light ml-2"><?php echo date("l, M d"); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-user"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Account
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item small" href="#">Account Settings</a>
                <a class="dropdown-item small" href="#logout" data-toggle="modal">Log-Out</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid border" style="width: auto; margin: 30px; padding: 15px;">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="mt-1 mb-1 font-weight-normal">Dashboard Overview</h1>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Revenue</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $count = mysqli_num_rows(mysqli_query($conn, "SELECT SUM(payable) AS value_sum FROM tbl_reserve WHERE status = 'Finished' AND balance = '0.00'"));
                      echo '₱'. $count .'.00';
                      ?>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Registered Clients</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_user"));
                      echo $count;
                      ?>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Messages</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php 
                          $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_message"));
                          echo $count;
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-envelope fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_reserve WHERE status = 'Pending'"));
                      echo $count;
                      ?>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-normal text-gray-800">
                      <div id="calendar_div">
                        <?php include 'calendar.php'; echo getCalender(); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'includes/foot.php' ?>