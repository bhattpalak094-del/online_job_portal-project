<?php
include '../db.php';
if(isset($_POST['signup'])){
    $c_name=$_POST['name'];
    $con_p=$_POST['cperson'];
    $add=$_POST['address'];
    $city=$_POST['city'];
    $email=$_POST['email'];
    $mobile=$_POST['phno'];
    $uname=$_POST['username'];
    $pass=$_POST['password'];
    $role=$_POST['role'];
    $c_type=$_POST['ctype'];

    $legal_image = $_FILES['clegal'];
    $legal_loc   = $_FILES['clegal']['tmp_name'];
    $legal_name  = $_FILES['clegal']['name'];
    $legal_des = "Legal_docs/" . $legal_name;
    move_uploaded_file($legal_loc, "Legal_docs/" . $legal_name);

    $logo_image = $_FILES['clogo'];
    $logo_loc   = $_FILES['clogo']['tmp_name'];
    $logo_name  = $_FILES['clogo']['name'];
    $logo_des = "Logo/" . $logo_name;
    move_uploaded_file($logo_loc, "Logo/" . $logo_name);

$sql ="SELECT * FROM `employer` WHERE  email = '$email'";
$Dup_Email=mysql_query($sql,$con);

$sql="SELECT * FROM `user` WHERE  username = '$uname'";
$Dup_Username=mysql_query($sql,$con);
if(mysql_num_rows( $Dup_Email)){
    echo"
    <script>
    alert('This Email is already taken');
    window.location.href='cregistration.php';
    </script>
    ";
}
if(mysql_num_rows( $Dup_Username)){
    echo"
     <script>
    alert('This Username is already taken');
    window.location.href='cregistration.php';
    </script>
    ";
}
else{
    $sql="INSERT INTO `user`(`username`, `password`,`role`) VALUES ('$uname','$pass','$role')";
    mysql_query($sql,$con);
    $sql="INSERT INTO `employer`(`cname`, `con_person`,`address`, `city`, `email`, `mobileno`,`username`,`password`,`legal_doc`, `c_type`,`logo`) VALUES('$c_name','$con_p','$add','$city','$email','$mobile','$uname','$pass','$legal_des','$c_type','$logo_des')";
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
   window.location.href='cregistration.php';
   </script>
   ";
}     
?>