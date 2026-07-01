<?php 
include 'navigation.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet"href="bootstrap/bootstrap.min.css">
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
     .table {width:100%;} 
     .table-responsive {
    overflow-x: auto;
}
.container-fluid {
    padding-left: 260px; 
}
     .form-title{
       font-size: 30px;
       font-weight: 600;
       text-align: center;
       padding-bottom: 5px;
       color:black;
       text-shadow: 2px 2px 2px black;
       font-family:'Times New Roman';
       margin-left:5%; }
       td {font-size:15pt;
        font-weight:bold;}
    th{font-size:15pt;}
      .action a{margin-right:20px;
                margin-bottom:5px;}
     </style>
</head>
<body>
<?php
include '../db.php';
$sql="SELECT * FROM `job_seeker`";
$Record = mysql_query($sql,$con);
$j_count = mysql_num_rows($Record);
$_SESSION['j_count'] = $j_count;
?>
<div class="container-fluid mt-5">
<h1 class="form-title">JOBSEEKER DETAILS</h1>
    <div class="row">
    <div class="table-responsive">
    <div class="col-md-11">
<table class="table border border-primary bg-light table-hover border my-5">
<thead class="bg-dark text-white fs-5 font-monospace text-center">
        <th>ID</th>
        <th>JOBSEEKER NAME</th>
        <th>CITY</th>
        <th>EMAIL</th>
        <th>MOBILE NO</th>
        <th>FRESHER / EXPERIENCED</th>
        <th>STATUS</th>
        <th>ACTION</th>
        <th>DELETE</th>
</thead>
<tbody class="text-center text-dark">
<?php
$i=0;
while( $row = mysql_fetch_array($Record)){
    $StatusClass = '';
    if ($row['status'] == 'Approved') {
        $StatusClass = 'text-success';
    } elseif ($row['status'] == 'Rejected') {
        $StatusClass = 'text-danger';
    } else {
        $StatusClass = 'text-warning';
    }
      // Determine whether the Approve or Reject button should be hidden
      $ApproveButton = ($row['status'] == 'Approved') ? 'style="display:none"' : '';
      $RejectButton = ($row['status'] == 'Rejected') ? 'style="display:none"' : '';
          // If status is 'Pending', show both buttons
       if ($row['status'] == 'Pending') {
          $approveButton = '';
          $rejectButton = '';
      }
    echo "
    <tr>
    <td>$row[j_id]</td>
    <td>$row[jname]</td>
    <td>$row[city]</td>
    <td>$row[email]</td>
    <td>$row[mobileno]</td>
    <td>$row[type]</td>
    <td class='$StatusClass'> $row[status]</td>
    <td class='action'>
     <a href='j_status.php? Id=$row[j_id] &Astatus=Approved' class = 'btn btn-success'$ApproveButton>Approve</a>
     <a href='j_status.php? Id=$row[j_id] &Rstatus=Rejected' class = 'btn btn-info'$RejectButton>Reject</a></td>
    <td> <a href='jdel.php? Id=$row[j_id]' class = 'btn btn-danger'>Delete</a></td>
    </tr>
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