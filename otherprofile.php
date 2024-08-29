<?php
include("template_header.php");
require_once("../library/image_resize.php");
require_once("dependants_deps_addremowrow.php");
$viewid=$_GET['appid'];
$fexists=file_exists ("app-attachments/$viewid/") ;
if($fexists!=true){
mkdir("app-attachments/$viewid/");
}
?>
<script>
function checkpassnum(passnum, applicantid)
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
			 
				xmlhttp.open('GET','newapplicant_checkpassajax.php?passnumber='+passnum+'&appid='+applicantid,true);
				xmlhttp.send();
}


</script>

	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<?php
		$i=1;
				$sql="select * from vapplicants where id='$viewid'  ";
				$res=mysql_query($sql) or die(mysql_error());
				$row=mysql_fetch_array($res);
					$sourcename="";
					$type="";
					if($row['type']=="other"){
						$sourcename=$row['introduced_by']."(متفرقه)";
						$sourceid="other";
					}else{
						$sq="select id, name, type from sources where id='$row[source_id]'";
						$rssource=mysql_query($sq) or die (mysql_error());
						$rwsource=mysql_fetch_array($rssource);
						$sourcename=$rwsource['name'];
						$sourceid=$rwsource['id'];
						$type=$rwsource['type'];
					}
		?>
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
			<?php
				if($row['type']=="other"){
					echo "<a href='others.php'>صفحه قبل</a>";
				}else{
					echo "<a href='etehadie_apps.php?ecode=$row[source_id]'>صفحه قبل</a>";
				}
			
			?>
				
				<!-- First level MENU -->
			</li>
			<li>
			<a href="homepage.php">صفحه اصلی</a>
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php echo "<form action='otherprofile.php?appid=$viewid' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
			<fieldset>
				<legend align="right"><span dir="rtl">مشخصات متقاضی >> منبع معرفی کننده:<?php if($type!="")echo $sourcename; else echo "متفرقه";?></span></legend>
			<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>

					<li><a href="#tabs-1">مشخصات عمومی شخص</a></li>
					<li><a href="#tabs-2">سوابق ویزایی</a></li>
					<li><a href="#tabs-3">اسناد</a></li>
				
				</ul>
				<div id="tabs-1">
				<br/>
				<?php
				if($type==""){
				?>
				وضعیت شخص : <select name="costatus" id="costatus">
				<option value="">انتخاب وضعیت</option>
				<?php
					$sql="select id, status, details from blacklist where applicant_id='$viewid'";
					$rsstatus=mysql_query($sql) or die (mysql_error());
					$rwstatus=mysql_fetch_array($rsstatus);
					if($rwstatus['id']==null || $rwstatus=''){
						$sql="insert  into blacklist  (status, applicant_id) values('1', '$viewid')";
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
						$sql="update blacklist set status='$_POST[costatus]', details='$_POST[statusdetail]' where applicant_id='$viewid'";
						mysql_query($sql) or die (mysql_error());
						header("location:otherprofile.php?appid=$viewid#tabs-1");
						die();
					}
				?>
				<?php
				}
				?>
				<br/><br/>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام </th>
				<th>نام پدر</th>
				<th>تخلص</th>
				<th>شماره گذرنامه</th>
				<th>نوع فعالیت</th>
				<th>کارشناس</th>
				<th>مرجع معرفی</th>
				<th>عملیات</th>
				</tr>
				<?php
				
					
					$sq="select name from users where id='$row[supervisor]'";
					$rsuser=mysql_query($sq) or die (mysql_error());
					$rwuser=mysql_fetch_array($rsuser);
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name]</td>
					<td> $row[father_name]</td>
					<td> $row[family]</td>
					<td>$row[passportnum]</td>
					<td> $row[work_field]</td>
					<td>$rwuser[name]</td>
					<td>$sourcename</td>
					";
					$sqcheck="select count(id) from visa_history where applicant_id='$row[id]'";
					$rscheck=mysql_query($sqcheck) or die (mysql_error());
					$rwcheck=mysql_fetch_array($rscheck);
					if($rwcheck['count(id)']>0){
					echo"<td><img src='img/cancel1.png' title='حذف متقاضی '/>";
					}else{
					echo"<td><a href='otherprofile.php?delapp=$row[id]&appid=$viewid#tabs-1' class='confirm'><img src='img/cancel.png' title=''/></a>";
					}
					echo "<a href='other_apps_edit.php?editid=$row[id]&source=$sourceid'><img src='img/edit.png' title='ویرایش درخواست کننده'/></a>
					</td></tr>
					";
					
				
				
				?>
				<?php
				
				
				if(isset($_GET['delapp'])){
					$sq="select type, source_id from vapplicants where id='$_GET[delapp]'";
					$rsgettype=mysql_query($sq) or die (mysql_error());
					$rwgettype=mysql_fetch_array($rsgettype);
					
					$sql="delete from vapplicants where id='$_GET[delapp]' ";
					mysql_query($sql) or die(mysql_error());
					if($type==""){
						header("location:others.php");
					}else if($type==1){
						header("location:etehadie_apps.php?ecode=$sourceid#tabs-1");
					}
					die();
				}
				
				?>
				</table>
			    </div>
				
				
					     
				<div id="tabs-2">
				<a href="#" id="addlink_tab3" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن سابقه ویزا</b></a>
						<a href="#" id="addlinkback_tab3" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن سابقه ویزا</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						
						<div id="addlinkdata_tab3" >
						<span id="checkpass" align="center"></span>
						<table width="70%">
						<tr align="right">
							<td> شماره پاسپورت:</td>
							<td><input type="text" size="40" class="validate[checkDuplicate[passportnum2],required]" onkeyup="checkpassnum(this.value,<?php echo $viewid;?>)" name="vpassnum"  id="vpassnum" /></td>
						</tr>
						<?php
						if($sourceid=="other"){
						?>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مرجع معرفی کننده:</td>
							<td><input type="text" size="40" name="source"  id="source" /></td>
						</tr>
						<?php
						}
						?>
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
							<td width="20%"> از تاریخ:</td>
							<td align="right" >
							<input type="text" name="fromdate" id="fromdate" class="validate[required,custom[date]]" style="width:200px" />
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('fromdate', this);"/>
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تا تاریخ:</td>
							<td>
							<input type="text" name="todate" id="todate" class="validate[required,custom[date]]" style="width:200px" />
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('todate', this);"/>
				</tr>
						<tr><td colspan='2'><br/></td></tr>
					<tr align="right">
							<td> عملکرد (واردات):</td>
							<td><input type="text" size="42" name="donejobs"  id="donejobs" value="0" class="validate[custom[integer]]"/> 
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
							<input type="text" size="42" name="donejobs_ex"  id="donejobs_ex" value="0" class="validate[custom[integer]]"/> 
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
							<td> کارشناس:</td>
							<td>
							<?php echo $_SESSION['user_name'];?>
							</td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> تعداد همراه:</td>
							<td><input type="text" size="40" name="numofdependents"  id="numofdependents" /></td>
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
							</select></td>
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
							<td><select name="requesttype" id="requesttype" class="validate[required]" style="height:30px; width:210px">
								<option value="">انتخاب نوع پیوست</option>
								<option value="درخواست">درخواست متقاضی</option>
								<option value="نامه">نامه</option>
							</select></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> آپلود فایل:</td>
							<td><input type="file" id="visaattach" name="visaattach"/></td>
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
							<td><textarea type="text" cols='40' rows='6' name="details"  id="details" ></textarea></td>
						</tr>
						</table>
						<table id="deptable" align="center">
						<tr align="center"><td colspan="7">لیست همراهان</td></tr>
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
				
					<td><input type="text" id="depjob1" name="depjob[]"  size='16'/></td>
				</tr>
						</table>
						<br/><div align="center">
						<input type="button" id="button1" style="background-color:white; border:0; background-image:url(img/add.gif); width:21px;height:21px " onclick="AddNew(),jQuery('#myform').validationEngine('hide'),calctotal()" class="add-row"/>
				<input type="button" id="button2" style="background-color:white; border:0; background-image:url(img/remove.gif); width:21px;height:21px  " onclick="removeRow(),jQuery('#myform').validationEngine('hide'),calctotal()" class="remove-row"/></br>
				</div>
							<br/>
						<input type="submit" class="submit"  name="inserthistory" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab3"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"otherprofile.php?appid=$viewid#tabs-2\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' value='انصراف'/></td>";?>

				</div><br/>
				<?php
					if(isset ($_POST['inserthistory'])){
						if($sourceid=="other"){
						$sql="insert into visa_history (applicant_id, fromdate, todate, import_amount, export_amount, currency_imp, currency_exp, newsource, details, numofdependents, visa_type, supervisor, passportnum, passissuedate, passissueplace, attachtype, orderforvisa, center_mojavez_num, center_mojavez_date, arjaeet, visanumber, visaissuedate, visaprice, limitdays, requestdate) 
						values('$viewid', '$_POST[fromdate]', '$_POST[todate]', '$_POST[donejobs]', '$_POST[donejobs_ex]', '$_POST[mcurrency1]', '$_POST[mcurrency2]', '$_POST[source]', '$_POST[details]', '$_POST[numofdependents]', '$_POST[visatype]', '$_SESSION[user_id]', '$_POST[vpassnum]', '$_POST[passissuedate]', 
						'$_POST[passissueplace]', '$_POST[requesttype]', '$_POST[visaorder]', '$_POST[centernum]', '$_POST[centerdate]', '$_POST[arjaeet]', '$_POST[visanum]', '$_POST[visaissuedate]', '$_POST[appvisaprice]', '$_POST[applimitdays]', '$_POST[requestdate]')";
						}else{
						$sql="insert into visa_history (applicant_id, fromdate, todate, import_amount, export_amount, currency_imp, currency_exp, details, numofdependents, visa_type, supervisor, passportnum, passissuedate, passissueplace, attachtype, orderforvisa, center_mojavez_num, center_mojavez_date, arjaeet, visanumber, visaissuedate, visaprice, limitdays, requestdate) 
						values('$viewid', '$_POST[fromdate]', '$_POST[todate]', '$_POST[donejobs]', '$_POST[donejobs_ex]', '$_POST[mcurrency1]', '$_POST[mcurrency2]', '$_POST[details]', '$_POST[numofdependents]', '$_POST[visatype]', '$_SESSION[user_id]', '$_POST[vpassnum]', '$_POST[passissuedate]', 
						'$_POST[passissueplace]', '$_POST[requesttype]', '$_POST[visaorder]', '$_POST[centernum]', '$_POST[centerdate]', '$_POST[arjaeet]', '$_POST[visanum]', '$_POST[visaissuedate]', '$_POST[appvisaprice]', '$_POST[applimitdays]', '$_POST[requestdate]')";
						
						}
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
						$filename=$_FILES['visaattach']['name'];
							 $file_ext = substr($filename, strripos($filename, '.'));
							$sql="insert into attachments (applicant_id, description, format, created_at) values ('$viewid', 'درخواست ویزا', '$file_ext', '".$_POST['requestdate']."')";
							mysql_query($sql) or die (mysql_error());
							$sqgetid="select id from attachments where applicant_id='$viewid' order by id desc LIMIT 1";
							$rsgetid=mysql_query($sqgetid) or die (mysql_error());
							$rwgetid=mysql_fetch_array($rsgetid);
							
							//$filename=$_FILES['attach']['name'][$j];
							// $file_ext = substr($filename, strripos($filename, '.'));

							  $newfilename =$rwgetid['id'].$file_ext;
							  $destination = "app-attachments/$viewid/".$newfilename;
							  $temp_file = $_FILES['visaattach']['tmp_name'][$j];
							  move_uploaded_file($temp_file,$destination);
							  //Resizing Image
							   $image = new SimpleImage();
							   $image->load($destination);
							   $image->scale(65);

					   $image->save($destination);
						header("location:otherprofile.php?appid=$viewid#tabs-2");
						die();
					}
				
				?>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<?php 
					if($sourceid=="other"){
				?>
				<th>مرجع معرفی</th>
				<?php
				}
				?>
				
				<th>شماره پاسپورت</th>
				<th>کارشناس</th>
				<th>تعداد همراه</th>
				<th>از تاریخ</th>
				<th>تا تاریخ</th>
				<th>واردات</th>
				<th>صادرات</th>
				<th>نوع ویزا</th>
				<th>چاپ فرمها</th>
				<th>توضیح</th>
				
				<th>تایید بازگشت</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				
					$sq="select * from visa_history where applicant_id='$viewid' order by id desc";
					$rs=mysql_query($sq) or (mysql_error());
					while($rw=mysql_fetch_array($rs)){
					$sq="select name from users where id='$rw[supervisor]'";
					$rsuser=mysql_query($sq) or die (mysql_error());
					$rwuser=mysql_fetch_array($rsuser);
					echo "
					<tr align='center'>
					<td>$i</td>";
					if($sourceid=="other"){
					echo "<td>$rw[newsource]</td>";
					}
					echo "<td> $rw[passportnum]</td>
					<td> $rwuser[name]</td>
					<td>$rw[numofdependents]</td>
					<td> $rw[fromdate]</td>
					<td>$rw[todate]</td>
					<td> $rw[import_amount] $rw[currency_imp]</td>";
					
					
					echo"
					<td> $rw[export_amount] $rw[currency_exp]</td>";
					$sqtypename="select name from visatypes where id='$rw[visa_type]'";
					$rstypename=mysql_query($sqtypename) or die (mysql_error());
					$rwtypename=mysql_fetch_array($rstypename);
					
					echo "<td> $rwtypename[name]</td>
					<td> <a href='resume_visaform_excel.php?resumeid=$rw[id]&ov=1' style='color:blue'>فرم ویزا</a> | <a href='resume_bill_excel.php?resumeid=$rw[id]' style='color:blue'>فیش بانکی</a> </td>
					<td>$rw[details]</td>
					";

					
					if($rw['back']==1){
						echo "<td><img src='img/accept.png'/></td>";
					}else{
						echo "<td><a style='color:blue' href='otherprofile.php?appid=$viewid&backapp=$rw[id]#tabs-2' >تایید بازگشت</a></td>";
					}
					if($sourceid=="other"){
						$type=3;
					}else{
						$type=4;
					}
					echo "<td><a href='resume_apps_edit.php?applicantid=$viewid&editid=$rw[id]&ecode=$sourceid&type=$type'><img src='img/edit.png' title='ویرایش درخواست کننده'/></a>
					
					";
					echo"<a href='otherprofile.php?delhistory=$rw[id]&appid=$viewid#tabs-2' class='confirm'><img src='img/cancel.png' title='پاک کردن درخواست کننده'/></a>
					</td></tr>";
					
					$i++;
					}
				
				
				?>
				<?php
					
					if(isset($_GET['delhistory'])){
						$sq="Delete from visa_history  where id='$_GET[delhistory]'";
						mysql_query($sq) or die (mysql_error());
						header("location:otherprofile.php?appid=$viewid#tabs-2");
						die();
					}
					if(isset($_GET['backapp'])){
						$sq="Update  visa_history set back='1' where id='$_GET[backapp]'";
						mysql_query($sq) or die (mysql_error());
						header("location:otherprofile.php?appid=$viewid#tabs-2");
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
				<a  href='app-attachments/<?php echo $viewid;?>/' target="_blank" ><input type="button"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:160px;margin-right:15px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="نمایش آرشیو فایلهای شرکت" />
							</a>
				<br/>
				<?php
					if(isset($_POST['insertattach'])){
						for($j=0;$j<sizeof($_POST['attachdetail']); $j++){
						$filename=$_FILES['attach']['name'][$j];
							 $file_ext = substr($filename, strripos($filename, '.'));
							$sql="insert into attachments (applicant_id, description, format, created_at) values ('$viewid', '".$_POST['attachdetail'][$j]."', '$file_ext', '".$_POST['date'][$j]."')";
							mysql_query($sql) or die (mysql_error());
							$sqgetid="select id from attachments where applicant_id='$viewid' order by id desc LIMIT 1";
							$rsgetid=mysql_query($sqgetid) or die (mysql_error());
							$rwgetid=mysql_fetch_array($rsgetid);
							
							//$filename=$_FILES['attach']['name'][$j];
							// $file_ext = substr($filename, strripos($filename, '.'));

							  $newfilename =$rwgetid['id'].$file_ext;
							  $destination = "app-attachments/$viewid/".$newfilename;
							  $temp_file = $_FILES['attach']['tmp_name'][$j];
							  move_uploaded_file($temp_file,$destination);
							  //Resizing Image
							   $image = new SimpleImage();
							   $image->load($destination);
							   $image->scale(65);

					   $image->save($destination);
						  }
					header("location:otherprofile.php?appid=$viewid#tabs-3");
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
				$sql="select * from attachments where applicant_id='$viewid' order by id desc";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[description]</td>
					<td><a href='app-attachments/$viewid/".$row['id'].$row['format']."' target='_blank'> <img src='app-attachments/$viewid/".$row['id'].$row['format']."' style='width:100px; height:70px'/></a></td>
					";
					
					
					echo "
					</tr>
					";
					$i++;
				
				}
				
				if(isset($_GET['delattach'])){
					$sql="delete from attachments where id='$_GET[delattach]'";
					mysql_query($sql) or die (mysql_error());
					unlink("app-attachments/$viewid/".$_GET['delattach'].$_GET['ftype']);
					header("location:otherprofile.php?appid=$viewid#tabs-3");
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
