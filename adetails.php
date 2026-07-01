<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location:../login.php");
    }
include "../db.php";
$user = $_SESSION['user'];
$sql = "SELECT cname, logo FROM employer WHERE username='$user'";
$result = mysql_query($sql,$con);
$row = mysql_fetch_assoc($result);
$cname = $row['cname'];
$logo  = $row['logo'];
?>
<html>
    <head>
        <title> Company Details </title>
        <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
        <style>
            body{
                font-family: 'Times New Roman';
                font-size:14pt;
            }
            .menu a{
                background-color: #fff;
                height: 45px;
                width: 90%;
                margin-left: 11px;
                text-align: center;
                font-family: 'Times New Roman';
                font-size:17pt;
                border-radius: 25px;
                text-decoration: none;
            }
            .menu a:hover{
                background-color: lightgray;
                width: 90%;
            }
            .container{
                width: 70%;
                margin-left: 25%;
                background: whitesmoke;
                padding: 20px;
                box-shadow: 2px 2px 2px 2px gray;
            }
            .job-card{
                border: 3px solid black;
                padding: 20px;
                margin-top: 10px;
            }
            table{
                width: 100%;
            }
            tr{font-size:15pt;}
            td{
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }
            .image{
                margin-right: 40%;
            }
            .job-card button{
                color: white;
                font-weight:bold;
                border: none;
                padding: 9px 22px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            .title{
                font-size: 30px;
                color: white;
                text-align: center;
                margin-bottom: 20px;
                background-color: #15317E;
                height: 13%;
                padding-top: 20px;
                margin-left: 15%;
                margin-right: 10px;
                margin-top: 1%;
            }
            .subtitle{
                text-align: center;
            }
            .subtitle h4{
                color: #15317E;
            }
            #reject{
                margin-left: 5%;
            }
            #shortlisted{
                margin-right: 5%;
            }
        </style>
    </head>
    <body>
        <div class="sidebar">
                <img src="<?php echo $logo; ?>" alt="" style="width: 50px; border-radius: 50%;">
                <span id="n1" name="n1">Hello, <?php echo $_SESSION['user']; ?></span> <br><br>
                <a href="cdashboard.php" class="text-white"><i class="fa-solid fa-house-user"></i></a>
                <br>
                    <div class="menu"><a href="job.php"><b> Manage Job </b></a></div>
                    <br>
                    <div class="menu"><a href="view_applyer.php"><b> View Applyers </b></a></div>
                    <br>
                    <div class="menu"><a href="interview.php"><b> Manage Interview </b></a></div>
                    <br>
                <div class="menu"><a href="logout.php"><b> Logout </b></a></div>
        </div>
        <h1 class="title"> Applyers Details </h1> 
        <div class="container">
            <?php
                include "../db.php";
                if((isset($_GET['name']) && isset($_GET['cname']) && isset($_GET['jtitle']))){
                    $name=mysql_real_escape_string($_GET['name']);
                    $jtitle=mysql_real_escape_string($_GET['jtitle']);
                    $cname=mysql_real_escape_string($_GET['cname']);
        
                $SQL = "SELECT * FROM job_seeker WHERE jname='$name'";
                $result = mysql_query($SQL,$con);
                if(mysql_num_rows($result) > 0){
                    while($row = mysql_fetch_assoc($result)){
                    echo "<div class='job-card'>
                           <table class='table table-bordered'>
                                <tr>
                                    <td>
                                        <img src='../profile.png' alt='' style='width: 50px; height: 50px;'>
                                    </td>
                                    <td> <strong> Applyer Name : </strong></td><td> " .$row['jname']. "</td>
                                </tr>
                                <tr>
                                    <td> <strong> Email : </strong></td><td> " .$row['email']. "</td>
                                    <td> <strong> Contact No : </strong></td><td> " .$row['mobileno']. "</td>
                                
                                    
                                </tr>
                            </table>
                    ";
                    }
                }
                else{
                    echo "<script src='jquery-3.5.1.js'> </script>";
                        echo "<script> alert('Applyer not found');
                        setTimeout(function(){
                            window.location.href = 'adetails.php';
                        },500);
                        </script>";
                }
                $SQL="SELECT * FROM education WHERE jname='$name'";
                $result = mysql_query($SQL,$con);
                if(mysql_num_rows($result) > 0){
                    while($row = mysql_fetch_assoc($result)){
                        echo "
                                
                                <div class='subtitle'><h4><b> EDUCATION DETAILS </b></h4><br>
                                <table class='table table-bordered'>

                                <tr style='text-align:center;'><b> SSC </b></tr>

                            <tr> 
                                <td> <strong> School : </strong></td><td>".$row['s_school']."</td>
                                <td> <strong> Passing Year :  </strong></td><td>".$row['s_year']."</td>
                            </tr>
                            <tr>
                                <td> <strong> Percentage :  </strong></td><td>".$row['s_percent']."</td>
                            </tr>
                            </table>

                            <table class='table table-bordered'>
                            <tr style='text-align:center;'><b> HSC </b></tr>

                            <tr>
                                <td> <strong> School :  </strong></td><td>".$row['h_school']."</td>
                                <td> <strong> Stream :  </strong></td><td>".$row['stream']."</td>
                            </tr>
                            <tr>
                                <td> <strong> Passing Year :  </strong></td><td>".$row['h_year']."</td>
                                <td> <strong> Percentage :  </strong></td><td>".$row['h_percent']."</td>
                            </tr>
                           </table>
                            <table class='table table-bordered'>
                            <tr style='text-align:center;'><b> COLLEGE/UNIVERSITY </b></tr>

                            <tr>
                                <td> <strong> College :  </strong></td><td>".$row['college']."</td>
                                <td> <strong> Qualification :  </strong></td><td>".$row['qualification']."</td>
                            </tr>
                            <tr>
                                <td> <strong> Degree :  </strong></td><td>".$row['degree']."</td>
                                <td> <strong> Passing Year :  </strong></td><td>".$row['c_year']."</td>
                            </tr>
                            <tr>
                                <td> <strong> CGPA :  </strong></td><td>".$row['cgpa']."</td>
                            </tr>
                            </table>";
                    }
                }
                else{
                    echo "<script src='jquery-3.5.1.js'> </script>";
                        echo "<script> alert('Applyer education details not found');
                        setTimeout(function(){
                            window.location.href = 'adetails.php';
                        },500);
                        </script>";
                }
                $sql = "SELECT type FROM job_seeker WHERE jname='$name'";
                $result = mysql_query($sql,$con);
                $row = mysql_fetch_assoc($result);
                $type = $row['type'];
                if($type == "experience")
                {
                    $SQL="SELECT * FROM j_exp WHERE jname='$name'";
                    $result = mysql_query($SQL,$con);
                    if(mysql_num_rows($result) > 0){
                        while($row = mysql_fetch_assoc($result)){
                        echo "
                                
                                 <div class='subtitle'><h4><b> EXPERIENCE DETAILS </b></h4><br>
                                <table class='table table-bordered'>
                            <tr> 
                                <td> <strong> Company Name : </strong></td><td>".$row['com_name']."</td>
                                <td> <strong> Designation :  </strong></td><td>".$row['designation']."</td>
                                </tr>
                            <tr>
                                <td> <strong> CTC :  </strong></td><td>".$row['ctc']."</td>
                                <td> <strong> Joining Date :  </strong></td><td>".$row['j_date']."</td>
                            </tr>
                            <tr>
                                <td> <strong> Leaving Date :  </strong></td><td>".$row['l_date']."</td>
                                <td> <strong> Resume :  </strong></td><td> <a href='".$row['resume']."'><button class='btn btn-primary' type='submit' id='btn' name='btn'> View </button></a> </td>
                            </tr>
                            </table>";
                        }
                    }
                    else{
                        echo "<script src='jquery-3.5.1.js'> </script>";
                            echo "<script> alert('Applyer experience details not found');
                            setTimeout(function(){
                                window.location.href = 'adetails.php';
                            },500);
                            </script>";
                    }
                }
                else{
                    $SQL="SELECT * FROM experience WHERE jname='$name' AND e_type='internship'";
                    $result = mysql_query($SQL,$con);
                    if(mysql_num_rows($result) > 0){
                        while($row = mysql_fetch_assoc($result)){
                                echo"
                                <div class='subtitle'><h4><b> INTERNSHIP DETAILS </b></h4><br>
                                <table class='table table-bordered'>
                            <tr> 
                                <td> <strong> Company Name : </strong></td><td>".$row['company']."</td>
                                <td> <strong> Position :  </strong></td><td>".$row['position']."</td>
                            </tr>
                            <tr>
                                <td> <strong> Duration:  </strong></td><td>".$row['duration']."</td>
                                <td> <strong> Resume :  </strong></td><td> <a href='".$row['resume']."'><button class='btn btn-primary' type='submit' id='btn' name='btn'> View </button></a> </td>
                            </tr>
                            </table>";
                        }
                    }
                    $SQL="SELECT * FROM experience WHERE jname='$name' AND e_type='project'";
                    $result = mysql_query($SQL,$con);
                    if(mysql_num_rows($result) > 0){
                        while($row = mysql_fetch_assoc($result)){
                    echo"<div class='subtitle'><h4><b> PROJECT DETAILS </b></h4><br>
                                <table class='table table-bordered'>
                            <tr>
                                <td> <strong> Project Title:  </strong></td><td>".$row['title']."</td>
                                <td> <strong> Technologies Used:  </strong></td><td>".$row['tech']."</td>
                                <td> <strong> Resume :  </strong></td><td> <a href='".$row['resume']."'><button class='btn btn-primary' type='submit' id='btn' name='btn'> View </button></a> </td>
                            </tr>
                               </table> ";
                }
            }
            }
                echo "<form method='POST' action=''>";
                $SQL="SELECT * FROM applyers WHERE jname='$name' AND j_title='$jtitle' AND cname='$cname'";
                $result = mysql_query($SQL,$con);
                if(mysql_num_rows($result) > 0){
                    while($row = mysql_fetch_assoc($result)){
                        echo"
                    <input type='hidden' name='application_id' value='".$row['a_id']."'>
                    <input type='hidden' name='job_id' value='".$row['job_id']."'>
                    <button class='btn btn-primary' type='submit' id='shortlisted' name='shortlisted'> Selected </button>
                    <button class='btn btn-success' type='submit' id='confirm' name='confirm'> Confirm </button>
                    <button class='btn btn-danger' type='submit' id='reject' name='reject'> Reject </button>
                    </form>
                    </div>";
                    }
                }
                }
                ?>
                <?php
                // shortlisted
                if (isset($_POST['shortlisted'])) {
                    $aid = $_POST['application_id'];
                    $job_id = $_POST['job_id'];
                    $_SESSION['a_id'] = $aid;
                    
                    // Check if the applicant is already shortlisted
                    $sql = "SELECT status FROM applyers WHERE a_id = '$aid'";
                    $result = mysql_query($sql, $con);
                    
                    if ($result) {
                        $row = mysql_fetch_assoc($result);
                        if ($row['status'] == 'shortlisted') {
                             // already shortlisted
                             echo "<script src='jquery-3.5.1.js'></script>";
                             echo "<script> alert('Applicant is already shortlisted!');
                             setTimeout(function(){
                             window.location.href = 'view_applyer.php';
                             }, 500);</script>";
                            } else {
                                
                                // shortlist the applicant
                                $update_application = "UPDATE applyers SET status = 'shortlisted' WHERE a_id = '$aid'";
                                $result = mysql_query($update_application, $con);
                                
                                if ($result) {
                                    
                                    // send shortlisted email
                                    include "shortlisted_email.php";
                                } 
                                else {
                                    echo "<script src='jquery-3.5.1.js'></script>";
                                    echo "<script> alert('Error in shortlisting the applicant!');
                                          setTimeout(function(){
                                              window.location.href = 'view_applyer.php';
                                          }, 500);</script>";
                                }
                            }
                        } 
                        else {
                            echo "<script src='jquery-3.5.1.js'></script>";
                            echo "<script> alert('Error checking applicant status!');
                                  setTimeout(function(){
                                      window.location.href = 'view_applyer.php';
                                  }, 500);</script>";
                        }
                    }
                    ?>

            <?php
                // confirm 
                if (isset($_POST['confirm'])) {
                    $aid = $_POST['application_id'];
                    $job_id = $_POST['job_id'];
                    $_SESSION['a_id'] = $aid;
                
                    // Check if the applicant is already confirmed
                    $sql = "SELECT status FROM applyers WHERE a_id = '$aid'";
                    $result = mysql_query($sql, $con);
                    
                    if ($result) {
                        $row = mysql_fetch_assoc($result);
                        if ($row['status'] == 'confirm') {
                            // If already confirmed, do not update the vacancy count again
                            echo "<script src='jquery-3.5.1.js'></script>";
                            echo "<script> alert('Applicant is already confirmed!');
                                  setTimeout(function(){
                                      window.location.href = 'interview.php'; // Redirect to applicants page
                                  }, 500);</script>";
                        } else {
                            // Confirm the applicant and update the status
                            $update_application = "UPDATE applyers SET status = 'confirm' WHERE a_id = '$aid'";
                            $result = mysql_query($update_application, $con);
                
                            if ($result) {
                                // Update the total vacancy count in the manage_job table
                                $update_vacancy = "UPDATE manage_job SET total_vacancy = total_vacancy - 1 WHERE job_id = '$job_id'";
                                mysql_query($update_vacancy, $con);
                
                                echo "<script src='jquery-3.5.1.js'></script>";
                                echo "<script> alert('Applicant confirmed successfully!');
                                      setTimeout(function(){
                                          window.location.href = 'interview.php'; // Redirect to interview page
                                      }, 500);</script>";
                            } else {
                                echo "<script src='jquery-3.5.1.js'></script>";
                                echo "<script> alert('Error confirming the applicant!');
                                      setTimeout(function(){
                                          window.location.href = 'view_applyer.php'; // Redirect to applicants page
                                      }, 500);</script>";
                            }
                        }
                    } else {
                        echo "<script src='jquery-3.5.1.js'></script>";
                        echo "<script> alert('Error checking applicant status!');
                              setTimeout(function(){
                                  window.location.href = 'view_applyer.php'; // Redirect to applicants page
                              }, 500);</script>";
                    }
                }
                ?>

                <?php
                    // reject

                    if (isset($_POST['reject'])) {
                        $aid = $_POST['application_id'];
                        $job_id = $_POST['job_id'];
                        $_SESSION['a_id'] = $aid;
                    
                        // Check if the applicant is already rejected
                        $sql = "SELECT status FROM applyers WHERE a_id = '$aid'";
                        $result = mysql_query($sql, $con);
                        
                        if ($result) {
                            $row = mysql_fetch_assoc($result);
                            if ($row['status'] == 'reject') {
                                // If already rejected
                                echo "<script src='jquery-3.5.1.js'></script>";
                                echo "<script> alert('Applicant is already rejected!');
                                      setTimeout(function(){
                                          window.location.href = 'view_applyer.php'; // Redirect to applicants page
                                      }, 500);</script>";
                            } else {
                                // reject the applicant and update the status
                                $update_application = "UPDATE applyers SET status = 'reject' WHERE a_id = '$aid'";
                                $result = mysql_query($update_application, $con);
                    
                                if ($result) {
                                    include "reject_email.php";
                                } 
                                else {
                                    echo "<script src='jquery-3.5.1.js'></script>";
                                    echo "<script> alert('Error in rejecting the applicant!');
                                          setTimeout(function(){
                                              window.location.href = 'view_applyer.php'; // Redirect to applicants page
                                          }, 500);</script>";
                                }
                            }
                        } else {
                            echo "<script src='jquery-3.5.1.js'></script>";
                            echo "<script> alert('Error checking applicant status!');
                                  setTimeout(function(){
                                      window.location.href = 'view_applyer.php'; // Redirect to applicants page
                                  }, 500);</script>";
                        }
                    }                    
                ?>
        </div>
    </body>
</html>