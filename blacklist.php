<?php
include("template_header.php");
require_once("../library/image_resize.php");
$viewid=$_GET['appid'];

?>


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
		<?php echo "<form action='otherprofile.php?appid=$viewid' method='post' accept-charset='utf-8' id='myform' class='formular' enctype='multipart/form-data' >";?>
		
			<fieldset>
				<legend align="right"><span dir="rtl">لیست متقاضیانی که بلک لیست شده اند.</span></legend>
			
				
				<table width="100%" id="table">
				<tr>
				<th>شماره</th>
				<th>نام </th>
				<th>نام پدر</th>
				<th>نام پدر</th>
				<th>شماره گذرنامه</th>
				<th>نوع فعالیت</th>
				<th>کارشناس</th>
				<th>مرجع معرفی</th>
				<th>نمایش پروفایل</th>
				</tr>
				<?php
				$i=1;
				//Counting all apps
				$sqlblack="select * from blacklist where status='0'";
				$rsblack=mysql_query($sqlblack) or die (mysql_error());
				$i=1;
				while($rwblack=mysql_fetch_array($rsblack)){
				$sql="select * from vapplicants where (id='$rwblack[applicant_id]' || source_id='$rwblack[source_id]')  order by id desc ";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					$sourcename="";
					if($rwblack['source_id']!="0"){
						//Getting the source name and id
						$sqlsource="select id, name, type from sources where id='$rwblack[source_id]'";
						$rssource=mysql_query($sqlsource);
						$rwsource=mysql_fetch_array($rssource);
						$type=$rwsource['type'];
					}else{
						$sourcename=$row['introduced_by'];
						$type="other";
					}
					$link="";
					if($type=="1"){
						$link="etehadie_apps.php?ecode=$rwblack[source_id]";
					}else if ($type=="2"){
						$link="company_apps.php?ecode=$rwblack[source_id]";
					}else if($type=="3"){
						$link="transport_apps.php?ecode=$rwblack[source_id]";
					}else{
						$link="otherprofile.php?appid=$row[id]";
					}
					echo "
					<tr align='center'>
					<td>$i</td>
					<td>$row[name]</td>
					<td> $row[father_name]</td>
					<td> $row[family]</td>
					<td>$row[passportnum]</td>
					<td> $row[work_field]</td>";
					$sql="select name from users where id='$row[supervisor]'";
					$rsuser=mysql_query($sql) or die (mysql_error());
					$rwuser=mysql_fetch_array($rsuser);
					
					echo "<td>$rwuser[name]</td>
					<td>$row[introduced_by]</td>
					";
					
					echo "<td><a style='color:blue' href='$link'>نمایش پروفایل</a>
					</td></tr>
					";
					$i++;
					
				}
				}
				?>
				
				</table>
			   
				
 		</fieldset>
			
		</form>
		</div>
		
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
