<?php
if(isset($_POST['sub'])){
    include '../db.php';
    $News = $_POST['news'];
    $NewsDate = $_POST['ndate'];
    $sql="INSERT INTO `news`(`news`, `n_date`) VALUES ('$News','$NewsDate')";
    mysql_query($sql,$con);
    header("location:news.php");
}
?>
   <!--Fetch data-->
   <table class="table table-hover">
<thead>
    <th>ID</th>
    <th>NEWS</th>
    <th>NEWS DATE</th>
    <th>Delete</th>
</thead>
</table>
