<?php include 'c_dashboard.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Job</title>
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
      .form-title{
       font-size: 30px;
       font-weight: 600;
       text-align: center;
       padding-bottom: 10px;
       color:blue;
       text-shadow: 2px 2px 2px black;
       border-bottom: solid 3px black; 
    }
    .form-group{
                width: 48%
            }
    .manage-job{
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
      .form-label{
        font-size:14pt;
        font-weight:bold;
        font-family:'Times New Roman';
    }
      .table {margin-left:100px;
              font-size:13pt;} 
       td{font-weight:bold;}
      .container{
        padding:25px;
        margin-left:225px;
    }
    .container1{margin-right:19%;}
    #sbt{font-size:15pt;}
    </style>
</head>
<body>
<div class="container">
     <div class="row">
        <div class="col-md-9 m-auto bg-light border border-dark mt-3">
    <form action="j_insert.php"method="POST">
    <div class="mb-2">
    <h1 class="form-title">MANAGE JOB</h1>
</div>
<div class="manage-job">
<div class="form-group">
    <label class="form-label">JOB TITLE:</label>
    <input type="text"id="jb"name="jb"class="form-control"placeholder="Enter Job Title"/ required> 
</div>
<div class="form-group">
    <label class="form-label">TOTAL VACANCY:</label>
    <input type="text"id="jv"name="jv"class="form-control"placeholder="Enter Job Vacancy"/ required> 
</div>
<div class="form-group">
    <label class="form-label">QUALIFICATION:</label><br>
    <input type="checkbox" id="bca" name="bca" value="BCA">
    <label for="bca"><b>BCA</b></label>
    <input type="checkbox" id="mca" name="mca" value="MCA">
    <label for="mca"><b> MCA</b></label>
    <input type="checkbox" id="btech" name="btech" value="BTECH">
    <label for="btech"><b>B.TECH</b></label>
    <input type="checkbox" id="mtech" name="mtech" value="MTECH">
    <label for="mtech"><b>M.TECH</b></label><br>
    <input type="checkbox" id="be" name="be" value="BE">
    <label for="be"><b>B.E</b></label>
    <input type="checkbox" id="me" name="me" value="ME">
    <label for="me"><b>M.E</b></label>
    <input type="checkbox" id="bsc" name="bsc" value="BSC(IT)">
    <label for="msc"><b>BSC(IT)</b></label>
    <input type="checkbox" id="msc" name="msc" value="MSC(IT)">
    <label for="msc"><b>MSC(IT)</b></label>
</div>
<div class="form-group">
    <label class="form-label">EXPERIENCE:</label><br>
    <select name="ex" class="form-control" required>
    <option value="">-- Select Experience --</option>
    <option value="Fresher">Fresher</option>
    <option value="0-1 Years">0 - 1 Years</option>
    <option value="1-3 Years">1 - 3 Years</option>
    <option value="3-5 Years">3 - 5 Years</option>
    <option value="5+ Years">5+ Years</option>
</select>
</div>
<div class="form-group">
    <label class="form-label">JOB TYPE:</label><br>
    <select name="jtype" class="form-control" required>
    <option value="">-- Select Job Type --</option>
    <option value="full-time">Full Time</option>
    <option value="part-time">Part Time</option>
    <option value="Internship">Internship</option>
    <option value="Work-from-home">Work From Home</option>
</select>
</div>
<div class="form-group">
    <label class="form-label">JOB LOCATION:</label>
    <input type="text"id="jl"name="jl"class="form-control"placeholder="Enter Job Location"/ required> 
</div>
<button id="sbt"name="sbt" class="bg-primary fs-4 fw-bold my-3 form-control text-white">Submit</button>
    </form>
    </div>
</div>
</div>
</div>
<!--Fetch data-->
 <div class="container1">
   <div class="col-md-9 m-auto">
   <table class="table border border-primary table-hover border my-5">
   <thead class="bg-dark text-white fs-5 font-monospace text-center">
       <th>ID</th>
       <th>COMPANY NAME</th>
       <th>JOB TITLE</th>
       <th>TOTAL VACANCY</th>
       <th>QUALIFICATION</th>
       <th>EXPERIENCE</th>
       <th>JOB TYPE</th>
       <th>JOB LOCATION</th>
       <th>UPDATE</th>
       <th>DELETE</th>
       </thead>
<tbody class="text-center">
<?php
include '../db.php';
$name = $_SESSION['user']; 
$sql = "SELECT cname FROM employer WHERE username='$name'"; 
$result = mysql_query($sql, $con);
$row = mysql_fetch_array($result);
$c_name = $row['cname']; // Store the company name

$sql="SELECT * FROM `manage_job` WHERE cname='$c_name'";
$result = mysql_query($sql,$con);
while($row = mysql_fetch_array($result))
{
    echo"
<tr>
<td>$row[job_id]</td>
<td>$row[cname]</td>
<td>$row[j_title]</td>
<td>$row[total_vacancy]</td>
<td>$row[j_qualification]</td>
<td>$row[j_experience]</td>
<td>$row[j_type]</td>
<td>$row[location]</td>
<td> <a href='jedit.php?ID=$row[job_id]' class='btn btn-primary'>Update</a></td>
<td> <a href='jdel.php?ID=$row[job_id]' class='btn btn-danger'>Delete</a></td>
</tr>
";
}
?>
</tbody>
</table>
</div>
</div>
</body> 
</html>


