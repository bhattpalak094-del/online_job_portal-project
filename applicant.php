<?php
include 'navigation.php';
include "../db.php";

$where = "";

// SEARCH
if(isset($_GET['search']))
{
$jname = mysql_real_escape_string($_GET['jname']);
$cname = mysql_real_escape_string($_GET['cname']);
$j_title = mysql_real_escape_string($_GET['j_title']);
$status = mysql_real_escape_string($_GET['status']);

if($jname != "")
{
$where .= " AND jname LIKE '%$jname%'";
}

if($cname != "")
{
$where .= " AND cname LIKE '%$cname%'";
}

if($j_title != "")
{
$where .= " AND j_title LIKE '%$j_title%'";
}

if($status != "")
{
$where .= " AND status='$status'";
}
}

$query = mysql_query("SELECT * FROM applyers WHERE 1 $where");
?>

<!DOCTYPE html>
<html>
<head>
<title>Job Seeker Report</title>
<style>
body{
font-family:'Times New Roman';
margin-left:25%;
}

h1{
margin-top:3%;
margin-bottom:3%;
font-weight:600;
text-align:center;
color:black;
text-shadow:2px 2px 2px black;
font-family:'Times New Roman';
}

/* Search box container */
.search-box{
width:80%;
background:#e6e6e6;
padding:20px;
border:2px solid black;
border-radius:8px;
margin-bottom:20px;
}

/* first row */
.row1{
display:flex;
align-items:center;
gap:20px;
margin-bottom:15px;
}

/* second row */
.row2{
display:flex;
align-items:center;
gap:20px;
}

label{
font-weight:bold;
}

input,select{
padding:7px;
border:1px solid gray;
border-radius:5px;
width:180px;
}

button{
padding:7px 18px;
background:#0d6efd;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

/* Table */
table{
border:3px solid black;
border-collapse:collapse;
width:90%;
background:white;
}

th,td{
font-size:15pt;
border:2px solid black;
padding:8px;
text-align:center;
}

th{
font-size:20pt;    
background:grey;
color:white;
font-weight:bold;
}
</style>
</head>
<body>

<h1>Applicants Report</h1>

<!-- SEARCH BAR -->
<div class="search-box">

<form method="get">

<div class="row1">

<label>Job Seeker :</label>
<input type="text" name="jname" placeholder="Enter Name">

<label>Company :</label>
<input type="text" name="cname" placeholder="Enter Company">

</div>

<div class="row2">

<label>Job Title :</label>
<input type="text" name="j_title" placeholder="Enter Job Title">

<label>Status :</label>
<select name="status">
<option value="">All</option>
<option value="shortlisted">Shortlisted</option>
<option value="confirm">Confirmed</option>
<option value="reject">Rejected</option>
<option value="pending">Pending</option>
</select>
<button type="submit" name="search">Search</button>
</div>
</form>
</div>
<!-- REPORT TABLE -->
<table>
<tr>
<th>ID</th>
<th>Job Seeker</th>
<th>Company</th>
<th>Job Title</th>
<th>Status</th>
</tr>

<?php
$count = mysql_num_rows($query);

if($count > 0)
{
    while($row = mysql_fetch_array($query))
    {
?>
<tr>
<td><?php echo $row['a_id']; ?></td>
<td><?php echo $row['jname']; ?></td>
<td><?php echo $row['cname']; ?></td>
<td><?php echo $row['j_title']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>
<?php
}
}
else 
{
?>
<tr>
<td colspan="5" style="color:red;font-size:18pt;">No Data Found</td>
</tr>

<?php
}
?>
</table>
</body>
</html> 