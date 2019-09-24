<?php
//include("includes/header.php");
session_start();
include("includes/DatabaseConfig.php");
include("includes/Functions.php");

if(logged_in())
{
  header("location:Login.php");
}
if(isset($_COOKIE['cookieMail']))
{
$userEmail=$_COOKIE['cookieMail'];
$result=mysqli_query($con,"SELECT first_name,last_name,address,phone,email,birthdate FROM users WHERE email='$userEmail'");
$retrive=mysqli_fetch_array($result);
$fname=$retrive['first_name'];
$lname=$retrive['last_name'];
$Address=$retrive['address'];
$Phone=$retrive['phone'];
$Email=$retrive['email'];
$Birthdate=$retrive['birthdate'];
?>
<html>
<head>
<link href ='css/bootstrap.css' rel='stylesheet' type='text/css'>
<title>Profile page</title>
<style>
#body-bg
{
  background-color: #efefef;
}
</style>
</head>
<body id='body-bg'>

<div class='container' style='background-color:#fff; padding-top: 10px; margin-bottom: 20px; margin-top: 20px;weight:1200px; height:640px'>

<div style='weight:1200px; height:100px'>
  <div>
<h2 align='center' style=" background-color: #18D4DF; padding-top:10px; height:70px">Welcome <?php echo ucfirst($fname)." ".ucfirst($lname)?></h2>
  </div>
  <a href='index.html'><button class="btn btn-outline-success" style='margin-right:20px'><b><font color='black'>Home Page</font></b></button></a>
  <a href='logout.php'><button class="btn btn-outline-success" style='float:right; margin-top:0px'><b><font color='black'>Logout (<?php echo $fname;?>)</font></b></button></a>
</div>
<hr>

<div class='login-form col-md-4 offset-md-4'>
<div class='jumbotron' style ='margin-top:30px; padding-top:20px; padding-bottom:5px'>
<div class="form-group">
<center><font color='green'><h3>Your Profile</h3></font></center>
<br>
<label>First Name : <?php echo $fname; ?></label>
<br>
<label>Last Name  : <?php echo $lname; ?></label>
<br>
<label>Address : <?php echo $Address; ?></label>
<br>
<label>Phone      : <?php echo $Phone; ?></label>
<br>
<label>Email      : <?php echo $Email; ?></label>
<br>
<label>Birthdate  : <?php echo $Birthdate; ?></label>
<center><a href='PasswordChange.php'><u>Change Password?</u></a></center>
</div>
</div>
</div>

 </div>

</body>
</html>
<?php
}
else if(isset($_SESSION['mail']))
{
    $userEmail=$_SESSION['mail'];
    $result=mysqli_query($con,"SELECT first_name,last_name,address,phone,email,birthdate FROM users WHERE email='$userEmail'");
    $retrive=mysqli_fetch_array($result);
    $fname=$retrive['first_name'];
    $lname=$retrive['last_name'];
    $Address=$retrive['address'];
    $Phone=$retrive['phone'];
    $Email=$retrive['email'];
    $Birthdate=$retrive['birthdate'];
    ?>
    <html>
    <head>
    <link href ='css/bootstrap.css' rel='stylesheet' type='text/css'>
    <title>Profile page</title>
    <style>
    #body-bg
    {
      background-color: #efefef;
    }

    </style>
    </head>
    <body id='body-bg'>

    <div class='container' style='background-color:#fff; padding-top: 10px; margin-bottom: 20px; margin-top: 20px;weight:1200px; height:640px'>

    <div style='weight:1200px; height:100px'>
      <div>
    <h2 align='center' style=" background-color: #18D4DF; padding-top:10px; height:70px">Welcome <?php echo ucfirst($fname)." ".ucfirst($lname)?></h2>
      </div>
      <a href='index.html'><button class="btn btn-outline-success" style='margin-right:20px'><b><font color='black'>Home Page</font></b></button></a>
      <a href='logout.php'><button class="btn btn-outline-success" style='float:right; margin-top:0px'><b><font color='black'>Logout (<?php echo $fname;?>)</font></b></button></a>
   </div>
   <hr>

   <div class='login-form col-md-4 offset-md-4'>
   <div class='jumbotron' style ='margin-top:30px; padding-top:20px; padding-bottom:5px'>
   <div class="form-group">
     <center><font color='green'><h3>Your Profile</h3></font></center>
     <br>
  <label>First Name : <?php echo ucfirst($fname); ?></label>
  <br>
  <label>Last Name  : <?php echo ucfirst($lname); ?></label>
  <br>
  <label>Address : <?php echo ucfirst($Address); ?></label>
  <br>
  <label>Phone      : <?php echo $Phone; ?></label>
  <br>
  <label>Email      : <?php echo $Email; ?></label>
  <br>
  <label>Birthdate  : <?php echo $Birthdate; ?></label>
  <center><a href='PasswordChange.php'><u><b>Change Password?</b></u></a></center>
  </div>
  </div>
  </div>

     </div>

    </body>
    </html>
<?php
}
?>
