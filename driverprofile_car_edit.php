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
			<a href="otherprofile.php?appid=<?php echo $_GET['editid'];?>">صفحه قبل</a>
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<?php 
		$sql="select * from cars where id='$_GET[editid]'";
		$rs=mysql_query($sql) or die (mysql_error());
		$rw=mysql_fetch_array($rs);
		echo "<form action='driverprofile_car_edit.php?editid=$_GET[editid]&profileid=$_GET[profileid]' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
			<fieldset>
			<table width="70%">
			
				<tr align="right">
							<td width="20%"> نوع خودرو:</td>
							<td align="right" >
							<select name="cartype" id="cartype" class="validate[required]">
								<option value="" >انتخاب نوع خودرو</option>
								<option value="سواری" <?php if($rw['type']=="سواری")echo "selected";?>>سواری</option>
								<option value="کامیون" <?php if($rw['type']=="کامیون")echo "selected";?> >کامیون</option>
								<option value="اتوبوس" <?php if($rw['type']=="اتوبوس")echo "selected";?> >اتوبوس</option>
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> مدل:</td>
							<td><input type="text" size="30" name="model" value="<?php echo $rw['model'];?>"  id="model" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> پلاک:</td>
							<td><input type="text" size="30" name="plaque" value="<?php echo $rw['plaque'];?>" id="plaque" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره شاسی:</td>
							
							<td><input type="text" size="30" name="shasy" value="<?php echo $rw['shasynum'];?>" id="shasy" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره انجین:</td>
							
							<td><input type="text" size="30" name="engine" value="<?php echo $rw['enginenum'];?>" id="engine" /></td>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> حجم بار یا تعداد سرنشین:</td>
							<td><input type="text" size="30" name="storage"  value="<?php echo $rw['storage'];?>" id="storage" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>						
						<tr align="right">
							<td> مسیر تردد (مبدأ-مقصد):</td>
							<td>
								<input type="text" size="30" name="way"  value="<?php echo $rw['way'];?>" id="way" />
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
						
						
						$sqlupdate="update cars set type='$_POST[cartype]', model='$_POST[model]', 
						plaque='$_POST[plaque]', shasynum='$_POST[shasy]', enginenum='$_POST[engine]', storage='$_POST[storage]', way='$_POST[way]'  where id='$rw[id]'";
						mysql_query($sqlupdate) or die(mysql_error());
						
						
						
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
