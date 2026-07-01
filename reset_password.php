<?php
session_start();
if (isset($_POST['reset_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (strlen($newPassword) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.');</script>";
    } elseif ($newPassword !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {
             include 'db.php';

        // Prepare the query to update the password
        $email = mysql_real_escape_string($_SESSION['email']);
        // First query: Check if the email exists in either job_seeker or employer
        $queryCheckUser = "SELECT 1 FROM user u 
                           JOIN job_seeker js ON u.username = js.username
                           WHERE js.email = '$email'
                           UNION
                           SELECT 1 FROM user u
                           JOIN employer e ON u.username = e.username
                           WHERE e.email = '$email'";

        $result = mysql_query($queryCheckUser, $con);
        if (mysql_num_rows($result) > 0) {

            // Check if the email is associated with a job_seeker or employer
            $queryCheckUserType = "SELECT 'job_seeker' AS user_type FROM job_seeker WHERE email = '$email'
                                   UNION
                                   SELECT 'employer' AS user_type FROM employer WHERE email = '$email'";

            $userTypeResult = mysql_query($queryCheckUserType, $con);
            $userType = mysql_fetch_assoc($userTypeResult)['user_type'];

            if ($userType === 'job_seeker') {
                // Update password for job_seeker
                $queryUpdatePassword = "UPDATE user u 
                                        JOIN job_seeker js ON u.username = js.username
                                        SET u.password = '$newPassword' 
                                        WHERE js.email = '$email'";
            } else {
                // Update password for employer
                $queryUpdatePassword = "UPDATE user u
                                        JOIN employer e ON u.username = e.username
                                        SET u.password = '$newPassword'
                                        WHERE e.email = '$email'";
            }

            if (mysql_query($queryUpdatePassword, $con)) {
                echo "<script>
                alert('Password reset successfully!');
                window.location.href='login.php';
                </script>";
                session_destroy(); // Destroy session after success
            } else {
                echo "<script>alert('Error updating password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('No user found with this email.');</script>";
        }

        mysql_close($con); 
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
            <h1 class=" text-center fs-1 fw-bold my-3">Reset Password</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label for=""><h4>New Password</h4></label>
                        <input type="password"id="new_password"name="new_password"placeholder="Enter New Password"class="form-control">
                   </div>
                   <div class="mb-3">
                        <label for=""><h4>Confirm Password</h4></label>
                        <input type="password"id="confirm_password"name="confirm_password"placeholder="Enter Confirm Password"class="form-control">
                   </div>
                   <div class="mb-3">
                    <button type="submit" id="reset_password" name="reset_password" class=" w-100 bg-primary fs-4 text-white">Reset Password</button>
                    </div>
</form>
</div>
</div>
</div>
</body>
</html>
