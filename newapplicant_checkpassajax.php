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
	$sql="";
	if($_GET['appid']=="" || $_GET['appid']==0){
	$sql="select count(vapplicants.id), count(visa_history.id),visa_history.passportnum, vapplicants.passportnum from vapplicants, visa_history where visa_history.applicant_id=vapplicants.id and  (visa_history.passportnum='$passport' || vapplicants.passportnum='$passport') ";
	
	}else{
	$sql="select count(vapplicants.id), count(visa_history.id),visa_history.passportnum, vapplicants.passportnum from vapplicants, visa_history where visa_history.applicant_id=vapplicants.id and vapplicants.id!='$_GET[appid]' and  (visa_history.passportnum='$passport' || vapplicants.passportnum='$passport') ";
	}
	$res=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($res); 
	if($row['count(vapplicants.id)']==0 and $row['count(visa_history.id)']==0){
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