<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

<table width="100%" >
</head>
<?php
$appid=$_GET['applicantid'];
$karvanid=$_GET['karvanid'];
$requesttype=$_GET['type'];
if($requesttype==1){
echo "<tr>
<td  style='background:#71ABFA' colspan='11' align='center'>
<b>مشخصات مرکز اقامتی فرد در ایران</b>
</td>
</tr>
<tr>
<td  style='background:#679EE7'  align='center'>
نام
</td>
<td  style='background:#679EE7'  align='center'>
ولد
</td>
<td  style='background:#679EE7'  align='center'>
نسبت
</td>
<td  style='background:#679EE7' align='center'>
تلفن همراه
</td>
<td  style='background:#679EE7'  align='center'>
تلفن منزل
</td>
<td  style='background:#679EE7'  align='center'>
کارت اقامت
</td>
<td  style='background:#679EE7'  align='center'>
آدرس محل سکونت
</td>
</tr>
<tr>
<td  style='background:#679EE7'  align='center' >
<input type='text' name='add_name' id='add_name' class='validate[required]'  size='13'/>
</td>
<td  style='background:#679EE7'  align='center'>
<input type='text' name='add_fname'  id='add_fname' class='validate[required]' size='13'/>
</td>
<td  style='background:#679EE7'  align='center'>
<input type='text' name='add_relation' id='add_relation' class='validate[required]' size='13'/>
</td>
<td  style='background:#679EE7' align='center'>
<input type='text' name='add_mobile'  id='add_mobile' class='validate[required,custom[phone]]' size='13'/>
</td>
<td  style='background:#679EE7'  align='center'>
<input type='text' name='add_phone' id='add_phone'  size='13'/>
</td>
<td  style='background:#679EE7'  align='center'>
<input type='text' name='add_idnum' id='add_idnum' class='validate[required]' size='13'/>
</td>
<td  style='background:#679EE7'  align='center'>
<textarea rows='1' name='add_address'  id='add_address' class='validate[required]' size='20'></textarea>
</td>
</tr>
<tr>
<td  style='background:#679EE7'  align='center'>
آدرس متفرقه 1:
</td>
<td style='background:#679EE7'  align='center' colspan='6'><input type='text' name='add[]' id='add1' size='105' />
</td>
</tr>
<tr>
<td  style='background:#679EE7'  align='center'>
آدرس متفرقه 2:
</td>
<td style='background:#679EE7'  align='center' colspan='6'><input type='text' name='add[]' id='add2' size='105' />
</td>
</tr>
<tr>
<td  style='background:#679EE7'  align='center'>
آدرس متفرقه 3:
</td>
<td style='background:#679EE7'  align='center' colspan='6'><input type='text' name='add[]' id='add3' size='105'/>
</td>
</tr>
<tr>
<td  style='background:#71ABFA' colspan='11' align='left'>
<input type='hidden' name='app_id' value='$appid'/>
<input type='submit' value='تایید'name='insertaddress' id='insertaddress' class='submit'/><input type='button' onclick='window.open(\"karvan_applicants.php?kid=$karvanid\",\"_parent\")' value='انصراف'name='cancel' />
</td>
</tr>";

}else if($requesttype==2){
//$sql="select id,last_address_id from karvan_applicants_getinfo where applicant_id='$appid' and karvan_id='$karvanid'";
//$res=mysql_query($sql) or die(mysql_error());
//$row=mysql_fetch_array($res);

$sql="select * from applicant_foreign_address where applicant_id='$appid' and parentid='0'";
$res=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($res);
echo "<tr>
<td  style='background:#71ABFA' colspan='11' align='center'>
<b>مشخصات مرکز اقامتی فرد در ایران</b>
</td>
</tr>
<tr>
<td  style='background:#679EE7'  align='center'>
<b>
نام
</b>
</td>
<td  style='background:#679EE7'  align='center'>
<b>
ولد
</b>
</td>
<td  style='background:#679EE7'  align='center'>
<b>
نسبت
</b>
</td>
<td  style='background:#679EE7' align='center'>
<b>
تلفن همراه
</b>
</td>
<td  style='background:#679EE7'  align='center'>
<b>
تلفن منزل
</b>
</td>
<td  style='background:#679EE7'  align='center'>
<b>
کارت اقامت
</b>
</td>
<td  style='background:#679EE7'  align='center'>
<b>
آدرس محل سکونت
</b>
</td>
</tr>
<tr>
<td  style='background:#679EE7'  align='center' >
<input type='text' name='add_name' id='add_name' class='validate[required]' value='$row[name]' size='15'/>
</td>
<td  style='background:#679EE7'  align='center'>
<input type='text' name='add_fname' id='add_fathername' class='validate[required]' value='$row[father_name]' size='15'/>
</td>
<td  style='background:#679EE7'  align='center'>
<input type='text' name='add_relation' id='add_relation' class='validate[required]' value='$row[relation]' size='15'/>
</td>
<td  style='background:#679EE7' align='center'>
<input type='text' name='add_mobile' id='add_mobile' class='validate[required]' value='$row[mobile]' size='15'/>
</td>
<td  style='background:#679EE7'  align='center'>
<input type='text' name='add_phone' id='add_phone'  value='$row[home_phone]' size='15'/>
</td>
<td  style='background:#679EE7'  align='center'>
<input type='text' name='add_idnum' id='add_idnum' class='validate[required]' value='$row[id_card]' size='15'/>
</td>
<td  style='background:#679EE7'  align='center'>
<textarea rows='1' name='add_address' id='add_address' class='validate[required]'  size='24'>$row[home_address]</textarea>

</td>
</tr>";
$sql="select id from karvan_applicants_getinfo where applicant_id='$appid' and karvan_id='$karvanid'";
$res=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($res);
$sql="select * from applicant_foreign_address where parentid='$row[id]'";
$res=mysql_query($sql) or die(mysql_error());
$i=1;
while($rw=mysql_fetch_array($res)){
echo "
<tr>
<td  style='background:#679EE7'  align='center'>
آدرس متفرقه $i:
</td>
<td style='background:#679EE7'  align='center' colspan='6'><input type='text' name='addr[]' value='$rw[home_address]' size='120'/>
</td>
</tr>
";
$i++;
}

echo "
<tr>
<td  style='background:#71ABFA' colspan='11' align='left'>
<input type='hidden' name='app_id' value='$appid'/>
<input type='hidden' name='karvan_idd' value='$karvanid'/>
<input type='submit' value='تایید' name='updateadd' id='updateadd' class='submit'/>
</td>
</tr>";



}
?>
</table>
</html>