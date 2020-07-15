<?php 
require 'includes/control.php';
require 'includes/head.php';
require 'modal.php';

$error = $alert = "";

if (isset($_POST['submit'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $passwordrepeat = $_POST['passwordrepeat'];

  if ($password != $passwordrepeat) {
    $error = '<small class="text-danger ml-4">Password does not match.</small>';
  }
  else{
    $sql = "SELECT * FROM tbl_user";
    $resultEmail = mysqli_query($conn, $sql);
    $password = md5($password);
    $sql = "UPDATE tbl_user SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', address = '$address', password = '$password'";
    $results = mysqli_query($conn, $sql);
    if ($results == true) {
      $alert = "<div class='alert alert-success mt-5 text-center'>Your profile has been changed succesfully.</div>";
    }
    else{

    }
  }
}
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
  <?php 
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM tbl_user WHERE email = '$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $phone = $row['phone'];
      $address = $row['address'];
      ?>
      <div class="container" style="margin-top: 50px;">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <?php echo $alert; ?>
            <div class="my-2 mt-4">
              <div class="card-body">
                <h1 style="line-height: 0.8em;" class="card-title text-center font-weight-light mt-2">Edit Profile</h1>
                <form class="form-signin mt-5" method="post">
                  <div class="form-label-group">
                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="<?php echo $email ?>" disabled>
                    <label for="inputEmail">Email</label>
                  </div> 
                  <div class="form-label-group">
                    <input type="text" id="inputFirst" name="firstname" class="form-control" placeholder="Firstname" value="<?php echo $firstname ?>">
                    <label for="inputFirst">Firstname</label>
                  </div> 
                  <div class="form-label-group">
                    <input type="text" id="inputLast" name="lastname" class="form-control" placeholder="Lastname" value="<?php echo $lastname ?>">
                    <label for="inputLast">Lastname</label>
                  </div> 
                  <div class="form-label-group">
                    <input type="text" id="inputPhone" name="phone" class="form-control" placeholder="Phone" value="<?php echo $phone ?>">
                    <label for="inputPhone">Phone</label>
                  </div> 
                  <div class="form-label-group">
                    <input type="text" id="inputAddress" name="address" class="form-control" placeholder="Address" value="<?php echo $address ?>">
                    <label for="inputAddress">Address</label>
                  </div>
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
                    <label for="inputPassword">Password</label>
                  </div>
                  <div class="form-label-group">
                    <input type="password" id="inputRepeat" name="passwordrepeat" class="form-control" placeholder="Password Repeat">
                    <label for="inputRepeat">Password Repeat</label>
                  </div>
                  <button class="btn btn-lg btn-warning text-white btn-block text-uppercase" name="submit" type="submit">Submit</button>
                  <hr>
                  <p class="text-center p-0 m-0"><?php echo $error; ?></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }} ?>
    <?php include 'includes/foot.php'; ?>