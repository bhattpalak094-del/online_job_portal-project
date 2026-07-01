<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link rel="stylesheet" href="css/navigation.css">
<link rel="stylesheet" href="css/log.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>

<!-- ===== BLUR BACKGROUND ===== -->
<div class="bg-layer"></div>
<div class="bg-overlay"></div>

<!-- ===== NAVIGATION BAR ===== -->
<div class="menu-bar">
    <ul>
        <li><a href="home.php">HOME</a></li>

        <li><a href="#">REGISTRATION</a>
            <div class="sub-menu-1">
                <ul>
                    <li><a href="./job seeker/eregistration.php">JobSeeker</a></li>
                    <li><a href="./company/cregistration.php">Employer</a></li>
                </ul>
            </div>
        </li>

        <li><a href="login.php">LOGIN</a></li>
          <li><a href="admin/n_display.php">LATEST NEWS</a></li>
        <li><a href="aboutus.php">ABOUT US</a></li>
    </ul>
</div>

<!-- ===== LOGIN SECTION ===== -->
<section>
<div class="login-box">
<form action="login1.php" method="POST" autocomplete="off">

<h2>LOGIN</h2>

<div class="input-box">
<span class="icon">
<i class="fa-solid fa-circle-user"></i>
</span>
<input type="text" name="uname" required autocomplete="off">
<label>USERNAME</label>
</div>

<div class="input-box">
<span class="icon">
<i class="fa-solid fa-lock"></i>
</span>
<input type="password" name="pwd" required autocomplete="off">
<label>PASSWORD</label>
</div>

<div class="remember-forgot">
<label><input type="checkbox"> Remember me</label>
<a href="forget_password.php">Forgot Password?</a>
</div>

<button type="submit">Login</button>

</form>
</div>
</section>

</body>
</html>