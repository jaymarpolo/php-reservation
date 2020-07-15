<?php 
session_start();
require 'includes/connect.php';
require 'includes/head.php';

$error = "";

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' LIMIT 1";
  $resultSet = $conn->query($sql);

  if ($resultSet->num_rows != 0) {
    $row = $resultSet->fetch_assoc();
    $verified = $row['verified'];

    if ($verified == 1) {
      $_SESSION['email'] = $row['email'];
      header('location:home.php');
    }else{
      $error = '<small class="text-danger ml-4">Account has not been verified yet.</small>';
    }
  }else {
    $error = '<small class="text-danger ml-4">Incorrect password or username.</small>';
  }
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
          <li>
            <a href="signup.php" class="btn btn-outline-dark my-2 my-sm-0">Register</a>
            <a href="signin.php" class="btn btn-outline-dark my-2 my-sm-0 ml-1 active">Log In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5 mt-5">
          <div class="card-body">
            <img style="margin-left: auto; margin-right: auto; width: 50%; margin-bottom: 30px; display: block;" src="assets/logo/logo.png">
            <form class="form-signin" method="post">
              <div class="form-label-group">
                <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
                <label for="inputEmail">Email</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label><?php echo $error; ?>
              </div>
              <button class="btn btn-lg btn-warning text-white btn-block text-uppercase" name="submit" type="submit">Log in</button>
              <hr class="p-0 mb-0">
              <div class="text-center"><a href="email.php">Forgot Password?</a></div>
            </form>
          </div>
        </div>
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
</body>
<?php include 'includes/foot.php'; ?>
