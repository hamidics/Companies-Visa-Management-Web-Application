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
function editetehadieb(code)
{
var divid='edite'+code;
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
			 
				xmlhttp.open('GET','company_editajax.php?coid='+code+'&etehadie=1',true);
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
function getcompanies(centertype)
{
var divid='gettransportsdiv';
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
			 
				xmlhttp.open('GET','companies_gettransportsajax.php?cotype='+centertype,true);
				xmlhttp.send();
				
				
}

function editetehadie2(code)
{
var divid='editetehadie'+code;
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
			 
				xmlhttp.open('GET','company_etehadie_editajax.php?coid='+code,true);
				xmlhttp.send();
				
				
}

function getcompanylist(centertype)
{
var divid='companylist';
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
			 
				xmlhttp.open('GET','company_getlistajax.php?ctype='+centertype,true);
				xmlhttp.send();
				
				
}
function checkname(comcode)
{
var divid='checkconamediv';
	if (comcode=='')
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
			 
				xmlhttp.open('GET','company_checknameajax.php?comcode='+comcode,true);
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
		<form action="companies.php" method="post" accept-charset="utf-8" id="myform"  class="formular"  enctype="multipart/form-data" >
			<fieldset>
				<legend align="right"><span >مدیریت مراکز ثبتی</span></legend>
				<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>

					<li><a href="#tabs-1">شرکت های تجاری و ثبتی</a></li>
					<li><a href="#tabs-2">اتحادیه ها</a></li>
				</ul>
				<div id="tabs-1">
				<a href="#" id="addlink" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن مرکز ثبتی جدید</b></a>
				<a href="#" id="addlinkback" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه نمودن مرکز ثبتی جدید</b></a>
				<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
				<hr align="right"style=" width:150px"/>
				<span id="checkconamediv"></span>
				<div id="addlinkdata">
				
						<select name="centertype" id="centertype" class="validate[required]" style="width:140px; height:30px" onchange="gettype(this.value)" >
							<option value="">انتخاب نوع مرکز</option>
							<option value="1">اتحادیه</option>
							<option value="2">شرکت تجاری و ثبتی </option>
							<option value="3">شرکت ترانسپورتی</option>
							<option value="4">پروفایل راننده ها</option>
						</select>
				<span id="gettypediv"></span>
				
				<?php
				    if(isset($_POST['insertnew'])){
						if($_POST['centertype']!=4){
					    $sql="Insert into  sources(code, name, activity_background, type, address, phonenum) values('$_POST[registernum]', '$_POST[name]', '$_POST[work_field]', '$_POST[centertype]',  '$_POST[newaddress]', '$_POST[newphone]')";
						
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
							mkdir("source-attachments/$sqrw[id]");
							header("location: transport_apps.php?ecode=$sqrw[id]");
						
						}if($_POST['centertype']==2){
							$sqgetid="select id from sources order by id desc LIMIT 1";
							$sqres=mysql_query($sqgetid)or die(mysql_error());
							$sqrw=mysql_fetch_array($sqres);
							mkdir("source-attachments/$sqrw[id]");
							header("location: company_apps.php?ecode=$sqrw[id]");
						
						}if($_POST['centertype']==1){
							$sqgetid="select id, etehadietype from sources order by id desc LIMIT 1";
							$sqres=mysql_query($sqgetid)or die(mysql_error());
							$sqrw=mysql_fetch_array($sqres);
							if($sqrw['etehadietype']=="ثبتی"){
							header("location: company_apps.php?ecode=$sqrw[id]");
							}else{
							mkdir("source-attachments/$sqrw[id]");
							$filename=$_FILES['javaz']['name'];
							 $file_ext = substr($filename, strripos($filename, '.'));
							 $sql="insert into attachments (company_code, description, format) values ('$sqrw[id]', 'جواز', '$file_ext')";
							mysql_query($sql) or die (mysql_error());
							$sqgetid="select id from attachments where company_code='$sqrw[id]' order by id desc LIMIT 1";
							$rsgetid=mysql_query($sqgetid) or die (mysql_error());
							$rwgetid=mysql_fetch_array($rsgetid);
							
							//$filename=$_FILES['attach']['name'][$j];
							// $file_ext = substr($filename, strripos($filename, '.'));

							  $newfilename =$rwgetid['id'].$file_ext;
							  $destination = "source-attachments/$sqrw[id]/".$newfilename;
							  $temp_file = $_FILES['javaz']['tmp_name'];
							  move_uploaded_file($temp_file,$destination);
							header("location: etehadie_apps.php?ecode=$sqrw[id]");
							}
							die();

							}
						
						die();
					}
				?>
				
				<br/><hr/><br/><br/>
				</div>
				
				جستجوی مراکز:
						<select name="centertypes" id="centertypes"  style="width:140px; height:30px" onchange="getcompanylist(this.value)" >
							<option value="">انتخاب نوع مرکز</option>
							<option value="1">اتحادیه</option>
							<option value="2">شرکت تجاری </option>
							<option value="3">شرکت ترانسپورتی</option>
						</select>
				<span id="gettransportsdiv" >نام شرکت یا صنف: <input type="text" id="searchdata1"  name="searchdata1"/></span>
				شماره ثبت: <input type="text" id="searchdata2"  name="searchdata2"/>
				<input type="submit" class="submit"  name="searchmosque" value="نمایش مرکز" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:130px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" />
				</br>
				<?php 
						if(isset($_POST['searchmosque'])){
							$limit="order by name asc  ";
						}else{
							$limit=" order by id desc ";
						}
						$searchval=$_POST['searchdata1'];
						if($searchval=="" || $searchval=="%"){
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
				<div id="companylist">
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
					$sql="select * from sources where (id LIKE '$searchval' or name LIKE '%$searchval%') and code LIKE '%$searchval2%' and (type LIKE '$centertype' and type!='1' || etehadietype='ثبتی')  $limit ";
					$res=mysql_query($sql) or die(mysql_error());
					while($row=mysql_fetch_array($res)){
					$parentname="";
					$parenttype="";
					
						$parenttype=$row['etehadietype'];
					
					echo "<tr align='center'>
					<td>$row[id]</td>
					<td>$row[code]</td>
					<td>$row[name]  </td>
					<td>$row[activity_background]</td>
					<td>$row[phonenum]</td>
					<td>$row[address]</td>";
					$link="";
					if($row['type']==1 && $parenttype=="عادی"){
						$link="etehadie_apps.php";
					}else if($row['type']==1 && $parenttype=="ثبتی"){
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
				</div>
				<?php
					if(isset($_POST['acceptedit'])){
					$sq="Update sources  set name='$_POST[editname]', code='$_POST[editcode]', activity_background='$_POST[editjob]', address='$_POST[editaddress]', phonenum='$_POST[editphone]' where id='$_POST[companyid]'";
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
				</div>
				<div id="tabs-2">
				
				جستجوی مراکز:
						
				<span id="gettransportsdiv" >نام اتحادیه: <input type="text" id="searchdata3"  name="searchdata3"/></span>
				<input type="submit" class="submit"  name="searchmosque2" value="نمایش مرکز" style="border-top-left-radius: 10px ;border-top-right-radius: 10px ; border-bottom-left-radius: 10px ;border-bottom-right-radius: 10px ; cursor:pointer;color:white;  background-color:#5e6062; border:0;height:30px; width:130px;"  onmouseover="this.style.background='#252527'" onmouseout="this.style.background='#5e6062'" />
				</br>
				<?php 
						if(isset($_POST['searchmosque2'])){
							$limit="order by name asc  ";
						}else{
							$limit=" order by id desc ";
						}
						$searchval=$_POST['searchdata3'];
						if($searchval=="" || $searchval=="%"){
							$searchval="%";
						}
						
					
				
				?>
				<br />
				<div id="companylist">
				<table width="100%" id="table">
					<tr align="center">
						<th>شماره رکورد</th>
						<th>نام اتحادیه</th>
						<th>شماره تماس</th>
						<th>نام رئیس</th>
						<th>آدرس</th>
						<th>نمایش عملکرد</th>
						<th>عملیات</th>
					</tr>
				<?php
					$sql="select * from sources where ( name LIKE '%$searchval%')  and type LIKE '1' and etehadietype!='ثبتی' order by id desc";
					$res=mysql_query($sql) or die(mysql_error());
					while($row=mysql_fetch_array($res)){
					
					echo "<tr align='center'>
					<td>$row[id]</td>
					<td>$row[name]  </td>
					<td>$row[phonenum]</td>
					<td>$row[bossname]</td>
					<td>$row[address]</td>";
						$link="etehadie_apps.php";
					echo "
					<td><a style='color:blue' href='$link?ecode=$row[id]'>نمایش اعضا و عملکرد اتحادیه</a>
					<td>
					";
					$sq="select count(id) from vapplicants where source_id='$row[id]'";
					$rs=mysql_query($sq) or die (mysql_error());
					$rw=mysql_fetch_array($rs);
					
					if($rw['count(id)']==0  ){
					echo"<a href='companies.php?delid2=$row[id]' class='confirm'><img src='img/cancel.png'/></a>";
					}else{
					echo"<img src='img/cancel1.png'/>";
					}
					echo "
					<img src='img/edit.png' style='cursor:pointer' onclick='editetehadieb(\"$row[id]\")' /></td>
					</tr>
					<tr> <td colspan='7' id='edite".$row['id']."' align='center'></td></tr>";
					}
				
				
				?>
				</table>
				</div>
				<br />
			    </div>
				<?php
					if(isset($_POST['acceptedit2'])){
					$sq="Update sources  set name='$_POST[editname]', code='$_POST[editcode]', bossname='$_POST[editboss]', address='$_POST[editaddress]', phonenum='$_POST[editphone]' where id='$_POST[companyid]'";
					mysql_query($sq) or die (mysql_query($sq));
					header("location:companies.php#tabs-2");
					die();
				}
				
				if(isset($_GET['delid2'])){
				$sq="delete from sources where id='$_GET[delid2]'";
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
