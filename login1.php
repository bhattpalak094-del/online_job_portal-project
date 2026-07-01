<?php
session_start();
include 'db.php';
  $Uname = $_POST['uname'];
  $Password = $_POST['pwd'];
  $sql= "SELECT * FROM `user` WHERE username = '$Uname' AND password = '$Password'";
  $result = mysql_query($sql,$con);

  if(mysql_num_rows($result)>0){
    $user = mysql_fetch_assoc($result);
    //if (password_verify($Password, $user['password'])){}
    $_SESSION['user'] = $Uname;
    $_SESSION['role'] = $user['role'];
    if($user['role']=='job_seeker'){
                        // Check if jobseeker is approved
      $status = "SELECT status FROM job_seeker WHERE username = '$Uname' AND status = 'Approved'";
      $status_result = mysql_query($status, $con);
      if (mysql_num_rows($status_result) > 0) {
                       // Jobseeker is approved, redirect to their dashboard
      echo"
      <script>
      alert('Login Successfully');
      window.location.href='Job Seeker/j_dashboard.php';
      </script>
      ";
      }else{
                      // Jobseeker is not approved or has been rejected
         echo "
         <script>
         alert('You are currently not Approved Or You are Rejected.');
         window.location.href='login.php';
         </script>
         ";
      }
    }
    elseif($user['role']=='employer'){
       // $_SESSION['user'] = $Uname;
                      // Check if employer is approved
      $status = "SELECT status FROM employer WHERE username = '$Uname' AND status = 'Approved'";
      $status_result = mysql_query($status, $con);
      if (mysql_num_rows($status_result) > 0) {
                    // Employer is approved, redirect to their dashboard
      echo"
      <script>
      alert('Login Successfully');
      window.location.href='company/cdashboard.php';
      </script>
      ";
    }else{
                   // Employer is not approved or has been rejected
      echo "
      <script>
      alert('You are currently not Approved Or You are Rejected.');
      window.location.href='login.php';
      </script>
      ";
  }
    }
    elseif($user['role']=='admin'){
      $_SESSION['admin'] = $Uname;
      echo"
      <script>
      alert('Login Successfully');
      window.location.href='admin/a_dashboard.php';
      </script>
      ";
    }
    else{
      echo"
      <script>
      alert('Invalid username/password');
      window.location.href='login.php';
      </script>
      ";
    }
}
else{
    echo"
    <script>
    alert('User not found');
    window.location.href='login.php';
    </script>
    ";
}
?>