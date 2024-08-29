<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


</head>


<?php
	$kafilId=$_GET['kafilId'];
	
	$sql="Select * from kafils where id ='$kafilId'";
	            $res=mysql_query($sql) or die(mysql_error());
	            $row=mysql_fetch_array($res);
				  				   
				echo"<table width='32%' >
								<tr>
					<td>نام :</td>
					<td><input type='text' id='name' value='$row[name]' class='validate[required] text-input' name='name'/></td>
				</tr>
				<tr>
					<td>نام پدر:</td>
					<td><input type='text' id='fathername' value='$row[father_name]' class='validate[required] text-input' name='fathername'/></td>
				</tr>
				<tr>
					<td>شهرستان : </td>
					<td>
						<select name='city' class='validate[required]' id='city'>
							<option value=''>انتخاب شهر</option>";
						if($row['city']=="1"){
							echo"
							<option value='1' selected>مشهد</option>
							<option value='2'>تهران</option>
							<option value='3'>دیگر شهرستانها</option>";
						}else if($row['city']=="2"){
							echo"
							<option value='1' >مشهد</option>
							<option value='2' selected>تهران</option>
							<option value='3'>دیگر شهرستانها</option>";
						}else{
							echo"
							<option value='1' >مشهد</option>
							<option value='2'>تهران</option>
							<option value='3' selected>دیگر شهرستانها</option>";
						
						}
						
						echo "</select>
					</td>
				</tr>
				<tr>
					<td>شماره کارت اقامت :</td>
					<td><input type='text' id='idcardno' value='$row[idcardno]'  name='idcardno' /></td>
				</tr>
				<tr>
					<td>تاریخ صدور کارت :</td>
					<td><input type='text' id='cardissue'  value='$row[idcard_issue_date]' name='cardissue' /></td>
				</tr>
				<tr>
					<td>تاریخ اعتبار کارت :</td>
					<td><input type='text' id='cardend' value='$row[idcard_end_date]'  name='cardend' /></td>
				</tr>
				<tr>
					<td>شماره گذرنامه:</td>
					<td><input type='text' id='passno' value='$row[passportno]'  name='passno'/></td>
				</tr>
				<tr>
					<td>تاریخ صدور پاسپورت:</td>
					<td><input type='text' id='passissue' value='$row[passport_issue_date]'  name='passissue' /></td>
				</tr>
				<tr>
					<td>تاریخ اعتبار پاسپورت :</td>
					<td><input type='text' id='passend'  value='$row[passport_end_date]' name='passend' /></td>
				</tr>
				<tr>
					<td>شغل :</td>
					<td><input type='text' id='job' value='$row[job]' name='job'/></td>
				</tr>
				
				
				<tr>
					<td>نشانی محل کار :</td>
					<td><textarea cols='17' rows='3' id='workaddress'  name='workaddress' >$row[work_address]</textarea></td>
				</tr>
				<tr>
					<td>شماره تماس محل کار :</td>
					<td><input type='text' id='workphone' value='$row[work_phone]' name='workphone'/></td>
				</tr>
				</tr>
					<td>نشانی محل سکونت :</td>
					<td><textarea cols='17' rows='3' id='homeaddress' name='homeaddress' >$row[home_address]</textarea></td>
				</tr>
				<tr>
					<td>تلفن ثابت محل سکونت :</td>
					<td><input type='text' id='homephone' value='$row[phone_no]' name='homephone'/></td>
				</tr>
				<tr>
					<td>تلفن همراه :</td>
					<td><input type='text' id='mobilenum' value='$row[mobile_no]'  name='mobilenum'/></td>
				</tr>

				<tr>
				<td></td>
				<td align='left'><input type='submit' class='submit'  name='edit_kafil' value='ذخیره' id='linkdatabutton'/>
				<a href='kafils.php'><input type='button' name='cancel' value='انصراف'/></a></td>
				<input type='hidden' name='kafil_id' value='$kafilId'/>
				</tr>
				</table>
				</br>";
		
?>


</html>