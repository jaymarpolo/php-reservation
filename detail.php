<?php
require 'includes/control.php';
require 'includes/head.php';
require 'modal.php';

$dateErr = "";

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $fullname = $_POST['fullname'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $event_name = $_POST['event_name'];
  $event_type = $_POST['event_type'];
  $venue = $_POST['venue'];
  $rdate = $_POST['rdate'];
  $rstart = $_POST['rstart'];
  $rend = $_POST['rend'];

  $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  $code = "";
  $limit = 6;
  $i = 0;
  while($i <= $limit)
  {
    $rand = rand(0, 61);
    $code .= $string[$rand];
    $i++;
  }
  $query = mysqli_query($conn, "SELECT * FROM tbl_reserve WHERE rdate = '".$rdate."' AND status = 'Approved'");
  if(mysqli_num_rows($query) > 0){
    $dateErr = '<small class="text-danger">Date is already taken!</small>';
  }
  else{
    $insert = $conn->query("INSERT INTO tbl_reserve (email, code, fullname, phone, address, event_name, event_type, venue, rdate, rstart, rend) VALUES ('$email', '$code', '$fullname', '$phone', '$address', '$event_name', '$event_type', '$venue', '$rdate', '$rstart', '$rend')") or die($conn->error);
    $rid = mysqli_insert_id($conn);
    $_SESSION['email'] = $rid;
    header('location:package.php');
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
          <li class="nav-item active">
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
    <div class="container" style="width: 70%;">
      <div class="py-5 text-center">
        <h2>Information Form</h2>
        <p>Below you need to input your information, each form has a validation state that can be triggered by attempting to submit the form without completing it.</p>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Step 1 of 3</span>
          </h4>
          <form class="needs-validation" method="post">
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
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="fullname" value="<?php echo $firstname . ' ' . $lastname ?>">
                <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                <input type="hidden" name="address" value="<?php echo $address; ?>">
                <div class="col-md-3 mb-3">
                  <label>Fullname</label>
                  <input type="text" class="form-control" value="<?php echo $firstname . ' ' . $lastname ?>" disabled>
                </div>
                <div class="col-md-3 mb-3">
                  <label>Phone</label>
                  <input type="text" class="form-control" value="<?php echo $phone ?>" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Your Address</label>
                  <input type="text" class="form-control" value="<?php echo $address ?>" disabled>
                </div>
                <div class="col-md-3 mb-3">
                  <label>Event Name</label>
                  <input type="text" class="form-control" name="event_name" required>
                  <small>(e.g. Juan Dela Cruz 1st Birthday)</small>
                </div>
                <div class="col-md-3 mb-3">
                  <label>Event Type</label>
                  <input type="text" class="form-control" name="event_type" required>
                  <small>(e.g. Birthday, Wedding, etc.)</small>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Venue Address</label>
                  <input type="text" class="form-control" name="venue" required>
                  <small>Please be advised that we have an <strong>Area Range</strong> *</small>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Date</label>
                  <input type="text" class="form-control" id="rdate" name="rdate" autocomplete="off" required><?php echo $dateErr; ?>
                  <small>For not experiencing any conflict, we recommend to see our <strong>Schedule</strong> section at the top *</small>
                </div>
                <div class="row" id="timeOnlyExample">
                  <div class="col-md-6 mb-3">
                    <label>Time Start</label>
                    <input type="text" class="form-control time start" name="rstart" autocomplete="off" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Time End</label>
                    <input type="text" class="form-control time end" name="rend" autocomplete="off" required>
                  </div>
                </div>
              <?php } ?>
            </div>
            <hr class="mb-2">
            <input type="checkbox" required> I have read and agree to the <a href="#term" data-toggle="modal">Terms and Conditions</a>
            <button class="btn btn-warning text-white float-right" name="submit" type="submit">Proceed to next step</button>
          </form>
        </div>
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

  <div id="term" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Terms and Conditions</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          </div>
          <div class="modal-body font-weight-normal" style="line-height: 1.1em; text-align: justify;">
            <p>Dishes from photos may differ from the actual dishes in food tasting.</p>
            <p>Reservation made by the customer will be on hold if the minimum down payment is paid less than the 50% of the actual price.</p>
            <p>Reservation made by the customer will be voided if the down payment hasn't been paid 2 days after making a reservation.</p>
            <p>Surcharge of Php 5,000 for Cancellation or Change of event date Seven (7) days prior to the original event date.</p>
            <p>Customer has the option of keeping any extra food remaining after the initial cater service is over. The client is responsible for providing own food storage containers. "Just 4 U" Co. Ltd. is no longer responsible for leftovers after the initial 3-hour service nor any consequences due to its later consumption.</p>
            <p>All non-food support items brought in by the caterer such as table napkin, Floral Arrangements, Backdrop Décor, Stypng Materials, plates, glass, utensils, Wax, etc remain the property of "Just 4 U" Co. Ltd. Customer does not have the right of claiming such items.</p>
            <p>Clients have the right to do inventory of the equipments brought in by "Just 4 U" Co. Ltd. While in the premises of the cater venue, customer has the right to search through the caterer’s equipment and waiters’ personal items. clients forfeits this right after the caterer has departed.</p>
            <p>Clients will be charged for loss or damage of the caterer's equipment not due to handling by the food service personnel.</p>
            <p>Only the clients and its Authorized representative will be allowed to discuss the details of the event.</p>
            <p>Final Guest Count, not subject to reduction, is due Seven (7) days prior to your event date(s). If you need to increase your guest count, within Seven (7) days of your event date, we will make every effort to accommodate your request.  Additional fees and charges MAY apply.</p>
            <p>In the occasion that the number of guest exceeds what is expected, "Just 4 U" Co. Ltd. usually makes a 10% allowance from the agreed number of guest to be served which will be charged accordingly to the client (Per Head Rate).</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn text-white btn-primary" data-dismiss="modal" autofocus>Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>