<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


</head>


<?php
	$userId=$_GET['userId'];
	
	$sql="Select * from users where id ='$userId'";
	            $res=mysql_query($sql) or die(mysql_error());
	            $row=mysql_fetch_array($res);
				  $companies = $row['companies'];
			      $newothers = $row['newothers'];
				   $others = $row['others'];
				   $users = $row['users'];
				   $report = $row['report'];
				if($_GET['usertype']=="admin"){   
				echo"<table width='30%' >
				<tr >
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>نام :</td>
					<td><input type='text' id='name' class='validate[required] text-input' name='name' value='$row[name]'/></td>
				</tr>
				<tr>
					<td>ایمیل:</td>
					<td><input type='text' id='email' class='validate[required] text-input' name='email' value='$row[email]'/></td>
				</tr>
				<tr>
					<td>نام کاربری :</td>
					<td><input type='text' id='user_name' class='validate[required] text-input' name='user_name' value='$row[user_name]'/></td>
				</tr>
				<tr>
					<td>کلمه عبور :</td>
					<td><input type='password' id='password' class='validate[required] text-input' name='password' value='$row[password]'/></td>
				</tr>
				<tr>
					<td>تکرار کلمه عبور :</td>
					<td><input type='password' id='repassword' class='validate[required] text-input' value='$row[password]' name='repassword'/></td>
				</tr>
				<tr>
					<td>نوع کاربر :</td>
					<td><select name='type' id='type' class='validate[required]'>
					<option value=''>انتخاب</option>";
					echo"<option value='admin'"; if($row['type'] == "admin"){ echo "selected"; } echo">کاربر مدیر</option>";
					echo"<option value='user'"; if ($row['type'] == "user"){ echo "selected"; } echo">کاربر عادی</option>";
					echo"</select>
					</td>
				</tr>
				<tr>
					<td>وضیعت :</td>
					<td><select name='status' id='status' class='validate[required]'>
					<option value=''>انتخاب</option>";
					echo"<option value='1'"; if($row['status'] == 1){ echo "selected"; } echo">فعال</option>";
					echo"<option value='2'"; if ($row['status'] == 2){ echo "selected"; } echo">غیر فعال</option>";
					echo"</select>
					</td>
				</tr>
				</tr>
					<td>تفصیل :</td>
					<td><textarea cols='17' rows='3' id='description' name='description' >$row[description]</textarea></td>
				</tr>
				<tr>
					<td align='left'><b>شرکت ها و اتحادیه های ثبتی</b></td>
					<td><input type='checkbox' name='ncompanies' id='ncompanies' value='1'"; if($companies == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>متفرقه جدید</b></td>
					<td><input type='checkbox' name='nnewothers' id='nnewothers' value='1' "; if($newothers == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>متقاضیان متفرقه</b></td>
					<td><input type='checkbox' name='nothers' id='nothers' value='1' "; if($others == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>مدیریت کاربران</b></td>
					<td><input type='checkbox' name='nusers' id='nusers' value='1' "; if($users == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>گزارش دهی</b></td>
					<td><input type='checkbox' name='nreport' id='nreport' value='1' "; if($report == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>تغییر کد عبور</b></td>
					<td><input type='checkbox' name='nchangepass' id='nchangepass' value='1' "; if($row['userpass'] == 1){ echo"checked";} echo"/></td>
				</tr>";
				}else{
				echo "<tr>
					<td>کلمه عبور :</td>
					<td><input type='password' id='password' class='validate[required] text-input' name='password' value='$row[password]'/></td>
				</tr>
				<tr>
					<td>تکرار کلمه عبور :</td>
					<td><input type='password' id='repassword' class='validate[required] text-input' value='$row[password]' name='repassword'/></td>
				</tr>";
				}
				echo"
				<tr>
				<td></td>
				<td align='left'><input type='submit' class='submit'  name='edit_user' value='ذخیره' id='linkdatabutton'/>
				<a href='users.php'><input type='button' name='cancel' value='انصراف'/></a></td>
				<input type='hidden' name='user_id' value='$userId'/>
				</tr>
				</table>
				</br>";
		
?>


</html>