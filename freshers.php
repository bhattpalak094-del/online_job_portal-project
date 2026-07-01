<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fresher Form</title>

<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

<style>

body{
    font-family:'Times New Roman';
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
    width:50%;
    margin:auto;
    margin-top:20px;
    background:#ffffff;
    padding:35px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
}

h1{
    font-size: 24px;
    color: white;
    text-align: center;
    margin-bottom: 20px;
    background-color: #15317E;
    height: 10%;
    padding-top: 20px;
}

h4{
    font-size:20pt;
    font-weight:600;
    text-align:center;
    margin-top:20px;
    margin-bottom:20px;
}

label{
    font-weight:bold;
}

.form-group{
    width:100%;
    margin-bottom:20px;
    font-size:15pt;
}

input,select{
    width:100%;
    padding:10px;
    margin-top:6px;
    border:1px solid #ccc;
    border-radius:5px;
}

.section-box{
    width:100%;
    background:#f7f9fc;
    padding:20px;
    border-radius:6px;
    border:1px solid #ddd;
    margin-top:10px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    margin-top:30px;
    background:#2F539B;
    color:white;
    font-size:16px;
    display:block;
}

button:hover{
    background:#0d3ea5;
}

form{
    display:block;
}

</style>

<script>

function showFields(){

var selection=document.getElementById("experience_type").value;

document.getElementById("internship_fields").style.display="none";
document.getElementById("project_fields").style.display="none";

if(selection=="internship"){
document.getElementById("internship_fields").style.display="block";
}

else if(selection=="project"){
document.getElementById("project_fields").style.display="block";
}

}

</script>
</head>

<body>

<div class="container">

<form method="POST" enctype="multipart/form-data">

<h1>FRESHER  FORM</h1>

<div class="form-group">
<label>Select Experience Type</label>
<select id="experience_type" name="experience_type" class="form-control" onchange="showFields()">
<option value="">---Select---</option>
<option value="internship">Internship</option>
<option value="project">Project</option>
</select>
</div>

<div class="form-group">
<label>Resume (PDF / DOC)</label>
<input type="file" id="resume" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
</div>


<!-- Internship Fields -->

<div id="internship_fields" class="section-box" style="display:none">

<h4>Internship Details</h4>

<div class="form-group">
<label>Company Name</label>
<input type="text" name="internship_company" class="form-control" placeholder="Enter Company Name" autocomplete="off">
</div>

<div class="form-group">
<label>Position</label>
<input type="text" name="internship_position" class="form-control" placeholder="Enter Position" autocomplete="off">
</div>

<div class="form-group">
<label>Duration</label>
<input type="text" name="internship_duration" class="form-control" placeholder="Enter Duration" autocomplete="off">
</div>

</div>


<!-- Project Fields -->

<div id="project_fields" class="section-box" style="display:none">

<h4>Project Details</h4>

<div class="form-group">
<label>Project Title</label>
<input type="text" name="project_title" class="form-control" placeholder="Enter Project Title" autocomplete="off">
</div>

<div class="form-group">
<label>Technologies Used</label>
<input type="text" name="project_tech" class="form-control" placeholder="Enter Technology" autocomplete="off">
</div>

</div>


<button type="submit" name="submit">Submit</button>
</form>
</div>

<?php
include '../db.php';
if(isset($_POST['submit'])){
if(isset($_FILES['resume']) && $_FILES['resume']['error']==UPLOAD_ERR_OK){
move_uploaded_file($_FILES['resume']['tmp_name'],"../resumes/".$_FILES['resume']['name']);
}
$uname=$_SESSION['user'];
$sql="SELECT jname FROM job_seeker WHERE username='$uname'";
$result=mysql_query($sql,$con);
$row=mysql_fetch_assoc($result);

$jname=$row['jname'];

$resume="../resumes/".$_FILES['resume']['name'];

$experience_type=$_POST['experience_type'];

if($experience_type=="internship"){

$company=$_POST['internship_company'];
$position=$_POST['internship_position'];
$duration=$_POST['internship_duration'];

$sql="INSERT INTO experience (jname,e_type,company,position,duration,resume)
VALUES ('$jname','internship','$company','$position','$duration','$resume')";

if(mysql_query($sql,$con)==TRUE){

echo "<script>alert('Internship Details submitted');
window.location='j_profile.php';
</script>";

}else{

echo "Error: ".mysql_error($con);

}

}

elseif($experience_type=="project"){

$title=$_POST['project_title'];
$tech=$_POST['project_tech'];

$sql="INSERT INTO experience (jname,e_type,title,tech,resume)
VALUES ('$jname','project','$title','$tech','$resume')";

if(mysql_query($sql,$con)==TRUE){

echo "<script>alert('Project Details submitted');
window.location='j_profile.php';
</script>";
}else{
echo "Error: ".mysql_error($con);
}
}
}
mysql_close($con);
?>
</body>
</html>

