<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>

<select id="getkarvan" name="getkarvan" width="200px" required>
<option value="">انتخاب کاروان</option>
<?php

$mosque_id=$_GET['mosque_id'];
$sql="select id, code, mosque_id from karvan where mosque_id='$mosque_id'";
$res=mysql_query($sql) or die (mysql_error());
while($row=mysql_fetch_array($res)){
	$sq="select name from mosques where id='$row[mosque_id]'";
	$rs=mysql_query($sq) or die (mysql_error());
	$rw=mysql_fetch_array($rs);
	echo "<option value='$row[id]'>$rw[name] ($row[code])</option>";
}
?>
</select>

</html>