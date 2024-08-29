<?php
include("template_header.php");
?>
<script>

    function getkafilInfo(kafilId){
        var divid="kafilEdit";
        
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
			 
				xmlhttp.open('GET','kafil_edit.php?kafilId='+kafilId,true);
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
		<form method="post" action="kafils.php" accept-charset="utf-8" id="myform"  class="formular">
			<fieldset>
				<legend align="right"><span >مدیریت کفیل</span></legend>
				<a href="#" id="addlink" ><b>اضافه نمودن کفیل جدید</b></a>
				<a href="#" id="addlinkback"><b>اضافه نمودن کفیل جدید</b></a>
				<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
				</br>
				<div id="addlinkdata">
				<div id="userExist"></div>
				<table width="32%" >
				<tr >
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>نام :</td>
					<td><input type="text" id="name" class="validate[required] text-input" name="name"/></td>
				</tr>
				<tr>
					<td>نام پدر:</td>
					<td><input type="text" id="fathername" class="validate[required] text-input" name="fathername"/></td>
				</tr>
				<tr>
					<td>شهرستان : </td>
					<td>
						<select name="city" class="validate[required]" id="city">
							<option value="">انتخاب شهر</option>
							<option value="1">مشهد</option>
							<option value="2">تهران</option>
							<option value="3">دیگر شهرستانها</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>شماره کارت اقامت :</td>
					<td><input type="text" id="idcardno"  name="idcardno" /></td>
				</tr>
				<tr>
					<td>تاریخ صدور کارت :</td>
					<td><input type="text" id="cardissue"  name="cardissue" /></td>
				</tr>
				<tr>
					<td>تاریخ اعتبار کارت :</td>
					<td><input type="text" id="cardend"  name="cardend" /></td>
				</tr>
				<tr>
					<td>شماره گذرنامه:</td>
					<td><input type="text" id="passno"  name="passno"/></td>
				</tr>
				<tr>
					<td>تاریخ صدور پاسپورت:</td>
					<td><input type="text" id="passissue"  name="passissue" /></td>
				</tr>
				<tr>
					<td>تاریخ اعتبار پاسپورت :</td>
					<td><input type="text" id="passend"  name="passend" /></td>
				</tr>
				<tr>
					<td>شغل :</td>
					<td><input type="text" id="job"  name="job"/></td>
				</tr>
				
				
				<tr>
					<td>نشانی محل کار :</td>
					<td><textarea cols="17" rows="3" id="workaddress" name="workaddress" ></textarea></td>
				</tr>
				<tr>
					<td>شماره تماس محل کار :</td>
					<td><input type="text" id="workphone"  name="workphone"/></td>
				</tr>
				</tr>
					<td>نشانی محل سکونت :</td>
					<td><textarea cols="17" rows="3" id="homeaddress" name="homeaddress" ></textarea></td>
				</tr>
				<tr>
					<td>تلفن ثابت محل سکونت :</td>
					<td><input type="text" id="homephone"  name="homephone"/></td>
				</tr>
				<tr>
					<td>تلفن همراه :</td>
					<td><input type="text" id="mobilenum"  name="mobilenum"/></td>
				</tr>
				<tr>
				<td></td>
				<td align="left"><input type="submit" class="submit"  name="save" value="ذخیره" id="linkdatabutton"/>
				<a href="kafils.php"><input type="button" name="cancel" value="انصراف"/></a></td>
				</tr>
				</table>
				</br>
				</div></br>
				<?php
				    if(isset($_POST['save'])){
						 
						if($_POST['user_exist']){
						     echo"<div id='fail' class='info_div' align right><span class='ico_cancel'>شما بر خلاف قوانین فورم اطلاعات وارد کردید</span></div>";
						}
						
					     $sql="Insert into kafils( name, father_name, city, idcardno, passportno, idcard_issue_date, passport_issue_date, idcard_end_date, passport_end_date,
						 job, work_address, work_phone, home_address, phone_no, mobile_no) values('$_POST[name]','$_POST[fathername]', '$_POST[city]', '$_POST[idcardno]', 
						 '$_POST[passno]', '$_POST[cardissue]',	 '$_POST[passissue]','$_POST[cardend]','$_POST[passend]','$_POST[job]','$_POST[workaddress]','$_POST[workphone]'
						 ,'$_POST[homeaddress]','$_POST[homephone]','$_POST[mobilenum]')";
				             mysql_query($sql) or die(mysql_error());
				             header("location: kafils.php");
						
					}                                                                                                                                                                             
				?>
				<div id="kafilEdit"></div>
				<h3 class="ico_mug">لیست کفیل های موجود در سیستم</h3>
				<div id="tabledata" class="section">
				<table width="90%" id="table" >
				<tr>
				<th>نام</th>
				<th>نام پدر</th>
				<th>کارت اقامت</th>
				<th>گذرنامه</th>
				<th>تعداد کفالت</th>
				<th>عملیات</th>
				</tr>
				<?php
				     $sql="Select id, name, father_name, idcardno, passportno from kafils order by id desc";
				     $res=mysql_query($sql) or die(mysql_error());
				        while($row=mysql_fetch_array($res)){
						  $id = $row['id'];
					      $name = $row['name'];
					      $fathername = $row['father_name'];
					      $idnum = $row['idcardno'];
						  $passnum = $row['passportno'];
						  //Counting number of kafils from karvans
						  $sq="select count(id) from applicants where kafil_id='$row[id]'";
						  $rs=mysql_query($sq) or die (mysql_error());
						  $rw1=mysql_fetch_array($rs);
						  //Counting number of kafils from visa applicants
						  $sq="select count(id) from visa_applicants where kafil_id='$row[id]'";
						  $rs=mysql_query($sq) or die (mysql_error());
						  $rw2=mysql_fetch_array($rs);
					      $numofkafils =  $rw1['count(id)']+$rw2['count(id)'];
						  
						  
						echo"<tr>
						<td class='table_date'  align='center'>$name</td>
						<td class='table_date'  align='center'>$fathername</td>
						<td class='table_date'  align='center'>$idnum</td>
						<td class='table_date'  align='center'>$passnum</td>
						<td class='table_date'  align='center'>$numofkafils</td>";
						echo"
						<td class='table_date'  align='center' ><img src='img/edit.png' style='cursor:pointer' onclick='getkafilInfo($row[id])'/>  
						";
						if($numofkafils==0){
							echo"<a href='kafils.php?delete_kafil=$row[id]' class='confirm'><img src='img/cancel.png' width='15px' height='15'/></a> ";
						}else{
							echo"<img src='img/cancel1.png' width='15px' height='15'/> ";
						}
						echo"
						<a href='kafil_reports.php?kafilid=$row[id]' style='color:blue'>چاپ فرم کفالت</a>  
						";
						echo"</td></tr>";
					}
				?>
				
				<?php
				if(isset($_POST['edit_kafil'])){
							
					       $sql="Update kafils SET name='$_POST[name]', father_name='$_POST[fathername]', city='$_POST[city]', idcardno='$_POST[idcardno]'
						   , passportno='$_POST[passno]', idcard_issue_date='$_POST[cardissue]', passport_issue_date='$_POST[passissue]',
						   idcard_end_date='$_POST[cardend]', passport_end_date='$_POST[passend]', job='$_POST[job]', work_address='$_POST[workaddress]',
						   work_phone='$_POST[workphone]', home_address='$_POST[homeaddress]', phone_no='$_POST[homephone]', mobile_no='$_POST[mobilenum]'
						 where id='$_POST[kafil_id]'";
					       mysql_query($sql) or die(mysql_error());
						
					       header("location:kafils.php");
						   die();
				    }
				?>
				
				<?php
				   if(isset($_GET['delete_kafil'])){
				         $id = $_GET['delete_kafil'];
				         $sql="Delete from kafils where id='$id'";
				         mysql_query($sql) or die (mysql_error());
						 
						 header("location: kafils.php");
						 die();
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
