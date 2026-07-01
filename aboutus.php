<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
       <link rel="stylesheet" href="css/navigation.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

    <style>
        
    
        /* ===== ABOUT US CONTENT ===== */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .header-image {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-image img {
            max-width: 40%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .box {
            border: 3px solid #0d6efd;
            padding: 25px;
            background-color: #1e1e2f; /* dark background */
            color: white;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        /* Optional: add slight bounce on hover */
        .box:hover {
            transform: translateY(-5px);
        }

        .box h3 {
            font-size: 18px;
            line-height: 1.6;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width:768px) {
            .menu-bar ul {
                flex-direction: column;
            }
            .menu-bar ul li {
                width: 100%;
                margin: 5px 0;
            }
            .header-image img {
                max-width: 70%;
            }
        }
    </style>
</head>
<body>
    <!-- BACKGROUND LAYERS -->
    <div class="bg-layer"></div>
    <div class="bg-overlay"></div>

    <!-- ===== NAVIGATION BAR ===== -->
    <div class="menu-bar">
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="#">REGISTRATION</a>
                <div class="sub-menu-1">
                    <ul>
                        <li><a href="job seeker/eregistration.php">JobSeeker</a></li>
                        <li><a href="company/cregistration.php">Employer</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="login.php">LOGIN</a></li>
            <li><a href="admin/n_display.php">LATEST NEWS</a></li>
            <li><a href="aboutus.php">ABOUT US</a></li>
        </ul>
    </div>

    <!-- ===== ABOUT US CONTENT ===== -->
    <div class="container">
        <div class="header-image">
            <img src="about.png" alt="Job Portal">
        </div>

        <div class="box">
            <h3>Welcome to the Online Job Portal. It provides facilities to Job Seekers to search for various jobs. Here, Job Seekers can register on the web portal and create their profile along with educational information. Job Seekers can search for jobs and apply for them.</h3>
        </div>

        <div class="box">
            <h3>This portal is also designed for employers who need to recruit employees. Employers can register on the portal and upload information about job vacancies. Employers can view applications from Job Seekers and send call letters to candidates.</h3>
        </div>
    </div>
</body>
</html>