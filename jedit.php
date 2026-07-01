<?php include 'c_dashboard.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Package</title>
    <link rel="stylesheet"href="css/bootstrap.min.css">
    <style>
      body{font-family:'Times New Roman';}
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
      .table {margin-left:115px;} 
       td{font-weight:bold;}
      .container{
        padding:25px;
        margin-left:225px;
    }
    </style>
</head>
<body>
<?php
 $jid =intval($_GET['ID']);
include '../db.php';
$sql= "SELECT * FROM `manage_job` WHERE job_id = $jid";
$result = mysql_query($sql,$con);
$Record = mysql_fetch_array($result);
?>
<div class="container">
    <div class="row">
        <div class="col-md-9 m-auto bg-light border border-dark mt-3">
    <form action="jedit.php"method="POST">
    <div class="mb-2">
    <h1 class="form-title">UPDATE JOB DETAILS</h1>
</div>
<div class="manage-job">
<div class="form-group">
    <label class="form-label">JOB TITLE:</label>
    <input type="text" value ="<?php echo $Record['j_title']?>"id="jb" name="jb" class="form-control" placeholder="Enter Job Title"> 
</div>
<div class="form-group">
    <label class="form-label">TOTAL VACANCY:</label>
    <input type="text" value ="<?php echo $Record['total_vacancy']?>"id="jv" name="jv" class="form-control" placeholder="Enter Total Vacancy"> 
</div>
<div class="form-group">
<label class="form-label">QUALIFICATION:</label><br>
<input type="checkbox" id="bca" name="bca" value="BCA"
<?php echo (strpos($Record['j_qualification'], 'BCA') !== false) ? 'checked' : ''; ?>>
    <label for="bca"><b>BCA</b></label>
    <input type="checkbox" id="mca" name="mca" value="MCA"
    <?php echo (strpos($Record['j_qualification'], 'MCA') !== false) ? 'checked' : ''; ?>>
    <label for="mca"><b> MCA</b></label>
    <input type="checkbox" id="btech" name="btech" value="BTECH"
    <?php echo (strpos($Record['j_qualification'], 'BTECH') !== false) ? 'checked' : ''; ?>>
    <label for="btech"><b>B.TECH</b></label>
    <input type="checkbox" id="mtech" name="mtech" value="MTECH"
    <?php echo (strpos($Record['j_qualification'], 'MTECH') !== false) ? 'checked' : ''; ?>>
    <label for="mtech"><b>M.TECH</b></label><br>
    <input type="checkbox" id="be" name="be" value="BE"
    <?php echo (strpos($Record['j_qualification'], 'BE') !== false) ? 'checked' : ''; ?>>
    <label for="be"><b>B.E</b></label>
    <input type="checkbox" id="me" name="me" value="ME"
    <?php echo (strpos($Record['j_qualification'], 'ME') !== false) ? 'checked' : ''; ?>>
    <label for="me"><b>M.E</b></label>
    <input type="checkbox" id="msc" name="msc" value="MSC(IT)"
    <?php echo (strpos($Record['j_qualification'], 'MSC(IT)') !== false) ? 'checked' : ''; ?>>
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
    <input type="text"id="jl"name="jl"class="form-control"placeholder="Enter Job Location"/> 
</div>
<input type="hidden" name="id" value="<?php echo $Record['job_id']?>">
<button name="edit" class="bg-primary fs-4 fw-bold my-3 form-control text-white">Update</button>
    </form>
    </div>
</div>
</div>
</div>
         <!--Php Update Code-->
         <?php
          include '../db.php';
         if(isset($_POST['edit'])){
            $Id = $_POST['id'];
            $jtitle = $_POST['jb'];
            $tvacancy = $_POST['jv'];
            // Check for selected qualifications
     $qualifications = [];
     if (isset($_POST['bca'])) {
         $qualifications[] = $_POST['bca'];
     }
     if (isset($_POST['mca'])) {
         $qualifications[] = $_POST['mca'];
     }
     if (isset($_POST['btech'])) {
         $qualifications[] = $_POST['btech'];
     }
     if (isset($_POST['mtech'])) {
         $qualifications[] = $_POST['mtech'];
     }
     if (isset($_POST['be'])) {
         $qualifications[] = $_POST['be'];
     }
     if (isset($_POST['me'])) {
         $qualifications[] = $_POST['me'];
     }
     if (isset($_POST['msc'])) {
         $qualifications[] = $_POST['msc'];
     }
     // Convert qualifications array into a comma-separated string
     $qualificationString = implode(', ', $qualifications); 
            $experience = $_POST['ex'];
            $j_type = $_POST['jtype'];
            $j_location = $_POST['jl'];
            $sql="UPDATE `manage_job` SET `j_title`='$jtitle',`total_vacancy`='$tvacancy',`j_qualification`='$qualificationString',`j_experience`='$experience',`j_type`='$j_type',`location`='$j_location' WHERE job_id= $Id";
            $res=mysql_query($sql,$con);
            echo"
             <script>
             alert('Job Updated Successfully');
             window.location.href='job.php';
             </script>
            ";
         }
         ?>
</body>
</html>

