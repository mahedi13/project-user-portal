<?php
$msgResult=''; $msgNewpass=''; $msgOldpass=''; $msgNewpassRe='';
//include("includes/header.php");
session_start();
include("includes/DatabaseConfig.php");
include("includes/Functions.php");
if(isset($_COOKIE['cookieMail']))
{
$userEmail=$_COOKIE['cookieMail'];
$result=mysqli_query($con,"SELECT first_name,last_name FROM users WHERE email='$userEmail'");
$retrive=mysqli_fetch_array($result);
$fname=$retrive['first_name'];
$lname=$retrive['last_name'];
}
else if(isset($_SESSION['mail']))
{
$userEmail=$_SESSION['mail'];
$result=mysqli_query($con,"SELECT first_name,last_name FROM users WHERE email='$userEmail'");
$retrive=mysqli_fetch_array($result);
$fname=$retrive['first_name'];
$lname=$retrive['last_name'];
}

if(isset($_POST['change']))
{
    $OldPassword = $_POST['oldPassword'];
    $NewPassword = $_POST['newPassword'];
    $NewPasswordRe = $_POST['retypeNewPassword'];

//echo $firstName;

    if($OldPassword=='')
    {
      $msgOldpass="<div class='error'>Please enter your current password</div>";
    }
    else if($NewPassword=='')
    {
      $msgNewpass="<div class='error'>Please enter a new password</div>";
    }
    else if($NewPasswordRe=='')
    {
      $msgNewpassRe="<div class='error'>Please retype new password</div>";
    }
    else if($NewPassword!= $NewPasswordRe)
    {
      $msgResult="<div class='error'><center>new password did not match</center></div>";
      $NewPassword='';
      $NewPasswordRe='';
    }
    else
    {
      $userEmail=$_SESSION['mail'];
      $result=mysqli_query($con,"SELECT first_name,password FROM users WHERE email='$userEmail'");
      $retrive=mysqli_fetch_array($result);
      $user=$retrive['first_name'];
      $retrived_Old_pass=$retrive['password'];
      $OldPassword = md5($OldPassword);
      $NewPassword=md5($NewPassword);
      if($retrived_Old_pass == $OldPassword)
      {
        mysqli_query($con, "UPDATE users SET password='$NewPassword' WHERE email='$userEmail'");
        $msgResult="<div class='Success'><center>Password has been changed for user $user</center></div>";
        $OldPassword='';
        $NewPassword='';
        $NewPasswordRe='';
      }
      else
      {
          $msgResult="<div class='error'><center>please enter correct old password</center></div>";
          $OldPassword='';
          $NewPassword='';
          $NewPasswordRe='';
      }



      }
  }
 ?>
 <html>
 <head>
 <link href ='css/bootstrap.css' rel='stylesheet' type='text/css'>
 <title>Change Password</title>
</head>
<style type="text/css">
#body-bg
{
  background-color: #efefef;
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
</style>
<body id ='body-bg'>
  <div class='container' style='background-color:#fff; padding-top: 10px; margin-bottom: 20px; margin-top: 20px;weight:1200px; height:640px'>

  <div style='weight:1200px; height:100px'>
    <div>
  <h2 align='center' style=" background-color: #18D4DF; padding-top:10px; height:70px">Welcome <?php echo ucfirst($fname)." ".ucfirst($lname)?></h2>
    </div>
    <a href='index.html'><button class="btn btn-outline-success" style='margin-right:20px'><b><font color='black'>Home Page</font></b></button></a>
    <a href='profile.php'><button class="btn btn-outline-success" style='margin-right:20px'><b><font color='black'>Your Profile</font></b></button></a>
    <a href='logout.php'><button class="btn btn-outline-success" style='float:right; margin-top:0px'><b><font color='black'>Logout (<?php echo $fname;?>)</font></b></button></a>
  </div>
  <hr>
  <div class='login-form col-md-4 offset-md-4'>
    <div class='jumbotron' style ='margin-top:20px; padding-top:20px; padding-bottom:20px'>
      <h2 align='center'>Password Change Form</h2>
      <?php
      echo $msgResult;
       ?>
      <br>
      <form method='post' enctype="multipart/form-data">


        <div class="form-group">
        <label>Old Password:</label>
        <input type="password" name='oldPassword' placeholder="enter old password.." class='form-control' value='<?php echo $OldPassword;?>'>
        <?php
        echo $msgOldpass;
         ?>
        </div>

        <div class="form-group">
        <label>New Password:</label>
        <input type="password" name='newPassword' placeholder="enter new password.." class='form-control' value='<?php echo $NewPassword;?>'>
        <?php
        echo $msgNewpass;
         ?>
        </div>


        <div class="form-group">
        <label>Retype New Password:</label>
        <input type="password" name='retypeNewPassword' placeholder="retype new password.." class='form-control' value='<?php echo $NewPasswordRe;?>'>
        <?php
        echo $msgNewpassRe;
         ?>
        </div>


        <center>
        <input type='submit' value='Change Password' name='change' class='btn btn-success' />
        </center>
    </form>

</div>
</div>
</div>
</body>
</html>
