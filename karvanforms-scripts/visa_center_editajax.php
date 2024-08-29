<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
$sq="select * from visa_centers where id='$_GET[cid]'";
$rs=mysql_query($sq) or die (mysql_error());
$rw=mysql_fetch_array($rs);

?>
<table width="100%" style="background-color:blue">
<tr>
<td align="center">
<input type="text" name="name" id="editmosquename" size="22" value="<?php echo $rw['name'];?>" class="validate[required]"/>
<input type="text" name="maddress" id="address" size="22" value="<?php echo $rw['address'];?>" class="validate[required]"/>
<input type="text" name="nphone" id="nphone" size="18" value="<?php echo $rw['phone'];?>" class="validate[required]"/>
<input type="text" name="mresponsible" id="responsible" size="22" value="<?php echo $rw['responsible'];?>" class="validate[required]"/>
<input type="submit" name="acceptedit" value="تایید ویرایش" id="submit" class="submit"/>
<input type="button" name="cancel" onclick="window.open('visa_centers.php','_parent')" value="انصراف" />
<input type="hidden" name="centerid" value="<?php echo $_GET['cid'];?>"/>
</td>
</tr>
</table>

</html>