<?php
session_start();
?>
<html>
    <head>
        <style>
                .title{
                    font-size: 30px;
                    color: white;
                    text-align: center;
                    margin-top: 3%;
                    margin-bottom: 3%;
                    background-color: #15317E;
                    height: 10%;
                    width:90%;
                    padding-top: 10px;
                    margin-left: 18%;
                }
                .job-card{
                    border: 5px solid black;
                    padding: 20px;
                    margin-top: 6%;
                    margin-left: 19%;
                    width:80%;
                }
                tr{
                    padding: 7px;
                    border: 2px solid gray;
                    font-size: 15pt;
                }
        </style>
    </head>
<body>
<h2 class="title"> Interview Details </h2>
<?php
    include "sidenav.php";
    include "../db.php";
        if(isset($_POST['view'])){
            $cname = $_POST['cname'];
            $j_title = $_POST['j_title'];
            $uname = $_SESSION['user'];
                $sql = "SELECT jname FROM job_seeker WHERE username='$uname'";
                $result = mysql_query($sql,$con);
                $row = mysql_fetch_assoc($result);
                $jname = $row['jname'];

            $SQL = "SELECT * FROM interview WHERE jname = '$jname' AND cname = '$cname' AND j_title ='$j_title'";
            $result = mysql_query($SQL,$con);
            if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){
            echo "<div class='job-card'>
                    <table class='table table-bordered'>
                        <tr>
                            <td> <strong> Company Name : </strong></td><td> " .$row['cname']. "</td>
                            <td> <strong> Job Title : </strong></td><td>" .$row['j_title']. "</td>
                        <tr>
                            <td> <strong> Interview Date : </strong></td><td>" .$row['i_date'] ." </td> 
                            <td> <strong> Interview Time : </strong></td><td>" .$row['i_time'] ." </td>
                            <td> <strong> Interview Mode : </strong></td><td>" .$row['i_mode'] ." </td> 
                        </tr>";
            }   
            }
            $SQL = "SELECT * FROM employer WHERE cname = '$cname'";
            $result = mysql_query($SQL,$con);
            if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){
                echo " <td> <strong> Contact person Name : </strong></td><td> " .$row['con_person']. "</td>
                        <td> <strong> Phone No : </strong></td><td>" .$row['mobileno']. "</td>
                        <tr>
                    </table>
                </div>
                <br>
            ";
            }
            }
            else{
                echo "<script src='../jquery.min.js'> </script>";
                echo "<script> alert('Interview details not found');
                setTimeout(function(){
                    window.location.href = 'ajob_list.php.php';
                },500);
                </script>";
            }
        }
?>
</body>
</html>