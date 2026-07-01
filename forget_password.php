<?php
session_start();
require 'composer/vendor/autoload.php';   // Update this path to the actual location of autoload.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
include 'db.php';
function sendOTP($recipientEmail) {
    $otp = rand(100000, 999999);  // Generate 6-digit OTP
    $_SESSION['otp'] = $otp;     // Store OTP in session for later verification
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

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Check if email exists in the job_seeker table
    $queryJobSeeker = "SELECT email FROM job_seeker WHERE email = '$email'";
    
    $resultJobSeeker = mysql_query($queryJobSeeker, $con);
    // Check if email exists in the employer table
    $queryEmployer = "SELECT email FROM employer WHERE email = '$email'";
    $resultEmployer = mysql_query($queryEmployer, $con);

    if (!$resultJobSeeker && !$resultEmployer) {
        die("<script>alert('Error executing query. Please try again later.');</script>");
    }

    if (mysql_num_rows($resultJobSeeker) > 0) {
        // Email exists in job_seeker table, send OTP
        if (sendOTP($email)) {
            $_SESSION['email'] = $email; // Store email in session
            $_SESSION['role'] = 'job_seeker'; // Store user type as job_seeker
            echo "<script>alert('OTP sent successfully! Please check your email.'); 
                  window.location.href='otp_verify.php';
                  </script>";
        } else {
            echo "<script>alert('Failed to send OTP. Please try again later.');</script>";
        }
    } elseif (mysql_num_rows($resultEmployer) > 0) {
        // Email exists in employer table, send OTP
        if (sendOTP($email)) {
            $_SESSION['email'] = $email; // Store email in session
            $_SESSION['role'] = 'employer'; // Store user type as employer
            echo "<script>alert('OTP sent successfully! Please check your email.'); 
                  window.location.href='otp_verify.php';
                  </script>";
        } else {
            echo "<script>alert('Failed to send OTP. Please try again later.');</script>";
        }
    } else {
        // Email does not exist in either table
        echo "<script>alert('Email address is not registered. Please use a valid email.');</script>";
    }

    mysql_free_result($resultJobSeeker);
    mysql_free_result($resultEmployer);
} else {
    echo "<script>alert('Invalid email address. Please enter a valid one.');</script>";
}
}
    mysql_close($con);
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
        .container{
                padding:70px;
                margin-top:20px;}
        .container h1{font-size:30pt;
                     color:darkblue;} 
                     .col-md-6{padding:30px;} 
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
            <div class="col-md-6  mt-3  m-auto bg-light font-monospace  border border-dark">
            <h1 class=" text-center fs-1 fw-bold my-3">Forgot Password</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label for=""><h4><b>Email Address<b></h4></label>
                        <input type="email"id="email"name="email"placeholder="Enter Your Email Address"class="form-control" required>
                   </div><br>
                   <div class="mb-3">
                    <button class=" w-100 bg-primary fs-4 text-white">Send OTP</button>
                    </div>
</form>
</div>
</div>
</div>
</body>
</html>