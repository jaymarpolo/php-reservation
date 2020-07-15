<?php 
session_start();
require 'includes/connect.php';
require 'includes/head.php';
require 'modal.php';

$alert = "";

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $conn->query("INSERT INTO tbl_message (name, subject, message) VALUES ('$name', '$subject', '$message')") or die($conn->error);
  if ($conn == true) {
    $alert = "<div class='alert alert-success mt-2 mb-2'>Your message has been sent successfully.</div>";
  }
  else{
    echo "Error";
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
          <li class="nav-item active">
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
    <header>
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-lg-12">
            <h1 class="mt-4 mb-0 font-weight-normal">Message Your Concern</h1>
            <?php echo $alert; ?>
            <hr>
          </div>
        </div>
      </div>
    </header>

    <section>
      <div class="container">
        <form method="post">
          <div class="row">
            <div class="col-md-6 mb-5">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" autocomplete="off" required autofocus>
              </div>
              <div class="form-group">
                <label>Subject</label>
                <input type="text" class="form-control" name="subject" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Message</label>
                <textarea type="text" class="form-control" name="message" autocomplete="off" required></textarea>
              </div>
              <button class="btn btn-warning text-white" name="submit" type="submit">Send</button>
            </div>
            <div class="col-md-6 mb-5">
              <h2 class="mb-3">Contacts</h2>
              <address>
                <strong>Address:</strong>
                <br>Natividad Subdivission Phase-3, Baranggay 168, Kabatuhan Road Deparo, Novaliches Caloocan City
                <br>
              </address>
              <address>
                <strong>Phone:</strong>
                <br><a href="#">just4u@gmail.com</a> (Email)
                <br>(02) 616-2432 (Landline)
                <br>09778547218 / 09178920650 / 09159038753 (Globe)
                <br>09328781800 / 09224964297 (Sun)
                <br>09476927493 / 09468761044 (Smart)
              </address>
              <address>
                <strong>Bank Acount:</strong>
                <br>123123-23123123 (BDO)
                <br>123123-23123123 (AUB)
                <br>123123-23930123 (PNB)
                <br>
              </address>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<!-- /.container -->
<footer class="sticky-footer">
  <div class="container-fluid mb-3">
    <div class="copyright text-center my-auto"><hr>
      <span>Copyright © EVENTS CREATION Just 4 U Co. Ltd. 2019</span>
    </div>
  </div>
</footer>

<?php require 'includes/foot.php'; ?>