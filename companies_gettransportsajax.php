<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>

<?php

if($_GET['cotype']==3){
	$sql="select id, name from sources where type='$_GET[cotype]' order by name asc";
	$rs=mysql_query($sql) or die (mysql_error());
	echo "<select name='searchdata1' id='searchdata1'>
<option value='%'>انتخاب شرکت ترانسپورتی</option>";
	while($rw=mysql_fetch_array($rs)){
		echo "<option value='$rw[id]'>$rw[name]</option>";
	}
	echo "</select>";
}else{
	echo "نام شرکت یا صنف<input type='text' id='searchdata1'  name='searchdata1'/>";
}
?>

</html>