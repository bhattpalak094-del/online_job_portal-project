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
$logo_des  = $row['logo'];
?>

<html>
    <head>
        <title> Company Dashboard </title>
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
            .file1{
                background-color: #fff;
                width: 80%;
                padding: 20px;
                margin-left: 20%;
                margin-top: 8%;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            }
        </style>
    </head>
    <body>
        <div class="sidebar">
                <img src="<?php echo $logo_des; ?>" style="width: 50px; border-radius: 50%;">
                <span id="n1" name="n1">Hello, <?php echo $_SESSION['user']; ?></span> <br><br>
                <a href="cdashboard.php" class="text-light"><i class="fa-solid fa-house-user"></i></a>
                <br>
                    <div class="menu"><a href="job.php"><b> Manage Job </b></a></div>
                    <br>
                    <div class="menu"><a href="view_applyer.php"><b> View Applyers </b></a></div>
                    <br>
                    <div class="menu"><a href="interview.php"><b> Manage Interview </b></a></div>
                    <br>
                <div class="menu"><a href="logout.php"><b> Logout </b></a></div>
        </div>
    </body>
</html>