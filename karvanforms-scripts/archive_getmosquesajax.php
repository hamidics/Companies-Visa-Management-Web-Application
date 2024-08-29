<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
if($_GET['searchtype']=="mosquename"){
$sql="select * from mosques";
$rs=mysql_query($sql) or die(mysql_error());
?>
<input type="text" id="search_data" name="search_data" size="30" />

<?php
}
?>
<?php
 if($_GET['searchtype']=="karvan"){
?>
<input type="text" id="search_data" name="search_data"  size='30' />
<?php
}
?>
</html>