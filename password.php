<?php 
session_start();
require 'includes/connect.php';
require 'includes/head.php';

$passwordErr = "";

if (isset($_POST['submit'])) {
  $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($conn, $_POST['new_pass_c']);
  // Grab to token that came from the email link
  $token = $_SESSION['token'];
  if ($new_pass != $new_pass_c) {
    $passwordErr = '<small class="text-danger ml-4">Password does not match.</small>';
  }
  else{
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM tbl_reset WHERE token = '$token' LIMIT 1";
    $results = mysqli_query($conn, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email) {
      $new_pass = md5($new_pass);
      $sql = "UPDATE tbl_user SET password = '$new_pass'";
      $results = mysqli_query($conn, $sql);
      echo '<script>window.location.href="thankyoupass.php"</script>';
    }
  }
}
?>
<?php include 'includes/head.php'; ?>
<body class="bg-light">
  <div class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-2 mt-4">
          <div class="card-body">
            <img style="margin-left: auto; margin-right: auto; width: 50%; margin-bottom: 30px; display: block;" src="assets/logo/logo.png">
            <form class="form-signin" method="post" action="">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="new_pass" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputRepeat" name="new_pass_c" class="form-control" placeholder="Password Repeat" required>
                <label for="inputRepeat">Password Repeat</label>
              </div>
              <button class="btn btn-lg btn-warning text-white btn-block text-uppercase" name="submit" type="submit">Submit</button>
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
        <span>Copyright © EVENTS CREATION Just 4 U Co. Ltd. 2019</span>
      </div>
    </div>
  </footer>
</body>