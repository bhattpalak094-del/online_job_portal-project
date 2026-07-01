<?php
session_start();

require '../composer/vendor/autoload.php';   // Update this path to the actual location of autoload.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../db.php'; // Include database connection

// Check if the form is submitted
if (isset($_POST['email'])) {
    // Get form data
    $cname = $_POST['cnm'];
    $jtitle = $_POST['jb'];
    $jname = $_POST['jnm'];
    $idate = $_POST['date'];
    $itime = $_POST['time'];
    $mode = $_POST['imode'];

    // Use simple mysql_query without prepared statements
    $sql = "SELECT * FROM interview WHERE jname = '$jname' AND cname = '$cname' AND j_title = '$jtitle'";
    $result = mysql_query($sql, $con);  // Use mysql_query (deprecated)

    if ($result && mysql_num_rows($result) > 0) {
        echo "<script src='../jquery.min.js'></script>";
        echo "<script> 
            alert('Email and Interview details have already been sent to this applicant!');
            setTimeout(function(){
                window.location.href = 'interview.php'; // Redirect to applicants page
            }, 500);
        </script>";
    } else {
        // SQL query to insert data into interview table
        $sql = "INSERT INTO `interview`(`cname`, `j_title`, `jname`, `i_date`, `i_time`,`i_mode`) 
                VALUES('$cname', '$jtitle', '$jname', '$idate', '$itime','$mode')";

        // Execute the query to insert interview details
        if (mysql_query($sql, $con)) {
            // After successfully inserting interview details, fetch confirmed applicants and their respective emails
            $sql = "
            SELECT j.email AS job_seeker_email, c.email AS company_email 
            FROM job_seeker j
            JOIN applyers a ON j.jname = a.jname
            JOIN employer c ON a.cname = c.cname
            WHERE a.status = 'confirm' AND a.cname='$cname' AND a.j_title='$jtitle' AND a.jname='$jname'"; // Assuming 'status' is used to track application confirmation

            $result = mysql_query($sql, $con);  // Use mysql_query (deprecated)

            if (mysql_num_rows($result) > 0) {
                while ($row = mysql_fetch_assoc($result)) {
                    $jobSeekerEmail = $row['job_seeker_email'];
                    $companyEmail = $row['company_email'];

                    // Send email after inserting interview details
                    sendEmail($companyEmail, $jobSeekerEmail);
                }
            } else {
                echo "
                <script>
                alert('No confirmed applicants found.');
                window.location.href='view_applyer.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
            alert('Interview Details not Inserted');
            window.location.href='interview.php';
            </script>
            ";
        }
    }

    // Close MySQL connection
    mysql_close($con); // Use mysql_close (deprecated)
}

// Function to send an email
function sendEmail($fromEmail, $toEmail) {
    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'saxipatel2005@gmail.com'; // Your SMTP username
        $mail->Password = 'dvct inmh tohc ooag'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email details
        $mail->setFrom($fromEmail, 'Company');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = "Application Confirmation";
        $mail->Body = "Dear Applicant, <br>Your application has been confirmed. Please check your dashboard for further details.";

        $mail->send();
        echo "
        <script>
        alert('Email is sent to applicant successfully');
        window.location.href='interview.php';
        </script>
        ";

    } catch (Exception $e) {
        echo "
        <script>
        alert('Email could not be sent. Error: {$mail->ErrorInfo}');
        window.location.href='interview.php';
        </script>
        ";
    }
}
?>
