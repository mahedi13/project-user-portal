<?php
require_once("includes/DatabaseConfig.php");
//code check email
if(!empty($_POST["emailid"])) {
$result = mysqli_query($con,"SELECT count(*) FROM users WHERE email='" . $_POST["emailid"] . "'");
$row = mysqli_fetch_row($result);
$email_count = $row[0];
//if($email_count>0) echo "<span style='color:red'> Email Already Exist .</span>";
//else echo "<span style='color:green'> Email Available.</span>";
echo $email_count;
}
else echo -1;
?>
