<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>

<table width="57%" >
<?php
if($_GET['apptype']=="etehadie" || $_GET['apptype']=="noetehadie"){
?>
<tr align="right">
							<td width="35%"> مرجع معرفی کننده:</td>
							<td>
							<select name="referencename" id="referencename" >
							<?php
								if($_GET['apptype']=="etehadie"){
								$sql="select code, name from sources where type='1'";
								}else if($_GET['apptype']=="noetehadie"){
								$sql="select code, name from sources where type='4'";
								}
								$rs=mysql_query($sql) or die (mysql_error());
								while($rw=mysql_fetch_array($rs)){
									echo "<option value='$rw[code]'>$rw[name]</option>";
								}
							
							?>
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
<tr align="right">
							<td> نام شرکت:</td>
							<td><input type="text" size="30" name="coname"  id="coname" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نوع فعالیت:</td>
							<td>
							<input type="text" size="30" name="worktype" class="validate[required]" id="worktype" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نوع فعالیت در ایران:</td>
							<td>
							<input type="text" size="30" name="activityiran" class="validate[required]" id="activityiran" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره تماس:</td>
							<td><input type="text" size="30" name="app_phone" class="validate[required]" id="app_phone" /></td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>
						
					<?php
					
					}
					if($_GET['apptype']=="driver"){
					?>
					<tr align="right">
							<td> شرکت ترانسپورتی مربوطه:</td>
							<td>
							<select name="referencename" id="referencename" >
							<?php
								$sql="select code, name from sources where type='3'";
								$rs=mysql_query($sql) or die (mysql_error());
								while($rw=mysql_fetch_array($rs)){
									echo "<option value='$rw[code]'>$rw[name]</option>";
								}
							
							?>
							</select>
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> عکس درخواست کننده:</td>
							<td><input type="file" size="30" name="app_photo"  id="app_photo" /></td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> شماره گذرنامه:</td>
							<td>
							<input type="text" size="30" name="passnum" class="validate[required]" id="passnum" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> محل صدور:</td>
							<td>
							<input type="text" size="30" name="issueplace" class="validate[required]" id="issueplace" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ صدور:</td>
							<td><input type="text" size="30" name="issuedate" class="validate[required]" id="issuedate" /></td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> تاریخ ختم اعتبار:</td>
							<td><input type="text" size="30" name="remaineddate" class="validate[required]" id="remaineddate" /></td>
						</tr>
						
						<tr><td colspan='2'><br/></td></tr>
					<?php
					}
					if($_GET['apptype']=="other"){
					?>
					
						<tr align="right">
							<td width="35%"> شماره گذرنامه:</td>
							<td>
							<input type="text" size="30" name="passnum" class="validate[required]" id="passnum" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>
						<tr align="right">
							<td> نوع فعالیت:</td>
							<td>
							<input type="text" size="30" name="worktype" class="validate[required]" id="worktype" />
							</td>
						</tr>
						<tr><td colspan='2'><br/></td></tr>

					<?php
					}
					?>

</table>

</html>
