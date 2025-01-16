<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

$pid = $_SESSION['pid'];

$new_prescriptions_query = mysqli_query($con, "SELECT * FROM prestb WHERE pid='$pid' AND isNew=TRUE");
if (mysqli_num_rows($new_prescriptions_query) > 0) {
    echo "true";
    // Mark prescriptions as seen
    mysqli_query($con, "UPDATE prestb SET isNew=FALSE WHERE pid='$pid' AND isNew=TRUE");
} else {
    echo "false";
}
?>