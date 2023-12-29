<?php
require_once 'database.php';
session_start();

if (isset($_POST["verify"])) {
    if (isset($_SESSION['otp'], $_SESSION['mail'])) {
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];
        $password = $_POST['pass'];
        $confirm_password = $_POST['con-pass'];

        if ($otp != $otp_code) {
            echo '<script>alert("Invalid OTP code. Please try again.");</script>';
        } else {
            if ($password === $confirm_password) {
                mysqli_query($db_connect, "UPDATE users SET password='$password' WHERE email='$email'");

                unset($_SESSION['otp']);
                unset($_SESSION['mail']);
                session_destroy();

                echo '<script>
                        window.location.replace("index.php");
                        alert("Your password has been successfully reset");
                      </script>';
            } else {
                echo '<script>alert("Passwords do not match. Please try again.");</script>';
            }
        }
    } else {
        echo '<script>alert("Session variables not set. Please try again.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Account</title>
    <link rel="stylesheet" href="forgot-pass.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="container">
            <a href="#" style="color: black !important; text-decoration: none;">VERIFICATION ACCOUNT</a>
        </div>
    </nav>

    <div class="container">
        <form action="#" method="POST">
            <div>
                <label for="otp">Enter OTP Code</label>
                <input type="text" id="otp" name="otp_code" autofocus required>
            </div>
            <div>
                <label for="psw">Enter Password</label>
                <input type="password" id="psw" name="pass" required>
            </div>
            <div>
                <label for="con-psw">Confirm Password</label>
                <input type="password" id="con-psw" name="con-pass" required>
            </div>

            <div>
                <button type="submit" name="verify">Confirm</button>
            </div>
        </form>
    </div>

</body>

</html>