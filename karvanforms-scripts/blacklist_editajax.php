<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
$sq="select * from blacklist where id='$_GET[applicantid]'";
$rs=mysql_query($sq) or die (mysql_error());
$rw=mysql_fetch_array($rs);

?>
<table width="100%" style="background-color:blue">
<tr>
<td align="center" style="color:white">

تاریخ ورود به لیست سیاه:<input type="text" name="cdate" id="cdate" size="10" value="<?php echo $rw['created_at'];?>" class="validate[required,custom[date]]"/>
<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('cdate', this);"/>
<input type="text" name="appname" id="appname" class="validate[required]" value="<?php echo $rw['name'];?>" />
<input type="text" name="apppass" id="apppass" class="validate[required]" size="12"  value="<?php echo $rw['passport_no'];?>" />
<input type="text" name="appdetails" id="appdetails" size="35" class="validate[required]" value="<?php echo $rw['details'];?>" />
<input type="submit" name="acceptedit" value="تایید ویرایش" id="submit" class="submit"/>
<input type="button" name="cancel" onclick="window.open('blacklist.php','_parent')" value="انصراف" />
<input type="hidden" name="app_id" value="<?php echo $_GET['applicantid'];?>"/>
</td>
</tr>
</table>

</html>
