<?php
function email_available($userEmail,$con)
{
  $row=mysqli_query($con, "SELECT id FROM users WHERE email='$userEmail'");
{
  if(mysqli_num_rows($row)>=1)
    {
      return true;
    }
  else
  {
    return false;
  }
}
}


function login_available($userEmail, $userPassword, $con)
{

    $userPassword=md5($userPassword);
    $row=mysqli_query($con, "SELECT id FROM users WHERE email='$userEmail' and password='$userPassword'");
    {
      if(mysqli_num_rows($row)==1)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
}

function admin_available($userEmail, $userPassword, $con)
{
    $row=mysqli_query($con, "SELECT id FROM admin WHERE email='$userEmail' and password='$userPassword'");
    {
      if(mysqli_num_rows($row)==1)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
}



function logged_in()
{
  if(isset($_SESSION['mail']) || isset($_COOKIE['cookieMail']))
  {
    return false;
  }
  else
    {
      return true;
    }

}
 ?>
