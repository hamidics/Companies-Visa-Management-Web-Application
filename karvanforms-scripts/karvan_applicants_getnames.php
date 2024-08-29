<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
$sql="select *from applicants where name='$_GET[appname]'";
$res=mysql_query($sql) or die(mysql_error());
while($row=mysql_fetch_array($res)){
echo "$row[name] شماره پاسپورت: $row[passport_no] <input type='checkbox' id='chossecustomer' value='$row[id]' onclick='disable(this.id)' />";
}

?>
</html>