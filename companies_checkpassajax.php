<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


</head>


<?php
	$passport=$_GET['passnumber'];
	$status=0;
	$sql="select count(vapplicants.id) as cid from vapplicants, visa_history where ( visa_history.passportnum='$passport' || vapplicants.passportnum='$passport') and vapplicants.id=visa_history.applicant_id and vapplicants.source_id!='$_GET[sourceid]' ";
	$res=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($res); 
	if($row['cid']==0){
		$status=1;
		echo "<input type='hidden' name='userstatus' value='$status'/>";
		echo "<input type='hidden' id='user' name='user' value=''/>";
	}else{
		$status=0;
		echo "<input type='hidden' name='userstatus' value='$status'/>";
		echo "<input type='hidden' id='passportnum2' name='passportnum2' value='$passport'/>";
	}
	
?>


</html>