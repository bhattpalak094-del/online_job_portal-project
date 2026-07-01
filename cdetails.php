<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location:../login.php");
    }
?>
<html>
    <head>
        <title> Company Details </title>
        <link rel="stylesheet" href="nav.css">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <style>
            body{
                font-family: Times New Roman;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
            }
            .container{
                width: 70%;
                margin-left: auto;
                background: white;
                padding: 20px;
                box-shadow: 0px 0px 0px rgba(0,0,0,0.1);
            }
            .job-card{
                border: 1px solid #ddd;
                padding: 20px;
                margin-top: 10px;
            }
            table{
                width: 100%;
                
            }
            td{
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }
            .image{
                margin-right: 40%;
            }
            .job-card button{
                background-color: #008000;
                color: white;
                border: none;
                padding: 9px 22px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            .job-card button:hover{
                background-color: #228B22;
            }
            .title{
                font-size: 24px;
                color: white;
                text-align: center;
                margin-bottom: 20px;
                background-color: #15317E;
                height: 10%;
                padding-top: 20px;
                margin-left: 10px;
                margin-right: 10px;
                margin-top: 1%;
            }
        </style>
    </head>
    <body>
        <?php include 'nav.php'; ?>
        <br>
        <h3 class="title"> Company Details </h3> <br><br>
        <div class="container">
            <?php
                include "../db.php";
                if(isset($_GET['id'])){
                    $id=intval($_GET['id']);
        
                $SQL = "SELECT * FROM manage_job WHERE job_id=$id";
                $result = mysql_query($SQL,$con);
                if(mysql_num_rows($result) > 0){
                    while($row = mysql_fetch_assoc($result)){
                    echo "<div class='job-card'>
                           <table class='table table-bordered'>
                                <tr>
                                    <td>
                                        <img src='../cpic.jpg' alt='Profile Picture' style='width: 150px; height: 150px;'>
                                    </td>
                                    <td> <strong> Company Name : </strong></td><td> " .$row['cname']. "</td><br>
                                    <td> <form method='POST' action='apply.php'> 
                                        <input type='hidden' name='jtitle' id='jtitle' value='".$row['j_title']."'>
                                        <input type='hidden' name='cname' id='cname' value='".$row['cname']."'>
                                        <button type='submit' id='apply' name='apply'> Apply </button> </form></td>
                                </tr>
                                <tr>
                                    <td> <strong> Job Title : </strong></td><td>" .$row['j_title']. "</td>
                                    <td> <strong> Total Vacancy :  </strong></td><td>" .$row['total_vacancy'] ." </td> 
                                </tr>
                                <tr>
                                    <td> <strong> Qualification : </strong></td><td>" .$row['j_qualification'] ." </td> 
                                    <td> <strong> Experience : </strong></td><td>" .$row['j_experience'] ." </td> 
                                </tr>
                        </div>
                    <br>
                    ";
                    }
                }
                else{
                    echo "<script src='../jquery.min.js'> </script>";
                        echo "<script> alert('Job not found');
                        setTimeout(function(){
                            window.location.href = 'search.php';
                        },500);
                        </script>";
                }
                
                $SQL="SELECT e.cname, e.con_person, e.address,e.city,e.email,e.mobileno,j.j_desc
                FROM employer e
                JOIN manage_job j ON e.cname = j.cname
                WHERE j.job_id = $id";
                $result = mysql_query($SQL,$con);
                if(mysql_num_rows($result) > 0){
                    while($row = mysql_fetch_assoc($result)){
                        echo "
                            <tr> 
                                <td> <strong> Description : </strong></td><td>".$row['j_desc']."</td>
                                <td> <strong> Contact Person :  </strong></td><td>".$row['con_person']."</td>
                            </tr>
                            <tr>
                                <td> <strong> Email :  </strong></td><td>".$row['email']."</td>
                                <td> <strong> Contact No :  </strong></td><td>".$row['mobileno']."</td>
                            </tr>
                            <tr>
                                <td> <strong> Comapny Address :  </strong></td><td>".$row['address']."</td>
                                <td> <strong> City :  </strong></td><td>".$row['city']."</td>
                            </tr>"
                        ;
                    }
                }
                else{
                    echo "<script src='../jquery.min.js'> </script>";
                        echo "<script> alert('Job not found');
                        setTimeout(function(){
                            window.location.href = 'search.php';
                        },500);
                        </script>";
                }
                echo "</table>
                    </div>";
            }
            ?>

        </div>
    </body>
</html>