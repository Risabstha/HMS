<?php
include("header.php");

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
$email = "";
$errors = array();





$check_email = "SELECT * FROM doctb WHERE email = '$email'";
//if user click continue button in forgot password form
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']); // Sanitize input
    $check_email_query = "SELECT * FROM doctb WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($run_sql) > 0) {
        // Email exists in the database
        $code = rand(999999, 111111); // Generate a random OTP
        $insert_code_query = "UPDATE doctb SET code = $code WHERE email = '$email'";
        $run_query = mysqli_query($con, $insert_code_query);
        if ($run_query) {
            // PHPMailer setup
            $mail = new PHPMailer(true);

            try {
                // PHPMailer configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'superior18281809@gmail.com';
                $mail->Password = 'cpnh vzxg umck lxvj'; // Use the App Password here
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('noreply@gmail.com', 'Advanced Patient Care Solution');
                $mail->addAddress($email);

                //Optional: Set "Reply-To" to the same "noreply" email to make sure recipients know they can't reply
                $mail->addReplyTo('noreply@gmail.com', 'No Reply');

                // Content
                $mail->isHTML(true);
                $mail->Subject = "Password Reset Code";
                $mail->Body = "Your password reset code is $code";

                $mail->send();
                // Success message
                $info = "We've sent a password reset OTP to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: docResetCode.php');
                exit();
            } catch (Exception $e) {
                // Error handling
                $errors['otp-error'] = "Failed while sending code! Error: {$mail->ErrorInfo}";
            }
        } else {
            $errors['db-error'] = "Something went wrong while updating the OTP!";
        }
    } else {
        // Email does not exist
        $errors['email'] = "This email address does not exist!";
    }
}


?>

<html>

<head>
    <title>HMS</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style>
        .form-control {
            border-radius: 0.75rem;
        }
    </style>

    <script>
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('cpassword').value) {
                document.getElementById('message').style.color = '#5dd05d';
                document.getElementById('message').innerHTML = 'Matched';
            } else {
                document.getElementById('message').style.color = '#f55252';
                document.getElementById('message').innerHTML = 'Not Matching';
            }
        }

        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8 || key == 32);
        };

        function checklen() {
            var pass1 = document.getElementById("password");
            if (pass1.value.length < 6) {
                alert("Password must be at least 6 characters long. Try again!");
                return false;
            }
        }
    </script>

</head>

<!------ Include the above in your HEAD tag ---------->

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">

            <a class="navbar-brand js-scroll-trigger" href="#" style="margin-top: 10px;margin-left:-65px;font-family: 'IBM Plex Sans', sans-serif;">
                <h4>&nbsp Advanced Patient Care Solution</h4>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" style="margin-right: 40px;">
                        <a class="nav-link js-scroll-trigger" href="index.php" style="font-family: 'IBM Plex Sans', sans-serif;">
                            <h6 class="focus">HOME</h6>
                        </a>
                    </li>

                    <li class="nav-item" style="margin-right: 40px;">
                        <a class="nav-link js-scroll-trigger" href="services.html" style="font-family: 'IBM Plex Sans', sans-serif;">
                            <h6 class="focus">ABOUT US</h6>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="contact.html" style="font-family: 'IBM Plex Sans', sans-serif;">
                            <h6 class="focus">CONTACT</h6>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container register" style="font-family: 'IBM Plex Sans', sans-serif;">
        <div class="row">
            <div class="col-md-3 register-left" style="margin-top: 11%; margin-left: 5%">
                <img style="width:200px; height: 200px;" src="assets/images/apcs7.png" alt="ACPS logo" />


            </div>

            <div class="col-md-6 register-right" style="margin-top:10%; margin-left:15%; ">



                <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3 class="register-heading">Forget Password</h3>
                    <form method="post" action="docForgetPassword.php">


                        <div class="row register-form">

                            <?php if (count($errors) > 0): ?>
                                <div class="alert alert-danger text-center" style="margin-left:10%; margin-top: 4%; margin-right:10%; width:80%;">
                                    <?php foreach ($errors as $error): ?>
                                        <p><?php echo $error; ?></p>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" class="form-control"
                                    style="margin-left:10%; margin-top:6%; margin-right:10%; width:80%;"        
                                    placeholder="Enter your email.." name="email" required value="<?php echo $email ?>" />

                                </div>

                            </div>
                                <input type="submit" class="btnRegister" style="margin-top: 4%; margin-left:25%;" name="check-email" value="submit" />
                            
                        </div>
                    </form>
                </div>



            </div>

        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

</html>