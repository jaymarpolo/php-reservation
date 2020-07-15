<?php
include 'includes/control.php';
include 'includes/head.php';
include 'modal.php';
$query = "SELECT * FROM tbl_reserve ORDER BY fullname desc";
$result = mysqli_query($conn, $query);  
?>
<body>
  <div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div href="dashboard.php" class="sidebar-heading">JUST 4 U CO. LTD.</div>
      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="#reserveSubmenu" class="list-group-item list-group-item-action bg-light" data-toggle="collapse">Reservation<i style="margin-top: 5px;" class="fa fa-angle-down float-right"></i></a>
        <div style="text-indent: 4px;" class="collapse show" id="reserveSubmenu">
          <a href="pending.php" class="list-group-item list-group-item-action">Pending</a>
          <a href="approve.php" class="list-group-item list-group-item-action">Approved</a>
          <a href="finish.php" class="list-group-item list-group-item-action">Finished</a>
        </div>
        <a href="client.php" class="list-group-item list-group-item-action bg-light">Clients</a>
        <a href="#menuSubmenu" class="list-group-item list-group-item-action bg-light" data-toggle="collapse">Menus<i style="margin-top: 5px;" class="fa fa-angle-down float-right"></i></a>
        <div style="text-indent: 4px;" class="collapse" id="menuSubmenu">
          <a href="menu.php" class="list-group-item list-group-item-action">Manage Menu</a>
          <a href="cat.php" class="list-group-item list-group-item-action">Manage Categories</a>
        </div>
        <a href="package.php" class="list-group-item list-group-item-action bg-light">Packages</a>
        <a href="event.php" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="gallery.php" class="list-group-item list-group-item-action bg-light">Gallery</a>
        <a href="message.php" class="list-group-item list-group-item-action bg-light">Messages</a>
        <a href="payment.php" class="list-group-item list-group-item-action bg-light">Payments</a>
        <a href="report.php" class="list-group-item list-group-item-action bg-light text-primary">Reports</a>
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
        <div class="table-wrapper">
          <div class="form-group form-inline float-right">
            <div class="row mt-3">
              <div class="col-lg-12">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From" autocomplete="off" required>
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To" autocomplete="off" required>
                <input type="submit" id="filter" name="filter" class="btn btn-white text-primary border-primary" value="Filter">
                <a href="javascript:void(0);" id="print" class="btn btn-white text-primary border-primary">Print</a>
              </div>
            </div>
          </div>
          <span class="counter float-right"></span>
          <div class="table-title">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="mt-1 mb-1 font-weight-normal">Manage Reports</h1>
              </div>
            </div>
          </div>
          <hr>
          <div id="order_table" class="table-responsive">
            <table class="table table-bordered" id="example">
              <thead>
                <tr>
                  <th>Fullname</th>
                  <th>Event Name</th>
                  <th>Event Type</th>
                  <th>Date Completed</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = mysqli_fetch_array($result)) { ?>
                  <tr>
                    <td><?php echo $row["fullname"]; ?></td>
                    <td><?php echo $row["event_name"]; ?></td>
                    <td><?php echo $row["event_type"]; ?></td>
                    <td><?php echo date('F d, Y', strtotime($row["datecompleted"])); ?></td>
                    <td><?php echo $row["payable"]; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php include 'includes/foot.php' ?>