<?php 
include 'db.php';
if(isset($_POST['sbt'])){
    $jtitle = $_POST['jb'];
    $tvacancy = $_POST['jv'];
    $qualification = $_POST['qua'];
    $experience = $_POST['ex'];
    $description = $_POST['des'];
    $idate = $_POST['date'];
    $itime = $_POST['time'];
    $mode = $_POST['imode'];
    $sql="INSERT INTO `interview`(`j_title`, `total_vacancy`, `j_qualification`, `j_experience`, `j_desc`,`interview_date`,'interview_time`,`i_mode`) VALUES ('$jtitle','$tvacancy','$qualification','$experience','$description','$idate','$itime','$mode')";
    mysql_query($sql,$con);
    header("location:interview.php");
}
?>
   <!--Fetch data-->
   <table class="table table-hover">
<thead>
    <th>ID</th>
    <th>JOB TITLE</th>
    <th>TOTAL VACANCY/th>
    <th>QUALIFICATION</th>
    <th>EXPERIENCE</th>
    <th>DESCRIPTION</th>
    <th>INTERVIEW DATE</th>
    <th>INTERVIEW TIME</th>
    <th>UPDATE</th>
    <th>DELETE</th>
</thead>
</table>

 