<?php
include("template_header.php");
require_once("../library/image_resize.php");
require_once("dependants_deps_addremowrow.php");
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
			<fieldset>
				<legend align="right"><span dir="rtl">ثبت افراد جدید به سیستم</span></legend>

			
					<form action='newapplicant.php' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >
<span id="checkpass" align="center"></span>
<span id="checkphone" align="center"></span>
						<table width="80%">
						<tr align="right">
							<td width="35%"> شماره گذرنامه:</td>
							<td>
							<input type="text" size="30" name="passnum" class="validate[checkDuplicate[passportnum2],required]" onkeyup="checkpassnum(this.value)"  id="passnum" />
							</td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره تماس:</td>
							<td><input type="text" size="30" name="phonenum"  onkeyup="checkphonenum(this.value)" id="visatype" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ مراجعه: </td>
							<td>
							<input type="text" size="42" name="requestdate"  id="requestdate"  /> 
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('requestdate', this);"/>

							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td width="20%"> نام:</td>
							<td align="right" ><input type="text" size="30" name="app_name" onkeyup="searchnames(this.value)" class="validate[required]" id="app_name" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تخلص:</td>
							<td><input type="text" size="30" name="app_fname"  id="app_fname" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> نام پدر:</td>
							<td><input type="text" size="30" name="app_fathername"  id="app_fathername" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> وضعیت تاهل:</td>
							
							<td>
							<select name="marital_status" id="marital_status" class="validate[required]">
								<option value="">انتخاب وضعیت تاهل</option>
								<option value="متاهل">متاهل</option>
								<option value="مجرد">مجرد</option>
							</select>
							</td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نوع فعالیت:</td>
							<td>
							<input type="text" size="30" name="worktype"  id="worktype" />
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
							<td><input type="text" size="30" name="vaddress" value="<?php echo $roo['address'];?>" id="vphone" /></td>
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
							<td> کارشناس:</td>
							<td>
							<?php echo $_SESSION['user_name'];?>
							
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مرجع معرفی کننده:</td>
							<td>
							<input type="text" size="30" name="introduced_by"  id="introduced_by" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> ثبت معرفی نامه:</td>
							<td><input type="file" size="30" name="app_photo"  id="app_photo" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						
						<tr align="right">
							<td> تعداد همراه:</td>
							<td><input type="text" size="30" name="numofdependents"  id="numofdependents" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نوع ویزا:</td>
							<td>
							<select name="visatype" id="visatype" class="validate[required]" style="height:30px; width:210px">
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
							<input type="text" size="42" name="passissuedate"  id="passissuedate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل صدور گذرنامه:</td>
							<td>
							<input type="text" size="42" name="passissueplace"  id="passissueplace"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> پیوست درخواست:</td>
							<td><select name="requesttype" id="requesttype" style="height:30px; width:210px">
								<option value="">انتخاب نوع پیوست</option>
								<option value="درخواست">درخواست متقاضی</option>
								<option value="نامه">نامه</option>
							</select></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> دستور رسیدگی:</td>
							<td>
							<input type="text" size="42" name="visaorder"  id="visaorder"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td>مجوز مرکز (شماره):</td>
							<td>
							<input type="text" size="42" name="centernum"  id="centernum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مجوز مرکز (تاریخ):</td>
							<td>
							<input type="text" size="42" name="centerdate"  id="centerdate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مدت اقامت:</td>
							<td>
							<input type="text" size="42" name="applimitdays"  id="applimitdays"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> قیمت ویزا:</td>
							<td>
							<input type="text" size="42" name="appvisaprice"  id="appvisaprice"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> ارجعیت:</td>
							<td>
							<input type="text" size="42" name="arjaeet"  id="arjaeet"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره روادید صادره:</td>
							<td>
							<input type="text" size="42" name="visanum"  id="visanum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور روادید:</td>
							<td>
							<input type="text" size="42" name="visaissuedate"  id="visaissuedate"  /> 

							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						
						<tr align="right">
							<td> توضیح:</td>
							<td><textarea type="text" cols='25' rows='3' name="details"  id="details" ></textarea></td>
						</tr>
						</table>
						<table id="deptable" width="85%" align="center">
						<tr align="center" height="20px" style="background-color:grey; color:white"><td colspan="7"><b>لیست همراهان</b></td></tr>
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
					<td><input type="text" id="depdepname1" name="depdepname[]"  size='14'/></td>
			
					<td><input type="text" id="deplastname1" name="deplastname[]"  size='14'/></td>
				
					<td><input type="text" id="depfather1" name="depfather[]"  size='14'/></td>
				
						<td><input type="text" name="depbirthdate[]"   size="14"   /></td>
				
					<td><input type="text" id="deprelation1" name="deprelation[]"  size='14'/></td>
				
					<td><input type="text" id="depeducation1" name="depeducation[]"  size='14'/></td>
				
					<td><input type="text" id="depjob1" name="depjob[]"  size='14'/></td>
				</tr>
						</table>
						<br/><div align="center">
						<input type="button" id="button1" style="background-color:white; border:0; background-image:url(img/add.gif); width:21px;height:21px " onclick="AddNew2(),jQuery('#myform').validationEngine('hide'),calctotal()" class="add-row"/>
				<input type="button" id="button2" style="background-color:white; border:0; background-image:url(img/remove.gif); width:21px;height:21px  " onclick="removeRow(),jQuery('#myform').validationEngine('hide'),calctotal()" class="remove-row"/></br>
				
							
						
						<input type="submit" class="submit"  name="insertapplicant" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:130px;margin-right:30px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" />
						<a href="homepage.php"><input type="button" class="submit"  name="insertapplicant" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:130px;margin-right:30px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="انصراف" /></a>

					</br></br>
					<?php
					if(isset($_POST['insertapplicant'])){
						 
				
						$sql="insert into vapplicants (name, family, father_name, passportnum, work_field, type, supervisor, introduced_by, phone, address, education, address_iran, address_afghanistan, birthdate, birthplace, marital_status) values ('$_POST[app_name]', '$_POST[app_fname]', '$_POST[app_fathername]', '$_POST[passnum]', '$_POST[worktype]', 'other', '$_SESSION[user_id]', '$_POST[introduced_by]', '$_POST[phonenum]', '$_POST[vaddress]', '$_POST[education]', '$_POST[iraddress]', '$_POST[afghanistanadd]', '$_POST[bdate]','$_POST[bplace]', '$_POST[marital_status]')";
						
						mysql_query($sql) or die(mysql_error());
						
						$filename=$_FILES['app_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
						
						$sql="select id from vapplicants order by id desc LIMIT 1";
						$res=mysql_query($sql) or die(mysql_error());
						$row=mysql_fetch_array($res); 
						//Adding visa history
						$sql="insert into visa_history (applicant_id, passportnum, supervisor, newsource, numofdependents, visa_type, details, passissuedate, passissueplace, attachtype, orderforvisa, center_mojavez_num, center_mojavez_date, arjaeet, visanumber, visaissuedate, visaprice, limitdays, requestdate) 
						values('$row[id]', '$_POST[passnum]', '$_SESSION[user_id]', '$_POST[introduced_by]', '$_POST[numofdependents]', '$_POST[visatype]', '$_POST[details]', '$_POST[passissuedate]', 
						'$_POST[passissueplace]', '$_POST[requesttype]', '$_POST[visaorder]', '$_POST[centernum]', '$_POST[centerdate]', '$_POST[arjaeet]', '$_POST[visanum]', '$_POST[visaissuedate]', '$_POST[appvisaprice]', '$_POST[applimitdays]', '$_POST[requestdate]')";
						mysql_query($sql) or die (mysql_error());
						//Inserting dependants
						//Getting the last inserted id
						
						$sq="select id from visa_history order by id desc LIMIT 1";
						$rsvh=mysql_query($sq) or die (mysql_error());
						$rwvh=mysql_fetch_array($rsvh);
						for($i=0; $i<sizeof($_POST['depdepname']);$i++){
							echo $_POST['depdepname'][$i];
							if($_POST['depdepname'][$i]!="" and $_POST['depdepname'][$i]!=null ){
								$sq="insert into  dependent_visa_dependants (name, family, father_name, birthdate, relation, education, job, other_parentid) 
								values ('".$_POST['depdepname'][$i]."', '".$_POST['deplastname'][$i]."', '".$_POST['depfather'][$i]."', '".$_POST['depbirthdate'][$i]."'
								, '".$_POST['deprelation'][$i]."', '".$_POST['depeducation'][$i]."', '".$_POST['depjob'][$i]."', '$rwvh[id]')";
								mysql_query($sq) or die (mysql_error());
							}
						
						}
						//
						//Creating a new folder
						
						mkdir("app-attachments/$row[id]");
						if($filename!="" and $filename!=null){
						//Uploading attachment
						$sql="insert into attachments (applicant_id, description, format, created_at) values ('$row[id]', 'معرفی نامه', '$file_ext', '$_POST[fromdate]')";
						mysql_query($sql) or die (mysql_error());
						$sqgetid="select id from attachments order by id desc LIMIT 1";
						$rsgetid=mysql_query($sqgetid) or die (mysql_error());
						$rwgetattid=mysql_fetch_array($rsgetid);
						
						  $newfilename =$rwgetattid['id'].$file_ext;
						  $destination = "app-attachments/$row[id]/".$newfilename;
						  $temp_file = $_FILES['app_photo']['tmp_name'];
						  move_uploaded_file($temp_file,$destination);
						  //Resizing Image
							   $image = new SimpleImage();
							   $image->load($destination);
							   $image->scale(65);

					   $image->save($destination);
						 }
					   
						header("location:otherprofile.php?appid=$row[id]");
						die();
						//}
						}
					?>
				<br />
				<br/>
				
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
