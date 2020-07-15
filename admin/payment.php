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
        <a href="payment.php" class="list-group-item list-group-item-action bg-light text-primary">Payments</a>
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
              <div class="col-sm-6">
                <h1 class="mt-1 mb-1 font-weight-normal">Manage Payments</h1>
              </div>
            </div>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table table-sm" id="example">
              <thead>
                <tr>
                  <th>Fullname</th>
                  <th>Phone</th>
                  <th>Bank</th>
                  <th>Reference</th>
                  <th>Amount</th>
                  <th>Image Receipt</th>
                  <th>Status</th>
                  <th>Payment Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sql = "SELECT * FROM tbl_payment JOIN tbl_user ON tbl_payment.phone = tbl_user.phone";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $payment_id = $row['payment_id'];
                    $name = $row['name'];
                    $phone = $row['phone'];
                    $bank = $row['bank'];
                    $ref = $row['ref'];
                    $amount = $row['amount'];
                    $image = $row['image'];
                    $status = $row['status'];
                    $payment_date = $row['payment_date'];

                    if($status == 'Unconfirmed'){
                      $alert = "<div class='btn text-center text-white bg-warning pt-0 pb-0'>$status</button>";
                    }else if($status == 'Received'){
                      $alert = "<div class='btn text-center text-white bg-success pt-0 pb-0'>$status</button>";
                    }else if($status == 'Invalid'){
                      $alert = "<div class='btn text-center text-white bg-danger pt-0 pb-0'>$status</button>";
                    }

                    ?>
                    <tr>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $phone; ?></td>
                      <td><?php echo $bank; ?></td>
                      <td><?php echo $ref; ?></td>
                      <td>₱<?php echo $amount; ?></td>
                      <td><a href="#view<?php echo $payment_id;?>" data-toggle="modal">View Image</a></td>
                      <td><?php echo $alert; ?></td>
                      <td><?php echo date("M. d, Y",strtotime($payment_date)); ?></td>
                      <td>
                        <a class="btn btn-info" href="#update<?php echo $payment_id;?>" data-toggle="modal">Update</a>
                        <a class="btn btn-danger" href="#delete<?php echo $payment_id;?>" data-toggle="modal">Delete</a>
                      </td>
                      <!-- Edit Modal -->
                      <div id="update<?php echo $payment_id; ?>" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post">
                              <div class="modal-header mb-2">            
                                <h4 class="modal-title font-weight-light">Update Status</h4>
                              </div>
                              <div class="modal-body font-weight-normal">
                                <input type="hidden" name="edit_id" value="<?php echo $payment_id; ?>">
                                <div>
                                  <label>Select Status:</label>
                                  <select name="status" class="form-control">
                                    <option value="Unconfirmed">Unconfirmed</option>
                                    <option value="Received">Received</option>
                                    <option value="Invalid">Invalid</option>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" name="update" class="btn btn-primary" value="Save">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- Delete Modal -->
                      <div id="delete<?php echo $payment_id; ?>" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post">
                              <div class="modal-header">            
                                <h4 class="modal-title font-weight-light">Delete Payment</h4>
                              </div>
                              <div class="modal-body font-weight-normal">
                                <input type="hidden" name="delete_id" value="<?php echo $payment_id; ?>">
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
                      <!-- View Image Modal -->
                      <div id="view<?php echo $payment_id; ?>" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">            
                              <h4 class="modal-title font-weight-light">Image Receipt</h4>
                            </div>
                            <div class="modal-body font-weight-normal">
                              <?php echo "<img src='../assets/images/payment/". $image."'style='width:450px;height:450px;'>"; ?>
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php }
                    if (isset($_POST['update'])) {
                      $edit_id = $_POST['edit_id'];
                      $status = $_POST['status'];
                      $sql = "UPDATE tbl_payment SET 
                      status = '$status'
                      WHERE payment_id = '$edit_id'";
                      if ($conn->query($sql) === TRUE) {
                        echo '<script>window.location.href="payment.php"</script>';
                      }
                    }
                    if(isset($_POST['delete'])){
                      $delete_id = $_POST['delete_id'];
                      $sql = "DELETE FROM tbl_payment WHERE payment_id = '$delete_id'";
                      if ($conn->query($sql) === TRUE) {
                        echo '<script>window.location.href="payment.php"</script>';
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