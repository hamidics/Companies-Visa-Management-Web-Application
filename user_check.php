<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


</head>


<?php
	$user_name=$_GET['user_name'];
	$sql="Select user_name from users where user_name ='$user_name'";
	$res=mysql_query($sql) or die(mysql_error());
	    while($row=mysql_fetch_array($res)){
				 if($user_name == $row['user_name']){
				   echo"<div id='fail' class='info_div' align right><span class='ico_cancel'>این نام کاربری قبلا گرفته شده است</span></div>";
				echo"
				<input type='hidden' name='user_exist' value='$user_name'/>";
				}
		   }
?>


</html>