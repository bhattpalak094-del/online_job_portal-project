<?php include 'navigation.php'; ?>
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
    .table {margin-left:150px; }
    .form-title{
       font-size: 30px;
       font-weight: 600;
       text-align: center;
       padding-bottom: 10px;
       color:black;
       text-shadow: 2px 2px 2px black;
       font-family:'Times New Roman';
       margin-left:15%; }
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
// Query to fetch employers and their respective job posts
$query = "
    SELECT employer.cname AS employer_name,manage_job.j_title,manage_job.total_vacancy,manage_job.j_qualification,
    manage_job.j_experience,manage_job.j_type,manage_job.location  FROM employer
    INNER JOIN manage_job ON employer.cname = manage_job.cname
    ORDER BY employer.cname, manage_job.j_title";
    
$result = mysql_query($query,$con);
// Check if any results are returned
if (mysql_num_rows($result) > 0) {
    // Initialize a variable to track the current employer
    $currentEmployer = "";
?>
<div class="container mt-2">
<h1 class="form-title">POSTED JOBS</h1>
    <div class="row">
    <div class="col-md-11">
<table class="table border border-primary bg-light table-hover border my-5">
<thead class="bg-dark text-white fs-5 font-monospace text-center">
        <th>COMPANY NAME</th>
        <th>JOB TITLE</th>
        <th>TOTAL VACANCY</th>
        <th>QUALIFICATION</th>
        <th>EXPERIENCE</th>
        <th>JOB TYPE</th>
        <th>JOB LOCATION</th>
</thead>
<tbody class="text-center text-dark">
<?php
// Loop through the results and display them in a table
while ($row = mysql_fetch_assoc($result)) {
    // If the employer name changes, display a new employer row
    if ($currentEmployer != $row['employer_name']) {
        $currentEmployer = $row['employer_name'];
    }
    echo"
    <tr>
    <td>$row[employer_name]</td>        
    <td> $row[j_title]</td>
    <td> $row[total_vacancy]</td>
    <td> $row[j_qualification]</td>
    <td> $row[j_experience]</td>
    <td> $row[j_type]</td>
    <td> $row[location]</td>
    </tr>
    ";
}
?>
</tbody>
</table>
</div>
</div>
</div>
<?php
} else {
    echo "<p>No job posts found.</p>";
}
?>
</body>
</html> 