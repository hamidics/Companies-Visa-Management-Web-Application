<?php
include("template_header.php");
require_once("../library/image_resize.php");
$viewid=$_GET['ecode'];

?>


	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="homepage.php">صفحه اصلی</a>
				<!-- First level MENU -->
			</li>
			 <?php 
 if($_GET['type']==1){
							$link="company_apps.php?ecode=$viewid#tabs-1";
						}else if($_GET['type']==2){
							$link="transport_apps.php?ecode=$viewid#tabs-1";
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
		$sql="select * from vapplicants where id='$_GET[editid]'";
		$rs=mysql_query($sql) or die (mysql_error());
		$rw=mysql_fetch_array($rs);
		echo "<form action='company_apps_edit.php?editid=$_GET[editid]&ecode=$_GET[ecode]&type=$_GET[type]' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
			<fieldset>
			<table width="70%">
						<tr align="right">
							<td width="20%"> نام:</td>
							<td align="right" ><input type="text" size="30" name="app_name" value="<?php echo $rw['name'];?>"  class="validate[required]" id="app_name" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نام پدر:</td>
							<td><input type="text" size="30" name="app_fathername" value="<?php echo $rw['father_name'];?>" class="validate[required]" id="app_fathername" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تخلص:</td>
							<td><input type="text" size="30" name="app_fname" value="<?php echo $rw['family'];?>" id="app_fname" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> وضعیت تاهل:</td>
							
							<td>
							<select name="marital_status" id="marital_status" >
								<option value="">انتخاب وضعیت تاهل</option>
								<option value="متاهل" <?php if($rw['marital_status']=="متاهل")echo "selected";?>>متاهل</option>
								<option value="مجرد" <?php if($rw['marital_status']=="مجرد")echo "selected";?>>مجرد</option>
							</select>
							</td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نام همسر:</td>
							
							<td><input type="text" size="30" name="wife" value="<?php echo $rw['wife'];?>" id="wife" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> میزان تحصیلات:</td>
							
							<td><input type="text" size="30" name="education" value="<?php echo $rw['education'];?>" id="education" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> نام فرزندان:</td>
							
							<td><input type="text" size="30" name="sons" value="<?php echo $rw['sons'];?>" id="sons" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره تماس:</td>
							<td><input type="text" size="30" name="app_phone" value="<?php echo $rw['phone'];?>"  id="app_phone" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>			
						<tr align="right">
							<td> آدرس افغانستان:</td>
							
							<td><input type="text" size="70" name="afghanistanadd"  id="afghanistanadd" value="<?php echo $rw['address_afghanistan'];?>" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>	
						<tr align="right">
							<td> آدرس ایران:</td>
							
							<td><input type="text" size="70" name="iraddress" value="<?php echo $rw['address_iran'];?>" id="iraddress" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ تولد:</td>
							
							<td><input type="text" size="30" name="bdate" value="<?php echo $rw['birthdate'];?>" id="bdate" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل تولد:</td>
							
							<td><input type="text" size="30" name="bplace" value="<?php echo $rw['birthplace'];?>" id="bplace" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>					
						<tr align="right">
							<td> عنوان متقاضی:</td>
							<td>
							<select name="app_position"  id="app_position"  style="width:182px">
							<option value="">عنوان متقاضی</option>
							<?php
								if($rw['responsibility']=="boss"){
									echo "<option value='boss' selected>رئیس</option>
									<option value='vicep' >معاون</option>";
								}else {
									echo "<option value='boss' >رئیس</option>
									<option value='vicep' selected>معاون</option>";
								}
							?>
							
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							
							<td colspan="2"> عکس کارمند:
							<img src="appphotos/<?php echo $rw['id'].".jpg"."?".time()."'";?>"/></td>
							
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
						<td>عکس جدید:</td>
						<td><input type="file" size="30" name="app_photo"  id="app_photo" /></td>
						</tr>
						</table>
						
							<div >
							</div>
						
						<input type="submit" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره"/>
 <?php 
 if($_GET['type']==1){
							$link="company_apps.php?ecode=$viewid#tabs-1";
						}else if($_GET['type']==2){
							$link="transport_apps.php?ecode=$viewid#tabs-1";
						}
					?>
						<a href="<?php echo $link;?>"><input type="button" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="انصراف"/></a>
			   			   
				
 		</fieldset>
			
		</form>
		</div>
		<?php
			if(isset($_POST['updateapplicant'])){
				 $filename=$_FILES['app_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
												 
							$phone=$_POST['app_phone'];
							$file_ext=".jpg";
							if($_POST['app_position']=="vicep" && $rw['responsibility']=="boss"){
								$newposition="vicep";

							}else if($_POST['app_position']=="boss" && $rw['responsibility']=="vicep"){
								$newposition="boss";
							}else{
								$newposition=$_POST['app_position'];
							}
							//Getting background id
							$sq="select activity_background from sources where id='$viewid'";
							$rsbackground=mysql_query($sq) or die (mysql_error());
							$rwbackground=mysql_fetch_array($rsbackground);
						$sqlupdate="update vapplicants set name='$_POST[app_name]', family='$_POST[app_fname]', 
						father_name='$_POST[app_fathername]', wife='$_POST[wife]', sons='$_POST[sons]', phone='$phone',
						responsibility='$newposition', work_field='$rwbackground', education='$_POST[education]', address_iran='$_POST[iraddress]', address_afghanistan='$_POST[afghanistanadd]',
						birthdate='$_POST[bdate]', birthplace='$_POST[bplace]', marital_status='$_POST[marital_status]' where id='$rw[id]'";
						mysql_query($sqlupdate) or die(mysql_error());
						
						  $newfilename =$rw['id'].$file_ext;
						  $destination = "appphotos/".$newfilename;
						  $temp_file = $_FILES['app_photo']['tmp_name'];
						  move_uploaded_file($temp_file,$destination);
							//Resizing Image
					   $image = new SimpleImage();
					   $image->load($destination);
					   $image->resize(75,90);

					   $image->save($destination);
					   if($_GET['type']==1){
							header("location:company_apps.php?ecode=$viewid#tabs-1");
						}else if($_GET['type']==2){
							header("location:transport_apps.php?ecode=$viewid#tabs-1");
						}
						die();
			
			
			}
		?>
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
