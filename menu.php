<?php 
session_start();
require 'includes/connect.php';
require 'includes/head.php';
require 'modal.php';
?>
<body class="bg-light">
	<nav style="background: white;" class="navbar navbar-expand-lg navbar-light fixed-top border-bottom">
		<div class="container">
			<a class="navbar-brand" href="home.php"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="home.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="detail.php">Reservation</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="sched.php">Schedule</a>
					</li>
					<li class="nav-item active">
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
						echo '<li><a href="signup.php" class="btn btn-outline-dark my-2 my-sm-0">Register</a>
						<a href="signin.php" class="btn btn-outline-dark my-2 my-sm-0 ml-1">Log In</a>
						</li>';
					} 
					?> 
				</ul>
			</div>
		</div>
	</nav>
	<!-- Page Content -->
	<div class="container-fluid border" style="margin-top: 100px; width: 70%">
		<h1 class="text-center mt-4 mb-0 font-weight-normal">List of all Menus</h1>
		<hr>
		<div class="row text-center text-lg-left">
          <?php 
          $sql = "SELECT * FROM tbl_menu";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $menu_name = $row['menu_name'];
              $cat_id = $row['cat_id'];
              $menu_image = $row['menu_image'];
              ?>
              <div class="col-md-3 mb-4">
                <div class="card border-0 transform-on-hover" style="box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.100);">
                  <?php echo "<img src='assets/images/menu/" . $menu_image."'style='width: 205px; height: 205px'>"; ?>
                  <div class="card-body m-0">
                    <h6 class="text-center p-0 m-0" style="font-size: 13px;"><?php echo $menu_name; ?></h6>
                  </div>
                </div>
              </div>
            <?php }} ?>
          </div>
		</div>

		<footer class="sticky-footer">
			<div class="container-fluid mb-3">
				<div class="copyright text-center my-auto"><hr>
					<span>Copyright © EVENTS CREATION Just 4 U Co. Ltd. 2019</span>
				</div>
			</div>
		</footer>
		<?php include 'includes/foot.php'; ?>