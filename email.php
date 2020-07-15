<?php 
session_start();
require 'includes/connect.php';
require 'includes/head.php';
require 'modal.php';

$emailErr = "";

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT email FROM tbl_user WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) <= 0) {
    $emailErr = '<small class="text-danger ml-4">Sorry, no user exists on our system with that email.</small>';
  }
  else{
    $mysqli = new mysqli('localhost', 'u704970076_ers', 'tarroza', 'u704970076_ers');
    // generate a unique random token of length 100
    $token = bin2hex(random_bytes(50));
    // store token in the password-reset database table against the user's email
    $insert = $mysqli->query("INSERT INTO tbl_reset (email, token) VALUES ('$email', '$token')");
    $token = mysqli_insert_id($conn);
    $_SESSION['token'] = $token;

    // Send email to user with the token in a link they can click on
    if ($insert) {
      require_once "vendor/autoload.php";
      $mail = new PHPMailer\PHPMailer\PHPMailer(); // create a new object
      $mail->IsSMTP(); // enable SMTP
      $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; // or 587
      $mail->IsHTML(true);
      $mail->Username = "jaymarpolo123@gmail.com";
      $mail->Password = "jaymarjaymar";
      $mail->SetFrom("just4u@gmail.com");
      $mail->Subject = "JUST 4 U Password Reset";
      $mail->Body = "Hi there, click on this <a href=\"http://localhost/ers/password.php?token=" . $token . "\">link</a> to reset your password on our site";
      $mail->AddAddress($email);

      if (!$mail->send()) {
        echo "Mailer Error: ". $mail->ErrorInfo;
      }
      else{
        echo '<script>window.location.href="thankyoureg.php"</script>';
      }
    }
  }
}
?>
<body class="bg-light">
  <nav style="background: #FCAD00;" class="navbar navbar-expand-lg navbar-light fixed-top">
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



  <div class="container" style="margin-top: 100px;">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <h1 class="text-center font-weight-light p-0 m-0">Password Reset</h1>
        <div class="card card-signin my-5 mt-5">
          <div class="card-body">
            <img style="margin-left: auto; margin-right: auto; width: 50%; margin-bottom: 30px; display: block;" src="assets/logo/logo.png">
            <form class="form-signin" method="post">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
                <label for="inputEmail">Email</label><?php echo $emailErr; ?>
              </div> 
              <button class="btn btn-lg btn-warning text-white btn-block text-uppercase" name="submit" type="submit">Submit</button>
              <hr class="p-0 mb-0">
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