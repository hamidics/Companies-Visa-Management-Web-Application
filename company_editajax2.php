<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
$sq="select * from sources where id='$_GET[coid]'";
$rs=mysql_query($sq) or die (mysql_error());
$rw=mysql_fetch_array($rs);

?>
<table width="100%" style="background-color:blue">
<tr>
	<?php
		if($rw['type']==2){
	?>
	<th>شماره ثبت</th>
	
	<?php
}	
		if($rw['type']==2 || $rw['type']==3){
	?>
	
	<th>نام شرکت</th>
	<th>زمینه فعالیت</th>
	<?php
	}else{
	?>
	<th>نام صنف</th>
	<?php
	}
	?>
	
	<th></th>
	<th></th>
</tr>
<tr align="center">
<?php
if($rw['type']==2){
?>
<td >
<input type="text" name="editcode" id="editcode" size="22" value="<?php echo $rw['code'];?>" class="validate[required]"/>
</td>
<?php
}

?>
<td>
<input type="text" name="editname" id="editname" size="22" value="<?php echo $rw['name'];?>" class="validate[required]"/>
</td>
<?php
if($rw['type']==2 || $rw['type']==3){
?>
<td>
<input type="text" name="editjob" id="editjob" size="22" value="<?php echo $rw['activity_background'];?>" class="validate[required]"/>
</td>
<?php
}
?><td>
<input type="submit" name="acceptedit" value="تایید ویرایش" id="submit" class="submit"/>
<input type="button" name="cancel" onclick="window.open('companies.php','_parent')" value="انصراف" />

<input type="hidden" name="companyid" value="<?php echo $_GET['coid'];?>"/>
</td>
<td></td>
</tr>
</table>

</html>