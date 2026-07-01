<?php
    session_start();
    if(!$_SESSION['user']){
            header("Location:../login.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet"href="bootstrap/bootstrap.min.css">
    <style> 
    .table {margin-left:30px;} 
    .form-title{
       font-size: 30px;
       font-weight: 600;
       text-align: center;
       padding-bottom: 10px;
       color:black;
       text-shadow: 2px 2px 2px black;
       font-family:'Times New Roman';
       margin-right:7%; }
       td{
        font-size:15pt;
        font-weight: bold;}
       th{font-size:15pt;
        font-weight: bold;}
       .action a{
        margin-right: 20px;
        margin-bottom: 5px;
       }
    </style>
</head>
<body>
    <?php include "sidenav.php"; ?>
<?php
include '../db.php';
$uname = $_SESSION['user'];
                $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                $result = mysql_query($sql,$con);
                $row = mysql_fetch_assoc($result);
                $jname = $row['jname'];

$sql="SELECT * FROM `applyers` WHERE jname='$jname'";
$Record = mysql_query($sql,$con);
?>
<div class="container mt-2">
<h1 class="form-title"> APPLIED JOB LIST </h1>
    <div class="row">
    <div class="col-md-11">
<table class="table border border-primary  table-hover border my-5">
<thead class="bg-dark text-white fs-5 font-monospace text-center">
        <th>JOB TITLE</th>
        <th>COMPANY NAME</th>
        <th>STATUS</th>
        <th>INTERVIEW</th>
</thead>

<tbody class="text-center text-dark">
<?php
 while($row = mysql_fetch_assoc($Record)){ 
     $StatusClass = '';
                        if ($row['status'] == 'confirm') {
                            $StatusClass = 'text-success';
                        } elseif ($row['status'] == 'shortlisted') {
                            $StatusClass = 'text-primary';
                        } elseif ($row['status'] == 'reject') {
                            $StatusClass = 'text-danger';
                        } else {
                            $StatusClass = 'text-warning';
                        }
    echo"
    <tr>
    <td> $row[j_title]</td>
    <td> $row[cname]</td>
    <td class='$StatusClass'> $row[status]</td>";
    if($row['status'] == 'confirm'){
        echo "<td class='action'>
            <form method='POST' action='interview_details.php'>
                <input type='hidden' name='cname' value='".$row['cname']."'>
                 <input type='hidden' name='j_title' value='".$row['j_title']."'>
            <button class = 'btn btn-success' name='view'> Interview </button>
            </form>
        </td>";
    }
    echo "</tr> 
    ";
 }
 ?>
</tbody>
</table>
</div>
</div>
</div>
</body>
</html>