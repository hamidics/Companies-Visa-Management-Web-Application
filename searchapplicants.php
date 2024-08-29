<?php
include("template_header.php");
?>
<script language="javascript" type='text/javascript'>
function searchtypemethod(stype)
{
var divid='stypediv';

	if (stype=='')
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
			 
				xmlhttp.open('GET','archive_getmosquesajax.php?searchtype='+stype,true);
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
		<div id="content_main" class="clearfix">
		<div align="right" dir="rtl">
		<form method="post" action="searchapplicants.php" accept-charset="utf-8" id="myform"  class="formular">
			<fieldset>
				<legend align="right"><span >جستجوی افراد</span></legend>
				</br>
				نام شخص:<input type='text' name='appname' size='15' />
				نام پدر:<input type='text' name='appfname' size='15' />
				شغل شخص:<input type='text' name='job' size='15' />
				<input type="submit"   name="search2" value="جستجو"/>
				<h3 class="ico_mug"></h3>
				<div id="tabledata" class="section">
				<table width="100%" id="table" >
				<?php
					
						 if(isset($_POST['search2'])){
							if($_POST['appname']==""){
								$_POST['appname']="%";
							}
							if($_POST['appfname']==""){
								$_POST['appfname']="%";
							}
							if($_POST['passport']==""){
								$_POST['passport']="%";
							}
							if($_POST['job']==""){
								$_POST['job']="%";
							}
	
							$sql="select  *from vapplicants where name LIKE '%$_POST[appname]%' and father_name LIKE '%$_POST[appfname]%' and work_field LIKE '%$_POST[job]%'  
							  ";
							
							$res=mysql_query($sql) or die(mysql_error());
							echo "
							<tr>
							<th>نام</th>
							<th>نام پدر</th>
							<th>نام خانوادگی</th>
							<th>زمینه فعالیت</th>
							<th>مرجع </th>
							<th>نمایش مشخصات</th>
							
							</tr>
							";
							
							echo "<tr style='background-color:blue; '><td colspan='6' align='center'  ><a href='newapplicant.php' style='color:white; font-size:15px'><b>ثبت جدید</b></a></td></tr>";
							
							
							while($row=mysql_fetch_array($res)){
								//echo "hi";
								$sq="select name, type, code from sources where code='$row[source_id]'";
								$rs=mysql_query($sq) or die(mysql_error());
								$rw=mysql_fetch_array($rs);
								
								$responsibility=$row['work_field']; 
									
								
								if(  $row['source_id']!="" and $row['source_id']!=null ){
									$sourcename=$rw['name'];
								}else{
									$sourcename="متفرقه";
								}
								echo "<tr align='center'>
								
								<td style='vertical-align:middle'>$row[name]</td>
								<td style='vertical-align:middle'>$row[father_name]</td>
								<td style='vertical-align:middle'>$row[family]</td>
								<td style='vertical-align:middle'>$responsibility</td>
								<td style='vertical-align:middle'>$sourcename</td>
								";
								if($rw['type']=="2" && ($row['type']="boss" || $row['responsibility']=="vicep")){
								echo"
								<td style='vertical-align:middle'><a href='company_apps.php?ecode=$rw[code]&type=$rw[type]' style='color:blue'>نمایش شرکت مربوطه</a></td>
								";
								} else if($rw['type']=="1" && ($row['responsibility']="boss" || $row['responsibility']=="vicep")){
								echo"
								<td style='vertical-align:middle'><a href='company_apps.php?ecode=$rw[code]&type=$rw[type]' style='color:blue'>نمایش اتحادیه مربوطه</a></td>
								";
								}else if($rw['type']=="3"  && ($row['responsibility']=="boss" || $row['responsibility']=="vicep")){
								echo"
								<td style='vertical-align:middle'><a href='company_apps.php?ecode=$rw[code]&type=$rw[type]' style='color:blue'>نمایش شرکت ترانسپورتی مربوطه</a></td>
								";
								}else{
								
								echo"
								<td style='vertical-align:middle'><a href='viewapplicants.php?applicant_id=$row[id]&type=$rw[type]' style='color:blue'>نمایش عملکرد متقاضی</a></td>
								";
								
								

							
							}echo "</tr>";
						}
						}
						//else{
						//	echo "<b style='font-size:20px; color:red; align:center'>جستجو ناموفق بود! دوباره سعی نمایید!</b>";
						//}
				
				?>
				</table>
				</div>
			 </div>
 		</fieldset>
			
		</form>
		</div>
		
</div><!-- end container -->
	   <?php
	   include ("template_footer.php");
	   ?>
</body>
</html>
