<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<?php
$sq="select * from sources where code='$_GET[code]'";
$rs=mysql_query($sq) or die (mysql_error());
$rw=mysql_fetch_array($rs);

?>
</br>
<table  >
				<tr >
				<?php 
					if($_GET['cotype']=="2"){
				
				?>
					<th height="30px" style="width:120px" >شماره ثبت شرکت</th>
				<?php
					}
				?>
				<?php
					if($_GET['cotype']==4){
						echo "<th style='width:130px'>نام شرکت ترانسپورتی</th>";
					
						echo "<th style='width:130px'>شماره پروفایل راننده</th>";
					
						echo "<th style='width:250px'>تاریخ ایجاد</th>";
					}

				?>
				<?php
				
					if($_GET['cotype']==1 and $_GET['cotype']!=4){
				?>
					<th style="width:120px">نام اتحادیه</th>
					<th style="width:120px">نام رئیس </th>
					<th>جواز</th>
				
				<?php 
				}	if(($_GET['cotype']==2 || $_GET['cotype']==3) and $_GET['cotype']!=4){
				?>
					<th style="width:120px">نام شرکت</th>
				
				<?php 
				}
					if($_GET['cotype']==2 || $_GET['cotype']==3){
				?>
					<th style="width:120px">زمینه فعالیت </th>
				<?php
					}
				if($_GET['cotype']!=4){
				?>
				<th>شماره تماس</th>
				<th>آدرس</th>
				<?php
				}
				?>
				<th style="width:200px"></th>
				</tr>
				<tr align="center">
					<?php
						if($_GET['cotype']==4){
							echo "<td><select name='transportco' id='transportco' class='validate[required]'>
							<option value=''>انتخاب شرکت ترانسپورتی</option>";
							$sq="select id, name from sources where type='3'";
							$rs=mysql_query($sq) or die (mysql_error());
							while($rw=mysql_fetch_array($rs)){
								echo "<option value='$rw[id]'>$rw[name]</option>";
							}
							echo "</select></td>";
							echo "<td><input type='text' id='profilenum' class='validate[required] text-input' size='18' name='profilenum'/></td>";
							echo "<td><input type='text' name='create_date' id='create_date' class='validate[required,custom[date]]' style='width:200px' />
				<input type='button' style='background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px ' onclick='displayDatePicker(\"create_date\", this);'/>
				</td>";
						}
					?>
				
					<?php 
						if($_GET['cotype']==2){
					?>
					<td align="center">
					<input type="text" id="registernum" class="validate[checkDuplicateconame[companycode],required] text-input" onkeyup="checkname(this.value);" size="13" name="registernum"/></td>
					<?php
					}
					?>
					<?php
					
						if($_GET['cotype']!=4){
					?>
					<td >
						<input type="text" id="name" class="validate[required] text-input"  size="22" name="name"/>
					</td>
					<?php 
					}
						if($_GET['cotype']==1){
					?>
					<td >
						<input type="text" id="bossname" size="22" name="bossname"/>
					</td>
					<td >
						<input type="file" id="javaz"  style="width:100px" name="javaz"/>
					</td>
					<?php
						}
					
					
						if($_GET['cotype']==2 ){
					?>
					<td >
						<input type="text" id="work_field" value="" size="18" name="work_field"/>
					</td>
					<?php
						}
						
					?>
					<?php 
						if($_GET['cotype']==3 ){
					?>
					<td >
						<input type="text" id="work_field" class="validate[required] text-input" value="" size="18" name="work_field"/>
					</td>
					<?php
						}
						if($_GET['cotype']!=4){
					?>
					<td >
					<input type="text" id="newphone"  value="" size="8" name="newphone"/>
					</td>
					<td>
					<input type="text" id="newaddress"  value="" size="18" name="newaddress"/>
					</td>
					<?php
						}
					?>
					<td>
						<input type="submit" class="submit"  name="insertnew" value="ذخیره کردن" id="linkdatabutton" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:80px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'"/>
						<input type="button" onclick="window.open ('companies.php','_parent')" name="cancel" value="انصراف" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:80px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" id="linkdatabutton1"/>
					</td>
				</tr>
				</table>

</html>