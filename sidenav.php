
<html>
    <head>
        <title> Job Seeker Dashboard </title>
        <link rel="stylesheet" href="panel.css">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
        <script src="../jquery.min.js"></script>
        <style>
            body{font-family:'Times New Roman';
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
    width: 70%;
    margin-left: 25%;
    background: #f5f5f5;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    margin-top: 30px;
}
        </style>
    </head>
    <body>
    <div class="sidebar">
                <img src="../profile.png" alt="Profile Picture" style="width: 50px; border-radius: 50%;">
                <span id="n1" name="n1">Welcome, <?php echo $_SESSION['user']; ?></span> <br><br>
                <a href="j_dashboard.php"class='text-white'><i class="fa-solid fa-house-user"></i></a>
                <br>
                <div class="menu"><a href="j_profile.php"><b>Profile</b></a></div>
                <br>
                <div class="menu"><a href="search.php"><b> Search Job </b></a></div>
                <br>
                <div class="menu"><a href="ajob_list.php"><b> View Interview </b></a></div>
                <br>
                <div class="menu"><a href="logout.php"><b>Logout</b></a></div>
        </div>
    </body>
</html>