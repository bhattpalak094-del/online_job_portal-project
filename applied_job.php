<?php include 'navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applied Jobs</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
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
    .table {margin-left:180px; }
    .form-title{
       font-size: 30px;
       font-weight: 600;
       text-align: center;
       padding-bottom: 10px;
       color:black;
       text-shadow: 2px 2px 2px black;
       font-family:'Times New Roman';
       margin-left:20%; }
    td {font-size:15pt;
        font-weight:bold;}
    th{font-size:15pt;}
    </style>
</head>
<body>

<?php
include '../db.php';
$query = "
SELECT 
    applyers.cname AS employer_name,
    applyers.j_title AS j_title,
    job_seeker.jname AS applicant_name,
    job_seeker.email AS email,
    applyers.status AS status
FROM applyers
INNER JOIN job_seeker 
    ON applyers.jname = job_seeker.jname
ORDER BY applyers.cname, applyers.j_title
";

$result = mysql_query($query,$con);
if (mysql_num_rows($result) > 0) {
?>

<div class="container mt-2">
<h1 class="form-title">APPLIED JOBS</h1>
    <div class="row">
    <div class="col-md-11">

<table class="table border border-primary bg-light table-hover border my-5">
<thead class="bg-dark text-white fs-5 font-monospace text-center">
        <th>COMPANY NAME</th>
        <th>JOB TITLE</th>
        <th>APPLICANT NAME</th>
        <th>EMAIL</th>
        <th>STATUS</th>
</thead>

<tbody class="text-center text-dark">
<?php
while ($row = mysql_fetch_assoc($result)) {
    echo "
    <tr>
        <td>{$row['employer_name']}</td>        
        <td>{$row['j_title']}</td>
        <td>{$row['applicant_name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['status']}</td>
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
    echo "<p>No applications found.</p>";
}
?>
</body>
</html>
