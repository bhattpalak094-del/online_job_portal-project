<?php
session_start();
if(!$_SESSION['user']){
        header("Location:../login.php");
    }
?>
<html>
    <head>
        <title> Job Seeker Dashboard </title>
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
            .header{
                font-family:'Times New Roman';
                color:black;
                text-shadow: 2px 2px 2px black;
            }
            .file1{
                background-color: #fff;
                width: 80%;
                padding: 20px;
                gap: 70px;
                margin-left: 20px auto;
                border-radius: 25px;
                box-shadow: 0 3px 3px 3px gray;
            }
            p{
                color: black;
            }
            .card{
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                background-color: lightgray;
            }
        </style>
    </head>
    <body>
    <div class="sidebar">
                <img src="../profile.png" alt="Profile Picture" style="width: 50px; border-radius: 50%;">
                <span id="n1" name="n1">Welcome, <?php echo $_SESSION['user']; ?></span> <br><br>
                <a href="j_dashboard.php"class='text-white'><i class="fa-solid fa-house-user"></i></a>
                <br> 
                <div class="menu"><a href="j_profile.php"><b>Profile</b></a></div>
                <br>
                <div class="menu"><a href="search.php"><b> Search Job </b></a></div>
                <br>
                <div class="menu"><a href="ajob_list.php"><b> View Interview </b></a></div>
                <br>
        </div>
            <div class="header">
                <h1> Dashboard </h1>
                <a href="logout.php"><button class="logout"><b> Logout </b></button></a>
            </div>
            <div class="content">
                <div class="card">
                    <h3> Welcome to your Panel, <?php echo $_SESSION['user']; ?> </h3>
                </div> <br>
                <?php 
                    include "../db.php";
 /*  Join Query  */ 
$SQL = "SELECT manage_job.*, employer.logo
FROM manage_job
JOIN employer
ON manage_job.cname = employer.cname
ORDER BY manage_job.time DESC";

$result = mysql_query($SQL,$con);
while($row = mysql_fetch_assoc($result)){
    echo "
    <div class='file1'>
        <div class='image'>
            <img src='../company/".$row['logo']."' alt='Company Logo' 
                 style='width:150px;height:150px;'>
        </div>
        <div class='job-card'>
            <div class='job-header'>
                <h3> Job Title : ".$row['j_title']."</h3>
                <h4> Company Name : ".$row['cname']."</h4>
                <p><strong> Total Vacancy : ".$row['total_vacancy']."</strong></p>
                <p><strong> Qualification : ".$row['j_qualification']."</strong></p>
                <p><strong> Experience : ".$row['j_experience']."</strong></p>
                <p><strong> Job Type : ".$row['j_type']."</strong></p>
                <p><strong> Job Location : ".$row['location']."</strong></p>
            </div>
        </div>
    </div>
    <br>";
}
?>
</div>
</body>
</html>