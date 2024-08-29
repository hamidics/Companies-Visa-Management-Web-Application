<?php
include("template_header.php");
require_once("../library/image_resize.php");
$viewid=$_GET['applicant_id'];

?>

<script language="javascript" type='text/javascript'>

function addapplicantaddres(appid,karvanid)
{
var divid='address'+appid;

	if (appid=='')
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
			 
				xmlhttp.open('GET','karvan_applicants_addressajax.php?applicantid='+appid+'&karvanid='+karvanid+'&type=1',true);
				xmlhttp.send();
					
}


</script>

	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="homepage.php">صفحه اصلی</a>
				<!-- First level MENU -->
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php echo "<form action='viewapplicants.php?applicant_id=$viewid&type=$_GET[type]' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		<?php
			$sq="select activity_background from sources where code='$viewid'";
			$rsbackground=mysql_query($sq) or die (mysql_error());
			$rwbackground=mysql_fetch_array($rsbackground);
			$sql="select id, name, responsibility from vapplicants where source_id='$viewid' and responsibility='boss'";
			$res=mysql_query($sql) or die(mysql_error());
			$ro=mysql_fetch_array($res);
			$sql="select code, licence_num, name from sources where code='$viewid'";
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
			<br/> <img style='height:75px; width:60px;' src='appphotos/$responsibleid".".jpg"."?".time()."'/> رئیس مرکز: $responsiblename>>>>";
			echo "<img style='height:75px; width:60px;margin-right:150px' src='appphotos/$rowvice[id]".".jpg"."?".time()."'/> معاون: $rowvice[name]>>></span>";
			}else{
			echo "<div style='color:red' >رئیس مرکز تعیین نگردیده است!</div>";
			}
		?>
			<fieldset>
				<legend align="right"><span dir="rtl"><marquee>نام مرکز: <?php echo $roo['name'];?>>> شماره ثبت: <?php echo $viewid;?> >> شماره جواز: <?php echo $roo['licence_num'];?></marquee></span></legend>
			<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>
					<li><a href="#tabs-1">مشخصات عمومی</a></li>
					<li><a href="#tabs-2">سوابق ویزایی</a></li>
					<li><a href="#tabs-3">ویزاهای نزدیکان</a></li>
				</ul>
				<div id="tabs-1">
						<?php
							if($responsibleid=="" || $rowvice['id']==""){
						?>
						<a href="#" id="addlink" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن عضو جدید</b></a>
						<a href="#" id="addlinkback" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن عضو جدید</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						<?php
						}
						?>
						<div id="addlinkdata" >
						<table width="50%">
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
							<td> نام همسر:</td>
							
							<td><input type="text" size="30" name="wife"  id="wife" /></td>
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
							<td><input type="text" size="30" name="app_phone" class="validate[required]" id="app_phone" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>						
						<tr align="right">
							<td> عنوان متقاضی:</td>
							<td>
							<select name="app_position"  id="app_position"  style="width:182px">
							<option value="">عنوان متقاضی</option>
							<?php
								if($responsibleid==""){
							?>
							<option value="boss">رئیس</option>
							<?php
							}
							if($rowvice['id']==""){
							?>
							<option value="vicep">معاون</option>
							<?php
							}
							?>
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
						
						<input type="submit" class="submit"  name="insertapplicant" value="ذخیره" id="linkdatabutton"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"company_apps.php?ecode=$viewid&type=$_GET[type]\",\"_parent\")' name='cancel' value='انصراف'/></td>";?>
						
					</div></br></br>
					<?php
					if(isset($_POST['insertapplicant'])){
						 $filename=$_FILES['app_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
												 
							$phone=$_POST['app_phone'];
							$file_ext=".jpg";
						
						$sql="Insert into vapplicants (name, family, father_name, wife, sons, phone, responsibility, work_field, source_id) values ('$_POST[app_name]',
						'$_POST[app_fname]', '$_POST[app_fathername]', '$_POST[wife]', '$_POST[sons]', '$phone', '$_POST[app_position]', '$rwbackground[activity_background]', '$viewid')";
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
				$sql="select * from vapplicants where source_id='$viewid'";
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
					echo "<a href='company_apps.php?editid=$row[id]&ecode=$viewid&type=$_GET[type]'><img src='img/edit.png' title='ویرایش درخواست کننده'/></a>
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
						<table width="50%">
						<tr align="right">
							<td width="20%"> نام متقاضی:</td>
							<td align="right" >
							<select name="applicantname" id="applicantname" class="validate[required]" width="220px">
							<option value="">انتخاب رئیس یا معاون</option>
							<?php
								$sql="select id, name, responsibility from vapplicants where source_id='$viewid' and responsibility='boss' or responsibility='vicep'";
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
							<td> عملکرد:</td>
							<td><input type="text" size="42" name="donejobs"  id="donejobs" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> توضیح:</td>
							<td><input type="text" size="42" name="details"  id="details" /></td>
						</tr>
						</table>
							<br/>
						<input type="submit" class="submit"  name="insertdone" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab2"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-2\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' value='انصراف'/></td>";?>

				</div><br/>
				<?php
					if(isset ($_POST['insertdone'])){
						$sql="insert into visa_history (applicant_id, fromdate, todate, amount, details) 
						values('$_POST[applicantname]', '$_POST[fromdate]', '$_POST[todate]', '$_POST[donejobs]', '$_POST[details]')";
						mysql_query($sql) or die (mysql_error());
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-2");
						die();
					}
				
				?>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام و وظیفه</th>
				<th>از تاریخ</th>
				<th>تا تاریخ</th>
				<th>عملکرد</th>
				<th>توضیح</th>
				<th>تایید بازگشت</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from vapplicants where source_id='$viewid' and (responsibility='boss' or responsibility='vicep')";
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
					<td> $rw[fromdate]</td>
					<td>$rw[todate]</td>
					<td> $rw[amount]</td>
					<td>$rw[details]</td>
					";
					if($rw['back']==1){
						echo "<td><img src='img/accept.png'/></td>";
					}else{
						echo "<td><a style='color:blue' href='company_apps.php?accept=1&ecode=$viewid&type=$_GET[type]&backapp=$rw[id]#tabs-2' >تایید بازگشت</a></td>";
					}
					
					echo"<td><a href='company_apps.php?delid=$row[id]&ecode=$viewid&type=$_GET[type]#tabs-2' class='confirm'><img src='img/cancel.png' title='پاک کردن درخواست کننده'/></a>
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
				?>
				</table>
				</div>
				
				
				<div id="tabs-3">
					<a href="#" id="addlink_tab3" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن ویزای بستگان</b></a>
						<a href="#" id="addlinkback_tab3" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن ویزای بستگان</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						<hr align="right"style=" width:150px"/>
						
						<div id="addlinkdata_tab3" >
						<table width="50%">
						<tr align="right">
							<td width="20%"> نام متقاضی:</td>
							<td align="right" >
							<input type="text" size="42" name="depname"  id="depname" class="validate[required]" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td width="20%"> نام پدر:</td>
							<td align="right" >
							<input type="text" size="42" name="depfname"  id="depfname" class="validate[required]" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
					<tr align="right">
							<td width="20%"> نسبت:</td>
							<td align="right" >
							<input type="text" size="42" name="relation"  id="relation" class="validate[required]" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td width="20%"> تاریخ صدور:</td>
							<td align="right" >
							<input type="text" name="fromdatedep" id="fromdate" class="validate[required,custom[date]]" style="width:200px" />
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('fromdatedep', this);"/>
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						</table>
							<br/>
						<input type="submit" class="submit"  name="insertdep" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;margin-right:60px"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره" id="linkdatabutton_tab3"/>
						
						<?php echo " <input type='button' id='cancel_cash' onclick='window.open (\"company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-2\",\"_parent\")' style='border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;'  onmouseover='this.style.background=\"#252527\"' onmouseout='this.style.background=\"#5e6062\"' name='cancel' value='انصراف'/></td>";?>

				</div><br/>
				<?php
					if(isset ($_POST['insertdep'])){
						$sql="insert into dependent_visa (source_id, fromdate, name, father_name, relation) 
						values('$viewid', '$_POST[fromdatedep]', '$_POST[depname]', '$_POST[depfname]', '$_POST[relation]')";
						mysql_query($sql) or die (mysql_error());
						header("location:company_apps.php?ecode=$viewid&type=$_GET[type]#tabs-3");
						die();
					}
				
				?>
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام و ولد</th>
				<th>نسبت</th>
				<th>تاریخ صدور</th>
				<th>تایید بازگشت</th>
				<th>عملیات</th>
				</tr>
				<?php
				$i=1;
				$sql="select * from dependent_visa where source_id='$viewid' ";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					
					
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name] فرزند ($row[father_name])</td>
					<td> $row[relation]</td>
					<td>$row[fromdate]</td>
					";
					if($row['back']==1){
						echo "<td><img src='img/accept.png'/></td>";
					}else{
						echo "<td><a style='color:blue' href='company_apps.php?accept_dependent=1&ecode=$viewid&type=$_GET[type]&backdep=$row[id]#tabs-3' >تایید بازگشت</a></td>";
					}
					
					echo"<td><a href='company_apps.php?delid=$row[id]&ecode=$viewid&type=$_GET[type]#tabs-2' class='confirm'><img src='img/cancel.png' title='پاک کردن درخواست کننده'/></a>
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
