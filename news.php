<?php include 'navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet"href="bootstrap/bootstrap.min.css">
    <style>
         body{
                font-family: 'Times New Roman';
                font-size:14pt;
                height:100%;
                margin:0;
                display:grid;
                place-items:center;
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
            th{font-size:18pt;}
            td{font-size:15pt;}
        .container{
            padding:50px;
            margin-left:10%;
        }
        .container p{
            font-size:20pt;
            color:darkblue;
        }     
        </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6  mt-5  m-auto bg-light shadow font-monospace  border border-dark">
                <p class=" text-center fs-1 fw-bold my-3">CREATE NEWS</p>
                <form action="n_insert.php" method="POST">
                    <div class="mb-3">
                        <label for="">NEWS:</label>
                        <input type="text"id="news"name="news"placeholder="Enter News"class="form-control" autocomplete="off">
                   </div>
                   <div class="mb-3">
                        <label for="">NEWS DATE:</label>
                        <input type="date"id="ndate"name="ndate"class="form-control" autocomplete="off">
                   </div>
                   <div class="mb-3">
                    <button class=" w-100 bg-success fs-4 text-white"id="sub"name="sub">Submit</button>
                    </div>
</form>
</div>
</div>
</div>
</body>
<!--Fetch data-->
<div class="container">
<div class="row">
<div class="col-md-8  m-auto">
 <table class="table border border-primary bg-light table-hover border my-5">
<thead class="bg-dark text-white fs-5 font-monospace text-center">
    <th>ID</th>
    <th>NEWS</th>
    <th>NEWS DATE</th>
    <th>DELETE</th>
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
<td>$row[n_id]</td>
<td>$row[news]</td>
<td>$row[n_date]</td>
<td> <a href='ndel.php?ID=$row[n_id]' class='btn btn-danger'>Delete</a></td>
</tr>
";
}
?>
</html>
