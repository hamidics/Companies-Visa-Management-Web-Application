<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
$sq="select * from visa_history where id='$_GET[editid]'";
$rs=mysql_query($sq) or die (mysql_error());
$rw=mysql_fetch_array($rs);

?>
<table width="100%" style="background-color:blue">
<tr>

	<th>تاریخ مراجعه</th>
	<th>ارجعیت</th>
	<th>شماره روادید</th>
	<th>تاریخ صدور </th>
	<th>توضیح</th>
	<th></th>

</tr>
<tr align="center">

<td>
<input type="text" name="editrdate" id="editrdate" size="9" value="<?php echo $rw['requestdate'];?>" class="validate[required,custom[date]" />
<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('editrdate', this);"/>

</td>
<td>
<input type="text" name="editarjaeet" id="editarjaeet" size="14" value="<?php echo $rw['arjaeet'];?>" />
</td>
<td>
<input type="text" name="editvnum" id="editvnum" size="25" value="<?php echo $rw['visanumber'];?>" />
</td>
<td>
<input type="text" name="editvissue" id="editvissue" size="9" value="<?php echo $rw['visaissuedate'];?>"  />
</td>
<td>
<input type="text" name="editdetail" id="editdetail" size="30" value="<?php echo $rw['details'];?>"  />
</td>
<td>
<input type="hidden" name="profileid" value="<?php echo $_GET['profilenum'];?>"/>
<input type="hidden" name="resumeid" value="<?php echo $_GET['editid'];?>"/>
<input type="submit" name="acceptresumeedit" value="تایید ویرایش" id="submit" class="submit"/>
<input type="submit" name="cancelresumeedit" value="انصراف" />


</td>
</tr>
</table>

</html>