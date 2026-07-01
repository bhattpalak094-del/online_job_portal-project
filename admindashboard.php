
<?php
session_start();
if(!$_SESSION['admin']){
    header("location:../login.php");
}
?>
<html>
    <head>
        <title> Admin Dashboard </title>
        <link rel="stylesheet" href="../css/panel.css">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
         <style>
            .menu a{
                background-color: #fff;
                height: 35px;
                width: 80%;
                margin-left: 10px;
                text-align: center;
                font-family: "Georgia";
                border-radius: 25px;
                text-decoration: none;
            }
            .menu a:hover{
                background-color: #DFD3E3;
                width: 80%;
            }
        </style>
    </head>
    <body>
        <div class="sidebar">
                <img src="../profile.png" alt="Profile Picture" style="width: 50px; border-radius: 50%;">
                <span id="n1" name="n1">Hello, <?php echo $_SESSION['admin']; ?></span> <br><br>
                <a href="admindashboard.php" class="text-info"><i class="fa-solid fa-house-user"></i></a>
                <br>
                <div class="menu"><a href="juser.php"><b> Jobseeker</b></a></div>
                    <br>
                    <div class="menu"><a href="cuser.php"><b> Employer </b></a></div>
                    <br>
                    <div class="menu"><a href="news.php"><b>News </b></a></div>
                    <br>
                <div class="menu"><a href="logout.php"><b> Logout </b></a></div>
        </div>
    </body>
</html>