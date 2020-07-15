<?php
require 'includes/control.php';
require 'includes/head.php';
require 'modal.php';
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
    <style>.invoice-box table{width:100%;line-height:inherit;text-align:left}.invoice-box table td{padding:5px;vertical-align:top}.invoice-box table tr td:nth-child(2){text-align:right}.invoice-box table tr.top table td{padding-bottom:20px}.invoice-box table tr.top table td.title{font-size:45px;line-height:45px;color:#333}.invoice-box table tr.information table td{padding-bottom:40px}.invoice-box table tr.heading td{background:#eee;border-bottom:1px solid #ddd;font-weight:700}.invoice-box table tr.details td{padding-bottom:20px}.invoice-box table tr.item td{border-bottom:1px solid #eee}.invoice-box table tr.item.last td{border-bottom:none}.invoice-box table tr.total td:nth-child(2){border-top:2px solid #eee;font-weight:700}@media only screen and (max-width:600px){.invoice-box table tr.top table td{width:100%;display:block;text-align:center}.invoice-box table tr.information table td{width:100%;display:block;text-align:center}}.rtl{direction:rtl;font-family:Tahoma,'Helvetica Neue',Helvetica,Helvetica,Arial,sans-serif}.rtl table{text-align:right}.rtl table tr td:nth-child(2){text-align:left}</style>
    <div class="container" style="width: 50%;">
      <div class="invoice-box">
        <br>
        <?php 
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM tbl_reserve WHERE email = '".$_SESSION['email']."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $rid = $row['rid'];
            $code = $row['code'];
            $fullname = $row['fullname'];
            $phone = $row['phone'];
            $address = $row['address'];
            $event_name = $row['event_name'];
            $event_type = $row['event_type'];
            $venue = $row['venue'];
            $invite = $row['invite'];
            $rdate = $row['rdate'];
            $rstart = $row['rstart'];
            $rend = $row['rend'];
            $custom = $row['custom'];
            $package = $row['package'];
            $price = $row['price'];
            $balance = $row['balance'];
            $payable = $row['payable'];
            $status = $row['status'];
            $datecreated = $row['datecreated'];
            if($package == 'CUSTOM'){
              $custominput = ': '.$custom;
            }else{
              $custominput = '';
            }
            if($balance == $payable){
              $display = "Unpaid";
            }
            elseif($balance == '0.00'){
              $display = "Paid";
            }else{
              $display = "Partial";
            }
            ?>
            <table cellpadding="0" cellspacing="0"> 
              <tr class="top">
                <td colspan="2">
                  <tr>
                    <td>
                      <h2 class="font-weight-normal">Reservation Details</h2>
                      <h5 class="font-weight-normal">Status: <?php echo $status; ?></h5>
                    </td>
                    <td>
                      Invoice #<?php echo $rid; ?><br>
                      <?php echo date("F d, Y",strtotime($datecreated)); ?><br>
                      <?php echo date("h:i A",strtotime($datecreated)); ?>
                    </td>
                  </tr>
                </td>
              </tr>

              <tr class="heading">
                <td>
                  Personal Information
                </td>
                <td>
                  Value
                </td>
              </tr>
              <tr class="details">
                  <td>
                    NAME *<br>
                    PHONE *<br>
                    ADDRESS *
                  </td>
                  <td>
                    <?php echo $fullname; ?><br>
                    <?php echo $phone; ?><br>
                    <?php echo $address; ?><br>
                  </td>
              </tr>
              <tr class="heading">
                <td>
                  Event Details
                </td>

                <td>
                  Value
                </td>
              </tr>

              <tr class="details">
                <td>
                  PAYMENT STATUS *<br>
                  EVENT NAME *<br>
                  EVENT TYPE *<br>
                  VENUE ADDRESS *<br>
                  INVITES *<br>
                  DATE *<br>
                  TIME START *<br>
                  TIME END *<br>
                </td>

                <td>
                  <?php echo $display; ?><br>
                  <?php echo $event_name; ?><br>
                  <?php echo $event_type; ?><br>
                  <?php echo $venue; ?><br>
                  <?php echo $invite; ?><br>
                  <?php echo date("M. d, Y",strtotime($rdate)); ?><br>
                  <?php echo date("h:i A",strtotime($rstart)); ?><br>
                  <?php echo date("h:i A",strtotime($rend)); ?><br>
                </td>
              </tr>


              <tr class="heading">
                <td>
                  Item
                </td>

                <td>
                  Value
                </td>
              </tr>

              <tr class="item">
                <td>
                  <?php echo $package; ?><?php echo $custominput; ?>
                </td>

                <td>
                  ₱<?php echo $price; ?>
                </td>
              </tr>

              <tr class="item last">
                <td>
                  PACKAGE * INVITES
                </td>

                <td>
                  ₱<?php echo $payable; ?>
                </td>
              </tr>
              <tr class="total">
                <td>
                </td>

                <td>
                  Total: ₱<?php echo $payable; ?>
                </td>
              </tr>
            </table>
            <a style="display: block;" href="payment.php" class="btn btn-primary mt-3">Click here and proceed to payment</a><br>
          <?php }} ?>
        </div>
      </div>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" autofocus>Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>