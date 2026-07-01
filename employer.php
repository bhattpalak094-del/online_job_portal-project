<?php
include 'navigation.php';
include "../db.php"; 
$where = "";

// SEARCH FILTER
if(isset($_GET['search']))
{
    $location  = mysql_real_escape_string($_GET['location']);
    $job_title = mysql_real_escape_string($_GET['job_title']);

    if($location != "")
    {
        $where .= " AND m.location='$location'";
    }

    if($job_title != "")
    {
        $where .= " AND m.j_title='$job_title'";
    }
}

// MAIN QUERY
$query = mysql_query("
SELECT 
m.cname,
COUNT(DISTINCT m.job_id) AS total_jobs,
SUM(CASE WHEN a.status='shortlisted' THEN 1 ELSE 0 END) AS selected_count,
SUM(CASE WHEN a.status='confirm' THEN 1 ELSE 0 END) AS confirmed_count,
SUM(CASE WHEN a.status='reject' THEN 1 ELSE 0 END) AS rejected_count
FROM manage_job m
LEFT JOIN applyers a 
ON m.job_id = a.job_id
WHERE 1 $where
GROUP BY m.cname
") or die(mysql_error());

$company = [];
$jobs = [];
$selected = [];
$confirmed = [];
$rejected = [];

while($row = mysql_fetch_array($query))
{
    $company[] = $row['cname'];
    $jobs[] = $row['total_jobs'];
    $selected[] = $row['selected_count'];
    $confirmed[] = $row['confirmed_count'];
    $rejected[] = $row['rejected_count'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Company Activity Report</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

form{
margin-bottom:30px;
}

input{
padding:5px;
margin-right:10px;
}

button{
padding:8px 15px;
background:#007bff;
color:white;
border:none;
cursor:pointer;
}

#companychart{
width:80%;
max-width:900px;
padding:10px;
background:lightgray;
border-radius:10px; 
height:600px;
margin:0 auto;
}
canvas{
max-width:900px;
padding:10px;
background:lightgray;
border-radius:8px;  
}

#downloadbtn{
display:block;
margin:20px auto;
padding:10px 20px;
font-size:16px;
cursor:pointer;
}

</style>
</head>
<body>

<h1>Company Activity Report</h1>

<!-- SEARCH BAR -->

<form method="get">

<b>Location :</b>
<input type="text" name="location" placeholder="Enter Location">

<b>Job Title :</b>
<input type="text" name="job_title" placeholder="Enter Job Title">
<button type="submit" name="search">Search</button>
</form>

<!-- GRAPH -->

<canvas id="companyChart"></canvas>
<button id="downloadbtn">Download Report</button>
<script>
var ctx = document.getElementById("companyChart").getContext("2d");

var companyChart = new Chart(ctx,{
type:'bar',

data:{
labels: <?php echo json_encode($company); ?>,

datasets:[

{
label:'Total Jobs Posted',
data: <?php echo json_encode($jobs); ?>,
backgroundColor:'darkblue',
borderColor:'grey',
borderWidth:3
},

{
label:'Applicants Selected',
data: <?php echo json_encode($selected); ?>,
backgroundColor:'blue',
borderColor:'grey',
borderWidth:3
},

{
label:'Applicants Confirmed',
data: <?php echo json_encode($confirmed); ?>,
backgroundColor:'green',
borderColor:'grey',
borderWidth:3
},

{
label:'Applicants Rejected',
data: <?php echo json_encode($rejected); ?>,
backgroundColor:'red',
borderColor:'grey',
borderWidth:3
}

]
},

options:{
responsive:true,
plugins:{
legend:{
position:'top'
}
}
}
});

// DOWNLOAD REPORT

document.getElementById('downloadbtn').addEventListener('click',function(){
var url = companyChart.toBase64Image();
var link = document.createElement('a');
link.href = url;
link.download = 'Company_Report.png';
link.click();
});
</script>
</body>
</html>