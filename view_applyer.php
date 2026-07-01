<?php 
    include 'c_dashboard.php';
    if(!$_SESSION['user']){
        header("Location:../login.php");
    }
    include "../db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Job</title>
    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <style>
        body{
                font-family: 'Times New Roman';
                font-size:14pt;
            }
            .menu a{
                background-color: #fff;
                height: 45px;
                width: 90%;
                margin-left: 11px;
                text-align: center;
                font-family: 'Times New Roman';
                font-size:17pt;
                border-radius: 25px;
                text-decoration: none;
            }
            .menu a:hover{
                background-color: lightgray;
                width: 90%;
            }
        .container{
            text-align: center;
            width: 70%;
            background-color: #007bff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            padding:25px;
            margin-left: 25%;
            margin-top: 3%;
        }
        .container h2{
            font-size: 24px;
            color: #fff;
            margin-bottom: 20px;
        }
        .search-form{
            display: flex;
            justify-content: center;
            align-items:center;
            gap: 20px;
        }
        .search-form select{
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
        }
        .search-form button{
            background-color: #0041C2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-form button:hover{
            background-color: #0056b3;
        }
        .file1{
            background-color: #fff;
            width: 80%;
            padding: 20px;
            margin-left: 20px auto;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            justify-content: center;
            align-items:center;
            font-family: Times New Roman;
        }
        .job-card p{
            color: #4D4D4F;
            display: flex;
        }
        #image{
            margin-right: 20px;
            display: flex;
        }
        .job-card{
            max-width: 500px;
            align-items: center;
        }
        .job-card button{
            background-color: #0041C2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; 
        }
        .job-card button:hover{
            background-color: #0056b3;
        }
        .table {
            margin-left:14%;
        } 
        .table th{font-size:18pt;}
        .table td{font-size:16pt;}
    </style>
</head>
<body>
            <div class="sidebar">
                <img src="<?php echo $logo_des; ?>" style="width: 50px; border-radius: 50%;">
                <span id="n1" name="n1">Hello, <?php echo $_SESSION['user']; ?></span> <br><br>
                <a href="cdashboard.php" class="text-light"><i class="fa-solid fa-house-user"></i></a>
                <br>
                    <div class="menu"><a href="job.php"><b> Manage Job </b></a></div>
                    <br>
                    <div class="menu"><a href="view_applyer.php"><b> View Applyers </b></a></div>
                    <br>
                    <div class="menu"><a href="interview.php"><b> Manage Interview </b></a></div>
                    <br>
                <div class="menu"><a href="logout.php"><b> Logout </b></a></div>
        </div>
    <div class="container">
        <h2> Search Applyers </h2> <br>
        <form method="POST"  class="search-form">
            <select name="job" require>
                <?php
                    $uname = $_SESSION['user'];
                    $sql = "SELECT cname,logo FROM employer WHERE username='$uname'";
                    $result = mysql_query($sql,$con);
                    $row = mysql_fetch_assoc($result);
                    $cname = $row['cname'];
                    $logo_des  = $row['logo'];
                        $SQL = "SELECT DISTINCT j_title FROM manage_job WHERE cname='$cname'";
                        $result = mysql_query($SQL,$con);
                        while($row=mysql_fetch_array($result)){
                            echo "<option value='". $row['j_title'] ."'>". $row['j_title'] ." </option>";
                        }
                    ?>
            </select>
            <button type="submit" id="view" name="view"> View </button>
        </form>
    </div>
    <br><br><br>
    
                    <!--Fetch data-->

    <?php
    if(isset($_POST['view'])){
        $job = $_POST['job'];
        $SQL = "SELECT * FROM applyers WHERE j_title='$job' AND cname='$cname'";
       echo"
        <div class='container1'>
        <div class='col-md-9 m-auto'>
        <table class='table border border-primary table-hover border my-5'>
        <thead class='bg-dark text-white fs-5 font-monospace text-center'>
            <th> ID </th>
            <th> JOB TITLE </th>
            <th> COMPANY NAME </th>
            <th> APPLYER NAME </th>
            <th> STATUS </th>
            <th> VIEW </th>
        </thead>
        <tbody class='text-center'>";
        $result = mysql_query($SQL,$con);
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result))
            {
                $StatusClass = '';
                        if ($row['status'] == 'confirm') {
                            $StatusClass = 'text-success';
                        } elseif ($row['status'] == 'shortlisted') {
                            $StatusClass = 'text-primary';
                        } elseif ($row['status'] == 'reject') {
                            $StatusClass = 'text-danger';
                        } else {
                            $StatusClass = 'text-warning';
                        }
            echo"
                <tr>
                <td>$row[a_id]</td>
                <td>$row[j_title]</td>
                <td>$row[cname]</td>
                <td>$row[jname]</td>
                <td class='$StatusClass' id='status'>$row[status]</td>
                <td> <a href='adetails.php?name=$row[jname]&jtitle=$row[j_title]&cname=$row[cname]' class='btn btn-primary'> View </a></td>
                </tr>
                ";
            }
    } else {

    // No Applicant 
    echo "
        <tr>
            <td colspan='6' class='text-center text-warning  fw-bold'>
                No applicant has applied for this job yet.
            </td>
        </tr>";
    }
echo "
    </tbody>
    </table>
    </div>
    </div>";
}
?>
</body>
</html>
