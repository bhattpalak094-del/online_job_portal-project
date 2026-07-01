<?php 
include 'c_dashboard.php'; 
include "../db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Interview</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
            .form-group{
                width: 48%
            }
        .manage-interview{
        display: flex;
        flex-wrap: wrap;
        gap: 20px;}
        .form-title{
            font-size: 30px;
            font-weight: 600;
            text-align: center;
            padding-bottom: 10px;
            color:blue;
            text-shadow: 2px 2px 2px black;
            border-bottom: solid 3px black;
            font-family:'Times New Roman';
        }
        .form-label{
            font-size:15pt;
            font-weight:bold;
            font-family:'Times New Roman';
        }
        .table {margin-left:150px;} 
        td{font-weight:bold;}
        .container{
        padding:25px;
        margin-left:220px;
    }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto bg-light border border-dark mt-3">
        <?php
            include '../db.php';
            if(isset($_SESSION['a_id'])) {
                $aid = $_SESSION['a_id']; // Get the application ID from session
            
                // Retrieve job_title and jname from applyers table using a_id
                $sql = "SELECT j_title, jname FROM applyers WHERE a_id = '$aid'";
                $result = mysql_query($sql, $con);
                if (mysql_num_rows($result) > 0) {
                    $row = mysql_fetch_assoc($result);
                    $j_title = $row['j_title'];  // Job Title
                    $jname = $row['jname'];      // Job Seeker Name
                } else {
                    // Handle case where no records are found (e.g., invalid a_id)
                    echo "<script>alert('No application found for this ID.'); window.location.href='view_applyer.php';</script>";
                }
            } else {
                echo "<script>alert('No application ID found.'); window.location.href='view_applyer.php';</script>";
            }
            $uname = $_SESSION['user'];
            $sql = "SELECT cname FROM employer WHERE username='$uname'";
            $result = mysql_query($sql,$con);
            $row = mysql_fetch_assoc($result);
            $cname = $row['cname'];  ?>   
            <form action="confirm_email.php" method="POST">
                <div class="mb-2">
                    <h1 class="form-title">MANAGE INTERVIEW</h1>
                </div>
                <div class="manage-interview">
                <div class="form-group">
                    <label class="form-label">COMPANY NAME:</label>
                    <input type="text" id="cnm" name="cnm" class="form-control" value="<?php echo $row['cname']; ?>" autocompele="off"/> 
                </div>
                <div class="form-group">
                    <label class="form-label">JOB TITLE:</label>
                    <input type="text" id="jb" name="jb" class="form-control" value="<?php echo $j_title; ?>" autocompele="off"/> 
                </div>
                <div class="form-group">
                    <label class="form-label">JOBSEEKER NAME:</label>
                    <input type="text" id="jnm" name="jnm" class="form-control" value="<?php echo $jname; ?>" autocompele="off"/> 
                </div>
                <div class="form-group">
                    <label class="form-label">INTERVIEW DATE:</label>
                    <input type="date" id="date" name="date" class="form-control" autocompele="off"/>
                </div>
                <div class="form-group">
                    <label class="form-label">INTERVIEW TIME:</label>
                    <input type="time" id="time" name="time" class="form-control" autocompele="off"/>
                </div>
                <div class="form-group">
                <label class="form-label">INTERVIEW MODE:</label>
                <select name="imode" id="imode" class="form-control"required>
                            <option value=""> Select Mode </option>
                            <option value="Online"> Online </option>
                            <option value="Offline"> Offline </option>
                    </select>
                </div>
                <button type="submit" id="email" name="email" class="bg-primary fs-4 fw-bold my-3 form-control text-white">Send Email</button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Fetch data -->
<div class="container1">
    <div class="col-md-8 m-auto">
        <table class="table border border-primary table-hover border my-5">
            <thead class="bg-dark text-white fs-5 font-monospace text-center">
                <th>ID</th>
                <th>COMPANY NAME</th>
                <th>JOB TITLE</th>
                <th>JOBSEEKER NAME</th>
                <th>INTERVIEW DATE</th>
                <th>INTERVIEW TIME</th>
                <th>INTERVIEW MODE</th>
                <th>DELETE</th>
            </thead>
            <tbody class="text-center">
            <?php
            include "../db.php";
            // Fetch interview details from the database
            $sql = "SELECT * FROM `interview` WHERE cname='$cname'";
            $result = mysql_query($sql, $con);

            while($row = mysql_fetch_array($result)) {
                echo "
                <tr>
                    <td>{$row['i_id']}</td>
                    <td>{$row['cname']}</td>
                    <td>{$row['j_title']}</td>
                    <td>{$row['jname']}</td>
                    <td>{$row['i_date']}</td>
                    <td>{$row['i_time']}</td>
                    <td>{$row['i_mode']}</td>
                    <td><a href='idel.php?ID={$row['i_id']}' class='btn btn-danger'>Delete</a></td>
                </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
