<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

if (isset($_POST['adsub'])) {
    $username = mysqli_real_escape_string($con, $_POST['username1']);
    $password = $_POST['password2'];

    // Fetch the hashed password for the given username
    $query = "SELECT * FROM admintb WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // Use password_verify to validate the password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $username;

            // Redirect to the admin panel
            header("Location:admin-panel1.php");
        } else {
            echo "<script>alert('Invalid Username or Password. Try Again!');
                  window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid Username or Password. Try Again!');
              window.location.href = 'index.php';</script>";
    }
}

if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];
    $query = "UPDATE appointmenttb SET payment = '$status' WHERE contact = '$contact'";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location:updated.php");
    }
}




function display_docs()
{
    global $con;
    $query = "select * from doctb";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        # echo'<option value="" disabled selected>Select Doctor</option>';
        echo '<option value="' . $name . '">' . $name . '</option>';
    }
}

if (isset($_POST['doc_sub'])) {
    $name = $_POST['name'];
    $query = "insert into doctb(name)values('$name')";
    $result = mysqli_query($con, $query);
    if ($result)
        header("Location:adddoc.php");
}
