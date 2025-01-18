<?php
include("header.php");

session_start();
$con = mysqli_connect('localhost', 'root', '', 'myhmsdb');
$email = "";
// $name = "";
$errors = array();


ob_start(); // Start output buffering

if (isset($_POST['change-password'])) {
  $_SESSION['info'] = "";
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
  if ($password !== $cpassword) {
    $errors['password'] = "Confirm password not matched!";
  } else {
    $code = 0;
    $email = $_SESSION['email']; //getting this email using session

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $update_pass = "UPDATE patreg SET code = $code, password = '$hashed_password' WHERE email = '$email'";
    $run_query = mysqli_query($con, $update_pass);
    if ($run_query) {
      header('Location: passwordChanged.php');
    } else {
      $errors['db-error'] = "Failed to change your password!";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type="text/css" href="style2.css">



</head>
<style type="text/css">
  #inputbtn:hover {
    cursor: pointer;
  }

  .card {
    background: #f8f9fa;
    border-top-left-radius: 7% 7%;
    border-bottom-left-radius: 7% 7%;
    border-top-right-radius: 7% 7%;
    border-bottom-right-radius: 7% 7%;
  }
</style>

<body style="background: -webkit-linear-gradient(left,#522258,#D95F59); background-size: cover;">
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="index.php" style="margin-top: 10px;margin-left:-65px;font-family: 'IBM Plex Sans', sans-serif;">
        <h4>&nbsp Advanced Patient Care Solution</h4>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" style="margin-right: 40px;">
            <a class="nav-link js-scroll-trigger" href="index.php" style="color: white;font-family: 'IBM Plex Sans', sans-serif;">
              <h6 class="focus">HOME</h6>
            </a>
          </li>

          <li class="nav-item" style="margin-right: 40px;">
            <a class="nav-link js-scroll-trigger" href="services.html" style="color: white;font-family: 'IBM Plex Sans', sans-serif;">
              <h6 class="focus">ABOUT US</h6>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="contact.html" style="color: white;font-family: 'IBM Plex Sans', sans-serif;">
              <h6 class="focus">CONTACT</h6>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



  <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;">
    <div class="row">



      <div class="col-md-7" style="padding-left: 180px; ">
        <div style="-webkit-animation: mover 2s infinite alternate;
    animation: mover 1s infinite alternate; width: 30%;padding-left: 0px;margin-top: 150px;margin-left: 45px;margin-bottom:15px">
          <img style="width:200px; height: 200px;" src="assets/images/apcs8.png" alt="ACPS logo" />
        </div>

        <div style="color: white;">
          <h4 style="font-family: 'IBM Plex Sans', sans-serif;">Caring for You, Anytime, Anywhere.</h4>
        </div>

      </div>

      <div class="col-md-4" style="margin-top: 5%;right: 8%; ">
        <div class="card" style="font-family: 'IBM Plex Sans', sans-serif; background: lightgrey;">
          <div class="card-body">
            <center>
              <i class="fa fa-hospital-o fa-3x" aria-hidden="true" style="color:#0062cc; border: none; "></i>
              <br>
              <h3 style="margin-top: 10%; color:#522258">New Password</h3><br>
              <form class="form-group" method="POST" action="newPassword.php">
                <div class="row" style="margin-top: 10%">
                  <?php
                  if (isset($_SESSION['info'])) {
                  ?>
                    <div class="alert alert-success text-center"
                      style="margin-left:10%; margin-top: -9%; margin-right:10%; width:80%;">
                      <?php echo $_SESSION['info']; ?>
                    </div>
                  <?php
                  }
                  ?>
                  <?php
                  if (count($errors) > 0) {
                  ?>
                    <div class="alert alert-danger text-center"
                      style="margin-left:10%; margin-top: -9%; margin-right:10%; width:80%;">
                      <?php
                      foreach ($errors as $showerror) {
                        echo $showerror;
                      }
                      ?>
                    </div>
                  <?php
                  }
                  ?>
                  <div class="col-md-8 email"><input type="password" style="border-top-left-radius: 5% 40%;
                                                                      border-bottom-left-radius: 5% 40%;
                                                                      border-top-right-radius: 5% 40%;
                                                                     border-bottom-right-radius: 5% 40%; 
                                                                     margin-left:30%       "
                      name="password" class="form-control" placeholder="Create new password" required />
                  </div><br><br>

                  <div class="col-md-8 pw" style="margin-top: 2%"><input type="password" style="border-top-left-radius: 5% 40%;
                                                                      border-bottom-left-radius: 5% 40%;
                                                                      border-top-right-radius: 5% 40%;
                                                                      border-bottom-right-radius: 5% 40%; 
                                                                     margin-left:30%       "
                      class="form-control" name="cpassword" placeholder="Confirm password" required /></div><br><br><br>
                </div>

                <div class="col-md-4" style="margin-left: -90%;margin-top:5%; margin-bottom:10%;">
                  <center>
                    <input type="submit" style="border-top-left-radius: 30% 120%;
                                                        border-bottom-left-radius: 30% 120%;
                                                       border-top-right-radius: 30% 120%;
                                                        border-bottom-right-radius: 30% 120%; 
                                                        margin-left: 155%; min-width:130%;"
                      id="inputbtn" name="change-password" value="Change" class="btnRegister">
                  </center>
                </div>
                <!--  <div class="col-md-8" style="margin-top: 10%">
                    <a href="index.php" class="btn btn-primary">Back</a></div> -->

              </form>
            </center>
          </div>
        </div>
      </div>


    </div>
  </div>





  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>