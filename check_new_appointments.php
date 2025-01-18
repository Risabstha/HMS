
<!DOCTYPE html>
<html>
<head>
    <style>
        .notification {
            visibility: hidden;
            min-width: 300px;
            margin-left: -150px;
            background-color: #4CAF50; /* Green */
            color: white;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .notification.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;} 
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;} 
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>
</head>
<body>
    <div id="notification" class="notification">
        You have a new prescription from your doctor.
    </div>
    <audio id="notificationSound" src="sounds/notification.mp3" preload="auto"></audio>
    <script>
        function showNotification() {
            var notification = document.getElementById("notification");
            var sound = document.getElementById("notificationSound");
            notification.className = "notification show";
            sound.play();
            setTimeout(function(){ notification.className = notification.className.replace("show", ""); }, 3000);
        }

        function checkForNewPrescriptions() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "check_new_prescriptions.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.newAppointments) {
                        showNotification();
                    }
                }
            };
            xhr.send();
        }

        setInterval(checkForNewPrescriptions, 5000); // Check every 5 seconds
    </script>
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

$dname = $_SESSION['dname'];

$new_appointments_query = mysqli_query($con, "SELECT * FROM appointmenttb WHERE doctor='$dname' AND isNew=TRUE");
if (mysqli_num_rows($new_appointments_query) > 0) {
    echo "true";
    // Mark appointments as seen
    mysqli_query($con, "UPDATE appointmenttb SET isNew=FALSE WHERE doctor='$dname' AND isNew=TRUE");
} else {
    echo "false";
}
?>
</body>
</html>
