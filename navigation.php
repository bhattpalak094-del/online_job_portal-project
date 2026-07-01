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
        <link rel="stylesheet"href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
        <script src="../jquery.min.js"></script>
        <script>
        $(document).ready(function () {
    $(".submenu-toggle").click(function (e) {
        e.preventDefault();
        $(this).next(".submenu").slideToggle();
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
  .sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 10px;
}

.sidebar ul li a {
    color:darkblue;
    background-color: #fff;
    height: 45px;
    width: 90%;
    margin-left: 10px;
    text-align: center;
    font-family: 'Times New Roman';
    border-radius: 25px;
    text-decoration: none;
}

.sidebar ul li a:hover {
    background-color: lightgray;
    width: 90%;
    text-decoration: none;
}

/* Hide submenu by default */
.submenu {
    display: none;
    list-style: none;
    padding-left: 11px;
}
.submenu-toggle {
    cursor: pointer;
    background-color: #fff;
    height: 45px;
    width: 90%;
    margin-left: 11px;
    text-align: center;
    font-family: 'Times New Roman';
    border-radius: 25px;
    padding: 10px 15px;
}
#i1{
    margin-left:10%;}
</style>
    </head>
    <body>
        <div class="sidebar">
                <img src="../profile.png" alt="Profile Picture" style="width: 50px; border-radius: 50%;">
                <span id="n1" name="n1">Welcome, <?php echo $_SESSION['admin']; ?></span> <br>
                <a href="a_dashboard.php"class='text-white'><i class="fa-solid fa-house-user"></i></a>
                <br>
                 <!-- Submenu -->
                 <div class="menu">
                <a href="" class="submenu-toggle"><b> Jobseeker</b><i class="fa-solid fa-caret-down" id="i1"></i></a>
                <ul class="submenu">
                    <li><a href="juser.php">Manage</a></li>
                    <li><a href="applied_job.php">Applied</a></li>
                 </ul>
                </div>
                <br>
            <div class="menu">
                <a href="" class="submenu-toggle"><b> Employer</b><i class="fa-solid fa-caret-down" id="i1"></i></a>
                <ul class="submenu">
                    <li><a href="cuser.php">Manage</a></li>
                    <li><a href="posted_job.php">Posted Job</a></li>
                </ul>
            </div>
            <br>
                    <div class="menu">
                <a href="" class="submenu-toggle"><b>Reports</b><i class="fa-solid fa-caret-down" id="i1"></i></a>
                <ul class="submenu">
                    <li><a href="approve_reject.php">Registration_Status</a></li>
                    <li><a href="employer.php">Employer_Activity</a></li>
                    <li><a href="applicant.php">Applicants_Activity</a></li>
                </ul>
               </div>
                    <br>
                    <div class="menu"><a href="news.php"><b>News</b></a></div>
                    <br>
                    <div class="menu"><a href="backup.php"><b>Backup</b></a></div>
                    <br>
                <div class="menu"><a href="logout.php"><b>Logout</b></a></div>
        </div>
    </body>
</html>