<?php
include 'includes/control.php';
include 'includes/head.php';
include 'modal.php';

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $bank = $_POST['bank'];
  $ref = $_POST['ref'];
  $amount = $_POST['amount'];
  $image = $_FILES['image']['name'];
  $target = "assets/images/payment/" . basename($image);

  $conn->query("INSERT INTO tbl_payment (name, phone, bank, ref, amount, image, status) VALUES ('$name', '$phone', '$bank', '$ref', '$amount', '$image', 'unconfirmed')") or die($conn->error);
  header('location:thankyoupay.php');
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {

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
            echo '<li class="nav-item active"><a class="nav-link" href="transac.php">Transaction</a></li>
            <li class="nav-item dropdown">
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
  <section class="mt-5">
    <div class="container" style="width: 50%; margin-top: 100px;">
      <div class="text-center">
        <img style="margin-left: auto; margin-right: auto; width: 25%; display: block;" src="assets/logo/logo.png">
        <h2 class="mt-3">Payment Form</h2>
        <p>Below you need to input your payment information, each form has a validation state that can be triggered by attempting to submit the form without completing it.</p>
      </div>
      <div class="row">
        <?php
        $sql = "SELECT * FROM tbl_user WHERE email = '".$_SESSION['email']."'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
          $email = $row['email'];
          $firstname = $row['firstname'];
          $lastname = $row['lastname'];
          $phone = $row['phone'];
          $address = $row['address'];
          ?>
          <input type="hidden" name="name" value="<?php echo $firstname . ' ' . $lastname ?>">
          <input type="hidden" name="phone" value="<?php echo $phone; ?>">
          <div class="col-xl-12">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
            </h4>
            <form  method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label>Bank Name</label>
                  <input type="text" class="form-control" name="bank" autocomplete="off" required>
                  <small>(e.g. BDO, AUB, PNB, etc.)</small>
                </div>
                <div class="col-md-12 mb-3">
                  <label>Reference Number</label>
                  <input type="number" class="form-control" name="ref" autocomplete="off" required>
                  <small>Note: Please take your time to double check your account number to avoid repeating the transaction method.</small>
                </div>
                <div class="col-md-12 mb-3">
                  <label>Amount</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">₱</span>
                    </div>
                    <input type="number" class="form-control" name="amount" autocomplete="off" required>
                  </div>
                  <small>Note: Please input a right amount based on your receipt to avoid delaying the process of your transaction.</small>
                </div>
                <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <label>Upload Image Receipt</label>
                    <input type="file" class="form-control-file" name="image">
                  </div>
                  <small>Note: Please send a detailed and readable image so we can identify it quickly.</small>
                </div>
              </div>
              <hr class="mb-4">
              <button class="btn btn-primary float-right" name="submit" type="submit">Send</button>
            </form>
          </div>
        <?php } ?>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="sticky-footer">
      <div class="container-fluid mb-3">
        <div class="copyright text-center my-auto"><hr>
          <span>Copyright © EVENTS CREATION Just 4 U Co. Ltd. 2019</span>
        </div>
      </div>
    </footer>

    <?php include 'includes/foot.php'; ?>