<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"href="bootstrap/bootstrap.min.css">
       <!--Font-awesome CDN-->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
       <link rel="stylesheet" href="../css/navigation.css">
       <style>
        body{font-family:'Times New Roman';}
        .container{margin-top:25px;}
       </style>
</head>
<body>
<div class="bg-layer"></div>
<div class="bg-overlay"></div>
<div class="menu-bar">
<ul>
<li><a href="../home.php">HOME</a></li>
<li><a href="#">REGISTRATION</a>
<div class="sub-menu-1">
<ul>
<li><a href="../Job Seeker/eregistration.php">JobSeeker</a></li>
<li><a href="../company/cregistration.php">Employer</a></li>
</ul>
</div>
</li>
<li><a href="../login.php">LOGIN</a></li>
<li><a href="../admin/n_display.php">LATEST NEWS</a></li>
<li><a href="../aboutus.php">ABOUT US</a></li>
</ul>
</div>
<br>
<div class="container">
<div class="row">
<div class="col-md-7  m-auto">
 <table class="table border border-secondary table-hover bg-light border my-5">
<thead class="bg-info text-black fs-5 font-monospace text-center">
    <th></th>
    <th>NEWS</th>
    <th>NEWS DATE</th>
</thead>
<tbody class="text-center">
    <?php
    include '../db.php';
    $sql="SELECT * FROM `news`";
    $result = mysql_query($sql,$con);
    while($row = mysql_fetch_array($result))
    {
        echo"
    <tr>
    <td><i class='fa-solid fa-newspaper'></i></td>
    <td>$row[news]</td>
    <td>$row[n_date]</td>
    </tr>
    ";
    }
    ?>
</tbody>
</table>
</body>
</html>