<?php
$jid = $_GET['ID'];
include '../db.php';
$sql="DELETE FROM `manage_job` WHERE job_id = $jid";
$result=mysql_query($sql,$con);
header("location:job.php");
?>