<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


</head>


<?php
	$phonenumber=$_GET['phone'];
	
	$sql="select count(id) from vapplicants where phone='$phonenumber' ";

	$res=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($res); 
	if($row['count(id)']==0){
		echo "<input type='hidden' id='phonenum2' name='phonenum2' value=''/>";
	}else{
		echo "<input type='hidden' id='phonenum2' name='phonenum2' value='$phonenumber'/>";
		//echo $row['count(id)'];
	}
	
?>


</html>