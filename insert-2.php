<?php
include '../db.php';
if(isset($_POST['signup'])){
    $j_name=$_POST['name'];
    $city=$_POST['city'];
    $email=$_POST['email'];
    $mobile=$_POST['phno'];
    $uname=$_POST['username'];
    $pass=$_POST['password'];
    $role=$_POST['role'];
    $type = $_POST['exp'];

$sql ="SELECT * FROM `job_seeker` WHERE  email = '$email'";
$Dup_Email=mysql_query($sql,$con);

$sql="SELECT * FROM `user` WHERE  username = '$uname'";
$Dup_Username=mysql_query($sql,$con);
if(mysql_num_rows( $Dup_Email)){
    echo"
    <script>
    alert('This Email is already taken');
    window.location.href='eregistration.php';
    </script>
    ";
} 
  if(mysql_num_rows( $Dup_Username)){
    echo"
     <script>
    alert('This Username is already taken');
    window.location.href='eregistration.php';
    </script>
    ";
}
else{
    $sql="INSERT INTO `user`(`username`, `password`,`role`) VALUES ('$uname','$pass','$role')";
    mysql_query($sql,$con);
    $sql="INSERT INTO `job_seeker`(`jname`, `city`, `email`, `mobileno`,`type`,`username`,`password`) VALUES ('$j_name','$city','$email','$mobile','$type','$uname','$pass')";
    mysql_query($sql,$con);
    echo"
    <script>
   alert('Register Successfully');
   window.location.href='../login.php';
   </script>
   ";
}
}
else{
    echo"
    <script>
   alert('not registered');
   window.location.href='eregistration.php';
   </script>
   ";
}  
?>