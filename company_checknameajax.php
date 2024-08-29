<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


</head>


<?php
	$comcode=$_GET['comcode'];
	$status=0;
	$sql="";
	$sql="select count(id) from sources where code='$comcode'";
	$rescount=mysql_query($sql) or die (mysql_error());
	$rwcount=mysql_fetch_array($rescount);
	echo $rwcount['count(id)'];
	if($rwcount['count(id)']>=1){
		echo "<input type='hidden' id='companycode' name='companycode' value='$comcode'/>";
	}
		
	
?>


</html>