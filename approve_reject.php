<?php
include 'navigation.php';
include '../db.php';

// SQL query to fetch the number of approved, rejected and pending job seekers and employers
$sql = "
    SELECT 
        'Job Seekers' AS category, 
        SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) AS approved,
        SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
        SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending
    FROM job_seeker
    UNION
    SELECT 
        'Employers' AS category, 
        SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) AS approved,
        SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
        SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending
    FROM employer;
";

// Execute the query
$result = mysql_query($sql, $con);

// Arrays to hold the categories, approved counts, rejected counts and pending counts
$categories = [];
$approved = [];
$rejected = [];
$pending = [];

if ($result) {
    while ($row = mysql_fetch_assoc($result)) {
        $categories[] = $row['category'];
        $approved[] = $row['approved'];
        $rejected[] = $row['rejected'];
        $pending[] = $row['pending'];
    }
} else {
    echo "Query failed: " . mysql_error();
}

// Close the connection
mysql_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Job Portal Status Report</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
font-family:'Times New Roman';
margin-left:15%;
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

#statuschart{
width:80%;
max-width:900px;
padding:10px;
background:lightgray;
border-radius:10px; 
height:600px;
margin:0 auto;
}

button{
display:block;
margin:20px auto;
padding:10px 20px;
font-size:16px;
cursor:pointer;
}
</style>
</head>
<body>
<h1>Job Portal Registration Status Report</h1>
<canvas id="statuschart"></canvas>
<button id="downloadbtn">Download Report</button>
<script>

var categories = <?php echo json_encode($categories); ?>;
var approved = <?php echo json_encode($approved); ?>;
var rejected = <?php echo json_encode($rejected); ?>;
var pending = <?php echo json_encode($pending); ?>;

var ctx = document.getElementById('statuschart').getContext('2d');

var jobPortalStatusChart = new Chart(ctx, {
type: 'bar',

data:{
labels: categories,

datasets:[
{
label:'Approved',
data:approved,
backgroundColor:'green',
borderColor:'black',
borderWidth:2
},
{
label:'Rejected',
data:rejected,
backgroundColor:'red',
borderColor:'black',
borderWidth:2
},
{
label:'Pending',
data:pending,
backgroundColor:'orange',
borderColor:'black',
borderWidth:2
}
]
},

options:{
responsive:true,
scales:{
y:{
beginAtZero:true
}
},
plugins:{
legend:{display:true}
}
}

});

// Download chart
document.getElementById('downloadbtn').addEventListener('click',function(){
var url = jobPortalStatusChart.toBase64Image();
var link = document.createElement('a');
link.href = url;
link.download = 'JobPortal_StatusReport.png';
link.click();
});
</script>
</body>
</html>