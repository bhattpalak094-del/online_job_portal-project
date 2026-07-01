<?php
session_start();
if(!$_SESSION['user']){
    header("location:../login.php");
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
        <title> Company Dashboard </title>
        <link rel="stylesheet" href="../css/panel.css">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
        <script src="../jquery.min.js"> </script>
        <script>
            $(document).ready(function(){
                $("#b1,#b2").click(function(){
                    $(this).next("#c1,#c2").slideToggle();
                });
            });
        </script>
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
            .file1{
                background-color: lightgray;
                width: 400px;
                padding: 20px;
                margin-left: 0%;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.4);
                font-family: 'Times New Roman';
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }
            .file1 h3{
                color: darkblue;
            }
            .cards{
                display: flex;
                flex-wrap: wrap;
                gap: 80px;
                margin-left: 300px;   
                margin-top: 10px;
            }
    
        </style>
    </head>
    <body>
        <div class="sidebar">
            <img src="<?php echo $logo; ?>" style="width:50px;border-radius:50%;">
            <span id="n1" name="n1">Hello, <?php echo $_SESSION['user']; ?></span> <br><br>
            <a href="cdashboard.php" class="text-white"><i class="fa-solid fa-house-user"></i></a>
            <br>
            <div class="menu"><a href="job.php"><b> Manage Job </b></a></div>
            <br>
            <div class="menu"><a href="view_applyer.php"><b> View Applyers </b></a></div>
            <br>
            <div class="menu"><a href="interview.php"><b> Manage Interview </b></a></div>
            <br>
        </div>
        <div class="header">
            <h1> Dashboard </h1>
            <a href="logout.php"><button class="logout"><b> Logout </b></button></a>
        </div>
        <br>
        <div class="cards">
        <div class="file1">
        <?php 
            $total_job = "SELECT COUNT(DISTINCT j_title) AS total_job FROM manage_job WHERE cname='$cname'";
            $result = mysql_query($total_job,$con);
            $row = mysql_fetch_assoc($result);
            $total_sub = $row['total_job'];

            echo "<i class='fa-solid fa-clipboard-check'style='font-size:35px;'></i>
            <h3><b> Posted Jobs: </b><br><br>
            <span id='total_job'>  $total_sub </span> </h3>";
        ?>
        </div> 
        <br><br>

        <div class="file1">
        <?php 
            $confirm_job = "SELECT COUNT(DISTINCT jname) AS confirm_job FROM applyers WHERE cname='$cname' and status='confirm'";
            $result = mysql_query($confirm_job,$con);
            $row = mysql_fetch_assoc($result);
            $confirm_job = $row['confirm_job'];

            echo "<i class='fa-solid fa-user-check'style='font-size:35px;'></i>
            <h3><b> Confirmed Applicants: </b><br><br>
            <span id='confirm_job'>  $confirm_job </span> </h3>";
        ?>
        </div>
        <br><br>

        <div class="file1">
        <?php 
        $short_job = "SELECT COUNT(DISTINCT jname) AS short_job 
        FROM applyers 
        WHERE cname='$cname' AND status='shortlisted'";
        $result = mysql_query($short_job,$con);
        $row = mysql_fetch_assoc($result);
        $short_job = $row['short_job'];
        
        echo "<i class='fa-solid fa-user-clock'style='font-size:35px;'></i>
        <h3><b> Shortlisted Applicants: </b><br><br>
        <span id='short_job'> $short_job </span> </h3>";
        ?>
        </div>
        <br><br>

        <div class="file1">
        <?php 
        $reject_job = "SELECT COUNT(DISTINCT jname) AS reject_job 
        FROM applyers 
        WHERE cname='$cname' AND status='reject'";
        $result = mysql_query($reject_job,$con);
        $row = mysql_fetch_assoc($result);
        $reject_job = $row['reject_job'];
        
        echo "<i class='fa-solid fa-user-xmark'style='font-size:35px;'></i>
        <h3><b> Rejected Applicants: </b><br><br>
        <span id='reject_job'> $reject_job </span> </h3>";
        ?>
        </div>
        </div>
    </body>
</html>
