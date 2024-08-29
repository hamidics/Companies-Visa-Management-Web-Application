<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
$sq="select * from driver_profiles where id='$_GET[profileid]'";
$rs=mysql_query($sq) or die (mysql_error());
$rw=mysql_fetch_array($rs);

?>
<table width="100%" style="background-color:blue; color:white">
<tr>
								<td>شماره فایل<input type="text" name="nprofile_num" value="<?php echo $rw['profile_num'];?>" id="nprofile_num" class="validate[required]"/>
							
							تاریخ ایجاد
							<input type="text" name="ncreate_date" value="<?php echo $rw['created_at'];?>" id="ncreate_date" class="validate[required,custom[date]]" style="width:200px" />
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('ncreate_date', this);"/>
				<input type="submit" class="submit"  name="updateprofile" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab4"/>
				<input type="submit" class="submit"  name="cupdateprofile" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="انصراف" />
				<?php  echo "<input type='hidden' name='profileid' value='$rw[id]'/>";
echo "<input type='hidden' name='sourceid' value='$rw[source_id]'/>";				?>
				</td>
				</tr>
</table>				
</html>