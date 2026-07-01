<?php
session_start();
include "../db.php"; // Include the database connection

// Check if the form has been submitted
if (isset($_POST['apply'])) {
    // Fetch username from session
    $uname = $_SESSION['user'];

    // Query to fetch jname of the user from the job_seeker table
    $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
    $result = mysql_query($sql, $con);

    // Check if the query was successful
    if ($result) {
        $row = mysql_fetch_assoc($result);
        
        if ($row) {
            $jname = $row['jname'];
            $jtitle = $_POST['jtitle'];
            $cname = $_POST['cname'];

            // Query to fetch job details including vacancies
            $jobQuery = "SELECT job_id, total_vacancy FROM manage_job WHERE j_title = '$jtitle' AND cname = '$cname'";
            $result = mysql_query($jobQuery, $con);
            $row = mysql_fetch_assoc($result);
            
            if ($row) {
                $job_id = $row['job_id'];
                $vacancies = $row['total_vacancy'];

                // Check if there are any vacancies available
                if ($vacancies == 0) {
                    // If no vacancies are available, show a message and do not apply
                    echo "<script src='../jquery.min.js'></script>";
                    echo "<script> alert('No vacancies available for this job.');
                    setTimeout(function(){
                        window.location.href = 'search.php';
                    },500);
                    </script>";
                } else {
                    // Check if the user has already applied for this job
                    $checkQuery = "SELECT * FROM applyers WHERE jname='$jname' AND j_title='$jtitle' AND cname='$cname'";
                    $checkResult = mysql_query($checkQuery, $con);

                    if (mysql_num_rows($checkResult) > 0) {
                        // If the user has already applied, show a message
                        echo "<script src='../jquery.min.js'></script>";
                        echo "<script> alert('You have already applied for this job.');
                        setTimeout(function(){
                            window.location.href = 'search.php';
                        },500);
                        </script>";
                    } else {
                        // If the user has not applied, proceed to insert the application
                        $SQL = "INSERT INTO applyers(job_id,j_title, cname, jname) VALUES('$job_id','$jtitle', '$cname', '$jname')";

                        // Check if the insertion was successful
                        if (mysql_query($SQL, $con)) {
                            echo "<script src='../jquery.min.js'></script>";
                            echo "<script> alert('Applied Successfully');
                            setTimeout(function(){
                                window.location.href = 'search.php';
                            },500);
                            </script>";
                        } else {
                            // Debugging: Show error message if the query failed
                            echo "<script src='../jquery.min.js'></script>";
                            echo "<script> alert('Error in application insertion: " . mysql_error($con) . "');
                            setTimeout(function(){
                                window.location.href = 'search.php';
                            },500);
                            </script>";
                        }
                    }
                }
            } else {
                echo "<script> alert('Job not found');
                setTimeout(function(){
                    window.location.href = 'search.php';
                },500);
                </script>";
            }
        } else {
            echo "<script> alert('User not found');
            setTimeout(function(){
                window.location.href = 'search.php';
            },500);
            </script>";
        }
    } else {
        echo "<script> alert('Error in fetching user data: " . mysql_error($con) . "');
        setTimeout(function(){
            window.location.href = 'search.php';
        },500);
        </script>";
    }
}
?>
