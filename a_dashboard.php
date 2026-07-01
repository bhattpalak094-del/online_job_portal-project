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
            .file1{
                background-color: lightgray;
                width: 400px;
                padding: 20px;
                margin-left: 0%;
                margin-top: 10px;
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
            .header{
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                font-family:'Times New Roman';
                color:black;
                text-shadow: 2px 2px 2px black;
                height: 13%;
                margin-left: 250px;
                border-radius: 7px;
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
    .cards{
                display: flex;
                flex-wrap: wrap;
                gap: 80px;
                margin-left: 300px;   
                margin-top: 10px;
            }
</style>
    </head>
    <?php
 session_start();
if(!$_SESSION['admin']){
    header("location:../login.php");
}
?>
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
        </div>
        <div class="header">
                <h1> Dashboard </h1>
                <a href="logout.php"><button class="logout"><b> Logout </b></button></a>
            </div>
            <br>
        <div class="cards">
        <div class="file1">
            <?php 
                    include "../db.php";
                        $total_com = "SELECT COUNT(DISTINCT cname) AS total_com FROM employer";
                        $result = mysql_query($total_com,$con);
                        $row = mysql_fetch_assoc($result);
                        $total_com = $row['total_com'];

                    echo "<i class='fa-solid fa-building'style='font-size:35px;'></i>
                    <h3><b> Registrated Companies: </b><br><br>
                    <span id='total_com'>  $total_com </span> </h3>";
                ?>
            </div>
            <br><br>

            <div class="file1">
            <?php 
                    include "../db.php";
                        $total_js = "SELECT COUNT(DISTINCT jname) AS total_js FROM job_seeker";
                        $result = mysql_query($total_js,$con);
                        $row = mysql_fetch_assoc($result);
                        $total_js = $row['total_js'];

                    echo "<i class='fa-solid fa-users'style='font-size:35px;'></i>
                    <h3><b> Registrated JobSeekers: </b><br><br>
                    <span id='total_js'>  $total_js </span> </h3>";
                ?>
            </div>
            <br><br>

            <div class="file1">
            <?php
            include "../db.php";
            $total_app = "SELECT COUNT(*) AS total_app FROM applyers";
            $result = mysql_query($total_app,$con);
            $row = mysql_fetch_assoc($result);
            $total_app = $row['total_app'];
        
            echo "<i class='fa-solid fa-user-group'style='font-size:35px;'></i>
            <h3><b> Applicants: </b><br><br>
            <span id='total_app'> $total_app </span> </h3>";
        ?>
        </div>
        <br><br>

        <div class="file1">
        <?php
        include "../db.php";
        $total_jobs = "SELECT COUNT(*) AS total_jobs FROM manage_job";
        $result = mysql_query($total_jobs,$con);
        $row = mysql_fetch_assoc($result);
        $total_jobs = $row['total_jobs'];
    
        echo "<i class='fa-solid fa-clipboard-check' style='font-size:35px;'></i>
        <h3><b> Posted Jobs: </b><br><br>
        <span id='total_jobs'> $total_jobs </span> </h3>";
    ?>
    </div>
</div>
    </body>
</html>
