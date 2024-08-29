<?php
include("template_header.php");
require_once("../library/image_resize.php");
require_once("dependants_deps_addremowrow.php");
$viewid=$_GET['ecode'];
$fexists=file_exists ("source-attachments/$viewid/") ;
if($fexists!=true){
mkdir("source-attachments/$viewid/");
}
//mkdir("source-attachments/$viewid/");
?>
<script>
function checkpassnum(passnum,sourceid)
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
			 
				xmlhttp.open('GET','companies_checkpassajax.php?passnumber='+passnum+'&sourceid='+sourceid,true);
				xmlhttp.send();
}

function checkpassnumothers(passnum,appname)
{
var divid="otherpassnumdiv";
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
			 
				xmlhttp.open('GET','all_others_checkpassajax.php?passnumber='+passnum+'&appname='+appname,true);
				xmlhttp.send();
}
</script>

	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="companies.php">صفحه قبل</a>
				<!-- First level MENU -->
			</li>
			<li>
			<a href="homepage.php">صفحه اصلی</a>
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php echo "<form action='company_apps.php?ecode=$viewid&type=$_GET[type]' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		<?php
			$sq="select activity_background from sources where id='$viewid'";
			$rsbackground=mysql_query($sq) or die (mysql_error());
			$rwbackground=mysql_fetch_array($rsbackground);
			$sql="select id, name, responsibility from vapplicants where source_id='$viewid' and responsibility='boss'";
			$res=mysql_query($sql) or die(mysql_error());
			$ro=mysql_fetch_array($res);
			$sql="select code, type, name, phonenum, address, activity_background from sources where id='$viewid'";
			$res=mysql_query($sql) or die(mysql_error());
			$roo=mysql_fetch_array($res);
			//Getting information of vice president
			$sql="select id, name, responsibility from vapplicants where source_id='$viewid' and responsibility='vicep'";
			$res=mysql_query($sql) or die(mysql_error());
			$rowvice=mysql_fetch_array($res);
			
			$responsiblename=$ro['name'];
			$responsibleid=$ro['id'];
			$responsibility=$ro['responsibility'];
			
			if($responsibleid!=""){
			echo "<span>
			
			
			<br/> <a href='company_apps_edit.php?editid=$responsibleid&ecode=$viewid&type=1'><img style='height:75px; width:60px;' src='appphotos/$responsibleid".".jpg"."?".time()."'/></a> رئیس مرکز: $responsiblename>>>>";
			if($rowvice['id']!=""){echo "<a href='company_apps_edit.php?editid=$rowvice[id]&ecode=$viewid&type=1' ><img style='height:75px; width:60px;margin-right:150px' src='appphotos/$rowvice[id]".".jpg"."?".time()."'/></a> معاون: $rowvice[name]>>></span>";
			}
			}else{
			echo "<div style='color:red' >رئیس مرکز تعیین نگردیده است!</div>";
			}
		?>
			<fieldset>
				<legend align="right"><span dir="rtl">نام مرکز: <?php echo $roo['name'];?>>> شماره ثبت: <?php echo $roo['code'];?> >> شماره تماس: <?php echo $roo['phonenum'];?>  >> آدرس: <?php echo $roo['address'];?>>> زمینه فعالیت: <?php echo $roo['activity_background'];?></span></legend>
			<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>

					<li><a href="#tabs-1">مشخصات عمومی</a></li>
					<li><a href="#tabs-2">سوابق ویزایی</a></li>
					<li><a href="#tabs-3">سایرین</a></li>
				
					<li><a href="#tabs-4">اسناد</a></li>
					<?php 
					
					
					echo "<li><a href='#tabs-5'>سوابق شرکت</a></li>";
					
					
				?>
				
				</ul>
				<div id="tabs-1">
						
						<a href="#" id="addlink" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن عضو جدید</b></a>
						<a href="#" id="addlinkback" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن عضو جدید</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						
						<div id="addlinkdata" >
						<table width="70%">
						<tr align="right">
							<td width="20%"> نام:</td>
							<td align="right" ><input type="text" size="30" name="app_name" onkeyup="searchnames(this.value)" class="validate[required]" id="app_name" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نام پدر:</td>
							<td><input type="text" size="30" name="app_fathername" class="validate[required]" id="app_fathername" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تخلص:</td>
							<td><input type="text" size="30" name="app_fname"  id="app_fname" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> وضعیت تاهل:</td>
							
							<td>
							<select name="marital_status" id="marital_status" style="width:190px" >
								<option value="">انتخاب وضعیت تاهل</option>
								<option value="متاهل">متاهل</option>
								<option value="مجرد">مجرد</option>
							</select>
							</td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نام همسر:</td>
							
							<td><input type="text" size="30" name="wife"  id="wife" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> میزان تحصیلات:</td>
							
							<td><input type="text" size="30" name="education"  id="education" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> نام فرزندان:</td>
							
							<td><input type="text" size="30" name="sons"  id="sons" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره تماس:</td>
							<td><input type="text" size="30" name="app_phone"  id="app_phone" /></td>
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
							<td> عنوان متقاضی:</td>
							<td>
							<select name="app_position"  id="app_position"  style="width:190px">
							<option value="">عنوان متقاضی</option>
							
							<option value="boss">رئیس</option>
							
							<option value="vicep">معاون</option>
							
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> عکس کارمند:</td>
							<td><input type="file" size="30" name="app_photo"  id="app_photo" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						</table>
						
							<div >
							</div>
						
						<input type="submit" class="submit"  name="insertapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"company_apps.php?ecode=$viewid&type=$_GET[type]\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' name='cancel' value='انصراف'/></td>";?>
						
					</div></br></br>
					<?php
					if(isset($_POST['insertapplicant'])){
						 $filename=$_FILES['app_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
												 
							$phone=$_POST['app_phone'];
							$file_ext=".jpg";
							$oldposition="";
							if($_POST['app_position']=="boss"){
								$oldposition="oldboss";
							}else if($_POST['app_position']=="vicep"){
								$oldposition="oldvicep";
							}
						$sql="Update  vapplicants set responsibility='$oldposition' where source_id='$viewid' and responsibility='$_POST[app_position]'";
						mysql_query($sql) or die(mysql_error());
						
						$sql="Insert into vapplicants (name, family, father_name, wife, sons, phone, responsibility, work_field, education, address_iran, address_afghanistan, birthdate, birthplace, marital_status, source_id) values ('$_POST[app_name]',
						'$_POST[app_fname]', '$_POST[app_fathername]', '$_POST[wife]', '$_POST[sons]', '$phone', '$_POST[app_position]', '$rwbackground[activity_background]', '$_POST[education]', '$_POST[iraddress]', '$_POST[afghanistanadd]', '$_POST[bdate]','$_POST[bplace]', '$_POST[marital_status]', '$viewid')";
						mysql_query($sql) or die(mysql_error());
						$sql="select id from vapplicants order by id desc LIMIT 1";
						$res=mysql_query($sql) or die(mysql_error());
						$row=mysql_fetch_array($res); 
						
						  $newfilename =$row['id'].$file_ext;
						  $destination = "appphotos/".$newfilename;
						  $temp_file = $_FILES['app_photo']['tmp_name'];
						  move_uploaded_file($temp_file,$destination);
							//Resizing Image
					   $image = new SimpleImage();
					   $image->load($destination);
					   $image->resize(75,90);

					   $image->save($destination);
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]");
						die();
						//}
						}
					?>
								وضعیت شرکت : <select name="costatus" id="costatus">
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
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-1");
						die();
					}
				?>
				
				<br/><br/>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام</th>
				<th>نام پدر</th>
				<th>عنوان</th>
				<th>تلفن</th>
				<th>همسر</th>
				<th>فرزندان</th>
				<th>عکس</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from vapplicants where source_id='$viewid' and (responsibility='boss' || responsibility='vicep') and type!='driver' order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					if($row['responsibility']=="boss"){
						$responsibility="رئیس";
					}else if($row['responsibility']=="vicep"){
						$responsibility="معاون";
					}
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name]</td>
					<td> $row[father_name]</td>
					<td>$responsibility</td>
					<td> $row[phone]</td>
					<td>$row[wife]</td>
					<td> $row[sons]</td>
					";
					
					echo"
					<td><img style='width:30px;height:30px' src='appphotos/".$row['id'].".jpg?".time()."'/></td>";
					$sq="select count(id) from visa_history where applicant_id='$row[id]' ";
					$rs=mysql_query($sq) or die (mysql_error());
					$rwcountdep=mysql_fetch_array($rs);
					$countdependant=$rwcountdep['count(id)'];
	
					if($countdependant==0){
					echo"<td><a href='company_apps.php?delid=$row[id]&ecode=$viewid&type=$_GET[type]' class='confirm'><img src='img/cancel.png' title='پاک کردن درخواست کننده'/></a>";
					}else{
						echo "<td><img src='img/cancel1.png'/>";
					}
					echo "<a href='company_apps_edit.php?editid=$row[id]&ecode=$viewid&type=1'><img src='img/edit.png' title='ویرایش درخواست کننده'/></a>
					</tr>
					";
					$i++;
				
				}
				?>
				<?php
				
				if(isset($_GET['delid'])){
					//$sql="Delete from karvan_applicants_getinfo where applicant_id='$_GET[delid]' and karvan_id='$_GET[kid]'";
					//$res=mysql_query($sql) or die(mysql_error());
					$sql="delete from vapplicants where id='$_GET[delid]'  and source_id='$viewid'";
					mysql_query($sql) or die(mysql_error());
					
					header("location:company_apps.php?ecode=$viewid&type=$_GET[type]");
					die();
				}
				if(isset($_GET['editid'])){
				
					header("location:company_apps_edit.php?appid=$_GET[editid]&kid=$_GET[kid]");
					die();
				}
				
				
				?>
				</table>
			    </div>
				
				
					     
				<div id="tabs-2">
				<a href="#" id="addlink_tab2" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن عملکرد جدید</b></a>
						<a href="#" id="addlinkback_tab2" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن عملکرد جدید</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						
						<div id="addlinkdata_tab2" >
						<span id="checkpass" align="center"></span>
						<table width="70%">
						
						<tr align="right">
							<td>شماره پاسپورت</td><td>
							<input type="text" size="30"  class="validate[checkDuplicate[passportnum2],required]" onkeyup="checkpassnum(this.value,<?php echo $viewid;?>)" name="passnum1" id="passnum1"/>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ مراجعه: </td>
							<td>
							<input type="text" size="30"  name="requestdate"  id="requestdate" class="validate[required]" /> 
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('requestdate', this);"/>

							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td width="20%"> نام متقاضی:</td>
							<td align="right" >
							<select name="applicantname" id="applicantname" class="validate[required]" width="190px">
							<option value="">انتخاب رئیس یا معاون</option>
							<?php
								$sql="select id, name, responsibility from vapplicants where source_id='$viewid' and (responsibility='boss' or responsibility='vicep')";
								$res=mysql_query($sql) or die (mysql_error());
								while($rw=mysql_fetch_array($res)){
									$apptype="";
									if($rw['responsibility']=="boss"){
										$apptype="(رئیس)";
									}
									if($rw['responsibility']=="vicep"){
										$apptype="(معاون)";
									}
									echo "<option value='$rw[id]' >$rw[name] $apptype </option> ";
								
								}
							?>
							</select>
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td width="20%"> از تاریخ:</td>
							<td align="right" >
							
							<input type="text" name="fromdate"  id="fromdate" class="validate[required,custom[date]]" size="30"  />
				<!--<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('fromdate', this);"/>
				-->
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تا تاریخ:</td>
							<td>
							<input type="text" name="todate" id="todate" class="validate[required,custom[date]]" size="30"  />
				<!--<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('todate', this);"/>
				-->
				</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> عملکرد (واردات):</td>
							<td><input type="text" size="30"  name="donejobs" value="0" id="donejobs"  class="validate[custom[integer]]"/> 
							<select name="mcurrency1" id="mcurrency1" >
							<option value="">انتخاب واحد پولی</option>
							<option value="میلیارد">میلیارد</option>
							<option value="میلیون">میلیون</option>
							<option value="دلار">دلار</option>
							</select>
							 </td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> عملکرد (صادرات):</td>
							<td>
							<input type="text" size="30"  name="donejobs_ex" value="0" id="donejobs_ex"  class="validate[custom[integer]]"/> 
							<select name="mcurrency2" id="mcurrency2" >
							<option value="">انتخاب واحد پولی</option>
							<option value="میلیارد">میلیارد</option>
							<option value="میلیون">میلیون</option>
							<option value="دلار">دلار</option>
							</select>
							 </td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
					<tr align="right">
							<td width="20%"> کارشناس:</td>
							<td align="right" >
							<?php echo $_SESSION['user_name'];?>
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نوع ویزا:</td>
							<td><select name="visatype" id="visatype" class="validate[required]" style="height:30px; width:190">
								<option value="">انتخاب نوع ویزا</option>
								<?php
									$sql="select * from visatypes";
									$retype=mysql_query($sql) or die (mysql_error());
									while($rwtype=mysql_fetch_array($retype)){
										echo "<option value='$rwtype[id]'>$rwtype[name]</option>";
									}
								?>
							</select></td>
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
							<input type="text" size="30"  name="appvisaprice"  id="appvisaprice"  /> 
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
							<td><input type="text" size="30"  name="details"  id="details" /></td>
						</tr>
						</table>
							<br/>
						<input type="submit" class="submit"  name="insertdone" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab2"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-2\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' value='انصراف'/></td>";?>

				</div><br/>
				<?php
					if(isset ($_POST['insertdone'])){
						$sql="insert into visa_history (applicant_id, fromdate, todate, import_amount, export_amount, currency_imp, currency_exp, details, visa_type, supervisor, passportnum, passissuedate, passissueplace, attachtype, orderforvisa, center_mojavez_num, center_mojavez_date, arjaeet, visanumber, visaissuedate, visaprice, limitdays, requestdate) 
						values('$_POST[applicantname]', '$_POST[fromdate]', '$_POST[todate]', '$_POST[donejobs]', '$_POST[donejobs_ex]', '$_POST[mcurrency1]', '$_POST[mcurrency2]', '$_POST[details]', '$_POST[visatype]', '$_SESSION[user_id]', '$_POST[passnum1]', '$_POST[passissuedate]', 
						'$_POST[passissueplace]', '$_POST[requesttype]', '$_POST[visaorder]', '$_POST[centernum]', '$_POST[centerdate]', '$_POST[arjaeet]', '$_POST[visanum]', '$_POST[visaissuedate]', '$_POST[appvisaprice]', '$_POST[applimitdays]', '$_POST[requestdate]')";
						mysql_query($sql) or die (mysql_error());
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-2");
						die();
					}
				
				?>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام و وظیفه</th>
				<th>شماره پاسپورت</th>
				<th>از تاریخ</th>
				<th>تا تاریخ</th>
				<th>واردات</th>
				<th>صادرات</th>
				<th>نوع ویزا</th>
				<th>کارشناس</th>
				<th>چاپ فرمها</th>
				<th>توضیح</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from vapplicants where source_id='$viewid' and (responsibility='boss' or responsibility='vicep') order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					if($row['responsibility']=="boss"){
						$responsibility="رئیس";
					}else if($row['responsibility']=="vicep"){
						$responsibility="معاون";
					}
					$sq="select * from visa_history where applicant_id='$row[id]' order by id desc";
					$rs=mysql_query($sq) or (mysql_error());
					while($rw=mysql_fetch_array($rs)){
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name] ($responsibility)</td>
					<td> $rw[passportnum]</td>
					<td> $rw[fromdate]</td>
					<td>$rw[todate]</td>
					<td> $rw[import_amount] $rw[currency_imp]</td>";
		
					$sq="select name from users where id='$rw[supervisor]'";
					$rsuser=mysql_query($sq) or die (mysql_error());
					$rwuser=mysql_fetch_array($rsuser);
					echo"
					<td> $rw[export_amount] $rw[currency_exp]</td>";
					$sqtypename="select name from visatypes where id='$rw[visa_type]'";
					$rstypename=mysql_query($sqtypename) or die (mysql_error());
					$rwtypename=mysql_fetch_array($rstypename);
					
					echo "<td> $rwtypename[name]</td>
					<td> $rwuser[name]</td>
					<td> <a href='resume_visaform_excel.php?resumeid=$rw[id]' style='color:blue'>فرم ویزا</a> | <a href='resume_bill_excel.php?resumeid=$rw[id]' style='color:blue'>فیش بانکی</a> </td>
					<td>$rw[details]</td>
					";
					echo "<td><a href='resume_apps_edit.php?applicantid=$row[id]&editid=$rw[id]&ecode=$viewid&type=1'><img src='img/edit.png' title='ویرایش درخواست کننده'/></a>
					
					";
					echo"<a href='company_apps.php?delresumeid=$rw[id]&ecode=$viewid&type=$_GET[type]#tabs-2' class='confirm'><img src='img/cancel.png' title='پاک کردن درخواست کننده'/></a>
					</td></tr>";
					
					$i++;
					}
				
				}
				?>
				<?php
					if(isset($_GET['accept'])){
						$sq="update visa_history set back='1' where id='$_GET[backapp]'";
						mysql_query($sq) or die (mysql_error());
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-2");
						die();
					}
					if(isset($_GET['delresumeid'])){
						$sq="delete from visa_history where id='$_GET[delresumeid]'";
						mysql_query($sq) or die (mysql_error());
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-2");
						die();
					}
				?>
				</table>
				</div>
				
				
				<div id="tabs-3">
					<a href="#" id="addlink_tab3" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن ویزای سایرین</b></a>
						<a href="#" id="addlinkback_tab3" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن ویزای سایرین</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						
						<div id="addlinkdata_tab3" >
						<span id="otherpassnumdiv"></span>
						<table width="70%">
						<tr align="right">
							<td width="20%"> شماره پاسپورت:</td>
							<td align="right" >
							<input type="text" size="30"  name="passnum"  id="passnum" onkeyup="checkpassnumothers(this.value,document.getElementById('depname').value)" class="validate[checkDuplicate[otherpassportnum2],required]" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td> تاریخ مراجعه: </td>
							<td>
							<input type="text" size="30"  name="requestdate2"  id="requestdate2" class="validate[required]" /> 
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('requestdate2', this);"/>

							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td width="20%"> نام متقاضی:</td>
							<td align="right" >
							<input type="text" size="30"  name="depname" class="validate[required]" id="depname" onkeyup="checkpassnumothers(document.getElementById('passnum').value,this.value)"  />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						
						<tr align="right">
							<td width="20%"> نام پدر:</td>
							<td align="right" >
							<input type="text" size="30"  name="depfname"  id="depfname"  />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
					<tr align="right">
							<td width="20%"> نسبت:</td>
							<td align="right" >
							<input type="text" size="30"  name="relation"  id="relation"  />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>			
						<tr align="right">
							<td> آدرس افغانستان:</td>
							
							<td><input type="text" size="70" name="oafghanistanadd"  id="oafghanistanadd" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td> آدرس ایران:</td>
							
							<td><input type="text" size="70" name="oiraddress"  id="oiraddress" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ تولد:</td>
							
							<td><input type="text" size="30" name="obdate"  id="obdate" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل تولد:</td>
							
							<td><input type="text" size="30" name="obplace"  id="obplace" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> وضعیت تاهل:</td>
							
							<td>
							<select name="omarital_status" id="omarital_status"  style="width:190px">
								<option value="">انتخاب وضعیت تاهل</option>
								<option value="متاهل">متاهل</option>
								<option value="مجرد">مجرد</option>
							</select>
							</td>
							</td>
						</tr>
						
						<tr align="right">
							<td> میزان تحصیلات:</td>
							
							<td><input type="text" size="30" name="oeducation"  id="education" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
					<tr align="right">
							<td width="20%"> تعداد همراهان:</td>
							<td align="right" >
							<input type="text" size="30"  name="dependentamount"  id="dependentamount" class="" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نوع ویزا:</td>
							<td>
							<select name="ovisatype" id="ovisatype" class="validate[required]" style="height:30px; width:190">
								<option value="">انتخاب نوع ویزا</option>
								<?php
									$sql="select * from visatypes";
									$retype=mysql_query($sql) or die (mysql_error());
									while($rwtype=mysql_fetch_array($retype)){
										echo "<option value='$rwtype[id]'>$rwtype[name]</option>";
									}
								?>
							</select>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور گذرنامه:</td>
							<td>
							<input type="text" size="30"  name="opassissuedate"  id="opassissuedate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل صدور گذرنامه:</td>
							<td>
							<input type="text" size="30"  name="opassissueplace"  id="opassissueplace"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> پیوست درخواست:</td>
							<td><select name="orequesttype" id="orequesttype"  style="height:30px; width:190">
								<option value="">انتخاب نوع پیوست</option>
								<option value="درخواست">درخواست متقاضی</option>
								<option value="نامه">نامه</option>
							</select></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> دستور رسیدگی:</td>
							<td>
							<input type="text" size="30"  name="ovisaorder"  id="ovisaorder"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td>مجوز مرکز (شماره):</td>
							<td>
							<input type="text" size="30"  name="ocenternum"  id="ocenternum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مجوز مرکز (تاریخ):</td>
							<td>
							<input type="text" size="30"  name="ocenterdate"  id="ocenterdate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> ارجعیت:</td>
							<td>
							<input type="text" size="30"  name="oarjaeet"  id="oarjaeet"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره روادید صادره:</td>
							<td>
							<input type="text" size="30"  name="ovisanum"  id="ovisanum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور روادید:</td>
							<td>
							<input type="text" size="30"  name="ovisaissuedate"  id="ovisaissuedate"  /> 

							</td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>	
					<tr align="right">
							<td width="20%"> کارشناس:</td>
							<td align="right" >
							<?php echo $_SESSION['user_name'];?>
				</td>
						</tr>
							<tr><td colspan='2'><br/></td></tr>	
					<tr align="right">
							<td width="20%"> مبلغ ویزا:</td>
							<td align="right" >
							<input type="text" size="30"  name="visaprice"  id="visaprice" class="" />
				</td>
						</tr>
							<tr><td colspan='2'><br/></td></tr>	
					<tr align="right">
							<td width="20%"> مدت اقامت:</td>
							<td align="right" >
							<input type="text" size="30"  name="limitdays"  id="limitdays" class="" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td width="20%"> توضیحات:</td>
							<td align="right" >
							<input type="text" size="70" name="depdetails"  id="depdetails" class="" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						</table>
						<table id="deptable" align="center">
						<tr align="center" style="height:20px; background-color:grey; color:white;"><td colspan="7"><b>لیست همراهان</b></td></tr>
						<tr>
						<th>نام</th>
						<th>نام خانوادگی</th>
						<th>نام پدر</th>
						<th>تاریخ تولد</th>
						<th>نسبت</th>
						<th>تحصیلات</th>
						<th>شغل</th>
						</tr>
					<tr>
					<td><input type="text" id="depdepname1" name="depdepname[]"  size='16'/></td>
			
					<td><input type="text" id="deplastname1" name="deplastname[]"  size='16'/></td>
				
					<td><input type="text" id="depfather1" name="depfather[]"  size='16'/></td>
				
						<td><input type="text" name="depbirthdate[]"   size="16"   /></td>
				
					<td><input type="text" id="deprelation1" name="deprelation[]"  size='16'/></td>
				
					<td><input type="text" id="depeducation1" name="depeducation[]"  size='16'/></td>
				
					<td><input type="text" id="depjob1" name="depjob[]" size='16'/></td>
				</tr>
						</table>
						<br/><div align="center">
						<input type="button" id="button1" style="background-color:white; border:0; background-image:url(img/add.gif); width:21px;height:21px " onclick="AddNew(),jQuery('#myform').validationEngine('hide'),calctotal()" class="add-row"/>
				<input type="button" id="button2" style="background-color:white; border:0; background-image:url(img/remove.gif); width:21px;height:21px  " onclick="removeRow(),jQuery('#myform').validationEngine('hide'),calctotal()" class="remove-row"/></br>
				</div>
						<input type="submit" class="submit"  name="insertdep" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab3"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-2\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' value='انصراف'/></td>";?>

				</div><br/>
				<?php
					if(isset ($_POST['insertdep'])){
						$sql="insert into dependent_visa (source_id, name, father_name, supervisor, relation, dependentamount, passportnum, visa_type, visaprice, limitdays, 
						iranaddress, afghanistanadd, birthdate, birthplace, marital_status, education, passissuedate, passissueplace, attachtype, visaorder, centernum, centerdate, arjaeet, visanum, visadate,
						details, requestdate) values('$viewid', '$_POST[depname]', '$_POST[depfname]', '$_SESSION[user_id]', '$_POST[relation]', '$_POST[dependentamount]', '$_POST[passnum]', '$_POST[ovisatype]', '$_POST[visaprice]',
						'$_POST[limitdays]', '$_POST[oiraddress]', '$_POST[oafghanistanadd]', '$_POST[obdate]', '$_POST[obplace]',
						'$_POST[omarital_status]', '$_POST[oeducation]', '$_POST[opassissuedate]', '$_POST[opassissueplace]', '$_POST[orequesttype]', '$_POST[ovisaorder]', 
						'$_POST[ocenternum]', '$_POST[ocenterdate]', '$_POST[oarjaeet]','$_POST[ovisanum]', '$_POST[ovisaissuedate]', '$_POST[depdetails]', '$_POST[requestdate2]')";
						mysql_query($sql) or die (mysql_error());
						//Getting the last inserted id
						$sql="select id from dependent_visa order by id desc LIMIT 1";
						$res=mysql_query($sql) or die (mysql_error());
						$rwdepid=mysql_fetch_array($res);
						for($i=0; $i<sizeof($_POST['depdepname']);$i++){
							echo $_POST['depdepname'][$i];
							if($_POST['depdepname'][$i]!="" and $_POST['depdepname'][$i]!=null ){
								$sq="insert into  dependent_visa_dependants (name, family, father_name, birthdate, relation, education, job, parent_id) 
								values ('".$_POST['depdepname'][$i]."', '".$_POST['deplastname'][$i]."', '".$_POST['depfather'][$i]."', '".$_POST['depbirthdate'][$i]."'
								, '".$_POST['deprelation'][$i]."', '".$_POST['depeducation'][$i]."', '".$_POST['depjob'][$i]."', '$rwdepid[id]')";
								mysql_query($sq) or die (mysql_error());
							}
						
						}
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-3");
						die();
					}
				
				?>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام و ولد</th>
				<th>نسبت</th>
				<th>شماره پاسپورت</th>
				<th>نوع ویزا</th>
				<th>تاریخ صدور</th>
				<th>تعداد همراه</th>
				<th>کارشناس</th>
				<th>چاپ فرمها</th>
				<th>تایید بازگشت</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from dependent_visa where source_id='$viewid' order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					$sqtypename="select name from visatypes where id='$row[visa_type]'";
					$rstypename=mysql_query($sqtypename) or die (mysql_error());
					$rwtypename=mysql_fetch_array($rstypename);
					
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name] فرزند ($row[father_name])</td>
					<td> $row[relation]</td>
					<td> $row[passportnum]</td>
					<td> $rwtypename[name]</td>
					<td>$row[visadate]</td>
					<td>$row[dependentamount]</td>";
					//Getting the user name
					$sql="select name from users where id='$row[supervisor]'";
					$rsuser=mysql_query($sql) or die (mysql_error());
					$rwuser=mysql_fetch_array($rsuser);
					
					echo "<td>$rwuser[name]</td>
					<td> <a href='others_visaform_excel.php?appid=$row[id]' style='color:blue'>فرم ویزا</a> | <a href='others_bill_excel.php?appid=$row[id]' style='color:blue'>فیش بانکی</a> </td>
					";
					if($row['back']==1){
						echo "<td><img src='img/accept.png'/></td>";
					}else{
						echo "<td><a style='color:blue' href='company_apps.php?accept_dependent=1&ecode=$viewid&type=$_GET[type]&backdep=$row[id]#tabs-3' >تایید بازگشت</a></td>";
					}
					echo "<td><a href='company_apps_others_edit.php?editid=$row[id]&ecode=$viewid&type=1'><img src='img/edit.png' title='ویرایش درخواست کننده'/></a>
					
					";
					echo"<a href='company_apps.php?deliddep=$row[id]&ecode=$viewid&type=$_GET[type]#tabs-2' class='confirm'><img src='img/cancel.png' title='پاک کردن درخواست کننده'/></a>
					</td></tr>";
					
					$i++;
					}
				
				
				?>
				<?php
					if(isset($_GET['accept_dependent'])){
						$sq="update dependent_visa set back='1' where id='$_GET[backdep]'";
						mysql_query($sq) or die (mysql_error());
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-3");
						die();
					}
					if(isset($_GET['deliddep'])){
						$sq="delete from dependent_visa where id='$_GET[deliddep]'";
						mysql_query($sq) or die (mysql_error());
						header("location:transport_apps.php?ecode=$viewid&type=$_GET[type]#tabs-3");
						die();
					}
				?>
				</table>
				
				
				
				</div>
				<div id="tabs-4">
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
						header("location:company_apps.php?ecode=$viewid#tabs-4");
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
					<td><a href='company_apps.php?delattach=$row[id]&ecode=$viewid&ftype=$row[format]' class='confirm'><img src='img/cancel.png'/></a></td>";
					
					echo "
					</tr>
					";
					$i++;
				
				}
				
				if(isset($_GET['delattach'])){
					$sql="delete from attachments where id='$_GET[delattach]'";
					mysql_query($sql) or die (mysql_error());
					unlink("source-attachments/$viewid/".$_GET['delattach'].$_GET['ftype']);
					header("location:company_apps.php?ecode=$viewid#tabs-4");
					die();
					
				}
				?>
				</table>
				
				</div>
				
				<div id="tabs-5">
				<table width="50%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام</th>
				<th>نام پدر</th>
				<th>عنوان</th>
				<th>تلفن</th>
				<th>همسر</th>
				<th>فرزندان</th>
				<th>عکس</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from vapplicants where source_id='$viewid' and (responsibility='oldboss' || responsibility='oldvicep') order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					if($row['responsibility']=="boss"){
						$responsibility="رئیس";
					}else if($row['responsibility']=="vicep"){
						$responsibility="معاون";
					}
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name]</td>
					<td> $row[father_name]</td>
					<td>$responsibility</td>
					<td> $row[phone]</td>
					<td>$row[wife]</td>
					<td> $row[sons]</td>
					";
					
					echo"
					<td><img style='width:30px;height:30px' src='appphotos/".$row['id'].".jpg?".time()."'/></td>";
					
					echo "
					</tr>
					";
					$i++;
				
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
