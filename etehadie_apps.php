<?php
include("template_header.php");
require_once("../library/image_resize.php");
$viewid=$_GET['ecode'];

?>
<script>
function checkpassnum(passnum)
{
var divid="checkpass";

	if (passnum=='')
  		{
  			document.getElementById(divid).innerHTML='';
 			 return;
 		 } 
	if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
 		 }
		else
		  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
 		 }
			xmlhttp.onreadystatechange=function()
			  {
 			 if (xmlhttp.readyState==4 && xmlhttp.status==200)
 			   {
					document.getElementById(divid).innerHTML=xmlhttp.responseText;    }
			  }
			 
				xmlhttp.open('GET','newapplicant_checkpassajax.php?passnumber='+passnum,true);
				xmlhttp.send();
}

function checkphonenum(phonenum)
{
var divid="checkphone";

	if (phonenum=='')
  		{
  			document.getElementById(divid).innerHTML='';
 			 return;
 		 } 
	if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
 		 }
		else
		  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
 		 }
			xmlhttp.onreadystatechange=function()
			  {
 			 if (xmlhttp.readyState==4 && xmlhttp.status==200)
 			   {
					document.getElementById(divid).innerHTML=xmlhttp.responseText;    }
			  }
			 
				xmlhttp.open('GET','newapplicant_checkphoneajax.php?phone='+phonenum,true);
				xmlhttp.send();
}


</script>
<?php

$sq="select code, name, phonenum, address, parent_id, bossname from sources where id='$viewid'";
$rsname=mysql_query($sq) or die (mysql_error());
$roo=mysql_fetch_array($rsname);


?>
	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="companies.php#tabs-2">صفحه قبل</a>
				<!-- First level MENU -->
			</li>
			<li>
			<a href="homepage.php">صفحه اصلی</a>
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php echo "<form action='etehadie_apps.php?ecode=$viewid' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
			<fieldset>
				<legend align="right"><span dir="rtl">   افراد معرفی شده توسط  <?php echo $roo['name'];?>>>نام رئیس : <?php echo $roo['bossname'];?>>> شماره ثبت: <?php echo $roo['code'];?> >> شماره تماس: <?php echo $roo['phonenum'];?> >> آدرس: <?php echo $roo['address'];?></span></legend>
						<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>

					<li><a href="#tabs-1">لیست افراد معرفی شده توسط اتحادیه</a></li>
					<li><a href="#tabs-2">اسناد</a></li>
				</ul>
				<div id="tabs-1">
				
						<a href="#" id="addlink_tab2" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن متقاضی</b></a>
						<a href="#" id="addlinkback_tab2" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن متقاضی</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						
						<div id="addlinkdata_tab2" >
						<span id="checkpass"></span>
						<span id="checkphone"></span>
						<table width="80%">
						
						<tr align="right">
							<td> شماره گذرنامه:</td>
							
							<td><input type="text" size="30" name="vpassnum" class="validate[checkDuplicate[passportnum2],required]" onkeyup="checkpassnum(this.value)"  id="vpassnum" /> </td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره تماس:</td>
							<td><input type="text" size="30" name="vphone"  onkeyup="checkphonenum(this.value)"  id="vphone" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> نام:</td>
							<td><input type="text" size="30" name="vname" class="validate[required]" id="vname" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نام پدر:</td>
							<td><input type="text" size="30" name="vfathername" class="validate[required]" id="vfathername" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تخلص:</td>
							<td><input type="text" size="30" name="vfamily"  id="vfamily" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> وضعیت تاهل:</td>
							
							<td>
							<select name="marital_status" id="marital_status" style="width:190px" class="validate[required]">
								<option value="">انتخاب وضعیت تاهل</option>
								<option value="متاهل">متاهل</option>
								<option value="مجرد">مجرد</option>
							</select>
							</td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> تاریخ مراجعه: </td>
							<td>
							<input type="text" size="30"  name="requestdate"  id="requestdate"  /> 
<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('requestdate', this);"/>

							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> زمینه فعالیت:</td>
							
							<td><input type="text" size="30" name="work"  id="work" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تحصیلات:</td>
							
							<td><input type="text" size="30" name="education"  id="education" /></td>
							</td>
						</tr>
						
						
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> تاریخ تولد:</td>
							
							<td><input type="text" size="30" name="bdate"  id="bdate" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل تولد:</td>
							
							<td><input type="text" size="30" name="bplace"  id="bplace" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td>آدرس محل کار در افغانستان:</td>
							<td><input type="text" size="70" name="vaddress"  id="vphone" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> آدرس افغانستان:</td>
							
							<td><input type="text" size="70" name="afghanistanadd"  id="afghanistanadd" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td> آدرس ایران:</td>
							
							<td><input type="text" size="70" name="iraddress"  id="iraddress" /></td>
							</td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td>کارشناس:</td>
							<td>
								<?php echo $_SESSION['user_name'];?>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> ثبت معرفی نامه:</td>
							<td><input type="file" size="30" name="app_photo"  id="app_photo" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td width="20%"> تاریخ مراجعه:</td>
							<td align="right" >
							<input type="text" name="fromdate" id="fromdate" class="validate[required,custom[date]]" size="30"  />
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('fromdate', this);"/>
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> تعداد همراه:</td>
							<td><input type="text" size="30"  name="numofdependents"  id="numofdependents" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نوع ویزا:</td>
							<td>
							<select name="visatype" id="visatype" class="validate[required]" style="height:30px; width:190px">
								<option value="">انتخاب نوع ویزا</option>
								<?php
									$sql="select * from visatypes";
									$retype=mysql_query($sql) or die (mysql_error());
									while($rwtype=mysql_fetch_array($retype)){
										echo "<option value='$rwtype[id]'>$rwtype[name]</option>";
									}
								?>
							</select>
							
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور گذرنامه:</td>
							<td>
							<input type="text" size="30"  name="passissuedate"  id="passissuedate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل صدور گذرنامه:</td>
							<td>
							<input type="text" size="30"  name="passissueplace"  id="passissueplace"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> پیوست درخواست:</td>
							<td><select name="requesttype" id="requesttype"  style="height:30px; width:190px">
								<option value="">انتخاب نوع پیوست</option>
								<option value="درخواست">درخواست متقاضی</option>
								<option value="نامه">نامه</option>
							</select></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> دستور رسیدگی:</td>
							<td>
							<input type="text" size="30"  name="visaorder"  id="visaorder"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td>مجوز مرکز (شماره):</td>
							<td>
							<input type="text" size="30"  name="centernum"  id="centernum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مجوز مرکز (تاریخ):</td>
							<td>
							<input type="text" size="30"  name="centerdate"  id="centerdate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مدت اقامت:</td>
							<td>
							<input type="text" size="30"  name="applimitdays"  id="applimitdays"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> قیمت ویزا:</td>
							<td>
							<input type="text" size="30" name="appvisaprice"  id="appvisaprice"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> ارجعیت:</td>
							<td>
							<input type="text" size="30"  name="arjaeet"  id="arjaeet"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره روادید صادره:</td>
							<td>
							<input type="text" size="30"  name="visanum"  id="visanum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور روادید:</td>
							<td>
							<input type="text" size="30"  name="visaissuedate"  id="visaissuedate"  /> 

							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> توضیح:</td>
							<td><textarea type="text" cols='33' rows='6' name="details"  id="details" ></textarea></td>
						</tr>
						</table>
						
							<div >
							</div>
						
						<input type="submit" class="submit"  name="insertdriver" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab2"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"etehadie_apps.php?ecode=$viewid\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' name='cancel' value='انصراف'/></td>";?>
						
					</div></br></br>
					<?php
					if(isset($_POST['insertdriver'])){
						
						$sql="Insert into vapplicants (name, family, father_name, passportnum, work_field, address, education, address_iran, address_afghanistan, birthdate, birthplace, marital_status,phone, supervisor, source_id) values ('$_POST[vname]',
						'$_POST[vfamily]','$_POST[vfathername]', '$_POST[vpassnum]', '$_POST[work]', '$_POST[vaddress]', '$_POST[education]', '$_POST[iraddress]', '$_POST[afghanistanadd]', '$_POST[bdate]','$_POST[bplace]', '$_POST[marital_status]', '$_POST[vphone]',  '$_SESSION[user_id]', '$viewid')";
						mysql_query($sql) or die(mysql_error());
						//Getting the last id
						$sqgetid="select id from vapplicants order by id desc LIMIT 1";
						$resgetid=mysql_query($sqgetid) or die (mysql_error());
						$rwgetid=mysql_fetch_array($resgetid);
						//Adding visa history
						$sql="insert into visa_history (applicant_id, fromdate, supervisor, newsource, numofdependents, visa_type, details, passportnum, passissuedate, passissueplace, attachtype, orderforvisa, center_mojavez_num, center_mojavez_date, arjaeet, visanumber, visaissuedate, visaprice, limitdays, requestdate) 
						values('$rwgetid[id]', '$_POST[fromdate]', '$_SESSION[user_id]', '$roo[name]', '$_POST[numofdependents]', '$_POST[visatype]', '$_POST[details]', '$_POST[vpassnum]', '$_POST[passissuedate]', 
						'$_POST[passissueplace]', '$_POST[requesttype]', '$_POST[visaorder]', '$_POST[centernum]', '$_POST[centerdate]', '$_POST[arjaeet]', '$_POST[visanum]', '$_POST[visaissuedate]', '$_POST[appvisaprice]', '$_POST[applimitdays]', '$_POST[requestdate]')";
						mysql_query($sql) or die (mysql_error());
						
						//Creating a new folder
						
						mkdir("app-attachments/$rwgetid[id]");
						//
						$filename=$_FILES['app_photo']['name'];
						if($filename!="" and $filename!=null){
						 $file_ext = substr($filename, strripos($filename, '.'));
						$sql="insert into attachments (applicant_id, description, format, created_at) values ('$rwgetid[id]', 'معرفی نامه', '$file_ext', '$_POST[fromdate]')";
						mysql_query($sql) or die (mysql_error());
						$sqgetid="select id from attachments order by id desc LIMIT 1";
						$rsgetid=mysql_query($sqgetid) or die (mysql_error());
						$rwgetattid=mysql_fetch_array($rsgetid);
						
						  $newfilename =$rwgetattid['id'].$file_ext;
						  $destination = "app-attachments/$rwgetid[id]/".$newfilename;
						  $temp_file = $_FILES['app_photo']['tmp_name'];
						  move_uploaded_file($temp_file,$destination);
						  //Resizing Image
							   $image = new SimpleImage();
							   $image->load($destination);
							   $image->scale(65);

					   $image->save($destination);
							}

						header("location:etehadie_apps.php?ecode=$viewid");
						die();
						//}
						}
					?>
				وضعیت اتحادیه یا صنف : <select name="costatus" id="costatus">
				<option value="">انتخاب وضعیت</option>
				<?php
					$sql="select id, status, details from blacklist where source_id='$viewid'";
					$rsstatus=mysql_query($sql) or die (mysql_error());
					$rwstatus=mysql_fetch_array($rsstatus);
					echo $rsstatus;
					if($rwstatus['id']==null){
						$sql="insert  into blacklist  (status, source_id) values('1', '$viewid')";
						$rsstatus=mysql_query($sql) or die (mysql_error());
						echo "<option value='1' selected>فعال</option>
						<option value='0'>غیر فعال </option>";
					}else{
						if($rwstatus['status']==1){
							echo "<option value='1' selected>فعال</option>
						<option value='0'>غیر فعال </option>";
						}else{
							echo "<option value='1' >فعال</option>
						<option value='0' selected>غیر فعال </option>";
						}
					
					}
				?>
				
				</select>
				دلیل:<input type="text" name="statusdetail" value="<?php echo $rwstatus['details'];?>" id="statusdetail" size="50"/>
				<input type="submit" name="insertstatus"/>
				<?php
					if(isset($_POST['insertstatus'])){
						$sql="update blacklist set status='$_POST[costatus]', details='$_POST[statusdetail]' where source_id='$viewid'";
						mysql_query($sql) or die (mysql_error());
						header("location:etehadie_apps.php?ecode=$viewid&type=$_GET[type]#tabs-1");
						die();
					}
				?>
				
				<br/><br/>
				<h3>اعضای معرفی شده توسط اتحادیه/ صنف</h3>
				<br/>
						
				<table width="50%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام</th>
				<th>نام پدر</th>
				<th>تخلص</th>
				<th>زمینه فعالیت</th>
				<th>شماره تماس</th>
				<th>کارشناس</th>
				<th>نمایش پروفایل</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from vapplicants where source_id='$viewid' order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					$sq="select name from users where id='$row[supervisor]'";
					$rsuser=mysql_query($sq) or die (mysql_error());
					$rwuser=mysql_fetch_array($rsuser);
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name]</td>
					<td> $row[father_name]</td>
					<td>$row[family]</td>
					<td> $row[work_field]</td>
					<td>$row[phone]</td>
					<td>$rwuser[name]</td>
					<td> <a style='color:blue' href='otherprofile.php?appid=$row[id]'>نمایش پروفایل</a></td>
					";
					echo "
					</tr>
					";
					$i++;
				
				}
				?>
				</table>
				</div>
				<div id="tabs-2">
				<br/>
				<table id="dtable">
				<tr>
				<th>توضیح فایل</th>
				<th>تاریخ</th>
				<th>آپلود فایل</th>
				</tr><tr>
				<td><input type="text" name="attachdetail[]" id="attachdetail1" class="validate[required]"/></td>
				<td><input type="text" name="date[]" id="date1" class="validate[required]"/></td>
				<td><input type="file" name="attach[]" id="attach1" class="validate[required]"/></td>
				</tr>
				</table>
				<br/><div align="center">
						<input type="button" id="button1" style="background-color:white; border:0; background-image:url(img/add.gif); width:21px;height:21px " onclick="AddNewfile(),jQuery('#myform').validationEngine('hide'),calctotal()" class="add-row"/>
				<input type="button" id="button2" style="background-color:white; border:0; background-image:url(img/remove.gif); width:21px;height:21px  " onclick="removeRowfile(),jQuery('#myform').validationEngine('hide'),calctotal()" class="remove-row"/></br>
				</div>
						<input type="submit" class="submit"  name="insertattach" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" />
				<a  href='source-attachments/<?php echo $viewid;?>/' target="_blank" ><input type="button"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:160px;margin-right:15px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="نمایش آرشیو فایلهای شرکت" />
							</a>
				<br/>
				<?php
					if(isset($_POST['insertattach'])){
						for($j=0;$j<sizeof($_POST['attachdetail']); $j++){
						$filename=$_FILES['attach']['name'][$j];
							 $file_ext = substr($filename, strripos($filename, '.'));
							$sql="insert into attachments (company_code, description, format, created_at) values ('$viewid', '".$_POST['attachdetail'][$j]."', '$file_ext', '".$_POST['date'][$j]."')";
							mysql_query($sql) or die (mysql_error());
							$sqgetid="select id from attachments where company_code='$viewid' order by id desc LIMIT 1";
							$rsgetid=mysql_query($sqgetid) or die (mysql_error());
							$rwgetid=mysql_fetch_array($rsgetid);
							
							//$filename=$_FILES['attach']['name'][$j];
							// $file_ext = substr($filename, strripos($filename, '.'));

							  $newfilename =$rwgetid['id'].$file_ext;
							  $destination = "source-attachments/$viewid/".$newfilename;
							  $temp_file = $_FILES['attach']['tmp_name'][$j];
							  move_uploaded_file($temp_file,$destination);
							  //Resizing Image
							   $image = new SimpleImage();
							   $image->load($destination);
							   $image->scale(65);

					   $image->save($destination);
						  }
						header("location:etehadie_apps.php?ecode=$viewid#tabs-2");
					die();
					}
				
				?>
				<br/>
				<table width="50%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام فایل</th>
				<th>تصویر فایل</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from attachments where company_code='$viewid' order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[description]</td>
					<td><a href='source-attachments/$viewid/".$row['id'].$row['format']."' target='_blank'><img src='source-attachments/$viewid/".$row['id'].$row['format']."' style='width:100px; height:70px'/></a></td>
					";
					
					echo"
					<td><a href='etehadie_apps.php?delattach=$row[id]&ecode=$viewid&ftype=$row[format]' class='confirm'><img src='img/cancel.png'/></a></td>";
					
					echo "
					</tr>
					";
					$i++;
				
				}
				
				if(isset($_GET['delattach'])){
					$sql="delete from attachments where id='$_GET[delattach]'";
					mysql_query($sql) or die (mysql_error());
					unlink("source-attachments/$viewid/".$_GET['delattach'].$_GET['ftype']);
					header("location:etehadie_apps.php?ecode=$viewid#tabs-2");
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
include("template_footer.php");
?>
</body>
</html>
