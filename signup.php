<?php 
session_start();
require 'includes/connect.php';
require 'includes/head.php';

$emailErr = "";
$passwordErr = "";

if (isset($_POST['submit'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordrepeat = $_POST['passwordrepeat'];

  $sql = "SELECT * FROM tbl_user WHERE email = '$email'";
  $resultEmail = mysqli_query($conn, $sql);

  if (mysqli_num_rows($resultEmail) > 0) {
    $emailErr = '<small class="text-danger ml-4">Email is already taken.</small>';
  }
  elseif ($password != $passwordrepeat) {
    $passwordErr = '<small class="text-danger ml-4">Password does not match.</small>';
  }
  else{
    $mysqli = new mysqli('localhost', 'u704970076_ers', 'tarroza', 'u704970076_ers');
    $email = $mysqli->real_escape_string($email);
    $password = $mysqli->real_escape_string($password);
    $passwordrepeat = $mysqli->real_escape_string($passwordrepeat);

    $vkey = md5(time().$email);

    $password = md5($password);

    $insert = $mysqli->query("INSERT INTO tbl_user (firstname, lastname, phone, address, email, password, vkey) VALUES ('$firstname', '$lastname', '$phone', '$address', '$email', '$password', '$vkey')");

    if ($insert) {
      ini_set('display_errors', 1);
      error_reporting( E_ALL );
      $to = $email;
      $subject = "JUST 4 U Email Verification";
      $message = "<a href='localhost/ers/verify.php?vkey=$vkey'>Register Account</a>";
      $headers = "From: just4u@gmail.com \r\n";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      mail($to, $subject, $message, $headers);
      header('location:thankyoureg.php');
    }
    else{
      echo $mysqli->error;
    }
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
      <div class="collapse navbar-collapse text-center" id="navbarResponsive">
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
            <a href="signup.php" class="btn btn-outline-dark my-2 my-sm-0 active">Register</a>
            <a href="signin.php" class="btn btn-outline-dark my-2 my-sm-0 ml-1">Log In</a>
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
                <input type="text" id="inputFirst" name="firstname" class="form-control" placeholder="Firstname" required autofocus>
                <label for="inputFirst">Firstname</label>
              </div> 
              <div class="form-label-group">
                <input type="text" id="inputLast" name="lastname" class="form-control" placeholder="Lastname" required>
                <label for="inputLast">Lastname</label>
              </div> 
              <div class="form-label-group">
                <input type="text" id="inputPhone" name="phone" class="form-control" placeholder="Phone" required>
                <label for="inputPhone">Phone: <span class="text-muted">[Ex. 09123456789]</span></label>
              </div>
              <div class="form-label-group">
                <input type="text" id="inputAddress" name="address" class="form-control" placeholder="Address" required>
                <label for="inputAddress">Address</label>
              </div> 
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required>
                <label for="inputEmail">Email</label><?php echo $emailErr; ?>
              </div> 
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputRepeat" name="passwordrepeat" class="form-control" placeholder="Password Repeat" required>
                <label for="inputRepeat">Password Repeat</label>
              </div>
              <button class="btn btn-lg btn-warning text-white btn-block text-uppercase" name="submit" type="submit">Register</button>
              <hr class="p-0 mb-0">
              <p class="text-center p-0 m-0"><?php echo $passwordErr; ?></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="sticky-footer">
    <div class="container-fluid mb-3">
      <div class="copyright text-center my-auto"><hr>
        <span>Copyright © Just 4 U Co. Ltd. 2019</span>
      </div>
    </div>
  </footer>
  <?php include 'includes/foot.php'; ?>