<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location:../login.php");
    }
    include "../db.php";
?>
<html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" href="panel.css">
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
.menu-bar{
    background-color: rgba(0,0,0,0.3);
    text-align:center;
}
            .container{
                width:70%;
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
                flex-basis: 50%;
                display: block;
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
        <?php
        include '../db.php';
                $uname = $_SESSION['user'];
                $sql = "SELECT type FROM job_seeker WHERE username='$uname'";
                $result = mysql_query($sql,$con);
                $row = mysql_fetch_assoc($result);
                $type = $row['type'];
                if($type == "fresher"){
                    include 'freshers.php';
                }
                else{
           ?>
        <div class="container">
            <h2 class="title"> Experience Details </h2>
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label> Company Name </label>
                    <input type="text" id="cname" name="cname" placeholder="Enter company name" value="" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> Designation </label>
                    <input type="text" id="designation" name="designation" placeholder="Enter Designation" value="" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> CTC </label><br>
                    <input type="text" id="ctc" name="ctc" placeholder="Enter ctc" value="" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> Joining Date </label>
                    <input type="date" id="j_date" name="j_date" value="" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> Leaving Date </label>
                    <input type="date" id="l_date" name="l_date" value="" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label> Resume (only PDF or DOC allowed)</label>
                    <input type="file" id="resume" name="resume" accept=".pdf, .doc, .docx" required>
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
            // Check: experience already submitted or not
            $check = "SELECT * FROM j_exp WHERE jname='$jname'";
            $checkResult = mysql_query($check,$con);
            if(mysql_num_rows($checkResult) > 0){
                echo "<script>
                alert('Experience details already submitted');
                window.location.href='j_profile.php';
                </script>";
                exit(); 
            }
            // file upload
            if(isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK){
                move_uploaded_file(
                    $_FILES['resume']['tmp_name'],
                    '../resumes/'.$_FILES['resume']['name']);
            }
            $cname = $_POST['cname'];
            $designation = $_POST['designation'];
            $ctc = $_POST['ctc'];
            $join = $_POST['j_date'];
            $leave = $_POST['l_date'];
            $resume = "../resumes/".$_FILES['resume']['name'];
            $SQL = "INSERT INTO j_exp(com_name, jname, designation, ctc, j_date, l_date, resume)
            VALUES('$cname','$jname','$designation','$ctc','$join','$leave','$resume')";
            if(mysql_query($SQL,$con)){
                echo "<script>
            alert('Experience details submitted successfully');
            window.location.href='j_profile.php';
        </script>";
    } else {
        echo "<script>
            alert('Experience details not submitted');
            window.location.href='experience.php';
        </script>";
    }
}
?>
<?php } ?>
    </body>
</html>

        