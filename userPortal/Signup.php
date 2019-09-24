<?php
$msgFN=''; $msgLN=''; $msgPh=''; $msgEmailAvail=''; $msgSuccess=''; $msgAdd=''; $msgEmail='';$msgdob=''; $msgPass='';
include("includes/DatabaseConfig.php");
include("includes/Functions.php");
if(isset($_POST['submit']))
{
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $userAddress = $_POST['Address'];
    $userPhone = $_POST['Phone'];
    $userEmail = $_POST['Email'];
    $userBirthday = $_POST['Birthday'];
    $userPassword = $_POST['Password'];
    $userRetypePassword = $_POST['RetypePassword'];

//echo $firstName;

    if($firstName=='')
    {
      $msgFN="<div class='error'>Please enter a first name</div>";
    }
    else if($lastName=='')
    {
      $msgLN="<div class='error'>Please enter a last name</div>";
    }
    else if($userAddress=='')
    {
      $msgAdd="<div class='error'>Please enter address</div>";
    }
    else if(empty($userPhone))
    {
      $msgPh="<div class='error'>Please enter a phone number</div>";
    }
    else if(!filter_var($userEmail,FILTER_VALIDATE_EMAIL))
    {
      $msgEmail="<div class='error'>Please enter valid email</div>";
    }
    else if(empty($userBirthday))
    {
      $msgdob="<div class='error'>Please enter date of birth</div>";
    }
    else if($userPassword!= $userRetypePassword)
    {
      $msgPass="<div class='error'>password is not same</div>";
    }
    else
    {
        $userPassword = md5($userPassword);
        mysqli_query($con, "INSERT INTO users
        (first_name,last_name,address,phone,email,birthdate,password)
        VALUES ('$firstName','$lastName','$userAddress','$userPhone','$userEmail','$userBirthday','$userPassword') ");
        $msgSuccess= "<div class='success'><center>Registration Successful</center></div>";
        //sleep(3);
        $firstName = '';
        $lastName = '';
        $userAddress = '';
        $userPhone = '';
        $userEmail = '';
        $userBirthday = '';
        $userPassword = '';
        $userRetypePassword = '';
        //header("location:Login.php");
    }




  }
 ?>
 <html>
 <head>
 <link href ='css/bootstrap.css' rel='stylesheet' type='text/css'>
 <title> Registration Form</title>
 <script src="jquery/jquery.min.js"></script>
 <script>
function checkemailAvailability() {

jQuery.ajax({
url: "email_availability_jquery_ajax.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
  if(data== '-1')
  {
    $("#email-availability-status").html("<span></span>");
    $("#submit").show();
  }
  else if(data >'0'){
$("#email-availability-status").html("<span style='color:red'> Email Already Exist .</span>");
$("#submit").hide();
}
else{
$("#email-availability-status").html("<span style='color:green'> Email Available .</span>");
$("#submit").show();
}

},
error:function (){}
});
}
</script>
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
</style>
<body id ='body-bg'>
  <div class='jumbotron' style ='margin-top:0px; padding-top:20px; padding-bottom:20px'>
  <a href='index.html'><button class="btn btn-outline-success" style='margin-right:20px'><b><font color='black'>Home Page</font></b></button></a>
  <a href='Login.php'><button class="btn btn-outline-success" style='margin-right:20px'><b><font color='black'>User Login</font></b></button></a>
  <a href='admin.php'><button class="btn btn-outline-success" style='margin-top:0px'><b><font color='black'>Admin Login</font></b></button></a>
</div>
<div class="container">
  <div class='login-form col-md-4 offset-md-4'>
    <div class='jumbotron' style ='margin-top:20px; padding-top:20px; padding-bottom:20px'>
      <h2 align='center'>Registration Form</h2>
      <?php
      echo $msgSuccess;
       ?>
      <br>
      <form method='post' enctype="multipart/form-data">

        <div class="form-group">
        <label>First Name:</label>
        <input type="text" name='fName' placeholder="input first name.." class='form-control' value='<?php echo $firstName;?>'>
        <?php
        echo $msgFN;
         ?>
        </div>

        <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name='lName' placeholder="input last name.." class='form-control' value='<?php echo $lastName;?>'>
        <?php
        echo $msgLN;
         ?>
        </div>

        <div class="form-group">
        <label>Address:</label>
        <input type="text" name='Address' placeholder="input address.." class='form-control' value='<?php echo $userAddress;?>'>
        <?php
        echo $msgAdd;
         ?>
       </div>

        <div class="form-group">
        <label>Phone:</label>
        <input type="text" name='Phone' placeholder="input phone number.." class='form-control' value='<?php echo $userPhone;?>'>
        <?php
        echo $msgPh;
         ?>
      </div>

        <div class="form-group">
        <label>Email:</label>
        <input type="email" name='Email' placeholder="input email.." id="emailid" onBlur="checkemailAvailability()" class='form-control' value='<?php echo $userEmail;?>' required />
        <span id="email-availability-status"></span>
        <?php
        echo $msgEmail;
        echo $msgEmailAvail;
         ?>
        </div>

        <div class="form-group">
        <label>Birthday:</label>
        <input type="date" name='Birthday' placeholder="input Birthday.." class='form-control' value='<?php echo $userBirthday;?>'>
        <?php
        echo $msgdob;
         ?>
        </div>

        <div class="form-group">
        <label>Password:</label>
        <input type="password" name='Password' placeholder="input password.." class='form-control' value='<?php echo $userPassword;?>'>
        <?php
        echo $msgPass;
         ?>
        </div>

        <div class="form-group">
        <label>Retype Password:</label>
        <input type="password" name='RetypePassword' placeholder="Retype password.." class='form-control'>
        </div>

        <center>
        <input type='submit' value='Register' name='submit' id="submit" class='btn btn-success' />
      </center>
      <br>
      <center><a href='Login.php'><u>Already Registered?</u></a></center>
    </form>

</div>
</div>
</div>
</body>
</html>
