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
	<th>نام اتحادیه</th>
	<?php
	}
	?>
	<th>شماره تماس</th>
	<?php 
	if($_GET['etehadie']==1){
	?>
	<th>نام رئیس</th>
	<?php
	}
	?>
	<th>آدرس</th>
	<th></th>
	<th></th>
</tr>
<tr align="center">
<?php
if($rw['type']==2){
?>
<td >
<input type="text" name="editcode" id="editcode" size="12" value="<?php echo $rw['code'];?>" class="validate[required]"/>
</td>
<?php
}

?>
<td>
<input type="text" name="editname" id="editname" size="18" value="<?php echo $rw['name'];?>" class="validate[required]"/>
</td>
<?php
if($rw['type']==2 || $rw['type']==3){
?>

<td>
<input type="text" name="editjob" id="editjob" size="15" value="<?php echo $rw['activity_background'];?>" class="validate[required]"/>
</td>
<?php
}
?>
<td>
<input type="text" name="editphone" id="editphone" size="17" value="<?php echo $rw['phonenum'];?>" class="validate[required]"/>
</td>
<?php
if($_GET['etehadie']==1){
?>
<td>
<input type="text" name="editboss" id="editboss" size="17" value="<?php echo $rw['bossname'];?>" class="validate[required]"/>
</td>
<?php
}
?>
<td>
<input type="text" name="editaddress" id="editaddress" size="18" value="<?php echo $rw['address'];?>" class="validate[required]"/>
</td>
<td>
<?php
if($_GET['etehadie']!=1){
?>
<input type="submit" name="acceptedit" value="تایید ویرایش" id="submit" class="submit"/>
<input type="button" name="cancel" onclick="window.open('companies.php','_parent')" value="انصراف" />
<?php
}else{
?>
<input type="submit" name="acceptedit2" value="تایید ویرایش" id="submit" class="submit"/>
<input type="button" name="cancel2" onclick="window.open('companies.php#tabs-2','_parent')" value="انصراف" />
<?php
}
?>


<input type="hidden" name="companyid" value="<?php echo $_GET['coid'];?>"/>
</td>
<td></td>
</tr>
</table>

</html>