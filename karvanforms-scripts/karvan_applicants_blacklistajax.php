<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

<table width="100%" style="background:blue; color:white" >
</head>
<?php
$appid=$_GET['applicantid'];
$karvanid=$_GET['karvanid'];
echo $karvanid;
?>
<tr align="center">
<td>دلیل انتقال به لیست سیاه:<input type="text" size="38" name="details" id="details" class="validate[required]"/>
تاریخ:<input type="text" name="cdate" id="cdate" size="12"  class="validate[required,custom[date]]"/>
<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('cdate', this);"/>

<input type="submit" name="accept" value="تایید" id="submit" class="submit"/>
<input type="button" name="cancel" onclick="window.open('karvan_applicants.php?kid=<?php echo $karvanid;?>','_parent')" value="انصراف" />
</td>
</tr>
</table>
<?php
echo $karvanid;
$sql="select name, passport_no from applicants where id='$appid'";
$rs=mysql_query($sql) or die (mysql_error());
$rw=mysql_fetch_array($rs);
?>
<input type="hidden" name="appid" value="<?php echo $appid;?>"/>
<input type="hidden" name="appname" value="<?php echo $rw['name'];?>"/>
<input type="hidden" name="apppass" value="<?php echo $rw['passport_no'];?>"/>
<input type="hidden" name="karvan_id" value="<?php echo $karvanid;?>"/>

</html>