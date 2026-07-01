<?php
$Iid = $_GET['ID'];
include '../db.php';
$sql="DELETE FROM `interview` WHERE i_id = $Iid";
$result=mysql_query($sql,$con);
header("location:job.php");
?>