<?php 
include '../db.php';
                  //Approve Employers
if(isset($_GET['Id']) && isset($_GET['Astatus'])){
    $id = intval($_GET['Id']);
    $astatus = mysql_real_escape_string($_GET['Astatus']);
    $result ="UPDATE job_seeker SET status='$astatus' WHERE j_id = '$id'";
    if(mysql_query($result)){
        echo"
        <script>
        alert('Approved Successfully');
        window.location.href='juser.php';
        </script>
        ";
}
else{
    echo"
        <script>
        alert('Unable to Approve');
        window.location.href='juser.php';
        </script>
        ";
}
}
                    // Reject Employers
if(isset($_GET['Id']) && isset($_GET['Rstatus'])){
    $id = intval($_GET['Id']);
    $rstatus = mysql_real_escape_string($_GET['Rstatus']);
    $result ="UPDATE job_seeker SET status='$rstatus' WHERE j_id = '$id'";
    if(mysql_query($result)){
        echo"
        <script>
        alert('Rejected Successfully');
        window.location.href='juser.php';
        </script>
        ";
}
else{
        echo"
            <script>
            alert('Unable to Reject');
            window.location.href='juser.php';
            </script>
            ";
}
}
?>