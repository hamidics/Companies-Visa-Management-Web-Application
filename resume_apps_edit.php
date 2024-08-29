<?php
include("template_header.php");
require_once("../library/image_resize.php");
$viewid=$_GET['ecode'];
?>
<script >
function checkpassnum1(passnum,sourceid)
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
function checkpassnum2(passnum, applicantid)
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
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="homepage.php">صفحه اصلی</a>
				<!-- First level MENU -->
			</li>
			<?php
						 if($_GET['type']==1){
							$link="company_apps.php?ecode=$viewid#tabs-2";
						}else if($_GET['type']==2){
							$link="transport_apps.php?ecode=$viewid#tabs-2";
						}else if($_GET['type']==3){
							$link="otherprofile.php?appid=$_GET[applicantid]#tabs-2";
						}else if($_GET['type']==4){
							$link="otherprofile.php?appid=$_GET[applicantid]#tabs-2";
						}
					?>
			<li>
			<a href="<?php echo $link;?>">صفحه قبل</a>
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php 
		$sql="select * from visa_history where id='$_GET[editid]'";
		$rs=mysql_query($sql) or die (mysql_error());
		$rowhistory=mysql_fetch_array($rs);
		echo "<form action='resume_apps_edit.php?editid=$_GET[editid]&applicantid=$_GET[applicantid]&type=$_GET[type]&ecode=$_GET[ecode]' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
			<fieldset>
			<span id="checkpass"></span>
			<table width="70%">
						<?php
						if($_GET['type']!=3 and $_GET['type']!=4){
						?>
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
									if($_GET['applicantid']==$rw['id']){
									echo "<option value='$rw[id]' selected >$rw[name] $apptype </option> ";
									}else{
									echo "<option value='$rw[id]'  >$rw[name] $apptype </option> ";
									}
								
								}
							?>
							</select>
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<?php
						}
						if($_GET['type']==1 || $_GET['type']==2){
							$validate="class='validate[checkDuplicate[passportnum2],required]' onkeyup='checkpassnum1(this.value,$viewid)'";
						}else{
							$validate="class='validate[checkDuplicate[passportnum2],required]' onkeyup='checkpassnum2(this.value,$_GET[applicantid])'";
						}
						?>
						<tr align="right">
							<td>شماره پاسپورت</td><td>
							<input type="text"  <?php echo $validate;?> value="<?php echo $rowhistory['passportnum'];?>" name="passnum" id="passnum"/>
							</td>
						</tr>
						
						<?php 
							if($_GET['type']==3){
						?>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مرجع معرفی:</td>
							<td><input type="text" size="40"   name="esource"  id="esource" value="<?php echo $rowhistory['newsource'];?>"/></td>
						</tr>
						<?php
						}
						?>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td width="20%"> تاریخ مراجعه:</td>
							<td align="right" >
							<input type="text" size="42" name="requestdate" value="<?php echo $rowhistory['requestdate'];?>" id="requestdate"  />
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('requestdate', this);"/>

				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td width="20%"> از تاریخ:</td>
							<td align="right" >
							<input type="text" name="fromdate" id="fromdate" value="<?php echo $rowhistory['fromdate'];?>"  style="width:200px" />
				<!--<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('fromdate', this);"/>
				-->
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تا تاریخ:</td>
							<td>
							<input type="text" name="todate" id="todate" value="<?php echo $rowhistory['todate'];?>"  style="width:200px" />
				<!--<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('todate', this);"/>
				-->
				</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> عملکرد (واردات):</td>
							<td><input type="text" size="42" name="donejobs"  id="donejobs" value="<?php echo $rowhistory['import_amount'];?>" class="validate[Integer]" /> 
							<select name="mcurrency1" id="mcurrency1" >
							<option value="">انتخاب واحد پولی</option>
							<option value="میلیارد" <?php if($rowhistory['currency_imp']=="میلیارد"){ echo "selected";}?> >میلیارد</option>
							<option value="میلیون" <?php if($rowhistory['currency_imp']=="میلیون"){ echo "selected";}?> >میلیون</option>
							<option value="دلار" <?php if($rowhistory['currency_imp']=="دلار"){ echo "selected";}?> >دلار</option>
							</select>							 
							 </td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> عملکرد (صادرات):</td>
							<td>
							<input type="text" size="42" name="donejobs_ex"  id="donejobs_ex" value="<?php echo $rowhistory['export_amount'];?>" class="validate[Integer]"/> 
							<select name="mcurrency2" id="mcurrency2" >
							<option value="">انتخاب واحد پولی</option>
							<option value="میلیارد" <?php if($rowhistory['currency_exp']=="میلیارد"){ echo "selected";}?>>میلیارد</option>
							<option value="میلیون" <?php if($rowhistory['currency_exp']=="میلیون"){ echo "selected";}?>>میلیون</option>
							<option value="دلار" <?php if($rowhistory['currency_exp']=="دلار"){ echo "selected";}?>>دلار</option>
							</select>
							</td>
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
										if($rwtype['id']==$rowhistory['visa_type']){
										echo "<option selected value='$rwtype[id]'>$rwtype[name]</option>";
										}else{
										echo "<option  value='$rwtype[id]'>$rwtype[name]</option>";

										}
									}
								?>
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور گذرنامه:</td>
							<td>
							<input type="text" size="42" name="passissuedate" value="<?php echo $rowhistory['passissuedate'];?>"  id="passissuedate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل صدور گذرنامه:</td>
							<td>
							<input type="text" size="42" name="passissueplace" value="<?php echo $rowhistory['passissueplace'];?>"  id="passissueplace"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> پیوست درخواست:</td>
							<td><select name="requesttype" id="requesttype" style="height:30px; width:210px">
								<option value="">انتخاب نوع پیوست</option>
								<option value="درخواست" <?php if($rowhistory['attachtype']=="درخواست"){ echo "selected";}?> >درخواست متقاضی</option>
								<option value="نامه" <?php if($rowhistory['attachtype']=="نامه"){ echo "selected";}?>>نامه</option>
							</select></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> دستور رسیدگی:</td>
							<td>
							<input type="text" size="42" name="visaorder" value="<?php echo $rowhistory['orderforvisa'];?>" id="visaorder"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td>مجوز مرکز (شماره):</td>
							<td>
							<input type="text" size="42" name="centernum" value="<?php echo $rowhistory['center_mojavez_num'];?>" id="centernum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مجوز مرکز (تاریخ):</td>
							<td>
							<input type="text" size="42" name="centerdate" value="<?php echo $rowhistory['center_mojavez_date'];?>" id="centerdate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مدت اقامت:</td>
							<td>
							<input type="text" size="42" name="applimitdays" value="<?php echo $rowhistory['limitdays'];?>" id="applimitdays"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> قیمت ویزا:</td>
							<td>
							<input type="text" size="42" name="appvisaprice" value="<?php echo $rowhistory['visaprice'];?>" id="appvisaprice"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> ارجعیت:</td>
							<td>
							<input type="text" size="42" name="arjaeet" value="<?php echo $rowhistory['arjaeet'];?>" id="arjaeet"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره روادید صادره:</td>
							<td>
							<input type="text" size="42" name="visanum" value="<?php echo $rowhistory['visanumber'];?>" id="visanum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور روادید:</td>
							<td>
							<input type="text" size="42" name="visaissuedate" value="<?php echo $rowhistory['visaissuedate'];?>" id="visaissuedate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<?php 
							if($_GET['type']==3 || $type==4){
						?>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تایید بازگشت:</td>
							<td><input type="checkbox" size="40" <?php if($rowhistory['back']==1)echo "checked";?> value='1' name="acceptback"  id="acceptback" /></td>
						</tr>
						<?php
						}
						?>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> توضیح:</td>
							<td><input type="text" size="42" value="<?php echo $rowhistory['details'];?>" name="details"  id="details" /></td>
						</tr>
						</table>
						<?php
							if($_GET['type']==3 || $_GET['type']==4){
						
						?>
						<table id="table" align="center">
						<tr align="center"><td colspan="8">لیست همراهان</td></tr>
						<tr>
						<th>نام</th>
						<th>نام خانوادگی</th>
						<th>نام پدر</th>
						<th>تاریخ تولد</th>
						<th>نسبت</th>
						<th>تحصیلات</th>
						<th>شغل</th>
						<th></th>
						</tr>
						<?php
							$sqldep="select * from dependent_visa_dependants where other_parentid='$rowhistory[id]'";
							$rsdep=mysql_query($sqldep) or die (mysql_error());
							while($rwdep=mysql_fetch_array($rsdep)){
								echo "<tr align='center'>
									<td>$rwdep[name]</td>
									<td>$rwdep[family]</td>
									<td>$rwdep[father_name]</td>
									<td>$rwdep[birthdate]</td>
									<td>$rwdep[relation]</td>
									<td>$rwdep[education]</td>
									<td>$rwdep[job]</td>
									<td><a href='resume_apps_edit.php?delid=$rwdep[id]&editid=$_GET[editid]&applicantid=$_GET[applicantid]&type=$_GET[type]&ecode=$_GET[ecode]' class='confirm'>
									<img src='img/cancel.png'/></a></td>
								</tr>";
							}
						
						?>
						</table>
						<br/>
						<table  align="center" style="width:900px">
						
					<tr align="center">
					<td><input type="text" id="depdepname1" name="depdepname[]"  size='14'/></td>
			
					<td><input type="text" id="deplastname1" name="deplastname[]"  size='14'/></td>
				
					<td><input type="text" id="depfather1" name="depfather[]"  size='14'/></td>
				
						<td><input type="text" name="depbirthdate[]"  size="14"   /></td>
				
					<td><input type="text" id="deprelation1" name="deprelation[]"  size='14'/></td>
				
					<td><input type="text" id="depeducation1" name="depeducation[]"  size='14'/></td>
				
					<td><input type="text" id="depjob1" name="depjob[]"  size='14'/></td>
				</tr>
						</table>
						<br/><div align="center">
						<input type="button" id="button1" style="background-color:white; border:0; background-image:url(img/add.gif); width:21px;height:21px " onclick="AddNew(),jQuery('#myform').validationEngine('hide'),calctotal()" class="add-row"/>
				<input type="button" id="button2" style="background-color:white; border:0; background-image:url(img/remove.gif); width:21px;height:21px  " onclick="removeRow(),jQuery('#myform').validationEngine('hide'),calctotal()" class="remove-row"/></br>
				</div>
						<?php
						}
						?>
							<div >
							</div>
						
						<input type="submit" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره"/>
					<?php
						 if($_GET['type']==1){
							$link="company_apps.php?ecode=$viewid#tabs-2";
						}else if($_GET['type']==2){
							$link="transport_apps.php?ecode=$viewid#tabs-2";
						}else if($_GET['type']==3){
							$link="otherprofile.php?appid=$_GET[applicantid]#tabs-2";
						}else if($_GET['type']==4){
							$link="otherprofile.php?appid=$_GET[applicantid]#tabs-2";
						}
					?>
						<a href="<?php echo $link;?>"><input type="button" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="انصراف"/></a>
			   
				
 		</fieldset>
			
		</form>
		</div>
		<?php
			if(isset($_POST['updateapplicant'])){
						if($_GET['type']==3 || $_GET['type']==4){
							if($_POST['acceptback']==""){
								$_POST['acceptback']=0;
							}
							$newsql=", back='$_POST[acceptback]', newsource='$_POST[esource]'";
							$_POST['applicant_id']=$_GET['applicantid'];
							
						}else{
							$apquery="applicant_id='$_POST[applicantname]',";
						}
						$sqlupdate="update visa_history set $apquery passportnum='$_POST[passnum]', 
						fromdate='$_POST[fromdate]', todate='$_POST[todate]', import_amount='$_POST[donejobs]', export_amount='$_POST[donejobs_ex]',
						currency_imp='$_POST[mcurrency1]', currency_exp='$_POST[mcurrency2]',
						visa_type='$_POST[visatype]', details='$_POST[details]', passissuedate='$_POST[passissuedate]', passissueplace='$_POST[passissueplace]', attachtype='$_POST[requesttype]', orderforvisa='$_POST[visaorder]', center_mojavez_num='$_POST[centernum]', center_mojavez_date='$_POST[centerdate]', arjaeet='$_POST[arjaeet]', visanumber='$_POST[visanum]', visaissuedate='$_POST[visaissuedate]', visaprice='$_POST[appvisaprice]', limitdays='$_POST[applimitdays]', requestdate='$_POST[requestdate]' $newsql where id='$_GET[editid]'";
						mysql_query($sqlupdate) or die(mysql_error());
						if($_GET['type']==3 || $_GET['type']==4){
						for($i=0; $i<sizeof($_POST['depdepname']);$i++){
							echo $_POST['depdepname'][$i];
							if($_POST['depdepname'][$i]!="" and $_POST['depdepname'][$i]!=null ){
								$sq="insert into  dependent_visa_dependants (name, family, father_name, birthdate, relation, education, job, other_parentid) 
								values ('".$_POST['depdepname'][$i]."', '".$_POST['deplastname'][$i]."', '".$_POST['depfather'][$i]."', '".$_POST['depbirthdate'][$i]."'
								, '".$_POST['deprelation'][$i]."', '".$_POST['depeducation'][$i]."', '".$_POST['depjob'][$i]."', '$_GET[editid]')";
								mysql_query($sq) or die (mysql_error());
							}
						
						}
						
						}
					   if($_GET['type']==1){
							header("location:company_apps.php?ecode=$viewid#tabs-2");
						}else if($_GET['type']==2){
							header("location:transport_apps.php?ecode=$viewid#tabs-2");
						}else if($_GET['type']==3){
							header("location:otherprofile.php?appid=$_GET[applicantid]#tabs-2");
						}else if($_GET['type']==4){
							header("location:otherprofile.php?appid=$_GET[applicantid]#tabs-2");
						}
						die();
			
			
			}
			if(isset($_GET['delid'])){
				$sqdel="delete from  dependent_visa_dependants where id='$_GET[delid]'";
				mysql_query($sqdel) or die (mysql_error());
				header("location:resume_apps_edit.php?editid=$_GET[editid]&applicantid=$_GET[applicantid]&type=$_GET[type]&ecode=$_GET[ecode]");
				die();
			}
		?>
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
