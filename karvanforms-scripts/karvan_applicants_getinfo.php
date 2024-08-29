<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

<table width="60%" >
</head>
		<?php 
		if($_GET['type']=='new'){
		?>						
		<tr><td>شماره پاسپورت:</td>
							<td align="right"><input type="text" name="app_new_passno"  size="30"id="app_new_passno" value="<?php echo $_GET['passno'];?>" class="validate[required]" size="25"/>
							</td>
						</tr>
<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> صادره پاسپورت:</td>
							<td>
							<input type="text" name="app_pass_issue_place" class="validate[required]" value="<?php echo $_GET['issueplace'];?>" id="app_pass_issue_place" size="30"/>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور پاسپورت:</td>
							<td>
							<input type="text" name="app_passissuedate" id="app_passissuedate" value="<?php echo $_GET['issuedate'];?>" class="validate[required]" size="25"/>
							<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('app_passissuedate', this);"/>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> اعتبار:</td>
							<td>
							<input type="text" name="app_valid_date" id="app_valid_date" value="<?php echo $_GET['validedate'];?>"   class="validate[required]" size="25"/>
							<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('app_valid_date', this);"/>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
<?php
}else{
	echo "";
}
?>

<?php
$karvanid=$_GET['karvanid'];
?>
</table>
</html>