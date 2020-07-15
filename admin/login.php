<?php
session_start();
require 'includes/connect.php';
require 'includes/head.php';

if(isset($_SESSION['username'])){
  header("location:dashboard.php");
}

$error = "";

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $error = '<small class="text-danger ml-4">Incorrect password or username</small>';
    } else {
        $username = clean($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $error = '<small class="text-danger ml-4">Incorrect password or username</small>';
    } else {
        $password = clean($_POST["password"]);
    }
}

if(isset($_POST['submit'])){
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['password'] == $password){
                $_SESSION['username'] = $row['username'];
                header("location:dashboard.php");
            } else {
                $error = '<small class="text-danger ml-4">Incorrect password or username</small>';
            }
        }
    } else {
        $error = '<small class="text-danger ml-4">Incorrect password or username</small>';
    }
}
?>
<body>
  <div class="container" style="margin-top: 35px;">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5 mt-5">
          <div class="card-body">
            <img style="margin-left: auto; margin-right: auto; width: 50%; display: block;" src="../assets/logo/logo.png">
            <h1 class="card-title text-center mt-3" style="font-size: 30px;">Welcome Admin</h1>
            <form class="form-signin" method="post">
              <div class="form-label-group">
                <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" autofocus>
                <label for="inputUsername">Username</label>
              </div>
              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                <label for="inputPassword">Password</label>
              </div>
              <button class="btn btn-lg btn-warning text-white btn-block text-uppercase" name="submit" type="submit">Log in</button>
              <hr class="p-0 mb-0">
              <p class="text-center p-0 m-0"><?php echo $error; ?></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php require 'includes/foot.php'; ?>