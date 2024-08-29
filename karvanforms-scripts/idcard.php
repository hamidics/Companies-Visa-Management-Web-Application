
<?PHP
require_once("../library/db.php");
require_once("../library/pdate.php");
session_start();
include("check_login.php");
 login();
 $karvan=$_GET['karvanid'];
 $appid=$_GET['resid'];
 $mosquename=$_GET['mosque'];
 $days=$_GET['validatedays'];
 $cardback=$_GET['card'];
 $today=pdate("Y-m-d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table width="50%" dir="rtl" style='font-family: B Titr'>
<?php
$sql="select name,phone_num,applicant_type from applicants where id='$appid'";
$rs=mysql_query($sql)or die(mysql_error());
$resname=mysql_fetch_array($rs);
$sql="select mobile from applicant_foreign_address where applicant_id='$appid'";
$rs=mysql_query($sql) or die(mysql_error());
$resmobile=mysql_fetch_array($rs);
$sql="select applicant_id from karvan_applicants_getinfo where karvan_id='$karvan'";
$res=mysql_query($sql) or die(mysql_error());
$i=1;
$j=0;
$karvancode="select * from karvan where id='$karvan'";
$reskarvan=mysql_query($karvancode) or die (mysql_error());
$rowkarvan=mysql_fetch_array($reskarvan);

while($row=mysql_fetch_array($res)){
	$sq="select *from applicants where id='$row[applicant_id]'";
	$rs=mysql_query($sq) or die(mysql_error());
	$rw=mysql_fetch_array($rs);
	$name=$rw['name'];
	$fathername=$rw['father_name'];
	$familyname=$rw['f_name'];
	$passisueplace=$rw['pass_issue_place'];
	$country="افغانستان";
	$birthdate=$rw['birth_date'];
	$birthplace=$rw['birth_place'];
	$passno=$rw['passport_no'];
	$issuedate=$rw['pass_issue_date'];
	$passvalidateion=$rw['pass_validation_date'];
	$id=$rw['id'];
	$photo=$id.".jpg";
	$code ="شماره اعزام:".$rowkarvan['send_number'];
		if($rw['applicant_type']=="سرپرست"){
		$q="<div style='background-color:white;width:50px' align='center'>"."سرپرست"."</div>";
	}else{
		$j++;
		$q="<div style='background-color:white;width:20px' align='center'>".$j."</div>";
	}
	if($rw['pass_issue_place']!="همراه " && $rw['pass_issue_date']!="0000-00-00"){

	if(($i%2)!=0){
		echo "
		<tr><td>
			<div id='wb_Table1' style='width:354px;height:225px;background-image:url(img/$cardback); margin-top:-20px'  align='left' border='1' dir='rtl'>
			<table width='100%' border='0' cellpadding='0' cellspacing='0' id='Table1'>
			<tr>
			<td align='right' valign='top'   height='30'><b style='align:left;color:red;font-size:13px'>".$rw['applicant_type']."</td>
			<td align='center' valign='top'  colspan='4' height='20'><b style='align:right;font-size:11px'>کاروان $mosquename </br>($code)</b></br><b style='font-size:11px'>سر پرست کاروان : ".$resname['name']."</br>تماس ایران : ".$resmobile['mobile']."</br>تماس هرات: ".$resname['phone_num']."</b></td>
			<td align='left' valign='top' width='65' height='80'><img src='applicant_images/$photo' style='width:80px;height:93px'/></td>
			</tr>
			<tr>
			<td align='right' valign='top' width='70'  height='25' style='font-size:11px;padding-right:8px'>نام:</td>
			<td align='right' valign='top'   height='25' colspan='2' style='font-size:12px;' ><b>$name</b></td>
			<td align='right' valign='top' height='25' style='font-size:11px;padding-right:16px'>نام پدر:</td>
			<td align='right' valign='top'  width='90' height='25' colspan='2' style='font-size:11px'><b>$fathername</b></td>
			</tr>
			<tr>
			<td align='right' valign='top'  height='25' style='font-size:10px;padding-right:7px'>شماره گذرنامه:</td>
			<td align='right' valign='top'  height='25' colspan='2' style='font-size:12px;'><div style='width:130px'><b>$passno</b></div></td>
			<td align='right' valign='top'  height='25' width='60' style='font-size:10px;padding-right:16px'>محل صدور:</td>
			<td align='right' valign='top'  height='25'  width='90' colspan='2'style='font-size:12px'><b>$passisueplace</b></td>
			</tr>
			<tr>
			<td align='right' valign='top'  height='25' style='font-size:11px;padding-right:8px'>تاریخ تولد:</td>
			<td align='right' valign='top'  height='25' colspan='2'style='font-size:12px'><b>$birthdate</b></td>
			<td align='right' valign='top'  height='25' style='font-size:11px;padding-right:16px'>ردیف:</td>
			<td align='right' valign='top'  height='25' colspan='2'style='font-size:12px'><b>$q</b></td>
			</tr>
			<tr>
			<td align='right' valign='top'  colspan='2' height='25' style='font-size:11px;padding-right:8px'>تاریخ صدور کارت:</td>
			<td align='right' valign='top'  height='25' colspan='3'style='font-size:12px'><b>$today</b></td><td align='right' style='font-size:10px; margin-left:10px' >کدناجا:<b style='color:red'>$rowkarvan[naja_code]</b></td>
			</tr>
			<tr>
			<td align='center' valign='top'  height='25' colspan='6' style='font-size:11px;color:red'>مدت اعتبار کارت:<b>$days  روز پس از تاریخ صدور کارت</b></td>
			</tr>
			</table></div>
		</td>";
	}else{
		echo "
<td>
			<div id='wb_Table1' style='width:354px;height:225px;background-image:url(img/".$cardback."); margin-top:-20px'  align='left' border='1' dir='rtl'>
			<table width='100%' border='0' cellpadding='0' cellspacing='0' id='Table1'>
			<tr>
			<td align='right' valign='top'   height='30'><b style='align:left;color:red;font-size:13px'>".$rw['applicant_type']."</td>
			<td align='center' valign='top'  colspan='4' height='20'><b style='align:right;font-size:11px'>کاروان $mosquename </br>($code)</b></br><b style='font-size:11px'>سر پرست کاروان : ".$resname['name']."</br>تماس ایران : ".$resmobile['mobile']."</br>تماس هرات: ".$resname['phone_num']."</b></td>
			<td align='left' valign='top' width='65' height='80'><img src='applicant_images/$photo' style='width:80px;height:93px'/></td>
			</tr>
			<tr>
			<td align='right' valign='top' width='70'  height='25' style='font-size:11px;padding-right:8px'>نام:</td>
			<td align='right' valign='top'   height='25' colspan='2' style='font-size:12px;' ><b>$name</b></td>
			<td align='right' valign='top' height='25' style='font-size:11px;padding-right:16px'>نام پدر:</td>
			<td align='right' valign='top'  width='90' height='25' colspan='2' style='font-size:11px'><b>$fathername</b></td>
			</tr>
			<tr>
			<td align='right' valign='top'  height='25' style='font-size:10px;padding-right:7px'>شماره گذرنامه:</td>
			<td align='right' valign='top'  height='25' colspan='2' style='font-size:12px;'><div style='width:130px'><b>$passno</b></div></td>
			<td align='right' valign='top'  height='25' width='60' style='font-size:10px;padding-right:16px'>محل صدور:</td>
			<td align='right' valign='top'  height='25'  width='90' colspan='2'style='font-size:12px'><b>$passisueplace</b></td>
			</tr>
			<tr>
			<td align='right' valign='top'  height='25' style='font-size:11px;padding-right:8px'>تاریخ تولد:</td>
			<td align='right' valign='top'  height='25' colspan='2'style='font-size:12px'><b>$birthdate</b></td>
			<td align='right' valign='top'  height='25' style='font-size:11px;padding-right:16px'>ردیف:</td>
			<td align='right' valign='top'  height='25' colspan='2'style='font-size:12px'><b>$q</b></td>
			</tr>
			<tr>
			<td align='right' valign='top'  colspan='2' height='25' style='font-size:11px;padding-right:8px'>تاریخ صدور کارت:</td>
			<td align='right' valign='top'  height='25' colspan='3'style='font-size:12px'><b>$today</b></td><td align='right' style='font-size:10px; margin-left:10px' >کدناجا:<b style='color:red'>$rowkarvan[naja_code]</b></td>
			</tr>
			<tr>
			<td align='center' valign='top'  height='25' colspan='6' style='font-size:11px;color:red'>مدت اعتبار کارت:<b>$days  روز پس از تاریخ صدور کارت</b></td>
			</tr>
			</table></div>
		</td></tr>
		<tr><td ><br/></td></tr>";
	}
	$i++;
	}

}
?>
</table>
</html>