<?php
//include("includes/header.php");
session_start();
include("includes/DatabaseConfig.php");
include("includes/Functions.php");
$msgEmail=''; $msgPass=''; $msgSuccess=''; $msgError='';
if(!logged_in())
{
  header("location:profile.php");
}
if(isset($_POST['login']))
{
$userEmail=$_POST['Email'];
$userPassword=$_POST['Password'];
$checkbox = isset($_POST['check']);
if($userEmail=='')
{
$msgEmail="<div class='error'>Please enter an email</div>";
}
else if($userPassword=='')
{
$msgPass="<div class='error'>Please enter password</div>";
}
else if(login_available($userEmail, $userPassword, $con))
{
//$msgSuccess= "<div class='success'><center>Login Successful</center></div>";
$_SESSION['mail']=$userEmail;
if($checkbox=='on')
{
  setcookie('cookieMail',$userEmail,time()+20);
}
header("location:profile.php");
}
else
{
$msgError="<div class='error'><center>Email Password do not match</center></div>";
$userPassword='';
}
}
?>
<html>
<head>
<link href ='css/bootstrap.css' rel='stylesheet' type='text/css'>
<title> Login Form</title>
</head>
<style type="text/css">
#body-bg
{
  background: url("image/background.jpg")
  center no-repeat fixed;
}
.error
{
  color:red;
}
.Success
{
    color:green;
    font-weight: bold;
}
#space
{
  margin-right:50px;
}
</style>
<body id ='body-bg'>
  <div class='jumbotron' style ='margin-top:0px; padding-top:20px; padding-bottom:20px'>
  <a href='index.html'><button class="btn btn-outline-success" style='margin-right:20px'><b><font color='black'>Home Page</font></b></button></a>
  <a href='admin.php'><button class="btn btn-outline-success" style='margin-top:0px'><b><font color='black'>Admin Login</font></b></button></a>
</div>
<div class="container">
 <div class='login-form col-md-4 offset-md-4'>

   <div class='jumbotron' style ='margin-top:20px; padding-top:20px; padding-bottom:20px'>
     <h2 align='center'>Login Form</h2>
<?php echo $msgSuccess; echo $msgError; ?>
     <br>
     <form method='post'>
      <div class="form-group">
      <label>Email :</label>
      <input type='email' name='Email' placeholder='enter email..' class='form-control' value='<?php echo $userEmail;?>'/>
<?php echo $msgEmail; ?>
      </div>
      <div class="form-group">
     <label>Password :</label>
     <input type='password' name='Password' placeholder='enter password..' class='form-control' value='<?php echo $userPassword;?>'/>
<?php echo $msgPass; ?>
     </div>
     <div class="form-group">
     <input type='checkbox' name='check' />
       &nbsp;Keep me logged in
     </div>
     <center>
     <input id="space" type='submit' value='Login' name='login' class='btn btn-success' />
     <input type='submit' value='Clear' name='clear' class='btn btn-success' />
    </center>
    <br>
    <center>Are you new here? <a href='Signup.php'><u>Register Now!</u></a></center>
  </form>
</div>
</div>
</div>

</body>
</html>
