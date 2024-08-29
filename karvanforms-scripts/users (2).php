<?php
include("template_header.php");
?>
<script>
    function check_exist(user_name){
        var divid="userExist";
        
     	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
 		 }
		else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
 		 }
			xmlhttp.onreadystatechange=function()
		 {
 			if (xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById(divid).innerHTML=xmlhttp.responseText;    }
			  }
			 
				xmlhttp.open('GET','user_check.php?user_name='+user_name,true);
				xmlhttp.send();
				
				}
    function getUserInfo(userId){
        var divid="userEdit";
        
     	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
 		 }
		else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
 		 }
			xmlhttp.onreadystatechange=function()
		 {
 			if (xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById(divid).innerHTML=xmlhttp.responseText;    }
			  }
			 
				xmlhttp.open('GET','user_edit.php?userId='+userId,true);
				xmlhttp.send();
				
				}
</script>
	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="homepage.php">صفحه اصلی</a><!-- First level MENU -->
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix">
		<div align="right" dir="rtl">
		<form method="post" action="users.php" accept-charset="utf-8" id="myform"  class="formular">
			<fieldset>
				<legend align="right"><span >کاربران</span></legend>
				<a href="#" id="addlink" ><b>اضافه نمودن کاربر جدید</b></a>
				<a href="#" id="addlinkback"><b>اضافه نمودن کاربر جدید</b></a>
				<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
				</br>
				<div id="addlinkdata">
				<div id="userExist"></div>
				<table width="30%" >
				<tr >
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>نام :</td>
					<td><input type="text" id="name" class="validate[required] text-input" name="name"/></td>
				</tr>
				<tr>
					<td>ایمیل:</td>
					<td><input type="text" id="email" class="validate[required] text-input" name="email"/></td>
				</tr>
				<tr>
					<td>نام کاربری :</td>
					<td><input type="text" id="user_name" class="validate[required] text-input" name="user_name" onKeyup="check_exist(this.value)"/></td>
				</tr>
				<tr>
					<td>کلمه عبور :</td>
					<td><input type="password" id="password" class="validate[required] text-input" name="password"/></td>
				</tr>
				<tr>
					<td>تکرار کلمه عبور :</td>
					<td><input type="password" id="repassword" class="validate[required] text-input" name="repassword"/></td>
				</tr>
				<tr>
					<td>وضیعت :</td>
					<td><select name="status" id="status" class="validate[required]">
					<option value="">انتخاب</option>
					<option value="1">فعال</option>
					<option value="2">غیر فعال</option>
					</select>
					</td>
				</tr>
				</tr>
					<td>تفصیل :</td>
					<td><textarea cols="17" rows="3" id="description" name="description" class="validate[required]"><?php if(isset($_GET['edit'])){ echo  $property_description; } ?></textarea></td>
				</tr>
				</tr>
					<td align="left"><b>روزنامچه</b></td>
					<td><input type="checkbox" name="today_transaction" id="today_transaction" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>صندوق</b></td>
					<td><input type="checkbox" name="teller" id="teller" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>بارنامه بندر عباس</b></td>
					<td><input type="checkbox" name="load_bandarabbas" id="load_bandarabbas" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>بارنامه ترکیه</b></td>
					<td><input type="checkbox" name="load_turkey" id="load_turkey" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>عواید گمرک</b></td>
					<td><input type="checkbox" name="custom_deals" id="custom_deals" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>فاکتور</b></td>
					<td><input type="checkbox" name="bill" id="bill" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>طرف حساب</b></td>
					<td><input type="checkbox" name="dealer" id="dealer" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>حساب بانکی </b></td>
					<td><input type="checkbox" name="bank_account" id="bank_account" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>ترانزکشن </b></td>
					<td><input type="checkbox" name="money_transaction" id="money_transaction" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>صرافی</b></td>
					<td><input type="checkbox" name="money_exchange" id="money_exchange" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>گزارش</b></td>
					<td><input type="checkbox" name="report" id="report" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>افتتاحییه</b></td>
					<td><input type="checkbox" name="opening" id="opening" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>سرمایه گذاری</b></td>
					<td><input type="checkbox" name="invest" id="invest" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>مصرف</b></td>
					<td><input type="checkbox" name="expense" id="expense" value="1"/></td>
				</tr>
				</tr>
					<td align="left"><b>کاربر</b></td>
					<td><input type="checkbox" name="users" id="users" value="1"/></td>
				</tr>
				<tr>
				<td></td>
				<td align="left"><input type="submit" class="submit"  name="save" value="ذخیره" id="linkdatabutton"/>
				<a href="bank_accounts.php"><input type="button" name="cancel" value="انصراف"/></a></td>
				</tr>
				</table>
				</br>
				</div></br>
				<?php
				    if(isset($_POST['save'])){
						 
						if($_POST['user_exist']){
						     echo"<div id='fail' class='info_div' align right><span class='ico_cancel'>شما بر خلاف قوانین فورم اطلاعات وارد کردید</span></div>";
						}else{
				             $sql="select count(code) from users";
				             $result=mysql_query($sql);
				             $resrow=mysql_fetch_array($result);
				             if($resrow){
				                 $last_code_num = $resrow['count(code)'];
				                 $last_code_num++;
				                 $code="US-".$last_code_num;
				             }else{
				                 $code="US-1";
				             }
				         $sql="Insert into users(code, name, email, user_name, password, status, today_transactions, tellers, bills, load_bandarabbas, load_turkey, dealers, bank_accounts, transactions, money_exchange, reports, openings, invests, expenses, description, users, custom_deals ) values('$code', '$_POST[name]','$_POST[email]', '$_POST[user_name]', '$_POST[password]', '$_POST[status]', '$_POST[today_transaction]', '$_POST[teller]', '$_POST[bill]', '$_POST[load_bandarabbas]', '$_POST[load_turkey]', '$_POST[dealer]', '$_POST[bank_account]', '$_POST[money_transaction]', '$_POST[money_exchange]', '$_POST[report]', '$_POST[opening]', '$_POST[invest]', '$_POST[expense]', '$_POST[description]', '$_POST[users]', '$_POST[custom_deals]')";
				             mysql_query($sql) or die(mysql_error());
				             header("location: users.php");
						}
					}                                                                                                                                                                             
				?>
				<div id="userEdit"></div>
				<h3 class="ico_mug">لیست کاربران سیستم</h3>
				<div id="tabledata" class="section">
				<table width="90%" id="table" >
				<tr>
				<th style="width:5%">کد</th>
				<th>نام</th>
				<th>نام کاربری</th>
				<th>ایمل</th>
				<th>وضیعت</th>
				<th>عملیات</th>
				</tr>
				<?php
				     $sql="Select id, code, name, email, user_name, description, status from users where delete_record='' order by code";
				     $res=mysql_query($sql) or die(mysql_error());
				        while($row=mysql_fetch_array($res)){
						  $id = $row['id'];
						  $code = $row['code'];
					      $name = $row['name'];
					      $email = $row['email'];
					      $user_name = $row['user_name'];
						  $status = $row['status'];
					      $description = $row['description'];
						  
						  if($status == "1"){
						    $condetion = "فعال";
						  }
						  
						  if($status == "2"){
						     $condetion = "غیر فعال";
						  }
						echo"<tr>
						<td class='table_date' align='center'>$code</td>
						<td class='table_date'  align='center'>$name</td>
						<td class='table_date'  align='center'>$user_name</td>
						<td class='table_date'  align='center'>$email</td>
						<td class='table_date'  align='center'>$condetion</td>
						<td class='table_date'  align='center' ><img src='img/edit.png' style='cursor:pointer' onclick='getUserInfo($row[id])'/><a href='delete.php?id=$row[id]&&table=users&&page=location:users.php' class='confirm'><img src='img/cancel.png' style='cursor:pointer' title='$name'/></a>   
						</td>
						</tr>";
					}
				?>
				
				<?php
				if(isset($_POST['edit_user'])){
							
					       $sql="Update users SET name = '$_POST[name]', user_name = '$_POST[user_name]' ,custom_deals = '$_POST[custom_deals]',  password = '$_POST[password]', email = '$_POST[email]', status = '$_POST[status]', description = '$_POST[description]', today_transactions = '$_POST[today_transaction]', tellers = '$_POST[teller]', bills = '$_POST[bill]', load_bandarabbas = '$_POST[load_bandarabbas]', load_turkey = '$_POST[load_turkey]', dealers = '$_POST[dealer]', bank_accounts = '$_POST[bank_account]', transactions = '$_POST[money_transaction]', money_exchange = '$_POST[money_exchange]', reports = '$_POST[report]', openings = '$_POST[opening]', invests = '$_POST[invest]', expenses = '$_POST[expense]' , users = '$_POST[users]'where id = '$_POST[user_id]'";
					       mysql_query($sql) or die(mysql_error());
						
					       header("location:users.php");
				    }
				?>
				
				<?php
				   if(isset($_GET['delete_user'])){
				         $id = $_GET['delete_user'];
				         $sql="Delete from users where id='$id'";
				         mysql_query($sql);
						 
						 header("location: users.php");
				   }
				?>
				</table>
				</div>
			 </div>
 		</fieldset>
			
		</form>
		</div>
		
</div><!-- end container -->
	   <?php
	   include ("template_footer.php");
	   ?>
</body>
</html>
