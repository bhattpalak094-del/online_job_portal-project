<?php
require '../composer/vendor/autoload.php';   // Update this path to the actual location of autoload.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
include '../db.php';
            if(isset($_SESSION['a_id'])) {
                $aid = $_SESSION['a_id']; // Get the application ID from session
            
                // Retrieve job_title and jname from applyers table using a_id
                $sql = "SELECT cname,j_title, jname FROM applyers WHERE a_id = '$aid'";
                $result = mysql_query($sql, $con);
                if (mysql_num_rows($result) > 0) {
                    $row = mysql_fetch_assoc($result);
                    $cname = $row['cname'];
                    $j_title = $row['j_title'];  // Job Title
                    $jname = $row['jname'];      // Job Seeker Name
                } else {
                    // Handle case where no records are found (e.g., invalid a_id)
                    echo "<script>alert('No application found for this ID.'); window.location.href='view_applyer.php';</script>";
                }
            } else {
                echo "<script>alert('No application ID found.'); window.location.href='view_applyer.php';</script>";
            }

  // Fetch shortlisted applicants and their respective company emails
$sql = "
SELECT j.email AS job_seeker_email, c.email AS company_email 
FROM job_seeker j
JOIN applyers a ON j.jname = a.jname
JOIN employer c ON a.cname = c.cname
WHERE a.cname='$cname' AND a.j_title='$j_title' AND a.jname='$jname' AND a.status = 'shortlisted'"; // Assuming 'status' is used to track application shortlisted

$result = mysql_query($sql,$con);

if (mysql_num_rows($result) > 0) {
while ($row = mysql_fetch_assoc($result)) {
    $jobSeekerEmail = $row['job_seeker_email'];
    $companyEmail = $row['company_email'];

    sendEmail($companyEmail, $jobSeekerEmail);
}
} else {
echo "
<script>
alert('No selected applyers found.');
window.location.href='view_applyer.php';
</script>
";
}

mysql_close($con);

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
    $mail->Subject = "Application Shortlisted";
    $mail->Body = "Dear Applicant, <br>You have been Shortlisted.";

    $mail->send();
    echo "
    <script>
    alert('Email Sent To:$toEmail  From:$fromEmail');
    window.location.href='view_applyer.php';
    </script>
    ";
} catch (Exception $e) {
    echo "
    alert('Email could not be sent. Error: {$mail->ErrorInfo}');
    window.location.href='view_applyer.php';
    </script>
    ";
}
}
?>
