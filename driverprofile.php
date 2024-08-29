<?php
include("template_header.php");
require_once("../library/image_resize.php");
require_once("dependants_deps_addremowrow.php");
$viewid=$_GET['pid'];
$fexists=file_exists ("driver-attachments/$viewid/") ;
if($fexists!=true){
mkdir("driver-attachments/$viewid/");
}
//mkdir("driver-attachments/$viewid/");
?>
<script >
function editresume(resumeid, pid)
{
var divid='edit'+resumeid;
	if (resumeid=='')
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
			 
				xmlhttp.open('GET','driverprofile_resume_edit.php?editid='+resumeid+'&profilenum='+pid,true);
				xmlhttp.send();
				
				
}

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

</script>
	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<?php
		$sql="select source_id from driver_profiles where id='$viewid' ";
		$rsgetsource=mysql_query($sql) or die (mysql_error());
		$rwgetsource=mysql_fetch_array($rsgetsource);
		
		$sql="select id, name, responsibility, source_id, type, position from vapplicants where profile_num='$viewid' and responsibility='new'";
			$res=mysql_query($sql) or die(mysql_error());
			$ro=mysql_fetch_array($res);
		
		?>
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
			<?php
					echo "<a href='transport_apps.php?ecode=$rwgetsource[source_id]#tabs-5'>صفحه قبل</a>";
			?>
			</li><li>
				<a href="homepage.php">صفحه اصلی</a>
				<!-- First level MENU -->
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php echo "<form action='driverprofile.php?pid=$viewid' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		<?php
	
			$responsiblename=$ro['name'];
			$responsibleid=$ro['id'];
			$responsibility="راننده فعلی";
			
			if($responsibleid!=""){
			echo "<span>
			
			
			<br/> <img style='height:75px; width:60px;margin-top:-10px' src='appphotos/$responsibleid".".jpg"."?".time()."'/> ";
			}else{
			echo "<div style='color:red' >راننده تعیین نگردیده است!</div>";
			}
		?>
			<fieldset>
				<legend align="right"><span dir="rtl">نام راننده فعلی :  <?php echo $responsiblename;?> >سمت یا وظیفه : <?php echo $ro['position']; ?></span></legend>
			<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>

					<li><a href="#tabs-1">مشخصات فعلی خودرو و راننده</a></li>
					<li><a href="#tabs-2">سوابق ویزایی</a></li>
					<li><a href="#tabs-3">اسناد</a></li>
				
					<li><a href="#tabs-4">رانندگان قبلی خودرو</a></li>
					<?php 
					echo "<li><a href='#tabs-5'>خودروهای قبلی</a></li>";
					
					
					
				?>
				
				</ul>
				<div id="tabs-1">
						
						<a href="#" id="addlink" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن خودرو</b></a>
						<a href="#" id="addlinkback" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن خودرو</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						
						<div id="addlinkdata" >
						<table width="50%">
						<tr align="right">
							<td width="20%"> نوع خودرو:</td>
							<td align="right" >
							<select name="cartype" id="cartype" class="validate[required]">
								<option value="">انتخاب نوع خودرو</option>
								<option value="سواری">سواری</option>
								<option value="کامیون" >کامیون</option>
								<option value="اتوبوس" >اتوبوس</option>
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مدل:</td>
							<td><input type="text" size="30" name="model"  id="model" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> پلاک:</td>
							<td><input type="text" size="30" name="plaque"  id="plaque" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره شاسی:</td>
							
							<td><input type="text" size="30" name="shasy"  id="shasy" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره انجین:</td>
							
							<td><input type="text" size="30" name="engine"  id="engine" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> حجم بار یا تعداد سرنشین:</td>
							<td><input type="text" size="30" name="storage"  id="storage" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>						
						<tr align="right">
							<td> مسیر تردد (مبدأ-مقصد):</td>
							<td>
								<input type="text" size="30" name="way"  id="way" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						</table>
						
							<div >
							</div>
						
						<input type="submit" class="submit"  name="insertcar" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"driverprofile.php?pid=$viewid#tabs-1\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' name='cancel' value='انصراف'/></td>";?>
						
					</div></br></br>
					<?php
					if(isset($_POST['insertcar'])){
												 
							$oldcar="";
							
						$sql="Update  cars set status='oldcar' where driver_profilenum='$viewid' ";
						mysql_query($sql) or die(mysql_error());
						
						$sql="Insert into cars (type, model, plaque, shasynum, enginenum, storage, way, driver_profilenum, status) values ('$_POST[cartype]',
						'$_POST[model]', '$_POST[plaque]', '$_POST[shasy]', '$_POST[engine]', '$_POST[storage]', '$_POST[way]', '$viewid', 'new')";
						mysql_query($sql) or die(mysql_error());
						header("location:driverprofile.php?pid=$viewid#tabs-1");
						die();
						//}
						}
					?>
				
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نوع خودرو</th>
				<th>مدل</th>
				<th>پلاک</th>
				<th>شاسی</th>
				<th>انجین</th>
				<th>مسیر تردد</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from cars where driver_profilenum='$viewid' and status='new' ";
				$res=mysql_query($sql) or die(mysql_error());
				
					$row=mysql_fetch_array($res);
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[type]</td>
					<td> $row[model]</td>
					<td> $row[plaque]</td>
					<td>$row[shasynum]</td>
					<td> $row[enginenum]</td>
					<td>$row[way]</td>
					";
					
					
	
					echo"<td><a href='driverprofile.php?delcar=$row[id]&pid=$viewid#tabs-1' class='confirm'><img src='img/cancel.png' title='حذف خودرو'/></a>";
					
					echo "<a href='driverprofile_car_edit.php?editid=$row[id]&profileid=$viewid' ><img src='img/edit.png' onclick='editcar($row[id], $viewid)' title='ویرایش درخواست کننده'/></a>
					</tr>
					
					";
					$carid=$row['id'];
				
				?>
				<?php
				
				if(isset($_GET['delcar'])){
					//$sql="Delete from karvan_applicants_getinfo where applicant_id='$_GET[delid]' and karvan_id='$_GET[kid]'";
					//$res=mysql_query($sql) or die(mysql_error());
					$sql="delete from cars where id='$_GET[delcar]' ";
					mysql_query($sql) or die(mysql_error());
					
					header("location:driverprofile.php?pid=$viewid#tabs-1");
					die();
				}
				
				?>
				</table>
				<br/><br/>
						<a href="#" id="addlink_tab2" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن راننده</b></a>
						<a href="#" id="addlinkback_tab2" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن راننده</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						
						<div id="addlinkdata_tab2" >
						<span id="checkpass"></span>
						<table width="60%">
						<tr align="right">
							<td> شماره گذرنامه:</td>
							
							<td><input type="text" size="30" name="dpass" class="validate[checkDuplicate[passportnum2],required]" onkeyup="checkpassnum(this.value)"  id="dpass" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نام:</td>
							<td><input type="text" size="30" name="dname" class="validate[required]" id="dname" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نام پدر:</td>
							<td><input type="text" size="30" name="dfather"  id="dfather" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تخلص:</td>
							<td><input type="text" size="30" name="dfamily"  id="dfamily" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> وضعیت تاهل:</td>
							
							<td>
							<select name="marital_status" id="marital_status" >
								<option value="">انتخاب وضعیت تاهل</option>
								<option value="متاهل">متاهل</option>
								<option value="مجرد">مجرد</option>
							</select>
							</td>
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
							<td> تحصیلات:</td>
							
							<td><input type="text" size="30" name="education"  id="education" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> سمت یا وظیفه:</td>
							<td>
							<select name="position" id="position" class="validate[required]">
							<option value="راننده">راننده</option>
							<option value="نماینده مرزی">نماینده مرزی</option>
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل صدور:</td>
							
							<td><input type="text" size="30" name="dissueplace"  id="dissueplace" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور:</td>
							<td><input type="text" size="30" name="dissuedate" id="dissuedate" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>						
						<tr align="right">
							<td> تاریخ ختم اعتبار:</td>
							<td>
								<input type="text" size="30" name="dvaliddate" id="dvaliddate" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td>آدرس محل کار در افغانستان:</td>
							<td><input type="text" size="30" name="vaddress"  id="vphone" /></td>
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
							<td> عکس راننده:</td>
							<td><input type="file" size="30" name="app_photo"  id="app_photo" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						</table>
						
							<div >
							</div>
						
						<input type="submit" class="submit"  name="insertdriver" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab2"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"driverprofile.php?pid=$viewid#tabs-1\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' name='cancel' value='انصراف'/></td>";?>
						
					</div></br></br>
					<?php
					if(isset($_POST['insertdriver'])){
						$filename=$_FILES['app_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
												 
							$phone=$_POST['app_phone'];
							$file_ext=".jpg";
							
							$oldcar="";
							
						$sql="Update  vapplicants set responsibility='olddriver' where profile_num='$viewid' ";
						mysql_query($sql) or die(mysql_error());
						$sq="select source_id from driver_profiles where id='$viewid'";
						$rssource=mysql_query($sq) or die (mysql_error());
						$rwsource=mysql_fetch_array($rssource);
						$sql="Insert into vapplicants (name, father_name, family, passportnum, issueplace, issuedate, remaineddate, education, address_iran, address_afghanistan, birthdate, birthplace, marital_status, responsibility, profile_num, source_id, type, position, work_field) values ('$_POST[dname]',
						'$_POST[dfather]', '$_POST[dfamily]', '$_POST[dpass]', '$_POST[dissueplace]', '$_POST[dissuedate]', '$_POST[dvaliddate]', '$_POST[education]', '$_POST[iraddress]', '$_POST[afghanistanadd]', '$_POST[bdate]','$_POST[bplace]', '$_POST[marital_status]', 'new', '$viewid', '$rwsource[source_id]',  'driver', '$_POST[position]', 'راننده')";
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
						
						header("location:driverprofile.php?pid=$viewid#tabs-1");
						die();
						//}
						}
					?>
				
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام </th>
				<th>نام پدر</th>
				<th>شماره گذرنامه</th>
				<th>محل صدور</th>
				<th>تاریخ صدور</th>
				<th>ختم اعتبار</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from vapplicants where profile_num='$viewid' and responsibility='new' ";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name]</td>
					<td> $row[father_name]</td>
					<td>$row[passportnum]</td>
					<td> $row[issueplace]</td>
					<td>$row[issuedate]</td>
					<td>$row[remaineddate]</td>
					";
					
					
	
					echo"<td><a href='driverprofile.php?delapp=$row[id]&pid=$viewid#tabs-1' class='confirm'><img src='img/cancel.png' title='حذف راننده'/></a>";
					
					echo "<a href='driverprofile_driver_edit.php?editid=$row[id]&profileid=$viewid' ><img src='img/edit.png'  title='ویرایش درخواست کننده'/></a></td>
					</tr>
					";
					$i++;
				
				}
				?>
				<?php
				
				if(isset($_GET['delcar'])){
					//$sql="Delete from karvan_applicants_getinfo where applicant_id='$_GET[delid]' and karvan_id='$_GET[kid]'";
					//$res=mysql_query($sql) or die(mysql_error());
					$sql="delete from cars where id='$_GET[delcar]' ";
					mysql_query($sql) or die(mysql_error());
					
					header("location:driverprofile.php?pid=$viewid#tabs-1");
					die();
				}
				if(isset($_GET['delapp'])){
					//$sql="Delete from karvan_applicants_getinfo where applicant_id='$_GET[delid]' and karvan_id='$_GET[kid]'";
					//$res=mysql_query($sql) or die(mysql_error());
					$sql="delete from vapplicants where id='$_GET[delapp]' ";
					mysql_query($sql) or die(mysql_error());
					
					header("location:driverprofile.php?pid=$viewid#tabs-1");
					die();
				}
				
				?>
				</table>
			    </div>
				
				
					     
				<div id="tabs-2">
				<?php
					if($carid=="" || $carid=="0"){
						echo "<b style='color:red' >برای اضافه نمودن سابقه ویزایی مشخصات خودرو تعیین نگردیده است!</b>";
					}else{
				?>
				<a href="#" id="addlink_tab3" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن سابقه ویزا</b></a>
						<a href="#" id="addlinkback_tab3" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن سابقه ویزا</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						
						<hr align="right"style=" width:150px"/>
						<?php
						}
						?>
						
						<div id="addlinkdata_tab3" >
						<table width="70%">
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> نام راننده:</td>
							<td>
							<select name="drivername" id="drivername" class="validate[required]">
								<option value="">انتخاب راننده</option>
								<?php
									$sql="select id, name, responsibility from vapplicants where profile_num='$viewid' and type='driver' and responsibility='new' order by id desc";
									$rs=mysql_query($sql) or die (mysql_error());
									while($rw=mysql_fetch_array($rs)){
										$dtype="";
											$dtype="(راننده فعلی)";
										
										echo "<option value='$rw[id]'>$rw[name] $dtype</option>";
									
									}
								
								?>
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td width="20%"> تاریخ مراجعه:</td>
							<td align="right" >
							<input type="text" name="fromdate" id="fromdate" class="validate[required,custom[date]]" style="width:200px" />
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('fromdate', this);"/>
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr><td>ارجعیت:</td>
						<td><input type="text" name="arjaeet" id="arjaeet"/>
						</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr><td>شماره روادید :</td>
						<td><input type="text" name="visanum" id="visanum"/>
						</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr><td>تاریخ صدور روادید:</td>
						<td><input type="text" name="vissuedate" id="vissuedate"/>
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('vissuedate', this);"/>

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
							<td> توضیح:</td>
							<td><input type="text" size="80" name="details"  id="details" /></td>
						</tr>
						</table>
							<br/>
						<input type="submit" class="submit"  name="inserthistory" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab3"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"driverprofile.php?pid=$viewid#tabs-2\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' value='انصراف'/></td>";?>

				</div><br/>
				<?php
					if(isset ($_POST['inserthistory'])){
						$sql="insert into visa_history (applicant_id, requestdate, supervisor, arjaeet, visanumber, visaissuedate, visa_type, details, car_id) 
						values('$_POST[drivername]', '$_POST[fromdate]', '$_SESSION[user_id]', '$_POST[arjaeet]', '$_POST[visanum]', '$_POST[vissuedate]', '8', '$_POST[details]', '$carid')";
						mysql_query($sql) or die (mysql_error());
						header("location:driverprofile.php?pid=$viewid#tabs-2");
						die();
					}
				
				?>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام راننده</th>
				<th>تاریخ مراجعه</th>
				<th>کارشناس</th>
				<th>توضیح</th>
				<th>چاپ فرم ها</th>
				<th>تایید بازگشت</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from vapplicants where profile_num='$viewid' and type='driver' order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					if($row['responsibility']=="new"){
						$responsibility="(راننده فعلی)";
					}else if($row['responsibility']=="olddriver"){
						$responsibility="(راننده قبلی)";
					}
					$sq="select * from visa_history where applicant_id='$row[id]' order by id desc";
					$rs=mysql_query($sq) or (mysql_error());
					while($rw=mysql_fetch_array($rs)){
					$sq="select name from users where id='$rw[supervisor]'";
					$rsuser=mysql_query($sq) or die (mysql_error());
					$rwuser=mysql_fetch_array($rsuser);
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name] $responsibility</td>
					<td> $rw[requestdate]</td>
					<td>$rwuser[name]</td>
					<td> $rw[details]</td>
					<td> <a href='drivers_visaform_excel.php?did=$rw[id]&appid=$row[id]' style='color:blue'>فرم ویزا</a> | <a href='drivers_bill_excel.php?did=$rw[id]&appid=$row[id]' style='color:blue'>فیش بانکی</a> </td>";
					
					if($rw['back']==1){
						echo "<td><img src='img/accept.png'/></td>";
					}else{
						echo "<td><a style='color:blue' href='driverprofile.php?pid=$viewid&backapp=$rw[id]#tabs-2' >تایید بازگشت</a></td>";
					}
					
					echo"<td><a href='driverprofile.php?delhistory=$rw[id]&pid=$viewid#tabs-2' class='confirm'><img src='img/cancel.png' title='پاک کردن درخواست کننده'/></a>
					<img src='img/edit.png' onclick='editresume($rw[id],$viewid)' /></td></tr>
					<tr><td id='edit$rw[id]' colspan='8' ></td></tr>";
					
					$i++;
					}
				
				}
				?>
				<?php
					if(isset($_GET['accept'])){
						$sq="update visa_history set back='1' where id='$_GET[backapp]'";
						mysql_query($sq) or die (mysql_error());
						header("location:driverprofile.php?pid=$viewid#tabs-2");
						die();
					}
					if(isset($_GET['delhistory'])){
						$sq="Delete from visa_history  where id='$_GET[delhistory]'";
						mysql_query($sq) or die (mysql_error());
						header("location:driverprofile.php?pid=$viewid#tabs-2");
						die();
					}
					if(isset($_GET['backapp'])){
						$sq="Update  visa_history set back='1' where id='$_GET[backapp]'";
						mysql_query($sq) or die (mysql_error());
						header("location:driverprofile.php?pid=$viewid#tabs-2");
						die();
					}
					if(isset($_POST['acceptresumeedit'])){
						$sql="update visa_history set requestdate='$_POST[editrdate]', details='$_POST[editdetail]', arjaeet='$_POST[editarjaeet]', visanumber='$_POST[editvnum]', visaissuedate='$_POST[editvissue]' where id='$_POST[resumeid]' ";
						mysql_query($sql) or die (mysql_error());
						header("location:driverprofile.php?pid=$_POST[profileid]#tabs-2");
						die();
					}
					if(isset($_POST['cancelresumeedit'])){
						
						header("location:driverprofile.php?pid=$_POST[profileid]#tabs-2");
						die();
					}
				?>
				</table>
				</div>
				
				
				<div id="tabs-3">
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
				<a  href='driver-attachments/<?php echo $viewid;?>/' target="_blank" ><input type="button"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:160px;margin-right:15px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="نمایش آرشیو فایلهای شرکت" />
							</a>
				<br/>
				<?php
					if(isset($_POST['insertattach'])){
						for($j=0;$j<sizeof($_POST['attachdetail']); $j++){
						$filename=$_FILES['attach']['name'][$j];
							 $file_ext = substr($filename, strripos($filename, '.'));
							$sql="insert into attachments (driverprofile_id, description, format, created_at) values ('$viewid', '".$_POST['attachdetail'][$j]."', '$file_ext', '".$_POST['date'][$j]."')";
							mysql_query($sql) or die (mysql_error());
							$sqgetid="select id from attachments where driverprofile_id='$viewid' order by id desc LIMIT 1";
							$rsgetid=mysql_query($sqgetid) or die (mysql_error());
							$rwgetid=mysql_fetch_array($rsgetid);
							
							//$filename=$_FILES['attach']['name'][$j];
							// $file_ext = substr($filename, strripos($filename, '.'));

							  $newfilename =$rwgetid['id'].$file_ext;
							  $destination = "driver-attachments/$viewid/".$newfilename;
							  $temp_file = $_FILES['attach']['tmp_name'][$j];
							  move_uploaded_file($temp_file,$destination);
							  //Resizing Image
							   $image = new SimpleImage();
							   $image->load($destination);
							   $image->scale(65);

					   $image->save($destination);
						  }
						header("location:driverprofile.php?pid=$viewid#tabs-3");
					die();
					}
				
				?>
				<br/>
				<table width="50%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام فایل</th>
				<th>تصویر فایل</th>
				<th>حجم فایل</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from attachments where driverprofile_id='$viewid' order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[description]</td>
					<td><a href='driver-attachments/$viewid/".$row['id'].$row['format']."' target='_blank'><img src='driver-attachments/$viewid/".$row['id'].$row['format']."' style='width:100px; height:70px'/></a></td>
					";
					
					echo"
					<td><a href='driverprofile.php?delattach=$row[id]&pid=$viewid&ftype=$row[format]' class='confirm'><img src='img/cancel.png'/></a></td>";
					
					echo "
					</tr>
					";
					$i++;
				
				}
				
				if(isset($_GET['delattach'])){
					$sql="delete from attachments where id='$_GET[delattach]'";
					mysql_query($sql) or die (mysql_error());
					unlink("driver-attachments/$viewid/".$_GET['delattach'].$_GET['ftype']);
					header("location:driverprofile.php?pid=$_GET[pid]#tabs-3");
					die();
					
				}
				?>
				</table>
				
				</div>
				<div id="tabs-4">
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام </th>
				<th>نام پدر</th>
				<th>شماره گذرنامه</th>
				<th>محل صدور</th>
				<th>تاریخ صدور</th>
				<th>ختم اعتبار</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from vapplicants where profile_num='$viewid' and responsibility='olddriver' ";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name]</td>
					<td> $row[father_name]</td>
					<td>$row[passportnum]</td>
					<td> $row[issueplace]</td>
					<td>$row[issuedate]</td>
					<td>$row[remaineddate]</td>
					</tr>
					";
			
					$i++;
				
				}
				?>
				</table>
				
				</div>
				<div id="tabs-5">
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نوع خودرو</th>
				<th>مدل</th>
				<th>پلاک</th>
				<th>شاسی</th>
				<th>انجین</th>
				<th>مسیر تردد</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from cars where driver_profilenum='$viewid' and status='oldcar' ";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[type]</td>
					<td> $row[model]</td>
					<td> $row[plaque]</td>
					<td>$row[shasynum]</td>
					<td> $row[enginenum]</td>
					<td>$row[way]</td>
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
