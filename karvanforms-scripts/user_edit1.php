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
	
	$sql="Select name, user_name, password, email, status, description, today_transactions, tellers, bills, load_bandarabbas, load_turkey, dealers, bank_accounts, transactions, money_exchange, reports, openings, invests, expenses, users, custom_deals from users where id ='$userId'";
	            $res=mysql_query($sql) or die(mysql_error());
	            while($row=mysql_fetch_array($res)){
				   $today_transactions = $row['today_transactions'];
			       $tellers = $row['tellers'];
				   $bills = $row['bills'];
				   $load_bandarabbas = $row['load_bandarabbas'];
				   $load_turkey = $row['load_turkey'];
				   $dealers = $row['dealers'];
				   $bank_accounts = $row['bank_accounts'];
				   $transactions = $row['transactions'];
				   $money_exchange = $row['money_exchange'];
				   $reports = $row['reports'];
				   $openings = $row['openings'];
				   $invests = $row['invests'];
				   $expenses = $row['expenses'];
				   $users = $row['users'];
				   $custom_deals = $row['custom_deals'];
				   
				echo"<table width='40%' >
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
					<td><input type='password' id='repassword' class='validate[required] text-input' name='repassword'/></td>
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
				<tr>
					<td>تفصیل :</td>
					<td><textarea cols='17' rows='3' id='description' name='description' class='validate[required]'>$row[description]</textarea></td>
				</tr>
				<tr>
					<td align='left'><b>روزنامچه</b></td>
					<td><input type='checkbox' name='today_transaction' id='today_transaction' value='1'"; if($today_transactions == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>صندوق</b></td>
					<td><input type='checkbox' name='teller' id='teller' value='1' "; if($tellers == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>بارنامه بندر عباس</b></td>
					<td><input type='checkbox' name='load_bandarabbas' id='load_bandarabbas' value='1' "; if($load_bandarabbas == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>بارنامه بندر ترکیه</b></td>
					<td><input type='checkbox' name='load_turkey' id='load_turkey' value='1' "; if($load_turkey == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>عواید گمرک</b></td>
					<td><input type='checkbox' name='custom_deals' id='custom_deals' value='1' "; if($custom_deals == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>فاکتور</b></td>
					<td><input type='checkbox' name='bill' id='bill' value='1' "; if($bills == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>طرف حساب</b></td>
					<td><input type='checkbox' name='dealer' id='dealer' value='1'"; if($dealers == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>حساب بانکی </b></td>
					<td><input type='checkbox' name='bank_account' id='bank_account' value='1'"; if($bank_accounts == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>ترانزکشن </b></td>
					<td><input type='checkbox' name='money_transaction' id='money_transaction' value='1'"; if($transactions == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>صرافی</b></td>
					<td><input type='checkbox' name='money_exchange' id='money_exchange' value='1'"; if($money_exchange == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>گزارش</b></td>
					<td><input type='checkbox' name='report' id='report' value='1'"; if($reports == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>افتتاحییه</b></td>
					<td><input type='checkbox' name='opening' id='opening' value='1'"; if($openings == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>سرمایه گذاری</b></td>
					<td><input type='checkbox' name='invest' id='invest' value='1'"; if($invests == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>مصرف</b></td>
					<td><input type='checkbox' name='expense' id='expense' value='1'"; if($expenses == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
					<td align='left'><b>کاربر</b></td>
					<td><input type='checkbox' name='users' id='users' value='1'"; if($users == 1){ echo"checked";} echo"/></td>
				</tr>
				<tr>
				<td></td>
				<td align='left'><input type='submit' class='submit'  name='edit_user' value='ذخیره' id='linkdatabutton'/>
				<a href='bank_accounts.php'><input type='button' name='cancel' value='انصراف'/></a></td>
				<input type='hidden' name='user_id' value='$userId'/>
				</tr>
				</table>
				</br>";
		}
?>


</html>