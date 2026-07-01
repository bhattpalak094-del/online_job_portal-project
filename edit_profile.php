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
        <link rel="stylesheet" href="../css/navigation.css">
        <style>
            .main{
                width: 60%;
                margin-left:30%;
                background-color: #f5f5f5;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                border-radius: 8px;
                margin-top: 4%;
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
            .form-group{
                margin-bottom: 15px;
            }
            label{
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                color: #333;
            }
            input{
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            button{
                width: 50%;
                height: 40px;
                background:#2F539B;
                border:none;
                outline:none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 1em;
                color:white;
                font-weight: 500;
                margin-left: 55%;
            }
            button:hover{
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <?php include 'sidenav.php'; ?>
        <div class="main">
            <h2 class="title"> Personal Details </h2>
            <form method='POST' action="">
                <?php
                    $name=$_SESSION['user'];
                    $sql = "SELECT * FROM job_seeker WHERE jname='$name'";
                    $result=mysql_query($sql,$con);
                    $row=mysql_fetch_array($result);
                ?>
                <div class='form-group'>
                    <label> Full Name </label>
                    <input type='text' id='name' name='name' value="<?php echo $row['jname']; ?>" required>
                </div>
                <div class='form-group'>
                    <label> Email </label>
                    <input type='text' id='email' name='email' value="<?php echo $row['email']; ?>" required>
                </div>
                <div class='form-group'>
                    <label> Contact No </label>
                    <input type='text' id='phno' name='phno' value="<?php echo $row['mobileno']; ?>" required>
                </div>
                <button type='submit' id='add' name='add'> Submit </button>
            </form>
        </div>
        <?php
            if(isset($_POST['add'])){
                $uname = $_SESSION['user'];
                $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                $result = mysql_query($sql,$con);
                $row = mysql_fetch_assoc($result);
                $jname = $row['jname'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phno = $_POST['phno'];

                $SQL = "INSERT INTO j_personal(jname,fname,email,contact) VALUES('$jname','$name','$email','$phno')";
                mysql_query($SQL,$con);
                $total = mysql_affected_rows();
                if($total>0)
                {
                    echo "<script src='../jquery.min.js'> </script>";
                    echo "<script> alert('Personal Details submitted');
                    setTimeout(function(){
                        window.location.href = 'j_profile.php';
                    },500);
                    </script>";
                }
                else{
                    echo "Personal details not submitted";
                }
            }
        ?>
    </body>
</html>
