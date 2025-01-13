<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="style2.css">


    
  </head>
  <style type="text/css">
    #inputbtn:hover{cursor:pointer;}
    .card{
    background: #f8f9fa;
    border-top-left-radius: 7% 7%;
    border-bottom-left-radius: 7% 7%;
    border-top-right-radius: 7% 7%;
    border-bottom-right-radius: 7% 7%;
}

  </style>
  <body style="background: -webkit-linear-gradient(left, #A1BE95, #F98866); background-size: cover;">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" >
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="index.php" style="margin-top: 10px;margin-left:-65px;font-family: 'IBM Plex Sans', sans-serif;"><h4><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp Advanced Patient Care Solution</h4></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" style="margin-right: 40px;">
            <a class="nav-link js-scroll-trigger" href="index.php" style="color: white;font-family: 'IBM Plex Sans', sans-serif;"><h6>HOME</h6></a>
          </li>
  
          <li class="nav-item" style="margin-right: 40px;">
            <a class="nav-link js-scroll-trigger" href="services.html" style="color: white;font-family: 'IBM Plex Sans', sans-serif;"><h6>ABOUT US</h6></a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="contact.html" style="color: white;font-family: 'IBM Plex Sans', sans-serif;"><h6>CONTACT</h6></a>
          </li>
        </ul>
      </div>
    </div>
  </nav> 



    <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;">
      <div class="row">

        

         <div class="col-md-7" style="padding-left: 180px; ">
                 <div style="-webkit-animation: mover 2s infinite alternate;
    animation: mover 1s infinite alternate; margin-top: 16%; right: 10%">
          <img style="width:200px; height: 200px;" src="assets/images/ACPS.png" alt="ACPS logo"/>
      </div>

      <div style="color: white;">
            <h4 style="font-family: 'IBM Plex Sans', sans-serif;"> We are here for you!</h4>
          </div>

         </div>

         <div class="col-md-4" style="margin-top: 5%;right: 8%; ">
          <div class="card" style="font-family: 'IBM Plex Sans', sans-serif; background:-webkit-linear-gradient(left,rgb(160, 180, 152),rgb(241, 137, 105));">
            <div class="card-body" >
              <center>
                <i class="fa fa-hospital-o fa-3x" aria-hidden="true" style="color:#0062cc; border: none; "></i>
                <br>
              <h3 style="margin-top: 10%; color:#262626">Patient Login</h3><br>
              <form class="form-group" method="POST" action="func.php">
                <div class="row" style="margin-top: 10%">
                  <div class="col-md-4" style="color:#262626"><label>Email-ID: </label></div>
                  <div class="col-md-8 email" ><input type="text" style="border-top-left-radius: 5% 40%;
                                                                      border-bottom-left-radius: 5% 40%;
                                                                      border-top-right-radius: 5% 40%;
                                                                      border-bottom-right-radius: 5% 40%; "
                        name="email" class="form-control" placeholder="enter email ID" required/>
                  </div><br><br>
                  <div class="col-md-4" style="margin-top: 8%; color:#262626"><label>Password: </label></div>
                  <div class="col-md-8 pw" style="margin-top: 8%"><input type="password" style="border-top-left-radius: 5% 40%;
                                                                      border-bottom-left-radius: 5% 40%;
                                                                      border-top-right-radius: 5% 40%;
                                                                      border-bottom-right-radius: 5% 40%; "
                             class="form-control" name="password2" placeholder="enter password" required/></div><br><br><br>
                </div>
                <div class="row">
                 <div class="col-md-4"  style="padding-left: 160px;margin-top: 10%">
                    <center><input type="submit" style="border-top-left-radius: 27% 40%;
                                                        border-bottom-left-radius: 27% 40%;
                                                        border-top-right-radius: 27% 40%;
                                                        border-bottom-right-radius: 27% 40%; "
                        id="inputbtn" name="patsub" value="Login" class="btn btn-primary"></center></div>           
                 <!--  <div class="col-md-8" style="margin-top: 10%">
                    <a href="index.php" class="btn btn-primary">Back</a></div> -->
                </div>
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