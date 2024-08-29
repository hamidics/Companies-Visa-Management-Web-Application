<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
$sq="select * from source_parents where id='$_GET[coid]'";
$rs=mysql_query($sq) or die (mysql_error());
$rw=mysql_fetch_array($rs);

?>
<table width="100%" style="background-color:blue">
<tr align="center">
	
<td>
<input type="text" name="editetehadiename" id="editetehadiename" size="17" value="<?php echo $rw['name'];?>" class="validate[required]"/>
</td>

<td>
<input type="submit" name="acceptetehadieedit" value="تایید ویرایش" id="submit" class="submit"/>
<a href="companies.php"><input type="button" name="cancel" value="انصراف" /></a>

<input type="hidden" name="etehadieid" value="<?php echo $_GET['coid'];?>"/>
</td>
<td></td>
</tr>
</table>

</html>