<?php 
session_start();
require 'includes/connect.php';
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
          <li class="nav-item active">
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
    <header>
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-lg-12">
            <h1 class="mt-4 mb-0 font-weight-normal">About Us</h1>
            <hr>
            <h5 class="mb-5 pt-5 font-weight-normal">JUST 4 U CO LTD are co-owned by Mr. Benny Cruz and Mrs. Aurora Cruz. It is a subsidiary company of Events Creation which is assigned to cater foods for events made by Events Creation. It is located at Room A, 2nd Floor, Block 1, Lot 3, Kabanatuan Road. Natividad Subdivission Phase-3, Baranggay 168, Kabatuhan road Deparo, Novaliches Caloocan City.</h5>
          </div>
        </div>
      </div>
    </header>
  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="sticky-footer">
    <div class="container-fluid mb-3">
      <div class="copyright text-center my-auto"><hr>
        <span>Copyright © EVENTS CREATION Just 4 U Co. Ltd. 2019</span>
      </div>
    </div>
  </footer>
  
  <?php require 'includes/foot.php'; ?>