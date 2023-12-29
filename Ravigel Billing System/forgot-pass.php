<?php

session_start();

require_once 'database.php';



if (isset($_POST["recover"])) {
    $email = $_POST["email"];

    $sql = mysqli_query($db_connect, "SELECT * FROM users WHERE email='$email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) <= 0) {
?>
        <script>
            alert("<?php echo "Invalid, email does not exist! " ?>");
        </script>
        <?php
    } else if ($fetch["status"] == 0) {
        echo '<script>alert("Account not verified yet. Please verify first!"); window.location.replace("verification.php");</script>';
    } else {

        $otp = rand(100000,999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['mail'] = $email;
        require "phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';
    
        $mail->Username='floresshannyn11@gmail.com';
        $mail->Password='eyvz srqq lxpu dydx';

        $mail->setFrom('floresshannyn11@gmail.com', 'OTP Recovery');
        $mail->addAddress($_POST["email"]);
    
        $mail->isHTML(true);
        $mail->Subject="Verification OTP";
        $mail->Body="<p>Dear user, </p> <h3>Your verification OTP code is $otp <br></h3>";

        if(!$mail->send()){
            ?>
                <script>
                    alert("<?php echo "Invalid Email "?>");
                </script>
            <?php
        }else{
            ?>
            <script>
                alert("<?php echo "To recover you account, check the OTP sent to " . $email ?>");
                window.location.replace('verification.php');
            </script>
            <?php
        }

    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgot-pass.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: black !important; text-decoration: none;">PASSWORD RECOVERY</a>
        </div>
    </nav>

    <div class="container">
        <form action="#" method="POST" name="recover_psw">
            <div class="form-group row">
                <label for="email_address" style="color: #ff4500 !important; text-decoration: none; font-size: 14px; margin-top: 10px; display: inline-block;">Email Address</label>
                <input type="email" id="email_address" class="form-control" name="email" required autofocus>
            </div>

            <div class="form-group row">
                <button type="submit" name="recover">Recover</button>
                <a href="index.php" style="color: #ff4500 !important; text-decoration: none; font-size: 14px; margin-top: 10px; display: inline-block;">Cancel</a>

            </div>
        </form>
    </div>
</body>

</html>