<?php
require 'includes/control.php';
require 'includes/head.php';
require 'modal.php';

if (isset($_POST['submit'])) {
  $rid = $_SESSION['email'];
  $invite = $_POST['invite'];

  $sql = mysqli_query($conn, "SELECT * FROM tbl_package");
  $row = mysqli_fetch_array($sql);
  $package_name = $row['package_name'];
  $price = $row['package_price'];
  $payable = $invite * $price;

  mysqli_query($conn, "UPDATE tbl_reserve SET
   invite = '$invite',
   package = '$package_name',
   price = '$price',
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
        <a href="custom.php"><button class="btn btn-warning float-right" type="submit">Skip to Customize</button></a>
        <h2>Select Package</h2>
        <p>Below you will be choosing your desired package and how many invites you prefer.</p>
      </div>
      <form class="needs-validation" method="post">
        <div class="float-right form-inline">
          <strong class="text-muted">Price *</strong>
          <input type="number" class="form-control ml-2" name="invite" placeholder="Number of invites.." autocomplete="off" required>
        </div>
        <h4 class="d-flex justify-content-between align-items-center">
          <span class="text-muted">Step 2 of 3</span>
        </h4>
        <small>Click the round button and choose one *</small>
        <?php
        $sql = "SELECT * FROM tbl_package";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
          $package_id = $row['package_id'];
          $package_name = $row['package_name'];
          $package_include = $row['package_include'];
          $package_price = $row['package_price'];
          $package_desc = $row['package_desc'];
          $package_image = $row['package_image'];
          ?>
          <div style="width: 70%; margin: auto;">
            <div class="pt-slim pt-4">
              <input style="width: 100%; height: 1.5em;" type="radio" value="<?php echo $package_id; ?>" name="package_id">
              <h1 class="pt-name" style="font-size: 35px;"><?php echo $package_name; ?></h1>
              <h4 class="pt-price"><b>₱<?php echo $package_price; ?></b> / Pax</h4>
              <div class="p-4">
                <h6>Includes:</h6>
                <p"><?php echo $package_include; ?></p>
                <hr>
                <h6>Description:</h6>
                <p><?php echo $package_desc; ?></p>
                <?php echo "<img src='assets/images/package/". $package_image."'style='margin-left:70px;max-width:500px;
                max-height:250px;'>"; ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <hr>
        <small>Note: You can't go back to this session after proceeding to the next step *</small>
        <button type="submit" class="btn btn-warning float-right" name="submit">Proceed to next step</button>
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
