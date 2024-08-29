<?php
include("template_header.php");
?>
<script language="javascript" type='text/javascript'>
function addapplicantaddres(appid,karvanid)
{
var divid='address'+appid;

	if (appid=='')
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
			 
				xmlhttp.open('GET','karvan_applicants_addressajax.php?applicantid='+appid+'&karvanid='+karvanid+'&type=1',true);
				xmlhttp.send();
				
				
}
function viewapplicantaddres(appid,karvanid)
{
var divid='address'+appid;

	if (appid=='')
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
			 
				xmlhttp.open('GET','karvan_applicants_addressajax.php?applicantid='+appid+'&karvanid='+karvanid+'&type=2',true);
				xmlhttp.send();
				
				
}
</script>

	    <div id="content" >
	    <div id="top_menu" class="clearfix">
		<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			<li class="current">
				<a href="homepage.php">صفحه اصلی</a><!-- First level MENU -->
			</li>
		</ul>
					</div>
		<div id="content_main" class="clearfix" >
		<div align="right" dir="rtl">
		<form action="reports.php" method="post" accept-charset="utf-8" id="myform"  class="formular" enctype="multipart/form-data" >
			<fieldset>
				<legend align="right"><span dir="rtl">بخش گزارش دهی سیستم مدیریت</span></legend>
			<div id="tabs" align="right">
				<ul>
					<li><a href="#tabs-1"> گزارش کلی کاروانها</a></li>					
				</ul>
				<div id="tabs-1">
				تهیه لیست کلی کاروانها از تاریخ:<input type="text" name="karvandate1" id="karvandate1"  class="validate[required]" size="25"/>
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('karvandate1', this);"/>
				تا:<input type="text" name="karvandate2" id="karvandate2"  class="validate[required]" size="25"/>
				<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('karvandate2', this);"/>
				<input type="submit" name="providereport" id="providereport" value="تهیه گزارش" class="submit"/>
				<br />
				
				<?php
					if(isset($_POST['providereport'])){
					echo "<center></br><a href='report_complete.php?date_1=$_POST[karvandate1]&date_2=$_POST[karvandate2]' style='align:center;font-size:24px;color:blue'  >چاپ نمودن گزارش </a></center>";
					echo "</br></br><h3 class='ico_mug'>لیست کلی کاروانها از تاریخ $_POST[karvandate1] تا تاریخ $_POST[karvandate2]</h3></br>
					<table width='100%' id='table'>
					<tr>
					<th>ردیف</th>
					<th>نام مرکز</th>
					<th>سرپرست کاروان</th>
					<th>شماره اعزام</th>
					<th>تاریخ صدور فرم</th>
					<th>تعداد افراد کاروان</th>
					<th>وضعیت</th>
					<th>کد</th>
					</tr>";
					$date1=$_POST['karvandate1'];
					
					$date2=$_POST['karvandate2'];
					$sql="select id,recipe_date,status,code,mosque_id,border,send_number from karvan where  recipe_date between '$date1' and '$date2' order by id asc";
					$res=mysql_query($sql) or die(mysql_error());
					$i=1;
					while($row=mysql_fetch_array($res)){
						$sql="select name from mosques where id='$row[mosque_id]'";
						$res1=mysql_query($sql) or die(mysql_error());
						$row1=mysql_fetch_array($res1);
						$sql2="select applicant_id,count(id) from  karvan_applicants_getinfo where karvan_id='$row[id]'";
						$res2=mysql_query($sql2) or die(mysql_error());
						$row2=mysql_fetch_array($res2);
						
						$sql3="select name from applicants where id='$row2[applicant_id]' and  applicant_type ='سرپرست'";
						$res3=mysql_query($sql3) or die(mysql_error());
						$row3=mysql_fetch_array($res3);
						
						echo "<tr align='center'>
							<td>$i</td>
							<td>$row1[name]</td>
							<td>$row3[name]</td>
							<td>$row[send_number]</td>
							<td>$row[recipe_date]</td>
							<td>".$row2['count(id)']."</td>";
						if($row['recipe_date']!='0000-00-00' && $row['border']!='0000-00-00'){
							echo "<td style='background:green;color:white;'>اعزام شد</td>";
						}else if($row['recipe_date']!='0000-00-00' && $row['border']=='0000-00-00'){
							echo "<td style='background:red;color:white;'>در حال طی مراحل</td>";
						}
						echo"<td>$row[code]</td>";
						echo "</tr>";
					
					$i++;
					}
					}
				?>
				</table>
			    </div>
				 </div>

 		</fieldset>
			
		</form>
		</div>
		
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
