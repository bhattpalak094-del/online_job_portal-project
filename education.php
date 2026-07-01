<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location:../login.php");
    }
    include "../db.php";
?>
<html>
    <head>
        <title>Education</title>
        <link rel="stylesheet" href="panel.css">
        <link rel="stylesheet"href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
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
                background: #f5f5f5;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                margin-top: 30px;
            }
            .title{
                font-size: 24px;
                color: white;
                text-align: center;
                margin-bottom: 20px;
                background-color: #15317E;
                height: 10%;
                padding-top: 20px;
            }
            h4{font-size: 20pt;
               font-weight:600;
               padding-bottom: 20px;
               margin-right:70%;
               color:black;
               text-shadow: 2px 2px 2px black;
               font-family:'Times New Roman';}
            form{
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
            }
            label{
                font-weight: bold;
            }
            input,select{
                width: 90%;
                padding: 8px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .form-group{
                width: 48%
            }
            button{
                width: 50%;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin: 10px auto;
                display: block;
                background:#2F539B;
                color:white;
            }
            button:hover{
                background-color: #0056b3;
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
                <div class="menu"><a href="logout.php"><b>Logout</b></a></div>
        </div>
        <div class="container">
            <h2 class="title">EDUCATION DETAILS</h2>
                 <h4>SSC</h4>
            <form method="POST" action="">
                <div class="form-group">
                    <label> School</label>
                    <input type="text" id="sschool" name="sschool" placeholder="Enter School Name" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> Year Of Passing </label>
                    <input type="text" id="syear" name="syear" placeholder="Enter year of passing" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> Percentage </label>
                    <input type="text" id="spercent" name="spercent" placeholder="Enter Percentage" autocomplete="off" required>
                </div>
                
                                         <!--HSC -->
                <h4>HSC</h4>
                <div class="form-group">
                    <label> School</label>
                    <input type="text" id="hschool" name="hschool" placeholder="Enter School Name" autocomplete="off" required>
                </div>
                <div class="form-group">
                <label>Stream</label>
                <select name="stream"id="stream" required>
                        <option value="science">Science</option>
                        <option value="commerce">Commerce</option>
                        <option value="arts">Arts</option>
                   </select>
                </div>
                <div class="form-group">
                    <label> Year Of Passing </label>
                    <input type="text" id="hyear" name="hyear" placeholder="Enter year of passing" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> Percentage </label>
                    <input type="text" id="hpercentage" name="hpercentage" placeholder="Enter Percentage" autocomplete="off" required>
                </div>
                                     <!--College-->
               <h4>COLLEGE/UNIVERSITY</h4>
                <div class="form-group">
                    <label>College</label>
                    <input type="text" id="college" name="college" placeholder="Enter Collage Name" autocomplete="off" required>
                </div>
                <div class="form-group">
                <label>Qualification</label>
                <select name="qua"id="qua" required>
                        <option value="">--Select Last Qualification--</option>
                        <option value="graduation">Graduation</option>
                        <option value="post graduation">Post Graduation</option>
                   </select>
                </div>
                <div class="form-group">
                <label>Degree Name</label>
                <select name="degree"id="degree" required>
                        <option value="">--Select Degree--</option>
                        <option value="bca">BCA</option>
                        <option value="mca">MCA</option>
                        <option value="btech">B.TECH</option>
                        <option value="mtech">M.TECH</option>
                        <option value="be">B.E</option>
                        <option value="me">M.E</option>
                        <option value="msc">MSC(IT)</option>
                        <option value="other">OTHER</option>
                   </select>
                </div>
                <div class="form-group">
                    <label> Year Of Passing </label>
                    <input type="text" id="cyear" name="cyear" placeholder="Enter year of passing" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> CGPA</label>
                    <input type="text" id="cgpa" name="cgpa" placeholder="Enter CGPA" autocomplete="off" required>
                </div>
                <br><br>
                <button type="submit" id="btn" name="btn"> Submit </button>
            </form>
            </div>
        <?php
           if(isset($_POST['btn'])){
                $uname = $_SESSION['user'];
                $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                $result = mysql_query($sql,$con);
                $row = mysql_fetch_assoc($result);
                $jname = $row['jname'];
                // Check if education details already exists
                $check = "SELECT * FROM education WHERE jname='$jname'";
                $checkResult = mysql_query($check,$con);

                if(mysql_num_rows($checkResult) > 0){
                 // Education details already submitted
                 echo "<script>
                 alert('Education details already submitted');
                 window.location.href='j_profile.php';
                 </script>";
                 exit();
                }
                $school = $_POST['sschool'];
                $syear = $_POST['syear'];
                $spercent = $_POST['spercent'];
                $hschool = $_POST['hschool'];
                $stream = $_POST['stream'];
                $hyear = $_POST['hyear'];
                $hpercent = $_POST['hpercentage'];
                $college = $_POST['college'];
                $qualification = $_POST['qua'];
                $degree = $_POST['degree'];
                $cyear =$_POST['cyear'];
                $cgpa = $_POST['cgpa'];

                $SQL = "INSERT INTO `education`(`jname`, `s_school`, `s_year`, `s_percent`, `h_school`, `stream`, `h_year`, `h_percent`, `college`, `qualification`, `degree`, `c_year`, `cgpa`) VALUES('$jname','$school','$syear','$spercent','$hschool','$stream','$hyear','$hpercent','$college','$qualification','$degree','$cyear','$cgpa')";
                if(mysql_query($SQL,$con))
                {
                    echo "<script src='jquery-3.5.1.js'> </script>";
                    echo "<script> alert('Education Details submitted');
                    setTimeout(function(){
                        window.location.href = 'j_profile.php';
                    },500);
                    </script>";
                }
                else{
                    echo "<script src='jquery-3.5.1.js'> </script>";
                    echo "<script> alert('Education details not submitted');
                    setTimeout(function(){
                        window.location.href = 'education.php';
                    },500);
                    </script>";
                }
            }
        ?>
    </body>
</html>