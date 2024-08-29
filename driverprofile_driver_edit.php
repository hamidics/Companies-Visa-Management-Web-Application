<?php
include("template_header.php");
require_once("../library/image_resize.php");

?>


	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="homepage.php">صفحه اصلی</a>
				<!-- First level MENU -->
			</li>
			<li>
			<a href="driverpdofile.php?pid=<?php echo $_GET['profileid'];?>">صفحه قبل</a>
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php 
		$sql="select * from vapplicants where id='$_GET[editid]'";
		$rs=mysql_query($sql) or die (mysql_error());
		$rw=mysql_fetch_array($rs);
		echo "<form action='driverprofile_driver_edit.php?editid=$_GET[editid]&profileid=$_GET[profileid]' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
			<fieldset>
			<table width="70%">
						<tr align="right">
							<td> شماره گذرنامه:</td>
							
							<td><input type="text" size="30" name="dpass" value="<?php echo $rw['passportnum'];?>" class="validate[required]" id="dpass" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
				<tr align="right">
							<td> نام:</td>
							<td><input type="text" size="30" name="dname" value="<?php echo $rw['name'];?>" class="validate[required]" id="dname" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نام پدر:</td>
							<td><input type="text" size="30" name="dfather" class="validate[required]" value="<?php echo $rw['father_name'];?>" id="dfather" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تخلص:</td>
							<td><input type="text" size="30" name="dfamily" value="<?php echo $rw['father_name'];?>" id="dfamily" /></td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> سمت یا وظیفه:</td>
							<td>
							<select name="position" id="position" class="validate[required]">
								<option value="">انتخاب نوع راننده</option>
								<option value="راننده" <?php if($rw['position']=="راننده"){echo "selected";}?> >راننده</option>
								<option value="نماینده مرزی" <?php if($rw['position']=="نماینده مرزی"){echo "selected";}?> >نماینده مرزی</option>
							</select>
							</td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> محل صدور:</td>
							
							<td><input type="text" size="30" name="dissueplace" value="<?php echo $rw['issueplace'];?>" id="dissueplace" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور:</td>
							<td><input type="text" size="30" name="dissuedate" value="<?php echo $rw['issuedate'];?>"  id="dissuedate" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>						
						<tr align="right">
							<td> تاریخ ختم اعتبار:</td>
							<td>
								<input type="text" size="30" name="dvaliddate" value="<?php echo $rw['remaineddate'];?>"  id="dvaliddate" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> عکس راننده:</td>
							<td>
							<img src="appphotos/<?php echo $rw['id'].".jpg";?>"/>
							</td>
						</tr>
						<tr align="right">
							<td> عکس جدید:</td>
							<td><input type="file" size="30" name="app_photo"  id="app_photo" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						</table>
						
							<div >
							</div>
						
						<input type="submit" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره"/>
<a href="driverprofile.php?pid=<?php echo $_GET['profileid'];?>"><input type="button" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="انصراف"/></a>
			   
				
 		</fieldset>
			
		</form>
		</div>
		<?php
			if(isset($_POST['updateapplicant'])){
				
						$filename=$_FILES['app_photo']['name'];
						 $file_ext = substr($filename, strripos($filename, '.'));
												 
							$phone=$_POST['app_phone'];
							$file_ext=".jpg";		
						
						$sqlupdate="update vapplicants set name='$_POST[dname]', family='$_POST[dfamily]', 
						father_name='$_POST[dfather]', passportnum='$_POST[dpass]', issueplace='$_POST[dissueplace]', issuedate='$_POST[dissuedate]', remaineddate='$_POST[dvaliddate]', position='$_POST[position]'  where id='$rw[id]'";
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
						
					   header("location:driverprofile.php?pid=$_GET[profileid]#tabs-1");
					die();
			
			
			}
		?>
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
