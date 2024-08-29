<?php
include("template_header.php");
require_once("../library/image_resize.php");
require_once("../library/image_rotate.php");
?>
<script>
function checkkafil(val){
	if(val=="none"){
		document.getElementById('save_applicant').style.visibility="hidden";
	}else{
		document.getElementById('save_applicant').style.visibility="visible";
	}

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
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<form action="visa_form.php" method="post" accept-charset="utf-8" id="myform"  enctype="multipart/form-data" class="formular">
			<fieldset>
				<legend align="right"><span >فرم درخواست روادید</span></legend>
			<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>
					<li><a href="#tabs-1">مشخصات درخواست کننده</a></li>
					<li><a href="#tabs-2">همراهان</a></li>
					<li><a href="#tabs-3">مشخصات ویزا</a></li>
					
				</ul>
				<div id="tabs-1">
				<br />
				 	<table width="50%" border="1" >
				<tr>
					<th width="200px"></th>
					<th></th>
				</tr>
				<tr>
					<td>تاریخ :</td>
						<td><input type="text" name="app_created_at" id="app_created_at" value="<?php echo $_POST['app_created_at'];?>" class="validate[required]" size="16"/><input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('app_created_at', this);"/></td>
				</tr>
				<tr>
				<td>مرکز معرفی کننده:</td>
				<td>
				<select name="vcenter" id="vcenter" class="validate[required]"/>
				<option value="">انتخاب مرکز معرفی کننده</option>
				<option value="none" >ندارد</option>
				<?php
				$sql="select * from visa_centers ";
				$rs=mysql_query($sql) or die (mysql_error());
				while($rw=mysql_fetch_array($rs)){
				echo "<option value='$rw[id]'>$rw[name]</option>";
				}							
				?>
				</select>
				</td>
				</tr>
				
                <tr>
					<td>نام :</td>
					<td><input type="text" id="app_first_name" name="app_first_name" value="<?php echo $_POST['app_first_name'];?>" class="validate[required]" size='30'/></td>
				</tr>
				 <tr>
					<td>نام خانوادگی:</td>
					<td><input type="text" id="app_last_name" name="app_last_name"  value="<?php echo $_POST['app_last_name'];?>"  size='30'/></td>
				</tr>
				<tr>
					<td>نام پدر:</td>
					<td><input type="text" id="app_father_name" name="app_father_name"  value="<?php echo $_POST['app_father_name'];?>" class="validate[required]" size='30'/></td>
				</tr>
<tr align="right">
							<td> نام کفیل:</td>
							<td>
							<select name="kafilname" id="kafilname" onchange="checkkafil(this.value)">
							<option value="">انتخاب نام کفیل</option>
							<?php
								$sqkafil="select id, name, father_name from kafils";
								$rskafil=mysql_query($sqkafil) or die (mysql_error());
								while($rwkafil=mysql_fetch_array($rskafil)){
									//Counting applicant kafils
										$sqlcountkafil="select count(id) from applicants where kafil_id='$rwkafil[id]'";
										$rscountkafil=mysql_query($sqlcountkafil) or die (mysql_error());
										$rwcountkafil1=mysql_fetch_array($rscountkafil);
									//Counting visa applicants kafils
										$sqlcountkafil="select count(id) from visa_applicants where kafil_id='$rwkafil[id]'";
										$rscountkafil=mysql_query($sqlcountkafil) or die (mysql_error());
										$rwcountkafil2=mysql_fetch_array($rscountkafil);
									$total=$rwcountkafil1['count(id)']+$rwcountkafil2['count(id)'];
									if($total>=5){
										echo "<option style='background-color:red;color:white' value='none'>$rwkafil[name] ($rwkafil[father_name])</option>";
									}else{
										echo "<option  value='$rwkafil[id]'>$rwkafil[name] ($rwkafil[father_name])</option>";
									}
								}
							?>
							</select>
							<input type="text" placeholder="نسبت شخص با کفیل" name="relationship" id="relationship"/>
							</td>
						</tr>
				<tr>
					<td>تاریخ تولد:</td>
					<td><input type="text" id="app_birth_date" name="app_birth_date"  value="<?php echo $_POST['app_birth_date'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>محل تولد:</td>
					<td><input type="text" id="app_birth_place" name="app_birth_place"  value="<?php echo $_POST['app_birth_place'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>وضعیت تاهل :</td>
					<td><select name="app_marital_status" id="app_marital_status" class="validate[required]">
					<option value="">انتخاب</option>
					<option >متاهل</option>
					<option >مجرد</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>میزان تحصیلات:</td>
					<td><input type="text" id="app_education" name="app_education"  value="<?php echo $_POST['app_education'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>شغل فعلی در افغانستان:</td>
					<td><input type="text" id="app_job" name="app_job"  value="<?php echo $_POST['app_job'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>نوع گذرنامه:</td>

					<td>
					<select name="passport_kind" id="passport_kind"  class="validate[required]" width="120px">
					<option value="">انتخاب نوع گذرنامه</option>
					<option >عادی</option>
					<option>تجارتی</option>
					<option >خدمت</option>
					<option>تحصیلی</option>
					<option>سایر</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>شماره گذرنامه:</td>
					<td><input type="text" id="passport_num" name="passport_num"  value="<?php echo $_POST['passport_num'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>تاریخ صدور گذرنامه:</td>
						<td><input type="text" name="passport_issue_date" id="passport_issue_date"   value="<?php echo $_POST['passport_issue_date'];?>" class="validate[required]" size="16"/><input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('passport_issue_date', this);"/></td>
				</tr>
				<tr>
					<td>محل صدور گذرنامه:</td>
					<td><input type="text" id="passport_issue_place" name="passport_issue_place"  value="<?php echo $_POST['passport_issue_place'];?>" class="validate[required]" size='30'/></td>
				</tr>
				</tr>
					<td >آدرس محل اقامت در ایران:</td>
					<td><input type="text" size="30"  id="add_in_iran" name="add_in_iran"  value="<?php echo $_POST['add_in_iran'];?>" ></input></td>
				</tr>
				<tr>
					<td>تلفن محل اقامت در ایران:</td>
					<td><input type="text" id="phone_in_iran" name="phone_in_iran"  value="<?php echo $_POST['phone_in_iran'];?>"  size='30'/></td>
				</tr>
				</tr>
					<td>آدرس محل کار در افغانستان:</td>
					<td><input type="text" size="30"  id="job_add_in_afghanistan" name="job_add_in_afghanistan"  value="<?php echo $_POST['job_add_in_afghanistan'];?>" ></input></td>
				</tr>
				<tr>
					<td>تلفن محل کار در افغانستان:</td>
					<td><input type="text" id="job_phone_in_afghanistan" name="job_phone_in_afghanistan"  value="<?php echo $_POST['job_phone_in_afghanistan'];?>"  size='30'/></td>
				</tr>
				</tr>
					<td>آدرس محل سکونت در افغانستان:</td>
					<td><input type="text" size="30"  id="add_in_afghanistan" name="add_in_afghanistan"  value="<?php echo $_POST['add_in_afghanistan'];?>" class="validate[required]"></input></td>
				</tr>
				<tr>
					<td>تلفن محل سکونت در افغانستان:</td>
					<td><input type="text" id="phone_in_afghanistan" name="phone_in_afghanistan"   value="<?php echo $_POST['phone_in_afghanistan'];?>"  class="validate[required]" size='30'/></td>
				</tr>
				<tr><td>عکس درخواست کننده:</td>
				<td><input type="file" size="30" name="app_photo"  id="app_photo" class="validate[required]" /></td>
				</tr>
				<tr>
				<td></td>
				<td><input type="submit" class="submit"  id="save_applicant" name="save_applicant" value="ذخیره" id="linkdatabutton"/>
			    <input type="submit" id="cancel_cash" name="cancel_applicant" value="انصراف"/></td>
				</tr>
				</table>
				<br />
			    </div>
				<?php
				    if(isset($_POST['save_applicant'])){
						 $filename=$_FILES['app_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
						 if($file_ext==".jpg"){
					    $sql="Insert into  visa_applicants(created_at, visa_center_id, first_name, last_name, father_name, birth_date, birth_place, marital_status, passport_kind, passport_num, passport_issue_date, passport_issue_place, job, education, add_in_iran, phone_in_iran, add_in_afghanistan, phone_in_afghanistan, job_add_in_afghanistan, job_phone_in_afghanistan, type, kafil_id, kafil_relation) values('$_POST[app_created_at]', '$_POST[vcenter]', '$_POST[app_first_name]', '$_POST[app_last_name]', '$_POST[app_father_name]', '$_POST[app_birth_date]', '$_POST[app_birth_place]', '$_POST[app_marital_status]', '$_POST[passport_kind]', '$_POST[passport_num]', '$_POST[passport_issue_date]', '$_POST[passport_issue_place]', '$_POST[app_job]', '$_POST[app_education]', '$_POST[add_in_iran]', '$_POST[phone_in_iran]', '$_POST[add_in_afghanistan]', '$_POST[phone_in_afghanistan]', '$_POST[job_add_in_afghanistan]', '$_POST[job_phone_in_afghanistan]', 'new', '$_POST[kafilname]', '$_POST[relationship]')";
				        mysql_query($sql) or die(mysql_error());
						$sql="select id from visa_applicants order by id desc LIMIT 1";
						$res=mysql_query($sql) or die(mysql_error());
						$row=mysql_fetch_array($res); 
						 $newfilename =$row['id'].$file_ext;
						 $destination = "visa_applicant_images/".$newfilename;
						 $temp_file = $_FILES['app_photo']['tmp_name'];
						 move_uploaded_file($temp_file,$destination);
						 //resizing image
					   $image = new SimpleImage();
					   $image->load($destination);
					   //$image->resize(105,170);
					   //For other computer
					   $image->resize(134,170);
					   $image->save($destination);
						 
				        header("location: visa_form.php");
						die();
						}else{
						echo "<p style='color:red'>فرمت عکس آپلود شده باید jpg باشد!!!</p>";
						}
					
					}
				?>
					     
				<div id="tabs-2">
				<table width="50%" >
				<tr >
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>متفاضی:</td>
					<td><select name="acco_applicant" id="acco_applicant" class="validate[required]" size="3">
					<option value="">انتخاب</option>
					<?php
					    $sql="select id, passport_num, first_name, last_name from  visa_applicants  where type='new' order by id desc";
						$res=mysql_query($sql);
						while($row=mysql_fetch_array($res)){
						    echo "<option value=$row[id]>$row[first_name] $row[last_name]($row[passport_num])</option>";
						}
				    ?>
					</select>
					</td>
				</tr>
				<tr>
					<td>نام :</td>
					<td><input type="text" id="acco_first_name" name="acco_first_name" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>نام خانواده گی :</td>
					<td><input type="text" id="acco_last_name" name="acco_last_name"  size='30'/></td>
				</tr>
				<tr>
					<td>نام پدر :</td>
					<td><input type="text" id="acco_father_name" name="acco_father_name" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>تاریخ تولد :</td>
						<td><input type="text" name="acco_birth_date"  id="acco_birth_date" size="16" class="validate[required]"  /></td>
				</tr>
				<tr>
					<td>نسبت :</td>
					<td><input type="text" id="acco_relation" name="acco_relation" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>تحصیلات :</td>
					<td><input type="text" id="acco_education" name="acco_education"  size='30'/></td>
				</tr>
				<tr>
					<td>شغل :</td>
					<td><input type="text" id="acco_job" name="acco_job"  size='30'/></td>
				</tr>
				<tr><td>عکس همراه:</td>
				<td><input type="file" size="30" name="acco_photo"  id="acco_photo" class="validate[required]" /></td>
				</tr>
				<tr>
				<td></td>
				<td><input type="submit" class="submit"  id="save_acco" name="save_acco" value="ذخیره" id="linkdatabutton"/>
			    <input type="submit" id="cancel_cash" name="cancel_acco" value="انصراف"/></td>
				</tr>
				</table>
				</div>
				<?php
				    if(isset($_POST['save_acco'])){
						$filename=$_FILES['acco_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
						 if($file_ext==".jpg"){
					    $sql="Insert into visa_dependants(first_name, last_name, father_name, birth_date, job, education, relation, applicant_id) values('$_POST[acco_first_name]', '$_POST[acco_last_name]', '$_POST[acco_father_name]', '$_POST[acco_birth_date]', '$_POST[acco_job]', '$_POST[acco_education]', '$_POST[acco_relation]', '$_POST[acco_applicant]')";
				        mysql_query($sql) or die(mysql_error());
						$sql="select id from visa_dependants order by id desc LIMIT 1";
						$res=mysql_query($sql) or die(mysql_error());
						$row=mysql_fetch_array($res); 
						 $newfilename =$row['id'].$file_ext;
						 $destination = "visa_dependants_images/".$newfilename;
						 $temp_file = $_FILES['acco_photo']['tmp_name'];
						 move_uploaded_file($temp_file,$destination);
					   //rotating image
					   rotateImage($destination,-90);
						 //resizing image
					   $image = new SimpleImage();
					   $image->load($destination);
					   //$image->resize(105,80);
					   //For other computer
					   $image->resize(134,80);
					   $image->save($destination);

				       header("location: visa_form.php#tabs-2");
					   die();
					}
					else{
						echo "<p style='color:red'>پسوند عکس آپلود شده باید jpg باشد!!!</p>";
					}
					}
				?>
				 <div id="tabs-3">
				<table width="50%" >
				<tr >
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>متفاضی:</td>
					<td><select name="visa_applicant" id="visa_applicant" class="validate[required]" size="3">
					<option value="">انتخاب</option>
					<?php
					    $sql="select id, passport_num, first_name, last_name from  visa_applicants  where type='new' order by id desc";
						$res=mysql_query($sql);
						while($row=mysql_fetch_array($res)){
						    echo "<option value=$row[id]>$row[first_name] $row[last_name]($row[passport_num])</option>";
						}
				    ?>
					</select>
					</td>
				</tr>
				<tr>
					<td>تاریخ صدور روادید:</td>
						<td><input type="text" name="visa_issue_date"  id="visa_issue_date" size="16" class="validate[required]" value="<?php if(isset($_GET['edit'])){ echo  $property_date; } ?>" /><input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('visa_issue_date', this);"/></td>
				</tr>
				<tr>
					<td>شماره روادید صادره :</td>
					<td><input type="text" id="visa_num" name="visa_num" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>پیوست :</td>
					<td><select name="visa_attach" id="visa_attach" class="validate[required]">
					<option value="">انتخاب</option>
					<option >درخواست متقاضی</option>
					<option >نامه</option>
					</select>
					</td>
				</tr>
				</tr>
					<td>دستور رسیدگی :</td>
					<td><input type="text" size="30"  id="visa_command" name="visa_command" class="validate[required]"></input></td>
				</tr>
				<tr>
					<td>کارشناس :</td>
					<td><input type="text" id="visa_specialist" name="visa_specialist" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>شماره مرکز مجوز:</td>
					<td><input type="text" id="visa_num_center_mojavez" name="visa_num_center_mojavez" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>تاریخ مرکز مجوز:</td>
					<td><input type="text" name="visa_date_center_mojavez" id="visa_date_center_mojavez"  class="validate[required]" size="16"/><input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('visa_date_center_mojavez', this);"/></td>
				</tr>
				<tr>
					<td>نوع رویداد :</td>
					<td>
					<select name="visa_type" id="visa_type" class="validate[required]" >
					<option value="">انتخاب نوع روادید</option>
					<option>سیاحتی</option>
					<option>زیارتی</option>
					<option>تجارتی - مکرر</option>
					<option>سایر</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>مبلغ :</td>
					<td><input type="text" id="visa_amount" name="visa_amount" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>مدت اقامت :</td>
					<td><input type="text" id="visa_period_of_stay" name="visa_period_of_stay" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>ارجعیت :</td>
					<td><select name="visa_arjaeat" id="visa_arjaeat" class="validate[required]">
					<option value="">انتخاب</option>
					<option >عادی</option>
					<option >فوری</option>
					</select>
					</td>
				</tr>
				<tr>
				<td></td>
				<td><input type="submit" class="submit"  id="save_visa" name="save_visa" value="ذخیره" id="linkdatabutton"/>
			    <input type="submit" id="cancel_cash" name="cancel_visa" value="انصراف"/></td>
				</tr>
				</table>
				</div>
				 </div>
				 <?php
				    if(isset($_POST['save_visa'])){
					    $sql="Insert into visa_info(attach, command, specialist, num_center_mojavez, date_center_mojavez, visa_type, price, period_of_stay, arjaeat, issue_date, visa_num, applicant_id) values('$_POST[visa_attach]', '$_POST[visa_command]', '$_POST[visa_specialist]', '$_POST[visa_num_center_mojavez]', '$_POST[visa_date_center_mojavez]', '$_POST[visa_type]', '$_POST[visa_amount]' , '$_POST[visa_period_of_stay]' , '$_POST[visa_arjaeat]', '$_POST[visa_issue_date]', '$_POST[visa_num]', '$_POST[visa_applicant]')";
				        mysql_query($sql) or die(mysql_error());
						$sql="Update visa_applicants set type='old' where id='$_POST[visa_applicant]' ";
						mysql_query($sql) or die (mysql_error());
				         header("location: visa_form.php#tabs-3");
					}
				?>
 		</fieldset>
			
		</form>
		</div>
		
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
