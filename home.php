<?php 
session_start();
require 'includes/connect.php';
require 'includes/head.php';
require 'modal.php';
?>
<body class="bg-light">
  <style>.carousel-item {height: 100vh;min-height: 350px;background: no-repeat center center scroll;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}.masthead{height: 90vh; min-height: 500px;background-size: cover;background-position: center;background-repeat: no-repeat;background: #ffff66;}</style>
  <nav style="background: white;" class="navbar navbar-expand-lg navbar-light fixed-top border-bottom">
    <div class="container">
      <a class="navbar-brand" href="home.php"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">Home</a>
          </li>
          <li class="nav-item">
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
            <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item small" href="account.php">Account Settings</a>
            <a class="dropdown-item small" href="#signout" data-toggle="modal">Log-Out</a>
            </div>
            </li>';
          } else {
            echo '<li><a href="signup.php" class="btn btn-outline-dark my-2 my-sm-0">Register</a>
            <a href="signin.php" class="btn btn-outline-dark my-2 my-sm-0 ml-1">Log In</a>
            </li>';
          } 
          ?> 
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header  class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12 text-center mt-5"><img style="margin-left: auto; margin-right: auto; width: 20%; display: block;" src="assets/logo/logo.png">
          <h1 class="font-weight-light mt-4 mb-2">A Catering Service</h1>
          <p>Let our team take your stress and strain out of planning an event and allow us to impress you.</p>
          <hr>
          <a style="border-radius: 50px; width: 120px;" href="detail.php" class="btn btn-outline-dark">Get Started</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <section style="padding-top: 150px; padding-bottom: 100px;" class="bg-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 mb-5 text-center">
          <h1 class="text-center mt-4 mb-0 font-weight-normal">What We Do?</h1>
          <h5 style="margin: 40px 250px" class="font-weight-light">Developing an event that will everyone will remember, JUST 4 U is your one-stop-shop for catering coordination. We Cater: Wedding, Debut, Birthdays, Baptismal, Seminar, Company's Launching & Christmas Party, School Events Prom/Graduation, Anniversaries, Conferences, Reunions, Private Parties, Special Events, and more!</h5>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.row -->
<section class="py-5">
  <div class="container">
    <h1 class="text-center mt-4 mb-0 font-weight-normal mb-5">Events</h1>
    <div class="row text-center text-lg-left">
      <?php 
      $sql = "SELECT * FROM tbl_event";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $event_name = $row['event_name'];
          $event_image = $row['event_image'];
          ?>
          <div class="col-md-6 col-lg-2">
            <div class="card border-0 transform-on-hover" style="box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.300);">
              <?php echo "<img src='assets/images/event/" . $event_image."'class='card-img-top'>"; ?>
              <div class="card-body">
                <h6 class="text-center"><?php echo $event_name; ?></h6>
              </div>
            </div>
          </div>
        <?php }} ?>
      </div>
    </div>
  </section>
  <hr>
  <!-- /.row -->
  <section class="py-5">
    <div class="container">
      <h1 class="text-center mb-0 font-weight-normal mb-5">Packages</h1>
      <div class="row">
        <?php 
        $sql = "SELECT * FROM tbl_package";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $package_id = $row['package_id'];
            $package_name = $row['package_name'];
            $package_include = $row['package_include'];
            $package_price = $row['package_price'];
            $package_desc = $row['package_desc'];
            $package_image = $row['package_image'];
            ?>
            <div class="col-lg-4">
              <div class="card border-dark mb-5 mb-lg-3">
                <div class="card-body">
                  <a style="display: block; margin-right: auto; margin-left: auto; color: black;" class="text-center mb-3" href="#view<?php echo $package_id;?>" data-toggle="modal">View Image</a>
                  <h5 class="card-title text-muted text-uppercase text-center"><?php echo $package_name; ?></h5>
                  <h6 class="card-price text-center">₱<?php echo $package_price; ?><span class="period"> / Pax</span></h6>
                  <hr>
                  <h6>Includes:</h6>
                  <p><?php echo $package_include; ?></p>
                  <hr>
                  <h6>Description:</h6>
                  <p><?php echo $package_desc; ?></p>
                </div>
              </div>
              <!-- View Modal -->
              <div id="view<?php echo $package_id; ?>" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">            
                      <h4 class="modal-title font-weight-light"><?php echo $package_name; ?></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body font-weight-normal">
                      <?php echo "<img src='assets/images/package/". $package_image."'style='width:450px;height:450px;'>"; ?>
                    </div>
                    <div class="modal-footer">
                      <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php }} ?>
        </div>
      </div>
    </section>
    <hr>
    <section class="py-5">
      <div class="container">
        <h1 class="text-center mt-4 mb-0 font-weight-normal mb-5">Menus</h1>
        <div class="row text-center text-lg-left">
          <?php 
          $sql = "SELECT * FROM tbl_menu LIMIT 12";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $menu_name = $row['menu_name'];
              $cat_id = $row['cat_id'];
              $menu_image = $row['menu_image'];
              ?>
              <div class="col-md-6 col-lg-2">
                <div class="card border-0 transform-on-hover">
                  <?php echo "<img src='assets/images/menu/" . $menu_image."'class='card-img-top'>"; ?>
                  <div class="card-body m-0 p-3">
                    <h6 class="text-center"><?php echo $menu_name; ?></h6>
                  </div>
                </div>
              </div>
            <?php }} ?>
          </div>
          <div class="col-md-12 text-center mt-5">
            <a href="menu.php" class="btn btn-warning text-white">View More</a>
          </div>
        </div>
      </section>
      <hr>
      <section class="py-5">
        <div class="container">
          <h1 class="text-center mt-4 mb-0 font-weight-normal mb-5">Gallery</h1>
          <div class="row text-center text-lg-left">
            <?php 
            $sql = "SELECT * FROM tbl_gallery LIMIT 4";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $gallery_image = $row['gallery_image'];
                ?>
                <div class="col-lg-3 col-md-4 col-6">
                  <?php echo "<img src='assets/images/gallery/" . $gallery_image."'style='width:260px;height:250px;box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.500);'>"; ?>
                </div>
              <?php }} ?>
            </div>
          </div>
        </section>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="sticky-footer">
          <div class="container-fluid mb-3">
            <div class="copyright text-center my-auto"><hr>
              <span>Copyright © EVENTS CREATION Just 4 U Co. Ltd. 2019</span>
            </div>
          </div>
        </footer>

        <?php include 'includes/foot.php'; ?>