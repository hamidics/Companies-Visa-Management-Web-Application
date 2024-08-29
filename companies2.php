<?php
include("template_header.php");
?>
<script>
function editetehadie(code)
{
var divid='edit'+code;
	if (code=='')
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
			 
				xmlhttp.open('GET','company_editajax.php?coid='+code,true);
				xmlhttp.send();
				
				
}

function gettype(centertype)
{
var divid='gettypediv';
	if (centertype=='')
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
			 
				xmlhttp.open('GET','company_gettypeajax.php?cotype='+centertype,true);
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
		<form action="companies2.php" method="post" accept-charset="utf-8" id="myform"  class="formular">
			<fieldset>
				<legend align="right"><span >مدیریت مراکز ثبتی</span></legend>
				<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>

					<li><a href="#tabs-1">معرفی مراکز</a></li>
					<li><a href="#tabs-2">معرفی اتحادیه ها</a></li>
				</ul>
				<div id="tabs-1">
				<a href="#" id="addlink" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن مرکز ثبتی جدید</b></a>
				<a href="#" id="addlinkback" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن مرکز ثبتی جدید</b></a>
				<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
				<hr align="right"style=" width:150px"/>
				
				<div id="addlinkdata">
				
						<select name="centertype" id="centertype" class="validate[required]" style="width:140px; height:30px" onchange="gettype(this.value)" >
							<option value="">انتخاب نوع مرکز</option>
							<option value="2">شرکت تجاری </option>
							<option value="3">شرکت ترانسپورتی</option>
							<option value="4">پروفایل راننده ها</option>
						</select>
				<span id="gettypediv"></span>
				
				<?php
				    if(isset($_POST['insertnew'])){
						if($_POST['centertype']!=4){
					    $sql="Insert into  sources(code, name, activity_background, type, parent_id) values('$_POST[registernum]', '$_POST[name]', '$_POST[work_field]', '$_POST[centertype]', '$_POST[parentname]')";
						}else{
						$sql="insert into driver_profiles (profile_num, source_id, created_at) values ('$_POST[profilenum]', '$_POST[transportco]', '$_POST[create_date]')";
						}
						mysql_query($sql) or die(mysql_error());
						if($_POST['centertype']==4){
							$sqgetid="select id from driver_profiles order by id desc LIMIT 1";
							$sqres=mysql_query($sqgetid)or die(mysql_error());
							$sqrw=mysql_fetch_array($sqres);
							
							header("location: driverprofile.php?pid=$sqrw[id]");
							die();
						}else if($_POST['centertype']==3){
							$sqgetid="select id from sources order by id desc LIMIT 1";
							$sqres=mysql_query($sqgetid)or die(mysql_error());
							$sqrw=mysql_fetch_array($sqres);
							
							header("location: transport_apps.php?ecode=$sqrw[id]");
						
						}if($_POST['centertype']==1){
							$sqgetid="select id from sources order by id desc LIMIT 1";
							$sqres=mysql_query($sqgetid)or die(mysql_error());
							$sqrw=mysql_fetch_array($sqres);
							
							header("location: etehadie_apps.php?ecode=$sqrw[id]");

							}
						die();
					}
				?>
				
				<br/><hr/><br/><br/>
				</div>
				
				جستجوی مراکز:
						<select name="centertypes" id="centertypes"  style="width:140px; height:30px" onchange="gettype(this.value)" >
							<option value="">انتخاب نوع مرکز</option>
							<option value="2">شرکت تجاری </option>
							<option value="3">شرکت ترانسپورتی</option>
						</select>
				نام شرکت: <input type="text" id="searchdata1"  name="searchdata1"/>
				شماره ثبت: <input type="text" id="searchdata2"  name="searchdata2"/>
				<input type="submit" class="submit"  name="searchmosque" value="نمایش مرکز" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:130px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" />
				</br>
				<?php 
						if(isset($_POST['searchmosque'])){
							$limit="order by name asc  ";
						}else{
							$limit=" order by id desc LIMIT 5";
						}
						$searchval=$_POST['searchdata1'];
						if($searchval==""){
							$searchval="%";
						}
						$searchval2=$_POST['searchdata2'];
						if($searchval2==""){
							$searchval2="%";
						}
						$centertype=$_POST['centertypes'];
						if($centertype==""){
							$centertype="%";
						}
					
				
				?>
				<br />
				<table width="100%" id="table">
					<tr align="center">
						<th>شماره ثبت</th>
						<th>نام مرکز</th>
						<th>زمینه فعالیت</th>
						<th>نمایش عملکرد</th>
						<th>عملیات</th>
					</tr>
				<?php
					$sql="select * from sources where name LIKE '%$searchval%' and code LIKE '%$searchval2%' and type LIKE '$centertype' and type!='1'  $limit";
					$res=mysql_query($sql) or die(mysql_error());
					while($row=mysql_fetch_array($res)){
					$parentname="";
					
					echo "<tr align='center'>
					<td>$row[code]</td>
					<td>$row[name] </td>
					<td>$row[activity_background]</td>";
					$link="";
					 if ($row['type']==2){
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
					<tr> <td colspan='5' id='edit".$row['id']."' align='center'></td></tr>";
					}
				
				
				?>
				</table>
				<br />
			    </div>
				<?php
					if(isset($_POST['acceptedit'])){
					$sq="Update sources  set name='$_POST[editname]', code='$_POST[editcode]', activity_background='$_POST[editjob]' where id='$_POST[companyid]'";
					mysql_query($sq) or die (mysql_query($sq));
					header("location:companies.php#tabs-1");
					die();
				}
				
				if(isset($_GET['delid'])){
				$sq="delete from sources where id='$_GET[delid]'";
				mysql_query($sq) or die (mysql_query($sq));
				header("location:companies.php");
				die();
				}

				?>
				
				<div id="tabs-2">
				<a href="#" id="addlink_tab2" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن اتحادیه جدید</b></a>
				<a href="#" id="addlinkback_tab2" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن اتحادیه جدید</b></a>
				<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
				<hr align="right"style=" width:150px"/>
				
				<div id="addlinkdata_tab2">
					نام اتحادیه: <input type="text" name="etehadiename" id="etehadiename" class="validate[required]"/>
					<input type="submit" class="submit"  name="insertetehadie" value="ذخیره کردن" id="linkdatabutton3" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:80px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'"/>
						<input type="button" onclick="window.open ('companies.php#tabs-2','_parent')" name="cancel" value="انصراف" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:80px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" id="linkdatabutton2"/>
					
						
				<span id="gettypediv"></span>
				
				<?php
				    if(isset($_POST['insertetehadie'])){
					    $sql="Insert into  sources(name, type) values('$_POST[etehadiename]', '1')";
				        mysql_query($sql) or die(mysql_error());
						$sq="select id from sources order by id desc LIMIT 1";
						$res=mysql_query($sq) or die (mysql_error());
						$rwsid=mysql_fetch_array($res);
						
				        header("location: etehadie_apps.php?ecode=$rwsid[id]");
						die();
					}
				?>
				
				<br/><hr/><br/><br/>
				</div>
				<br />
				<table width="100%" id="table">
					<tr align="center">
						<th>شماره</th>
						<th>نام اتحادیه</th>
						<th>نمایش افراد معرفی شده</th>
						<th>عملیات</th>
					</tr>
				<?php
					$sql="select * from sources where type='1' order by id, name desc ";
					$res=mysql_query($sql) or die(mysql_error());
					$i=1;
					while($row=mysql_fetch_array($res)){
					echo "<tr align='center'>
					<td>$i</td>
					<td>$row[name]</td>
					<td><a href='etehadie_apps.php?ecode=$row[id]'>نمایش اعضای معرفی شده</a></td>
					<td>";
					$sq="select count(id) from sources where parent_id='$row[id]'";
					$rs=mysql_query($sq) or die (mysql_error());
					$rw=mysql_fetch_array($rs);
					if($rw['count(id)']==0){
					echo"<a href='companies.php?delparid=$row[id]#tabs-2' class='confirm'><img src='img/cancel.png'/></a>";
					}else{
					echo"<img src='img/cancel1.png'/>";
					}
					echo "
					<img src='img/edit.png' style='cursor:pointer'  /></td>
					</tr>
					<tr> <td colspan='4' id='edit".$row['id']."' align='center'></td></tr>";
					$i++;
					}
				?>
				</table>
				<?php
					if(isset($_GET['delparid'])){
					$sq="delete from sources where id='$_GET[delparid]'";
					mysql_query($sq) or die (mysql_query($sq));
					header("location:companies.php#tabs-2");
					die();
				}
				?>
				
				
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
