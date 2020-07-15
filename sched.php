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
					<li class="nav-item active">
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
	<div class="container-fluid border" style="margin-top: 100px; width: 65%">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h1 class="mt-4 mb-0 font-weight-normal">Upcoming Events</h1>
					</div>
				</div>
			</div>
			<hr>
			<div class="table-responsive">
				<table class="table table-bordered" id="example">
					<thead>
						<tr>
							<th>Date</th>
							<th>Time Start</th>
							<th>Time End</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = "SELECT * FROM tbl_reserve WHERE status = 'Approved'";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$rid = $row['rid'];
								$rdate = $row['rdate'];
								$rstart = $row['rstart'];
								$rend = $row['rend'];
								?>
								<tr>
									<td><?php echo date("M. d, Y",strtotime($rdate)); ?></td>
									<td><?php echo date("h:i A",strtotime($rstart)); ?></td>
									<td><?php echo date("h:i A",strtotime($rend)); ?></td>
								<?php } }?>
							</tr>
						</tbody>
					</table>
				</div>
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