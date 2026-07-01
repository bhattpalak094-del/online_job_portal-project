<?php
$nid=$_GET['ID'];
include '../db.php';
$sql="DELETE FROM `news` WHERE n_id= $nid";
$result=mysql_query($sql); 
header("location:news.php");
?>