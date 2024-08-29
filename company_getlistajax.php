<?php
require_once("../library/db.php");
?>
<html>
<head>
<meta http-equiv='Content-Language' content='fa'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head>
<table width="100%" id="table">
<tr align="center">
						<th>شماره رکورد</th>
						<th>شماره ثبت</th>
						<th>نام مرکز</th>
						<th>زمینه فعالیت</th>
						<th>شماره تماس</th>
						<th>آدرس</th>
						<th>نمایش عملکرد</th>
						<th>عملیات</th>
					</tr>
				<?php
					$centertype=$_GET['ctype'];
					$sql="select * from sources where (id LIKE '$searchval' or name LIKE '%$searchval%') and code LIKE '%$searchval2%' and (type LIKE '$centertype' and type!='1' || etehadietype='ثبتی')  $limit order by id desc";
					$res=mysql_query($sql) or die(mysql_error());
					while($row=mysql_fetch_array($res)){
					$parentname="";
					
					echo "<tr align='center'>
					<td>$row[id]</td>
					<td>$row[code]</td>
					<td>$row[name]  </td>
					<td>$row[activity_background]</td>
					<td>$row[phonenum]</td>
					<td>$row[address]</td>";
					$link="";
					//if($row['type']==1 && $row['etehadietype']=="عادی"){
					//	$link="etehadie_apps.php";
					if($row['type']==1 && $row['etehadietype']=="ثبتی"){
						$link="company_apps.php";
					}else if ($row['type']==2){
					$link="company_apps.php";
					}else if($row['type']==3){
					$link="transport_apps.php";
					}
					echo "
					<td><a style='color:blue' href='$link?ecode=$row[id]'>نمایش اعضا و عملکرد شرکت</a>
					<td>
					";
					$sq="select count(id) from vapplicants where source_id='$row[id]'";
					$rs=mysql_query($sq) or die (mysql_error());
					$rw=mysql_fetch_array($rs);
					$sq="select count(id) from driver_profiles where source_id='$row[id]'";
					$rs=mysql_query($sq) or die (mysql_error());
					$rw1=mysql_fetch_array($rs);
					if($rw['count(id)']==0 and $rw1['count(id)']==0 ){
					echo"<a href='companies.php?delid=$row[id]' class='confirm'><img src='img/cancel.png'/></a>";
					}else{
					echo"<img src='img/cancel1.png'/>";
					}
					echo "
					<img src='img/edit.png' style='cursor:pointer' onclick='editetehadie(\"$row[id]\")' /></td>
					</tr>
					<tr> <td colspan='8' id='edit".$row['id']."' align='center'></td></tr>";
					}
				
				
				?>

				</table>
</html>