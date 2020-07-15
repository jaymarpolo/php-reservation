  <?php
  include 'includes/control.php';
  include 'includes/head.php';
  include 'modal.php';
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
            <a href="finish.php" class="list-group-item list-group-item-action text-primary">Finished</a>
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
          <div class="table-wrapper">
            <div class="table-title">
              <div class="row">
                <div class="col-sm-12">
                  <h1 class="mt-1 mb-1 font-weight-normal">Manage Finished Reservations</h1>
                </div>
              </div>
            </div>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="example">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Fullname</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Event Name</th>
                    <th>Event Type</th>
                    <th>Venue Address</th>
                    <th>Invites</th>
                    <th>Date</th>
                    <th>Time Start</th>
                    <th>Time End</th>
                    <th>Package Name</th>
                    <th>Package Price</th>
                    <th>Balance</th>
                    <th>Payable</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM tbl_reserve WHERE status = 'Finished'";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      $rid = $row['rid'];
                      $code = $row['code'];
                      $fullname = $row['fullname'];
                      $phone = $row['phone'];
                      $address = $row['address'];
                      $event_name = $row['event_name'];
                      $event_type = $row['event_type'];
                      $venue = $row['venue'];
                      $invite = $row['invite'];
                      $rdate = $row['rdate'];
                      $rstart = $row['rstart'];
                      $rend = $row['rend'];
                      $package = $row['package'];
                      $price = $row['price'];
                      $balance = $row['balance'];
                      $payable = $row['payable'];
                      $status = $row['status'];
                      if($balance == $payable){
                        $display = "<td class='btn text-center text-white bg-secondary pt-0 pb-0 pr-2 mt-1 ml-1'>Unpaid</td>";
                      }
                      elseif($balance == '0.00'){
                        $display = "<td class='btn text-center text-white bg-success pt-0 pb-0 pr-2 mt-1 ml-1'>Paid</td>";
                      }else{
                        $display = "<td class='btn text-center text-white bg-warning pt-0 pb-0 pr-2 mt-1 ml-1'>Partial</td>";
                      }
                      ?>
                      <tr>
                        <td><?php echo $code; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $event_name; ?></td>
                        <td><?php echo $event_type; ?></td>
                        <td><?php echo $venue; ?></td>
                        <td><?php echo $invite; ?></td>
                        <td><?php echo date("m/d/y", strtotime($rdate)); ?></td>
                        <td><?php echo date("h:i A", strtotime($rstart)); ?></td>
                        <td><?php echo date("h:i A", strtotime($rend)); ?></td>
                        <td><?php echo $package; ?></td>
                        <td>₱<?php echo $price; ?></td>
                        <td>₱<?php echo $balance; ?></td>
                        <td>₱<?php echo $payable; ?></td>
                        <?php echo $display; ?>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item small" href="#edit<?php echo $rid;?>" data-toggle="modal">Update Balance</a>
                              <a class="dropdown-item small" href="#delete<?php echo $rid;?>" data-toggle="modal">Delete</a>
                            </div>
                          </div>
                        </td>
                        <!-- Edit Modal HTML -->
                        <div id="edit<?php echo $rid; ?>" class="modal fade">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="post">
                                <div class="modal-header mb-2">
                                  <h4 class="modal-title font-weight-light">Update Balance</h4>
                                </div>
                                <div class="modal-body font-weight-normal">
                                  <input type="hidden" name="edit_id" value="<?php echo $rid; ?>">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Balance</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                          </div>
                                          <input type="number" class="form-control" name="balance" value="<?php echo $balance; ?>" autocomplete="off" required>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                  <input type="submit" class="btn btn-primary" name="update" value="Save">
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- Delete Modal -->
                        <div id="delete<?php echo $rid; ?>" class="modal fade">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="post">
                                <div class="modal-header">            
                                  <h4 class="modal-title font-weight-light">Delete Reservation</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body font-weight-normal">
                                  <input type="hidden" name="delete_id" value="<?php echo $rid; ?>">
                                  <p>Are you sure you want to delete this?</p>
                                  <p><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                  <input type="submit" name="delete" class="btn btn-danger" value="Delete" autofocus>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                      function itexmo($number,$message,$apicode){
                        $ch = curl_init();
                        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
                        curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                          http_build_query($itexmo));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        return curl_exec ($ch);
                        curl_close ($ch);
                      }
                      if(isset($_POST['update'])){
                        $edit_id = $_POST['edit_id'];
                        $balance = $_POST['balance'];
                        $sql = "UPDATE tbl_reserve SET 
                        balance = '$balance'
                        WHERE rid = '$edit_id'";
                        if ($conn->query($sql) === TRUE) {
                          echo '<script>window.location.href="finish.php"</script>'; 
                        } else {
                          echo "Error updating record: " . $conn->error;
                        }
                      }
                      if(isset($_POST['delete'])){
                        $delete_id = $_POST['delete_id'];
                        $sql = "DELETE FROM tbl_reserve WHERE rid = '$delete_id'";
                        if ($conn->query($sql) === TRUE) {
                          echo '<script>window.location.href="finish.php"</script>';
                        } else {
                          echo "Error deleting record: " . $conn->error;
                        }
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'includes/foot.php' ?>