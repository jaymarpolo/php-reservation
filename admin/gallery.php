<?php
include 'includes/control.php';
include 'includes/head.php';
include 'modal.php';
if (isset($_POST['submit'])) {
  $gallery_image = $_FILES['gallery_image']['name'];
  $target = "../assets/images/gallery/" . basename($gallery_image);
  $conn->query("INSERT INTO tbl_gallery (gallery_image) VALUES ('$gallery_image')") or die($conn->error);
  if (move_uploaded_file($_FILES['gallery_image']['tmp_name'], $target)) {
    header('location:gallery.php');
  }
}
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
        <a href="gallery.php" class="list-group-item list-group-item-action bg-light text-primary">Gallery</a>
        <a href="message.php" class="list-group-item list-group-item-action bg-light">Messages</a>
        <a href="payment.php" class="list-group-item list-group-item-action bg-light">Payments</a>
        <a href="report.php" class="list-group-item list-group-item-action bg-light">Reports</a>
      </div>
    </div>

    <!-- Page Content -->
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
          <div class="float-right">
            <a href="#add" class="btn btn-white text-primary border-primary" data-toggle="modal"><span>Add New Gallery</span></a>
          </div>
          <span class="counter float-right"></span>
          <div class="row">
            <div class="col-sm-6">
              <h1 class="mt-1 mb-1 font-weight-normal">Manage Gallery</h1>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <?php 
          $sql = "SELECT * FROM tbl_gallery";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $gallery_id = $row['gallery_id'];
              $gallery_image = $row['gallery_image'];
              ?>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="portfolio-content">
                  <figure>
                    <?php echo "<img src='../assets/images/gallery/". $gallery_image."'>"; ?>
                  </figure>
                  <div class="entry-content flex flex-column align-items-center justify-content-center">
                    <ul class="flex flex-wrap justify-content-center">
                      <li>
                        <a class="btn btn-white text-danger border-danger" href="#delete<?php echo $gallery_id;?>" data-toggle="modal">Delete</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Add Menu Modal -->
              <div id="add" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post" enctype="multipart/form-data">
                      <div class="modal-header">            
                        <h4 class="modal-title font-weight-light">New Thumbnail</h4>
                      </div>
                      <div class="col-md-12">
                        <div class="modal-body font-weight-normal">
                          <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" class="form-control-file" name="gallery_image">
                          </div>
                          <div class="modal-footer">
                            <input type="button" class="btn btn-default border" data-dismiss="modal" value="Cancel">
                            <input type="submit" name="submit" class="btn btn-primary" value="Add">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Edit Modal -->
              <div id="edit<?php echo $gallery_id; ?>" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post">
                      <div class="modal-header">            
                        <h4 class="modal-title font-weight-light">Update Image</h4>
                      </div>
                      <div class="col-md-12">
                        <div class="modal-body font-weight-normal">
                          <input type="hidden" name="edit_id" value="<?php echo $gallery_id; ?>">
                          <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" class="form-control-file" name="event_image" autocomplete="off">
                          </div>
                          <div class="modal-footer">
                            <input type="button" class="btn btn-default border" value="Cancel" data-dismiss="modal">
                            <input type="submit" class="btn btn-primary" name="update" value="Save">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Delete Menu Modal -->
              <div id="delete<?php echo $gallery_id; ?>" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post">
                      <div class="modal-header">            
                        <h4 class="modal-title font-weight-light">Delete Thumbnail</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      </div>
                      <div class="modal-body font-weight-normal">
                        <input type="hidden" name="delete_id" value="<?php echo $gallery_id; ?>">
                        <p>Are you sure you want to delete this?</p>
                        <p><small>This action cannot be undone.</small></p>
                      </div>
                      <div class="modal-footer">
                        <input type="button" class="btn btn-default border" value="Cancel" data-dismiss="modal">
                        <input type="submit" class="btn btn-danger" name="delete" value="Delete" autofocus>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
            }
            if(isset($_POST['update'])){
              $edit_id = $_POST['edit_id'];
              $gallery_image = $_FILES['gallery_image']['name'];
              $target = "../assets/images/gallery/" . basename($gallery_image);
              $sql = "UPDATE tbl_gallery SET 
              gallery_image='$gallery_image'
              WHERE gallery_id ='$edit_id'";
              if ($conn->query($sql) === TRUE) {
                if (move_uploaded_file($_FILES['gallery_image']['tmp_name'], $target)) {
                  
                }
                echo '<script>window.location.href="gallery.php"</script>';
              } else {
                echo "Error updating record: " . $conn->error;
              }
            }
            if(isset($_POST['delete'])){
              $delete_id = $_POST['delete_id'];
              $sql = "DELETE FROM tbl_gallery WHERE gallery_id = '$delete_id'";
              if ($conn->query($sql) === TRUE) {
                echo '<script>window.location.href="gallery.php"</script>';
              } else {
                echo "Error deleting record: " . $conn->error;
              }
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'includes/foot.php'; ?>