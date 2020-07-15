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
        <a href="client.php" class="list-group-item list-group-item-action bg-light text-primary">Clients</a>
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
              <div class="col-sm-6">
                <h1 class="mt-1 mb-1 font-weight-normal">Manage Clients</h1>
              </div>
            </div>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table" id="example">
              <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Verified</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sql = "SELECT * FROM tbl_user";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $userid = $row['userid'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $email = $row['email'];
                    $verified = $row['verified'];
                    if ($verified == '0') {
                      $display = 'Not Verified';
                    }
                    elseif ($verified == '1') {
                      $display = 'Verified';
                    }
                    ?>
                    <tr>
                      <td><?php echo $firstname; ?></td>
                      <td><?php echo $lastname; ?></td>
                      <td><?php echo $phone; ?></td>
                      <td><?php echo $address; ?></td>
                      <td><?php echo $email; ?></td>
                      <td><?php echo $display; ?></td>
                      <td>
                        <a class="btn btn-info" href="#edit<?php echo $userid;?>" data-toggle="modal">Update</a>
                        <a class="btn btn-danger" href="#delete<?php echo $userid;?>" data-toggle="modal">Delete</a>
                      </td>
                      <!-- Edit Modal -->
                      <div id="edit<?php echo $userid; ?>" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post" action="">
                              <div class="modal-header">            
                                <h4 class="modal-title font-weight-light">Update Verification</h4>
                              </div>
                              <div class="col-md-12">
                                <div class="modal-body font-weight-normal">
                                  <input type="hidden" name="edit_id" value="<?php echo $userid; ?>">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" autocomplete="off" disabled>
                                  </div>
                                  <div>
                                    <label>Verified</label>
                                    <select class="form-control" name="verified" autocomplete="off" required>
                                      <option value="1">Verify</option>
                                    </select>
                                  </div>
                                  <div class="modal-footer">
                                    <input type="button" class="btn btn-default border" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-primary" name="update" value="Save">
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- Delete Modal -->
                      <div id="delete<?php echo $userid; ?>" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post">
                              <div class="modal-header">            
                                <h4 class="modal-title font-weight-light">Delete Client</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                              </div>
                              <div class="modal-body font-weight-normal">
                                <input type="hidden" name="delete_id" value="<?php echo $userid; ?>">
                                <p>Are you sure you want to delete this?</p>
                                <p><small>This action cannot be undone.</small></p>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-default border" value="Cancel" data-dismiss="modal">
                                <input type="submit" name="delete" class="btn btn-danger" value="Delete" autofocus>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <?php 
                    }
                    if(isset($_POST['update'])){
                      $edit_id = $_POST['edit_id'];
                      $verified = $_POST['verified'];
                      $sql = "UPDATE tbl_user SET 
                      verified = '$verified'
                      WHERE userid = '$edit_id'";
                      if ($conn->query($sql) === TRUE) {
                        echo '<script>window.location.href="client.php"</script>';
                      } else {
                        echo "Error updating record: " . $conn->error;
                      }
                    }

                    if(isset($_POST['delete'])){
                      $delete_id = $_POST['delete_id'];
                      $sql = "DELETE FROM tbl_user WHERE userid = '$delete_id'";
                      if ($conn->query($sql) === TRUE) {
                        echo '<script>window.location.href="client.php"</script>';
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
  <?php include 'includes/foot.php'; ?>