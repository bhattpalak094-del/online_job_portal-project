<?php
session_start();
include "../db.php";
?>

<!DOCTYPE html>
<html ng-app="registrationApp">
<head>
<meta charset="UTF-8">
<title>Employer Registration</title>

<link rel="stylesheet" href="../css/navigation.css">
<script src="../angular-1.8.2/angular.min.js"></script>

<style>

.register-container{
    max-width:900px;
    margin:80px auto;
    padding:30px;
    border-radius:12px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow:0 8px 25px rgba(0,0,0,0.3);
    border:1px solid rgba(255,255,255,0.3);
}

.register-container h2{
    text-align:center;
    margin-bottom:25px;
}

.register-form{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

.form-group{
    width:48%;
    font-size:15pt;
}

label{
    font-weight:bold;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
    border:1px solid #ccc;
    border-radius:6px;
}

button{
    width:40%;
    margin:20px auto;
    padding:12px;
    background:#2563EB;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
    display:block;
}

button:hover{
    background:#1E40AF;
}

.error{
    color:red;
    font-weight:bold;
    font-size:13pt;
}

@media(max-width:768px){
    .form-group{
        width:100%;
    }
}

</style>
</head>

<body ng-controller="RegistrationController">

<div class="bg-layer"></div>
<div class="bg-overlay"></div>
<div class="menu-bar">
<ul>
<li><a href="../home.php">HOME</a></li>
<li><a href="#">REGISTRATION</a>
<div class="sub-menu-1">
<ul>
<li><a href="../Job Seeker/eregistration.php">JobSeeker</a></li>
<li><a href="cregistration.php">Employer</a></li>
</ul>
</div>
</li>
<li><a href="../login.php">LOGIN</a></li>
<li><a href="../admin/n_display.php">LATEST NEWS</a></li>
<li><a href="../aboutus.php">ABOUT US</a></li>
</ul>
</div>

<div class="register-container">

<h2>Employer Registration</h2>

<form action="insert-1.php" method="POST" autocomplete="off" enctype="multipart/form-data" name="registrationForm" class="register-form" novalidate>

<div class="form-group">
<label>Company Name</label>
<input type="text" name="name" ng-model="company.name" ng-required="true" ng-pattern="/^[a-zA-Z\s]*$/">
<span class="error" ng-show="registrationForm.name.$touched && registrationForm.name.$error.required">Company name required</span>
<span class="error" ng-show="registrationForm.name.$error.pattern">Only characters allowed</span>
</div>

<div class="form-group">
<label>Contact Person</label>
<input type="text" name="cperson" ng-model="company.cperson" ng-required="true" ng-pattern="/^[a-zA-Z\s]*$/">
<span class="error" ng-show="registrationForm.cperson.$touched && registrationForm.cperson.$error.required">Contact person required</span>
<span class="error" ng-show="registrationForm.cperson.$error.pattern">Only characters allowed</span>
</div>

<div class="form-group">
<label>Company Address</label>
<textarea name="address" ng-model="company.address" ng-required="true"></textarea>
<span class="error" ng-show="registrationForm.address.$touched && registrationForm.address.$error.required">Address required</span>
</div>

<div class="form-group">
<label>City</label>
<input type="text" name="city" ng-model="company.city" ng-required="true" ng-pattern="/^[a-zA-Z\s]*$/">
<span class="error" ng-show="registrationForm.city.$touched && registrationForm.city.$error.required">City required</span>
<span class="error" ng-show="registrationForm.city.$error.pattern">Only characters allowed</span>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" ng-model="company.email" ng-required="true">
<span class="error" ng-show="registrationForm.email.$touched && registrationForm.email.$error.required">Email required</span>
<span class="error" ng-show="registrationForm.email.$error.email">Invalid email</span>
</div>

<div class="form-group">
<label>Contact No</label>
<input type="text" name="phno" ng-model="company.phno" ng-required="true" ng-pattern="/^\d{10}$/">
<span class="error" ng-show="registrationForm.phno.$touched && registrationForm.phno.$error.required">Mobile number required</span>
<span class="error" ng-show="registrationForm.phno.$error.pattern">Enter 10 digit number</span>
</div>

<div class="form-group">
<label>Username</label>
<input type="text" name="username" ng-model="company.username" ng-required="true" ng-pattern="/^[a-zA-Z\s]*$/">
<span class="error" ng-show="registrationForm.username.$touched && registrationForm.username.$error.required">Username required</span>
<span class="error" ng-show="registrationForm.username.$error.pattern">Only characters allowed</span>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" ng-model="company.password" ng-required="true" ng-minlength="6" ng-maxlength="8">
<span class="error" ng-show="registrationForm.password.$touched && registrationForm.password.$error.required">Password required</span>
<span class="error" ng-show="registrationForm.password.$error.minlength">Minimum 6 characters</span>
<span class="error" ng-show="registrationForm.password.$error.maxlength">Maximum 8 characters</span>
</div>

<div class="form-group">
<label>User Type</label>
<select name="role" ng-model="company.role" ng-required="true">
<option value="">Select Type</option>
<option value="job_seeker">Job Seeker</option>
<option value="employer">Employer</option>
</select>
</div>

<div class="form-group">
<label>Legal Document Upload</label>
<input type="file" name="clegal" accept=".pdf,.doc,.docx" required>
<small><b><u>e.g(GST Certificate / Certificate of Incorporation)</u></b></small>
</div>

<div class="form-group">
<label>Company Type</label>
<select name="ctype" ng-model="company.ctype" ng-required="true">
<option value="">Select Company Type</option>
<option value="National">National</option>
<option value="International">International</option>
</select>
</div>

<div class="form-group">
<label>Company Logo</label>
<input type="file" name="clogo" accept=".jpg,.jpeg,.png" required>
</div>

<button type="submit" name="signup" ng-disabled="registrationForm.$invalid">Register</button>

</form>

</div>

<script>

var app = angular.module('registrationApp', []);

app.controller('RegistrationController', function($scope){
$scope.company = {};
});

</script>

</body>
</html>
