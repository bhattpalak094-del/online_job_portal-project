<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location:../login.php");
    }
    include "../db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Job</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="panel.css">
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
            text-align: center;
            width: 70%;
            background-color: #007bff;
            margin-left: 25%;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .container h2{
            font-size: 24px;
            color: #fff;
            margin-bottom: 20px;
        }
        .search-form{
            display: flex;
            gap: 20px; 
            justify-content: center;
            align-items:center;
        }
        #cname{
            margin-left:3%;
        }
        .search-form input[type="text"],select{
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
        }
        #view{
            margin-top:2%;

        }
        .search-form button,#list{
            background-color: #0041C2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
        .search-form button:hover,#list:hover{
            background-color: #0056b3;
        }
        .job-card{
                border: 3px solid black;
                padding: 20px;
                margin-top: 10px;
                margin-left: 20%;
            }
            table{
                width: 70%;
                background-color: #F8F6F0;
                border: 2px solid #ddd;
            }
            td{
                padding: 7px;
                border-bottom: 1px solid #ddd;
                font-size: 17px;
            }
        #image{
            margin-right: 20px;
            display: flex;
        }
    </style>
</head>
<body>
    <div class="sidebar">
                <img src="../profile.png" alt="Profile Picture" style="width: 50px; border-radius: 50%;">
                <span id="n1" name="n1">Welcome, <?php echo $_SESSION['user']; ?></span><br><br>
                <a href="j_dashboard.php"class='text-white'><i class="fa-solid fa-house-user"></i></a>
                <br>
                <div class="menu"><a href="j_profile.php"><b>Profile</b></a></div>
                <br>
                <div class="menu"><a href="search.php"><b> Search Job </b></a></div>
                <br>
                <div class="menu"><a href="ajob_list.php"><b> View Interview </b></a></div>
                <br>
                <div class="menu"><a href="logout.php"><b>Logout</b></a></div>
        </div>
    <br><br>
    <div class="container">
        <h2> SEARCH  JOB </h2> <br>
        <form method="POST"  class="search-form">
        <select name="job">
            <option value="">Select Job Title</option>
                <?php
                        $SQL = "SELECT DISTINCT j_title FROM manage_job";
                        $result = mysql_query($SQL,$con);
                        while($row=mysql_fetch_array($result)){
                            echo "<option value='". $row['j_title'] ."'>". $row['j_title'] ." </option>";
                        }
                    ?>
            </select>
            <select name="company">
                <option value="">Select Company</option>
                <?php
                        $SQL = "SELECT DISTINCT cname FROM manage_job";
                        $result = mysql_query($SQL,$con);
                        while($row=mysql_fetch_array($result)){
                            echo "<option value='". $row['cname'] ."'>". $row['cname'] ." </option>";
                        }
                    ?>
            </select>
            <select name="location">
            <option value="">Select Job Location</option>
                <?php
                        $SQL = "SELECT DISTINCT location FROM manage_job";
                        $result = mysql_query($SQL,$con);
                        while($row=mysql_fetch_array($result)){
                            echo "<option value='". $row['location'] ."'>". $row['location'] ." </option>";
                        }
                    ?>
            </select>
            <br><br>
            <button type="submit" id="search" name="search">Search</button>
            <!--<a href="ajob_list.php"><button type="button" id="list" name="list"> Applied Job List </button></a>-->
        </form>
        
    </div>
    <br><br><br>
    <?php
        if(isset($_POST['search'])){
            $job = $_POST['job'];
            $cname = $_POST['company'];
            $jlocation = $_POST['location'];
            $SQL = "SELECT manage_job.*, employer.logo
            FROM manage_job JOIN employer ON manage_job.cname = employer.cname 
            WHERE manage_job.j_title='$job' OR manage_job.cname='$cname' OR manage_job.location='$jlocation'";

            $result = mysql_query($SQL,$con);
            if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){
            echo "<div class='job-card'>
                    <table class='table table-bordered'>
                        <tr>
                            <td>
                                <img src='../company/".$row['logo']."' alt='Company Logo' 
                                 style='width:100px;height:100px;'>
                            </td>
                            <td> <strong> Company Name : </strong></td><td> " .$row['cname']. "</td>
                        </tr>
                        <tr>
                            <td> <strong> Job Title : </strong></td><td>" .$row['j_title']. "</td>
                            <td> <strong> Total Vacancy :  </strong></td><td>" .$row['total_vacancy'] ." </td> 
                        </tr>
                        <tr>
                            <td> <strong> Qualification : </strong></td><td>" .$row['j_qualification'] ." </td> 
                            <td> <strong> Experience : </strong></td><td>" .$row['j_experience'] ." </td>
                        </tr>
                        <tr>
                            <td> <strong> Job Type : </strong></td><td>" .$row['j_type'] ." </td> 
                            <td> <strong> Job Location : </strong></td><td>" .$row['location'] ." </td>
                        </tr>
                        </table>
                        <center>
                         <form method='POST' action='apply.php'> 
                                <input type='hidden' name='jtitle' id='jtitle' value='".$row['j_title']."'>
                                <input type='hidden' name='cname' id='cname' value='".$row['cname']."'>
                                <button type='submit' id='apply' name='apply' class='bg-success fs-4 fw-bold my-10 text-white'> Apply </button> 
                                </form>
                                </center>
                </div>
                <br>
            ";
            }
            }
            else{
                echo "<script src='../jquery.min.js'> </script>";
                echo "<script> alert('Vacancy is not available');
                setTimeout(function(){
                    window.location.href = 'search.php';
                },500);
                </script>";
            }
        }
        ?>
</body>
</html>