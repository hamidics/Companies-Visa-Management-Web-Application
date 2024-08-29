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
				<legend align="right"><span dir="rtl">لیست متقاضیان متفرقه</span></legend>
			
				
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
				$sqcount="select count(id) from vapplicants where type='other'";
				$rscount=mysql_query($sqcount) or die (mysql_error());
				$rwcount=mysql_fetch_array($rscount);
				$amount=$rwcount['count(id)'];
				$sql="select * from vapplicants where type='other' order by id desc ";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
					$sourcename="";
						$sourcename=$row['introduced_by'];
					
					echo "
					<tr align='center'>
					<td>$amount</td>
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
					
					echo "<td><a style='color:blue' href='otherprofile.php?appid=$row[id]'>نمایش پروفایل</a>
					</td></tr>
					";
					$i++;
					$amount--;
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
