<?php 
session_start();
include '../db.php';
if(isset($_POST['sbt'])){
    $uname = $_SESSION['user'];
    $sql = "SELECT cname FROM employer WHERE username='$uname'";
    $result = mysql_query($sql,$con);
    $row = mysql_fetch_assoc($result);
    $cname = $row['cname'];
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
    $date = date('Y-m-d H:i:s');
    $sql="INSERT INTO `manage_job`(`cname`,`j_title`, `total_vacancy`, `j_qualification`, `j_experience`, `j_type`, `location`,`time`) VALUES ('$cname','$jtitle','$tvacancy','$qualificationString','$experience','$j_type','$j_location','$date')";
    if(mysql_query($sql,$con)){
    echo"
    <script>
    alert('Job Posted Successfully');
    window.location.href='job.php';
    </script>
    ";
    }
    else{
        echo"
    <script>
    alert('Job is not Posted');
    window.location.href='job.php';
    </script>
    ";
    }
    //header("location:job.php");
}
?>
   <!--Fetch data-->
   <table class="table table-hover">
<thead>
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
</table>

 