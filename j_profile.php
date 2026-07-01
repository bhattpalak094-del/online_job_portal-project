<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location:../login.php");
    }

    include "../db.php";
?>
<html>
    <head>
        <title>Profile Page</title>
        <link rel="stylesheet" href="../css/profile.css">
        <style>
            label{
               font-weight: bold; 
            }
            .btn{
                text-decoration: none;
                background-color: #483D8B;
                color: white;
                padding: 8px 20px;
                border-radius: 5px;
                cursor: pointer;
            }
            .profile_container h3{
                color: darkblue;
                font-size:20pt;
                font-weight:bold;
            }
            .profile_container h5{
                color: darkgreen;
                font-size:18pt;
                font-weight:bold;
            }
        </style>
</head>
<body>
    <?php include 'sidenav.php'; ?>
    <section class="profile_container">
        <h2>  Profile </h2>
        <div class="profile-card">
        <img src="../profile.png" alt="Profile Picture" class="pic">
        <h3> <?php echo $_SESSION['user']; ?></h3>
        <br><br>
        <div class="action-btn">
            <a href="education.php"><button> ADD EDUCATION </button></a>
            <a href="experience.php"><button> ADD EXPERIENCE </button></a>
        </div>
        </div>
        <div class="profile-section">
            <div class="section">
                <h3> Summary About Me </h3><br>
                <?php
                    $uname = $_SESSION['user'];
                    $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                    $result = mysql_query($sql,$con);
                    $row = mysql_fetch_assoc($result);
                    $jname = $row['jname'];
                    $sql = "SELECT * FROM job_seeker WHERE jname='$jname'";
                    $result=mysql_query($sql,$con);
                    $row=mysql_fetch_array($result);
                ?>
                <label> Full Name : </label> <?php echo $row['jname']; ?><br><br>
                <label> Email : </label> <?php echo $row['email']; ?><br><br>
                <label> Contact No : </label> <?php echo $row['mobileno']; ?><br><br>
            </div>

            <div class="section">
                <h3> Education Details </h3><br>
                <?php
                    $uname = $_SESSION['user'];
                    $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                    $result = mysql_query($sql,$con);
                    $row = mysql_fetch_assoc($result);
                    $jname = $row['jname'];
                    $sql = "SELECT * FROM education WHERE jname='$jname'";
                    $result=mysql_query($sql,$con);
                    $row=mysql_fetch_array($result);
                ?>
                <h5> SSC </h5><br>
                <label> School Name : </label> <?php echo $row['s_school']; ?><br><br>
                <label> Year Of Passing : </label> <?php echo $row['s_year']; ?><br><br>
                <label> Percentage : </label> <?php echo $row['s_percent']; ?><br><br>
                <h5> HSC </h5><br>
                <label> School Name : </label> <?php echo $row['h_school']; ?><br><br>
                <label> Stream : </label> <?php echo $row['stream']; ?><br><br>
                <label> Year Of Passing : </label> <?php echo $row['h_year']; ?><br><br>
                <label> Percentage : </label> <?php echo $row['h_percent']; ?><br><br>
                <h5> Collage </h5><br>
                <label> Collage Name : </label> <?php echo $row['college']; ?><br><br>
                <label> Qualification : </label> <?php echo $row['qualification']; ?><br><br>
                <label> Degree : </label> <?php echo $row['degree']; ?><br><br>
                <label> Year of Passing : </label> <?php echo $row['c_year']; ?><br><br>
                <label> cgpa : </label> <?php echo $row['cgpa']; ?><br><br>
            </div>

            <div class="section">
                <?php
                $uname = $_SESSION['user'];
                $sql = "SELECT type FROM job_seeker WHERE username='$uname'";
                $result = mysql_query($sql,$con);
                $row = mysql_fetch_assoc($result);
                $type = $row['type'];
                if($type == "fresher"){
                ?>
                <h3> Fresher's Details </h3><br>
                <?php
                    $uname = $_SESSION['user'];
                    $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                    $result = mysql_query($sql,$con);
                    $row = mysql_fetch_assoc($result);
                    $jname = $row['jname'];
                    $sql = "SELECT company,position,duration FROM experience WHERE jname='$jname'";
                    $result=mysql_query($sql,$con);
                    $row=mysql_fetch_array($result);
                ?>
                <h5> Internship Details </h5><br>
                <label> Company Name : </label> <?php echo ($row['company'] != "") ? $row['company'] : "-"; ?>
                <br><br>
                <label> Position : </label> <?php echo ($row['position'] != "") ? $row['position'] : "-"; ?>
                <br><br>
                <label> Duration : </label> <?php echo ($row['duration'] != "") ? $row['duration'] : "-"; ?>
                <br><br>
                <?php
                    $uname = $_SESSION['user'];
                    $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                    $result = mysql_query($sql,$con);
                    $row = mysql_fetch_assoc($result);
                    $jname = $row['jname'];
                    $sql = "SELECT title,tech,resume FROM experience WHERE jname='$jname'";
                    $result=mysql_query($sql,$con);
                    $row=mysql_fetch_array($result);
                ?>
                <h5> Project Details </h5><br>
                <label> Project title : </label> <?php echo ($row['title'] != "") ? $row['title'] : "-"; ?>
                <br><br>
                <label> Technology used : </label> <?php echo ($row['tech'] != "") ? $row['tech'] : "-"; ?>
                <br><br>
                <label> Resume : </label> <a href="<?php echo $row['resume']; ?>">
                <button class="btn"> View </button></a><br><br>
                <?php 
                } else{ ?>
                <h3> Work Experience </h3><br>
                <?php
                    $uname = $_SESSION['user'];
                    $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                    $result = mysql_query($sql,$con);
                    $row = mysql_fetch_assoc($result);
                    $jname = $row['jname'];
                    $sql = "SELECT * FROM j_exp WHERE jname='$jname'";
                    $result=mysql_query($sql,$con);
                    $row=mysql_fetch_array($result);
                ?>
                <label> Company Name : </label> <?php echo $row['com_name']; ?><br><br>
                <label> Designation : </label> <?php echo $row['designation']; ?><br><br>
                <label> CTC : </label> <?php echo $row['ctc']; ?><br><br>
                <label> From Date : </label> <?php echo $row['j_date']; ?><br><br>
                <label> To Date : </label> <?php echo $row['l_date']; ?><br><br>

                <label> Resume : </label> <a href="<?php echo $row['resume']; ?>"><button class="btn"> View </button></a><br><br>
                <?php } ?>
            </div>
        </div>
    </section>
</body>
</html>
