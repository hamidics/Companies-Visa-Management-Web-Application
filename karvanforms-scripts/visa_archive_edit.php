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
		<form action="<?php echo "visa_archive_edit.php?edit_id=$_GET[edit_id]";?>" method="post" accept-charset="utf-8" id="myform"  enctype="multipart/form-data" class="formular">
			<fieldset>
				<legend align="right"><span >ویرایش درخواست کننده</span></legend>
			<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>
					<li><a href="#tabs-1">ویرایش مشخصات درخواست کننده</a></li>
					<li><a href="#tabs-2">ویرایش همراهان درخواست کننده</a></li>
					<li><a href="#tabs-3">ویرایش توضیحات ویزا</a></li>
					
				</ul>
				<div id="tabs-1">
				<?php
				$sql="select *from visa_applicants where id='$_GET[edit_id]'";
				$res=mysql_query($sql) or die (mysql_error());
				$row=mysql_fetch_array($res);
				?>
				<br />
				 	<table width="50%" border="1" >
				<tr>
					<th width="200px"></th>
					<th></th>
				</tr>
				<tr>
					<td>تاریخ :</td>
						<td><input type="text" name="app_created_at" id="app_created_at" value="<?php echo $row['created_at'];?>" class="validate[required]" size="16"/><input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('app_created_at', this);"/></td>
				</tr>
				<tr>
				<td>مرکز معرفی کننده:</td>
				<td>
				<select name="vcenter" id="vcenter" class="validate[required]" style="width:150px"/>
				<option value="none" >ندارد</option>
				<?php
				$sql="select * from visa_centers ";
				$rs=mysql_query($sql) or die (mysql_error());
				while($rw=mysql_fetch_array($rs)){
				if($row['visa_center_id']==$rw['id']){
				echo "<option selected value='$rw[id]'>$rw[name]</option>";
				}else{
				echo "<option value='$rw[id]'>$rw[name]</option>";
				}
				}							
				?>
				</select>
				</td>
				</tr>
				
                <tr>
					<td>نام :</td>
					<td><input type="text" id="app_first_name" name="app_first_name" value="<?php echo $row['first_name'];?>" class="validate[required]" size='30'/></td>
				</tr>
				 <tr>
					<td>نام خانوادگی:</td>
					<td><input type="text" id="app_last_name" name="app_last_name"  value="<?php echo $row['last_name'];?>"  size='30'/></td>
				</tr>
				<tr>
					<td>نام پدر:</td>
					<td><input type="text" id="app_father_name" name="app_father_name"  value="<?php echo $row['father_name'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
				<td>نام کفیل:</td>
							<td>
							<select name="newkafil" id="newkafil" onchange="checkkafil(this.value)">
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
									if($total==5 and $rwkafil['id']==$row['kafil_id']){
											echo "<option selected style='color:white;background-color:red' value='$rwkafil[id]'>$rwkafil[name] ($rwkafil[father_name])</option>";
									}
									if($total<5 and $rwkafil['id']==$row['kafil_id']){
											echo "<option selected  value='$rwkafil[id]'>$rwkafil[name] ($rwkafil[father_name])</option>";
									}
									if($total==5 and $rwkafil['id']!=$row['kafil_id']){
											echo "<option  style='color:white;background-color:red' value='none'>$rwkafil[name] ($rwkafil[father_name])</option>";
									}
									if($total<5 and $rwkafil['id']!=$row['kafil_id']){
											echo "<option   value='$rwkafil[id]'>$rwkafil[name] ($rwkafil[father_name])</option>";
									}
								}
							?>
							</select>
							<input type="text" name="relationshipkafil" value="<?php echo $row['kafil_relation'];?>" id="relationshipkafil" placeholder="نسبت شخص با کفیل"/>
							
							</td>
						</tr>
				<tr>
					<td>تاریخ تولد:</td>
					<td><input type="text" id="app_birth_date" name="app_birth_date"  value="<?php echo $row['birth_date'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>محل تولد:</td>
					<td><input type="text" id="app_birth_place" name="app_birth_place"  value="<?php echo $row['birth_place'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>وضعیت تاهل :</td>
					<td><select name="app_marital_status" id="app_marital_status" class="validate[required]">
					<option value="">انتخاب</option>
					<?php
					if($row['marital_status']=="متاهل"){
						echo "<option selected >متاهل</option>";
						echo "<option  >مجرد</option>";
					}else{
						echo "<option selected >مجرد</option>";
						echo "<option  >متاهل</option>";
					}
					?>
					</select>
					</td>
				</tr>
				<tr>
					<td>میزان تحصیلات:</td>
					<td><input type="text" id="app_education" name="app_education"  value="<?php echo $row['education'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>شغل فعلی در افغانستان:</td>
					<td><input type="text" id="app_job" name="app_job"  value="<?php echo $row['job'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>نوع گذرنامه:</td>

					<td>
					<select name="passport_kind" id="passport_kind"  class="validate[required]" width="120px">
					<option value="">انتخاب نوع گذرنامه</option>
					<?php
						$select1="";
						$select2="";
						$select3="";
						$select4="";
						$select5="";
						if($row['passport_kind']=="عادی"){
							$select1="selected";
						}else if($row['passport_kind']=="تجارتی"){
							$select2="selected";
						}else if($row['passport_kind']=="خدمت"){
							$select3="selected";
						}else if($row['passport_kind']=="تحصیلی"){
							$select4="selected";
						}else if($row['passport_kind']=="سایر"){
							$select5="selected";
						}
					?>
					<option <?php echo $select1;?> >عادی</option>
					<option <?php echo $select2;?> >تجارتی</option>
					<option <?php echo $select3;?> >خدمت</option>
					<option <?php echo $select4;?> >تحصیلی</option>
					<option <?php echo $select5;?> >سایر</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>شماره گذرنامه:</td>
					<td><input type="text" id="passport_num" name="passport_num"  value="<?php echo $row['passport_num'];?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>تاریخ صدور گذرنامه:</td>
						<td><input type="text" name="passport_issue_date" id="passport_issue_date"   value="<?php echo $row['passport_issue_date'];?>" class="validate[required]" size="16"/><input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('passport_issue_date', this);"/></td>
				</tr>
				<tr>
					<td>محل صدور گذرنامه:</td>
					<td><input type="text" id="passport_issue_place" name="passport_issue_place"  value="<?php echo $row['passport_issue_place'];?>" class="validate[required]" size='30'/></td>
				</tr>
				</tr>
					<td >آدرس محل اقامت در ایران:</td>
					<td><input type="text" size="30"  id="add_in_iran" name="add_in_iran"  value="<?php echo $row['add_in_iran'];?>" ></input></td>
				</tr>
				<tr>
					<td>تلفن محل اقامت در ایران:</td>
					<td><input type="text" id="phone_in_iran" name="phone_in_iran"  value="<?php echo $row['phone_in_iran'];?>"  size='30'/></td>
				</tr>
				</tr>
					<td>آدرس محل کار در افغانستان:</td>
					<td><input type="text" size="30"  id="job_add_in_afghanistan" name="job_add_in_afghanistan"  value="<?php echo $row['job_add_in_afghanistan'];?>" ></input></td>
				</tr>
				<tr>
					<td>تلفن محل کار در افغانستان:</td>
					<td><input type="text" id="job_phone_in_afghanistan" name="job_phone_in_afghanistan"  value="<?php echo $row['job_phone_in_afghanistan'];?>"  size='30'/></td>
				</tr>
				</tr>
					<td>آدرس محل سکونت در افغانستان:</td>
					<td><input type="text" size="30"  id="add_in_afghanistan" name="add_in_afghanistan"  value="<?php echo $row['add_in_afghanistan'];?>" class="validate[required]"></input></td>
				</tr>
				<tr>
					<td>تلفن محل سکونت در افغانستان:</td>
					<td><input type="text" id="phone_in_afghanistan" name="phone_in_afghanistan"   value="<?php echo $row['phone_in_afghanistan'];?>"  class="validate[required]" size='30'/></td>
				</tr>
				<tr><td>عکس درخواست کننده:</td>
				<td>
				<?php echo "<img src='visa_applicant_images/".$_GET['edit_id'].".jpg?".time()."'/>";?>
				<input type="file" size="30" name="app_photo"  id="app_photo"  /></td>
				</tr>
				<tr>
				<td></td>
				<td></br><input type="submit" class="submit"  id="save_applicant" name="save_applicant" value="ذخیره" id="linkdatabutton"/>
			    <a href='visa_archive.php'><input type="button" id="cancel_cash" name="cancel_applicant" value="انصراف"/></a></td>
				</tr>
				</table>
				<br />
			    </div>
				<?php
				    if(isset($_POST['save_applicant'])){
						 $filename=$_FILES['app_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
						$sql="Update visa_applicants set created_at='$_POST[app_created_at]' , visa_center_id='$_POST[vcenter]' , first_name='$_POST[app_first_name]' , last_name='$_POST[app_last_name]' , 
						father_name='$_POST[app_father_name]' , birth_date='$_POST[app_birth_date]' , birth_place='$_POST[app_birth_place]' , marital_status='$_POST[app_marital_status]' , passport_kind='$_POST[passport_kind]' , 
						passport_num='$_POST[passport_num]' , passport_issue_date='$_POST[passport_issue_date]' , passport_issue_place='$_POST[passport_issue_place]' , job='$_POST[app_job]' , education='$_POST[app_education]' , 
						add_in_iran='$_POST[add_in_iran]' , phone_in_iran='$_POST[phone_in_iran]' , add_in_afghanistan='$_POST[add_in_afghanistan]' , phone_in_afghanistan='$_POST[phone_in_afghanistan]' , job_add_in_afghanistan='$_POST[job_add_in_afghanistan]' , 
						job_phone_in_afghanistan='$_POST[job_phone_in_afghanistan]', kafil_id='$_POST[newkafil]', kafil_relation='$_POST[relationshipkafil]' where id='$_GET[edit_id]'";
				        mysql_query($sql) or die(mysql_error());
						 $newfilename =$_GET['edit_id'].$file_ext;
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
						 
				        header("location: visa_archive.php");
						die();

					
					}
				?>
					     
				<div id="tabs-2">
				<table width="50%" >
				<tr >
					<th></th>
					<th></th>
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
			    <a href='visa_archive.php'><input type="button" id="cancel_cash" name="cancel_applicant" value="انصراف"/></a></td>
				</tr>
				</table>
				</br></br>
				<h3>لیست همراهان متقاضی</h3>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام</th>
				<th>نسبت</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from visa_dependants where applicant_id='$_GET[edit_id]'";
				$res=mysql_query($sql) or die (mysql_error());
				while($row=mysql_fetch_array($res)){
					echo "<tr align='center'><td>$i</td>
					<td>$row[first_name]</td>
					<td>$row[relation]</td>
					<td>
					<a href='visa_archive_edit.php?edit_id=$_GET[edit_id]&delid=$row[id]' class='confirm'><img src='img/cancel.png' /></a>
					</td></tr>";
				}
				?>
				</table>
				</div>
				<?php
					if(isset($_GET['delid'])){
						$sql="Delete from visa_dependants where id='$_GET[delid]'";
						mysql_query($sql) or die (mysql_error());
						header("location:visa_archive_edit.php?edit_id=$_GET[edit_id]#tabs-2");
						die();
					}
				    if(isset($_POST['save_acco'])){
						$filename=$_FILES['acco_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
						 if($file_ext==".jpg"){
					    $sql="Insert into visa_dependants(first_name, last_name, father_name, birth_date, job, education, relation, applicant_id) values('$_POST[acco_first_name]', '$_POST[acco_last_name]', '$_POST[acco_father_name]', '$_POST[acco_birth_date]', '$_POST[acco_job]', '$_POST[acco_education]', '$_POST[acco_relation]', '$_GET[edit_id]')";
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

				       header("location:visa_archive.php");
					   die();
					}
					else{
						echo "<p style='color:red'>پسوند عکس آپلود شده باید jpg باشد!!!</p>";
					}
					}
				?>
				 <div id="tabs-3">
				 <?php
					$sql="select * from visa_info where applicant_id='$_GET[edit_id]'";
					$res=mysql_query($sql) or die (mysql_error());
					$row=mysql_fetch_array($res);
				 
				 ?>
				<table width="50%" >
				<tr >
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>تاریخ صدور روادید:</td>
						<td><input type="text" name="visa_issue_date"  id="visa_issue_date" size="16" class="validate[required]" value="<?php echo $row['issue_date']; ?>" /><input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('visa_issue_date', this);"/></td>
				</tr>
				<tr>
					<td>شماره روادید صادره :</td>
					<td><input type="text" id="visa_num" name="visa_num" class="validate[required]" value="<?php echo $row['visa_num']; ?>" size='30'/></td>
				</tr>
				<tr>
					<td>پیوست :</td>
					<td><select name="visa_attach" id="visa_attach" class="validate[required]">
					<option value="">انتخاب</option>
					<?php
					if($row['attach']=="نامه"){
						echo "<option >درخواست متقاضی</option>
					<option selected>نامه</option>";
					}else{
						echo "<option selected>درخواست متقاضی</option>
					<option >نامه</option>";
					}
					?>
					</select>
					</td>
				</tr>
				</tr>
					<td>دستور رسیدگی :</td>
					<td><input type="text" size="30"  id="visa_command" name="visa_command" value="<?php echo $row['command']; ?>" class="validate[required]"></input></td>
				</tr>
				<tr>
					<td>کارشناس :</td>
					<td><input type="text" id="visa_specialist" name="visa_specialist" value="<?php echo $row['specialist']; ?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>شماره مرکز مجوز:</td>
					<td><input type="text" id="visa_num_center_mojavez" name="visa_num_center_mojavez" value="<?php echo $row['num_center_mojavez']; ?>" class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>تاریخ مرکز مجوز:</td>
					<td><input type="text" name="visa_date_center_mojavez" id="visa_date_center_mojavez" value="<?php echo $row['date_center_mojavez']; ?>" class="validate[required]" size="16"/><input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('visa_date_center_mojavez', this);"/></td>
				</tr>
				<tr>
					<td>نوع رویداد :</td>
					<td>
					<select name="visa_type" id="visa_type" class="validate[required]" >
					<option value="">انتخاب نوع روادید</option>
					<?php
					$select1="";
					$select2="";
					$select3="";
					$select4="";
					if($row['visa_type']=="سیاحتی"){
						$select1="selected";
					}else if($row['visa_type']=="زیارتی"){
						$select2="selected";
					}else if($row['visa_type']=="تجارتی - مکرر"){
						$select3="selected";
					}else{
						$select4="selected";
					}
					
					?>
					<option <?php echo $select1;?> >سیاحتی</option>
					<option <?php echo $select2;?> >زیارتی</option>
					<option <?php echo $select3;?> >تجارتی - مکرر</option>
					<option <?php echo $select4;?> >سایر</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>مبلغ :</td>
					<td><input type="text" id="visa_amount" name="visa_amount" value="<?php echo $row['price']; ?>"  class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>مدت اقامت :</td>
					<td><input type="text" id="visa_period_of_stay" name="visa_period_of_stay" value="<?php echo $row['period_of_stay']; ?>"  class="validate[required]" size='30'/></td>
				</tr>
				<tr>
					<td>ارجعیت :</td>
					<td><select name="visa_arjaeat" id="visa_arjaeat" class="validate[required]">
					<option value="">انتخاب</option>
					<?php
					if($row['arjaeat']=="عادی"){
						echo "<option selected>عادی</option>
					<option >فوری</option>";
					}else{
						echo "<option >عادی</option>
					<option selected>فوری</option>";
					}
					?>

					</select>
					</td>
				</tr>
				<tr>
				<td></td>
				<td><input type="submit" class="submit"  id="save_visa" name="save_visa" value="ذخیره" id="linkdatabutton"/>
			    <a href='visa_archive.php'><input type="button" id="cancel_cash" name="cancel_applicant" value="انصراف"/></a></td>
				</tr>
				</table>
				</div>
				 </div>
				 <?php
				    if(isset($_POST['save_visa'])){
						$sql="Update visa_info set attach='$_POST[visa_attach]' , command='$_POST[visa_command]' , specialist='$_POST[visa_specialist]' , 
						num_center_mojavez='$_POST[visa_num_center_mojavez]' , date_center_mojavez='$_POST[visa_date_center_mojavez]' , visa_type='$_POST[visa_type]' , price='$_POST[visa_amount]' , period_of_stay='$_POST[visa_period_of_stay]' , 
						arjaeat='$_POST[visa_arjaeat]' , issue_date='$_POST[visa_issue_date]' , visa_num='$_POST[visa_num]' where applicant_id='$_GET[edit_id]'";
				        mysql_query($sql) or die(mysql_error());
				         header("location: visa_archive.php");
						 die();
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
