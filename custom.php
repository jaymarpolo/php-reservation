<?php
require 'includes/control.php';
require 'includes/head.php';
require 'modal.php';

if (isset($_POST['submit'])) {
  $rid = $_SESSION['email'];
  $invite = $_POST['invite'];
  $package = $_POST['package'];
  $checkname = implode(", ", $package);

  foreach ($_POST['price'] as $price) {
    $total += $price;
  }

  $payable = $total * $invite;

  mysqli_query($conn, "UPDATE tbl_reserve SET
  invite = '$invite',
  custom = '$checkname',
  package = 'CUSTOM',
  price = '$total',
  balance = '$payable',
  payable = '$payable',
  status = 'Pending'
  WHERE rid = '$rid'")or die(mysqli_error($conn));
  header('location:thankyoures.php');
  $_SESSION['email'] = $rid;
}
?>
<body class="bg-light">
  <nav style="background: white;" class="navbar navbar-expand-lg navbar-light fixed-top border-bottom">
    <div class="container">
      <a class="navbar-brand" href="home.php">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="detail.php">Reservation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sched.php">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="menu.php">Menus</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <?php   
          if(isset($_SESSION['email'])) {
            echo '<li class="nav-item"><a class="nav-link" href="transac.php">Transaction</a></li>
            <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item small" href="account.php">Account Settings</a>
            <a class="dropdown-item small" href="#signout" data-toggle="modal">Log-Out</a>
            </div>
            </li>';
          } else {
            echo '<li><a href="signup.php" class="btn btn-outline-light my-2 my-sm-0">Register</a>
            <a href="signin.php" class="btn btn-outline-light my-2 my-sm-0 ml-1">Log In</a>
            </li>';
          } 
          ?> 
        </ul>
      </div>
    </div>
  </nav>
  <section class="mt-5">
    <div class="container" style="width: 70%;">
      <div class="py-5">
        <a href="package.php"><button class="btn btn-primary float-right" type="submit">Back to Package</button></a>
        <h2>Customize Package</h2>
        <p>Below you will be choosing your desired menus and how many invites you prefer.</p>
      </div>
      <form class="needs-validation" method="post">
        <div class="float-right form-inline">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">₱</span>
            </div>
            <input style="width: 60px;"  class="form-control mr-2" id="total" disabled>
          </div>
          <strong class="text-muted">* </strong>
          <input type="number" class="form-control ml-2" name="invite" placeholder="Number of invites.." autocomplete="off" required>
        </div>
        <h4 class="d-flex justify-content-between align-items-center">
          <span class="text-muted">Step 2 of 3</span>
        </h4>
        <div class="row">
          <?php 
          $sql = "SELECT * FROM tbl_menu";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $menu_id = $row['menu_id'];
              $menu_name = $row['menu_name'];
              $menu_price = $row['menu_price'];
              $menu_image = $row['menu_image'];
              ?> 
              <div class="col-md-4">
                <div class="m-3">
                  <?php echo "<img src='assets/images/menu/" . $menu_image."'style='width:150px;height:150px;box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.500);'>"; ?>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="price[]" class="custom-control-input sum" id="<?php echo $menu_id; ?>" value="<?php echo $menu_price; ?>" data-toggle="checkbox">
                    <input type="checkbox" name="package[]" class="custom-control-input" id="<?php echo $menu_name; ?>" value="<?php echo $menu_name; ?>" data-toggle="checkbox">
                    <label class="custom-control-label mt-2" for="<?php echo $menu_id; ?>"><?php echo $menu_name; ?></label><br>
                    <label>₱<?php echo $menu_price; ?></label>
                  </div>
                </div>
              </div>
            <?php }} ?>
          </div>
          <hr>
          <small>Note: You can't go back to this session after proceeding to the next step *</small>
          <button type="submit" class="btn btn-primary float-right" name="submit">Proceed to next step</button>
        </form>
      </div>
    </section>

    <!-- Footer -->
    <footer class="sticky-footer">
      <div class="container-fluid mt-5 mb-3">
        <div class="copyright text-center my-auto"><hr>
          <span>Copyright © EVENTS CREATION Just 4 U Co. Ltd. 2019</span>
        </div>
      </div>
    </footer>
    <?php include 'includes/foot.php'; ?>
    <script>
      $(document).ready(function(){
        $("form").submit(function(){
          if ($('input:checkbox').filter(":checked").length < 1) {
            alert("Please choose atleast 20 menu");
            return false;
          }
        });
      });
    </script>