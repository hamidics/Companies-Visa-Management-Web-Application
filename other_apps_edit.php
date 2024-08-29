<?php
include("template_header.php");

?>


	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="homepage.php">صفحه اصلی</a>
				<!-- First level MENU -->
			</li>
			<li>
			<a href="otherprofile.php?appid=<?php echo $_GET['editid'];?>">صفحه قبل</a>
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php 
		$sql="select * from vapplicants where id='$_GET[editid]'";
		$rs=mysql_query($sql) or die (mysql_error());
		$rw=mysql_fetch_array($rs);
		echo "<form action='other_apps_edit.php?editid=$_GET[editid]&source=$_GET[source]' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
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
							<select name="marital_status1" id="marital_status1" class="validate[required]">
								<option value="">انتخاب وضعیت تاهل</option>
								<option value="متاهل" <?php if($rw['marital_status']=="متاهل"){echo "selected";}?> >متاهل</option>
								<option value="مجرد" <?php if($rw['marital_status']=="مجرد"){echo "selected";}?> >مجرد</option>
							</select>
							</td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						
						<tr align="right">
							<td> شماره گذرنامه:</td>
							
							<td><input type="text" size="30" name="vpassnum" value="<?php echo $rw['passportnum'];?>" id="vpassnum" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> زمینه فعالیت:</td>
							
							<td><input type="text" size="30" name="work"  value="<?php echo $rw['work_field'];?>" id="work" /></td>
							</td>
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
							<td> آدرس محل کار در افغانستان:</td>
							
							<td><input type="text" size="70" name="address1" value="<?php echo $rw['address'];?>" id="address1" /></td>
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
						
						</table>
						
							<div >
							</div>
						
						<input type="submit" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="ذخیره"/>
<a href="otherprofile.php?appid=<?php echo $_GET['editid'];?>"><input type="button" class="submit"  name="updateapplicant"  style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:100px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" value="انصراف"/></a>
			   
				
 		</fieldset>
			
		</form>
		</div>
		<?php
			if(isset($_POST['updateapplicant'])){
				
							
						$sqlupdate="update vapplicants set name='$_POST[app_name]', family='$_POST[app_fname]', 
						father_name='$_POST[app_fathername]', passportnum='$_POST[vpassnum]', phone='$_POST[app_phone]',
						work_field='$_POST[work]', education='$_POST[education]', address_iran='$_POST[iraddress]', address_afghanistan='$_POST[afghanistanadd]',
						birthdate='$_POST[bdate]', birthplace='$_POST[bplace]', marital_status='$_POST[marital_status1]', address='$_POST[address1]' where  id='$_GET[editid]'";
						mysql_query($sqlupdate) or die(mysql_error());
						
					   	header("location:otherprofile.php?appid=$_GET[editid]#tabs-1");
						die();
			
			
			}
		?>
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
