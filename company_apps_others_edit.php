<?php
include("template_header.php");
require_once("../library/image_resize.php");
$viewid=$_GET['ecode'];
require_once("dependants_deps_addremowrow.php");

?>
<script>
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
				<a href="homepage.php">صفحه اصلی</a>
				<!-- First level MENU -->
			</li>
			<?php
						if($_GET['type']==1){
							$link="company_apps.php?ecode=$viewid#tabs-3";
						}else if($_GET['type']==2){
							$link="transport_apps.php?ecode=$viewid#tabs-3";
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
		echo "<form action='company_apps_others_edit.php?editid=$_GET[editid]&type=$_GET[type]&ecode=$_GET[ecode]' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
			<fieldset>
			<span id="otherpassnumdiv"></span>
			<table width="70%">
			<?php
				$sqlother="select * from dependent_visa where id='$_GET[editid]'";
				$rsother=mysql_query($sqlother) or die (mysql_error());
				$rwother=mysql_fetch_array($rsother);
			?>
						<tr align="right">
							<td width="20%"> نام متقاضی:</td>
							<td align="right" >
							<input type="text" size="42" name="depname" value="<?php echo $rwother['name'];?>" id="depname" onkeyup="checkpassnumothers(document.getElementById('passnum').value,this.value)" class="validate[required]" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td width="20%"> شماره پاسپورت:</td>
							<td align="right" >
							<input type="text" size="42" name="passnum" value="<?php echo $rwother['passportnum'];?>" id="passnum" onkeyup="checkpassnumothers(this.value,document.getElementById('depname').value)" class="validate[checkDuplicate[otherpassportnum2],required]" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td width="20%"> تاریخ مراجعه:</td>
							<td align="right" >
							<input type="text" size="42" name="requestdate" value="<?php echo $rwother['requestdate'];?>" id="requestdate"  />
<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('requestdate', this);"/>

				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td width="20%"> نام پدر:</td>
							<td align="right" >
							<input type="text" size="42" name="depfname" value="<?php echo $rwother['father_name'];?>" id="depfname"  />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
					<tr align="right">
							<td width="20%"> نسبت:</td>
							<td align="right" >
							<input type="text" size="42" name="relation" value="<?php echo $rwother['relation'];?>" id="relation"  />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>			
						<tr align="right">
							<td> آدرس افغانستان:</td>
							
							<td><input type="text" size="70" name="oafghanistanadd" value="<?php echo $rwother['afghanistanadd'];?>"  id="oafghanistanadd" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td> آدرس ایران:</td>
							
							<td><input type="text" size="70" name="oiraddress" value="<?php echo $rwother['iranaddress'];?>" id="oiraddress" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ تولد:</td>
							
							<td><input type="text" size="30" name="obdate" value="<?php echo $rwother['birthdate'];?>" id="obdate" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل تولد:</td>
							
							<td><input type="text" size="30" name="obplace" value="<?php echo $rwother['birthplace'];?>" id="obplace" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> وضعیت تاهل:</td>
							
							<td>
							<select name="omarital_status" id="omarital_status">
								<option value="">انتخاب وضعیت تاهل</option>
								<option value="متاهل" <?php if($rwother['marital_status']=="متاهل")echo "selected"; ?> >متاهل</option>
								<option value="مجرد" <?php if($rwother['marital_status']=="مجرد")echo "selected"; ?> >مجرد</option>
							</select>
							</td>
							</td>
						</tr>
						
						<tr align="right">
							<td> میزان تحصیلات:</td>
							
							<td><input type="text" size="30" name="oeducation" value="<?php echo $rwother['education'];?>" id="education" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						
					<tr align="right">
							<td width="20%"> تعداد همراهان:</td>
							<td align="right" >
							<input type="text" size="42" name="dependentamount" value="<?php echo $rwother['dependentamount'];?>" id="dependentamount"  />
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
										if($rwtype['id']==$rwother['visa_type']){
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
							<input type="text" size="42" name="opassissuedate" value="<?php echo $rwother['passissuedate'];?>" id="opassissuedate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل صدور گذرنامه:</td>
							<td>
							<input type="text" size="42" name="opassissueplace" value="<?php echo $rwother['passissueplace'];?>" id="opassissueplace"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> پیوست درخواست:</td>
							<td><select name="orequesttype" id="orequesttype" class="validate[required]" style="height:30px; width:210px">
								<option value="">انتخاب نوع پیوست</option>
								<option value="درخواست" <?php if($rwother['attachtype']=="درخواست")echo "selected"; ?>>درخواست متقاضی</option>
								<option value="نامه" <?php if($rwother['attachtype']=="نامه")echo "selected"; ?>>نامه</option>
							</select></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> دستور رسیدگی:</td>
							<td>
							<input type="text" size="42" name="ovisaorder" value="<?php echo $rwother['visaorder'];?>"  id="ovisaorder"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td>مجوز مرکز (شماره):</td>
							<td>
							<input type="text" size="42" name="ocenternum"  value="<?php echo $rwother['centernum'];?>" id="ocenternum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مجوز مرکز (تاریخ):</td>
							<td>
							<input type="text" size="42" name="ocenterdate" value="<?php echo $rwother['centerdate'];?>"  id="ocenterdate"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> ارجعیت:</td>
							<td>
							<input type="text" size="42" name="oarjaeet" value="<?php echo $rwother['arjaeet'];?>" id="oarjaeet"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره روادید صادره:</td>
							<td>
							<input type="text" size="42" name="ovisanum" value="<?php echo $rwother['visanum'];?>" id="ovisanum"  /> 
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور روادید:</td>
							<td>
							<input type="text" size="42" name="ovisaissuedate" value="<?php echo $rwother['visadate'];?>" id="ovisaissuedate"  /> 
							</td>
						</tr>												
						
						<tr align="right">
							<td width="20%"> مبلغ ویزا:</td>
							<td align="right" >
							<input type="text" size="42" name="visaprice" value="<?php echo $rwother['visaprice'];?>" id="visaprice" class="" />
				</td>
						</tr>
							<tr><td colspan='2'><br/></td></tr>	
					<tr align="right">
							<td width="20%"> مدت اقامت:</td>
							<td align="right" >
							<input type="text" size="42" name="limitdays" value="<?php echo $rwother['limitdays'];?>" id="limitdays" class="" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تایید بازگشت:</td>
							<td><input type="checkbox" size="40" <?php if($rwother['back']==1)echo "checked";?> value='1' name="acceptback"  id="acceptback" /></td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td width="20%"> توضیحات:</td>
							<td align="right" >
							<input type="text" size="42" name="depdetails"  id="depdetails" class="" />
				</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						</table>
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
							$sqldep="select * from dependent_visa_dependants where parent_id='$rwother[id]'";
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
									<td><a href='company_apps_others_edit.php?delid=$rwdep[id]&editid=$_GET[editid]&type=$_GET[type]&ecode=$_GET[ecode]' class='confirm'>
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
							<div >
							</div>
						
						<input type="submit" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره"/>
<?php
						 if($_GET['type']==1){
							$link="company_apps.php?ecode=$viewid#tabs-3";
						}else if($_GET['type']==2){
							$link="transport_apps.php?ecode=$viewid#tabs-3";
						}
					?>
						<a href="<?php echo $link;?>"><input type="button" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="انصراف"/></a>
			   
						
			   
				
 		</fieldset>
			
		</form>
		</div>
		<?php
			if(isset($_POST['updateapplicant'])){
						if($_POST['acceptback']==""){
							$_POST['acceptedit']=0;
						}
						$sqlupdate="update dependent_visa set  name='$_POST[depname]', 
						passportnum='$_POST[passnum]', father_name='$_POST[depfname]', relation='$_POST[relation]', fromdate='$_POST[fromdatedep]',
						dependentamount='$_POST[dependentamount]', back='$_POST[acceptback]', visa_type='$_POST[visatype]', visaprice='$_POST[visaprice]', limitdays='$_POST[limitdays]', 
						iranaddress='$_POST[oiraddress]', afghanistanadd='$_POST[oafghanistanadd]', birthdate='$_POST[obdate]', birthplace='$_POST[obplace]'
						, marital_status='$_POST[omarital_status]', education='$_POST[oeducation]', passissuedate='$_POST[opassissuedate]', passissueplace='$_POST[opassissueplace]', 
						attachtype='$_POST[orequesttype]', visaorder='$_POST[ovisaorder]', centernum='$_POST[ocenternum]', centerdate='$_POST[ocenterdate]', arjaeet='$_POST[oarjaeet]', visanum='$_POST[ovisanum]', visadate='$_POST[ovisaissuedate]',
						details='$_POST[depdetails]', requestdate='$_POST[requestdate]'  where id='$_GET[editid]'";
						mysql_query($sqlupdate) or die(mysql_error());
						//Inserting dependants
						for($i=0; $i<sizeof($_POST['depdepname']);$i++){
							if($_POST['depdepname'][$i]!="" ){
								$sq="insert into  dependent_visa_dependants (name, family, father_name, birthdate, relation, education, job, parent_id) 
								values ('".$_POST['depdepname'][$i]."', '".$_POST['deplastname'][$i]."', '".$_POST['depfather'][$i]."', '".$_POST['depbirthdate'][$i]."'
								, '".$_POST['deprelation'][$i]."', '".$_POST['depeducation'][$i]."', '".$_POST['depjob'][$i]."', '$rwother[id]')";
								mysql_query($sq) or die (mysql_error());
							}
						
						}
					   if($_GET['type']==1){
							header("location:company_apps.php?ecode=$viewid#tabs-3");
						}else if($_GET['type']==2){
							header("location:transport_apps.php?ecode=$viewid#tabs-3");
						}
						die();
			
			
			}
			if(isset($_GET['delid'])){
				$sqdel="delete from  dependent_visa_dependants where id='$_GET[delid]'";
				mysql_query($sqdel) or die (mysql_error());
				header("location:company_apps_others_edit.php?editid=$_GET[editid]&type=$_GET[type]&ecode=$_GET[ecode]");
				die();
			}
		?>
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
