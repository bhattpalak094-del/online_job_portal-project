<?php
session_start();
require 'composer/vendor/autoload.php'; // Update this path to the actual location of autoload.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'db.php';
function sendOTP($recipientEmail) {
    $otp = rand(100000, 999999); // Generate 6-digit OTP
    $_SESSION['otp'] = $otp; // Store OTP in session for later verification
    $mail = new PHPMailer(true);

    try {
        // SMTP server configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'saxipatel2005@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'dvct inmh tohc ooag'; // Replace with your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('saxipatel2005@gmail.com', 'Sakshi');
        $mail->addAddress($recipientEmail);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your OTP code is: <b>$otp</b>";
        $mail->AltBody = "Your OTP code is: $otp";

        $mail->send();
        return true; // OTP sent successfully
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false; // Hide detailed error from the user
    }
}

$resendMessage = ''; // JavaScript alert message for resend OTP
if (isset($_GET['resend']) && $_GET['resend'] === 'true') {
    if (isset($_SESSION['email'])) {
        if (sendOTP($_SESSION['email'])) {
            $resendMessage = 'OTP has been resent to your email.';
        } else {
            $resendMessage = 'Failed to resend OTP. Please try again later.';
        }
    } else {
        $resendMessage = 'Session expired. Please start the process again.';
    }
}

// Handle OTP verification
$otpMessage = ''; // JavaScript alert message for OTP validation
if (isset($_POST['otp'])) {
    $otp = $_POST['otp'];
    if ($otp == $_SESSION['otp']) {
        echo "<script>
                alert('OTP Verification Successfully!');
                window.location.href='reset_password.php';
                </script>";
    } else {
        $otpMessage = 'Invalid OTP. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/navigation.css">
    <style>
    body{height:100%;
         place-items:center;}
        .container{padding:70px;}
        .container h1{font-size:30pt;
                     color:darkblue;}  
                     </style>
</head>
<body>
<div class="bg-layer"></div>
<div class="bg-overlay"></div>
<div class="menu-bar">
<ul>
<li><a href="home.php">HOME</a></li>
<li><a href="#">REGISTRATION</a>
<div class="sub-menu-1">
<ul>
<li><a href="Job Seeker/eregistration.php">JobSeeker</a></li>
<li><a href="company/cregistration.php">Employer</a></li>
</ul>
</div>
</li>
<li><a href="login.php">LOGIN</a></li>
<li><a href="admin/n_display.php">LATEST NEWS</a></li>
<li><a href="aboutus.php">ABOUT US</a></li>
</ul>
</div>
<div class="container">
        <div class="row">
            <div class="col-md-6  mt-5  m-auto bg-light font-monospace  border border-dark">
            <h1 class=" text-center fs-1 fw-bold my-3">Verify OTP</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label for=""><h4>Enter OTP</h4></label>
                        <input type="text"id="otp"name="otp"class="form-control">
                   </div>
                   <div class="mb-3">
                    <button class=" w-100 bg-primary fs-4 text-white"id="sbt"name="sbt">Verify OTP</button>
                    </div>
</form>
<p class="text-center">
                Didn't receive the OTP? <a href="?resend=true" class="text-decoration-none">Resend OTP</a>
            </p>
</div>
</div>
</div>
</body>
</html>
