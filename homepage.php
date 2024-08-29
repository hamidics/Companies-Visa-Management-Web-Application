<?php
session_start();
include("template_header.php");
include("logout.php");

  
	if (isset($_GET['logout'])) {
	    logout();
    }
?>
<script>
function insertmessage()
{
message=document.getElementById('message').value;
//document.write(message);
//var len = (int) (document.getElementById('useramounts').value);
var userlist="";
    for (var i=1; i<=5; i++) {
        //document.getElementById('chosenusers'+i).value;
		userlist+=(document.getElementById('chosenusers'+i).value)+'...';
    }
	document.write(userlist);
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
				xmlhttp.open('GET','insertmessage.php?message='+message+"&users="+userlist,true);
				xmlhttp.send();
				
				
}


</script>
<script>

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
			<div id="main_panel_container" class="left">
			
			
			<?php 
			    $user_id = $_SESSION['user_id'];
				$sql="Select * from users where id ='$user_id'";
	            $res=mysql_query($sql) or die(mysql_error()."hi");
	            $row=mysql_fetch_array($res);
				$companies = $row['companies'];
			    $report = $row['report'];
				$others = $row['others'];
				$newothers = $row['newothers'];
				$users = $row['users'];				
				
			?>
			
			<div id="shortcuts" class="clearfix" align="right" dir="rtl" style="margin-top:0px">
			<h2 class="sidebar">جستجو</h2>
					<form method="post" action="homepage.php" accept-charset="utf-8" id="myform"  class="formular">
			<?php if(isset($_POST['search2'])!=1){
				?>
			<fieldset>
				<legend align="right"><span >افراد و شرکت ها</span></legend>
				</br>
				<table><tr><th>شماره ثبت شرکت</th><th>نام شرکت</th><th>نام شخص</th><th>نام پدر</th><th>زمینه فعالیت</th><th>پاسپورت</th><th></th></tr>
				<tr><td><input type='text' name='regnum' size='9' /></td>
				<td><input type='text' name='coname1' size='8' /></td>
				<td><input type='text' name='appname' size='8' /></td>
				<td><input type='text' name='appfname' size='7' /></td>
				<td><input type='text' name='job' size='6' /></td>
				<td><input type='text' name='passport' size='6' /></td>
				<td><input type="submit"   name="search1" value="جستجو"/><input type="submit"   name="cancel" value="بازگشت"/></td>
				</tr>
				</table>
				<h3 class="ico_mug"></h3>
				</fieldset>
				<?php 
				}if(isset($_POST['search1'])!=1){
				?>
				<fieldset>
				<legend align="right"><span >راننده ها</span></legend>
				<table><tr><th>نام شرکت ترانسپورتی</th><th>شماره فایل</th><th>نام </th><th>ولد</th><th></th></tr>
				<tr><td>
				<select name="coname" id="coname" >
					<option value="%">انتخاب نام شرکت </option>
					<?php
						$sql="select id, code, name from sources where type='3' order by name asc";
						$rs=mysql_query($sql) or die (mysql_error());
						while($rwco=mysql_fetch_array($rs)){
							echo "<option value='$rwco[id]'>$rwco[name]</option>";
						}
					?>
				</select>
				</td>
				<td><input type='text' name='profilenum' size='10' /></td>
				<td><input type='text' name='dname' size='10' /></td>
				<td><input type='text' name='dfname' size='10' /></td>
				<td><input type="submit"   name="search2" value="جستجو"/><input type="submit"   name="cancel" value="بازگشت"/></td>
				</tr>
				</table>
				</fieldset>
				<?php
				}
				?>
				<div id="tabledata" class="section">
				<table width="100%" id="table" >
				<?php
					$conditionchoose="";
						 if(isset($_POST['search1'])){
							if($_POST['appname']==""){
								$_POST['appname']="%";
							}
							if($_POST['appfname']==""){
								$_POST['appfname']="%";
							}
							if($_POST['coname1']==""){
								$_POST['coname1']="%";
								
							}
							if($_POST['job']==""){
								$_POST['job']="%";
							}
							if($_POST['passport']==""){
								$_POST['passport']="%";
							}
							if($_POST['regnum']==""){
								$_POST['regnum']="%";
							}
							if(($_POST['regnum']!="" && $_POST['regnum']!="%") || ($_POST['coname1']!="" &&  $_POST['coname1']!="%" )){
								
								$tablechoose=", sources";
								$conditionchoose="and vapplicants.source_id=sources.id and sources.code LIKE '%$_POST[regnum]%' and sources.name LIKE '%$_POST[coname1]%'";
							}
							$sql="select  *, vapplicants.name as vname from vapplicants $tablechoose where vapplicants.name LIKE '%$_POST[appname]%'  and father_name LIKE '%$_POST[appfname]%' and work_field LIKE '%$_POST[job]%'  
							 and vapplicants.type!='driver'   $conditionchoose  and (passportnum LIKE '%$_POST[passport]%' or vapplicants.id in (select applicant_id from visa_history where passportnum LIKE '%$_POST[passport]%' and applicant_id=vapplicants.id))";
							$res=mysql_query($sql) or die(mysql_error());
							echo "
							<tr>
							<th>نام</th>
							<th>نام پدر</th>
							<th>نام خانوادگی</th>
							<th>زمینه فعالیت</th>
							<th>معرفی کننده</th>
							<th>نمایش مشخصات</th>
							
							</tr>
							";
							
							//echo "<tr style='background-color:blue; '><td colspan='5' align='center'  ><a href='newapplicant.php' style='color:white; font-size:15px'><b>ثبت جدید</b></a></td></tr>";
							
							
							while($row=mysql_fetch_array($res)){
								$color="";
								//echo "hi";
								$sq="select id, name, type, code from sources where id='$row[source_id]'";
								$rs=mysql_query($sq) or die(mysql_error());
								$rw=mysql_fetch_array($rs);
								
								$responsibility=$row['work_field']; 
									
								if($rw['type']=="2"){
								$sourcename=$rw['name']."(".$rw['code'].")";
								}else{
								$sourcename=$rw['name'];
								}
								
								if($row['type']=="other"){
									$sourcename="متفرقه(".$row['introduced_by'].")" ;
								}
								//Getting the status of company
								if($row['type']!="other"){
								$sq="select status from blacklist where source_id='$rw[id]'";
								}else{
								$sq="select status from blacklist where applicant_id='$row[id]'";
								}
								
								$rsstatus=mysql_query($sq) or die (mysql_error());
								$rwstatus=mysql_fetch_array($rsstatus);
								if($rwstatus['status']==0 and $rwstatus['status']!=""){
								$color="style='background-color:red'";
								}
								echo "<tr align='center' $color>
								
								<td style='vertical-align:middle'>$row[vname]</td>
								<td style='vertical-align:middle'>$row[father_name]</td>
								<td style='vertical-align:middle'>$row[family]</td>
								<td style='vertical-align:middle'>$responsibility</td>
								<td style='vertical-align:middle'>$sourcename</td>
								";
								if($rw['type']=="2" ){
								$tab="";
								if($row['responsibility']=="boss" || $row['responsibility']=="vicep"){
									$tab="#tabs-1";
								}
								if($row['responsibility']=="oldboss" || $row['responsibility']=="oldvicep"){
									$tab="#tabs-5";
								}else{
									$tab="tabs-3";
								}
								
								echo"
								<td style='vertical-align:middle'><a href='company_apps.php?ecode=$rw[id]&type=$rw[type]$tab' style='color:blue'>$sourcename</a></td>
								";
								
								}
								if($rw['type']=="1" ){
								echo"
								<td style='vertical-align:middle'><a href='otherprofile.php?appid=$row[id]' style='color:blue'> $sourcename</a></td>
								";
								}
								
								 if($rw['type']=='3'){
								 $tab="";
								if($row['responsibility']=="oldboss" || $row['responsibility']=="oldvicep"){
									$tab="#tabs-6";
								}else 
								if($row['responsibility']=="boss" || $row['responsibility']=="vicep"){
									$tab="#tabs-1";
								}else{
									$tab="#tabs-3";
								}
								echo"
								<td style='vertical-align:middle'><a href='transport_apps.php?ecode=$rw[id]' style='color:blue'>$sourcename</a></td>
								";
								
								}
								if($row['type']=="other") {
								echo"
								<td style='vertical-align:middle'><a href='otherprofile.php?appid=$row[id]' style='color:blue'>$sourcename </a></td>
								";

							} echo "</tr>";
						}
						if($_POST['job']=="%" and $_POST['fname']=="%"){
						$sql="select * from dependent_visa where name LIKE '$_POST[appname]'  and father_name LIKE '$_POST[appfname]' ";
						$res=mysql_query($sql) or die(mysql_error());
														
							
							
							while($row=mysql_fetch_array($res)){
								//echo "hi";
								$color="";
								$sq="select id, name, type, code from sources where code='$row[source_id]'";
								$rs=mysql_query($sq) or die(mysql_error());
								$rw=mysql_fetch_array($rs);
								
								$responsibility=$row['work_field']; 
									
								
									$sourcename=$rw['name'];
								if($row['type']=="other"){
									$sourcename="متفرقه(".$row['introduced_by'].")" ;
								}
								//Getting the status of company
								$sq="select status from blacklist where source_id='$rw[id]'";
								$rsstatus=mysql_query($sq) or die (mysql_error());
								$rwstatus=mysql_fetch_array($rsstatus);
								if($rwstatus['status']==0){
								$color="style='background-color:red'";
								}
								echo "<tr align='center' $color>
								
								<td style='vertical-align:middle'>$row[name]</td>
								<td style='vertical-align:middle'>$row[father_name]</td>
								<td style='vertical-align:middle'></td>
								<td style='vertical-align:middle'></td>
								<td style='vertical-align:middle'>$sourcename</td>
								";
								if($rw['type']=="2" ){
								echo"
								<td style='vertical-align:middle'><a href='company_apps.php?ecode=$rw[id]#tabs-3' style='color:blue'>$sourcename</a></td>
								";
								
								}
								
								else if($rw['type']=='3' ){
								echo"
								<td style='vertical-align:middle'><a href='transport_apps.php?ecode=$rw[id]#tabs-3' style='color:blue'>$sourcename</a></td>
								";
								
								}				
								

							
							}echo "</tr>";
						}
						}
						
						//else{
						//	echo "<b style='font-size:20px; color:red; align:center'>جستجو ناموفق بود! دوباره سعی نمایید!</b>";
						//}
				
				?>
				<?php
					
						 if(isset($_POST['search2'])){
							
							if($_POST['profilenum']==""){
								$_POST['profilenum']="%";
							}
							if($_POST['dname']==""){
								$_POST['dname']="%";
							}
							if($_POST['dfname']==""){
								$_POST['dfname']="%";
							}
							$sql="select  vapplicants.name, vapplicants.father_name, vapplicants.source_id, vapplicants.position, vapplicants.profile_num, driver_profiles.profile_num as pfnum from vapplicants, driver_profiles where name LIKE '%$_POST[dname]%' and father_name LIKE '%$_POST[dfname]%' and vapplicants.profile_num=driver_profiles.id and driver_profiles.profile_num LIKE '$_POST[profilenum]' and vapplicants.source_id LIKE '$_POST[coname]' and type='driver' order by driver_profiles.profile_num asc  ";
							
							
							$res=mysql_query($sql) or die(mysql_error());
							echo "
							<tr>
							<th>نام</th>
							<th>نام پدر</th>
							<th>سمت یا وظیفه</th>
							<th>شرکت مربوطه</th>
							<th>شماره پروفایل</th>
							<th>نمایش پروفایل</th>
							
							</tr>
							";
							
							
							
							while($row=mysql_fetch_array($res)){
								//echo "hi";
								$sq="select name, type, code from sources where id='$row[source_id]'";
								$rs=mysql_query($sq) or die(mysql_error());
								$rw=mysql_fetch_array($rs);
					
									$sourcename=$rw['name'];
								
								//Getting the status of company
								$sq="select status from blacklist where source_id='$rw[id]'";
								$rsstatus=mysql_query($sq) or die (mysql_error());
								$rwstatus=mysql_fetch_array($rsstatus);
								if($rwstatus['status']==0){
								$color="style='background-color:red'";
								}
								
								echo "<tr align='center' $source>
								
								<td style='vertical-align:middle'>$row[name]</td>
								<td style='vertical-align:middle'>$row[father_name]</td>
								<td style='vertical-align:middle'>$row[position]</td>
								<td style='vertical-align:middle'>$rw[name]</td>
								<td style='vertical-align:middle'>$row[pfnum]</td>
								";
								$tab="";
								if($row['responsibility']=="olddriver"){
									$tab="#tabs-4";
								}
								echo"
								<td style='vertical-align:middle'><a href='driverprofile.php?pid=$row[profile_num]$tab' style='color:blue'>$sourcename</a></td>
								";
								
								

							
							}echo "</tr>";
						}
						
						
				
				?>
				</table>
				</div>
			
			</div>
			</div>
				<div id="sidebar" class="right">
				<h2 class="sidebar" align="center">بخش ها</h2>
			<ul id="menu" dir="rtl" align="right" style="font-family: B Titr; font-size:18px">
				<li>
				<?php
				  
					if($companies == "1"){
					    echo"<a href='companies.php' class='side_content' >شرکت های تجاری و ثبتی</a>";
						echo"<a href='companies.php#tabs-2' class='side_content' >اتحادیه ها</a>";
					}
					
					if($newothers == "1"){
					    echo"<a href='newapplicant.php' class='side_content' >متفرقه جدید</a>";
					}
					
					if($others == "1"){
					    echo"<a href='others.php' class='side_content' >متقاضیان متفرقه</a>";
					}
                 
                    if($users == "1"){				 
					    echo"<a href='users.php' class='side_content' >مدیریت کاربران</a>";
					}
					
					if($report == "1"){
					    echo"<a href='imports.php' class='side_content' >گزارش دهی</a>";
						echo"<a href='blacklist.php' class='side_content' >لیست سیاه</a>";
					}
					
					?>
            </div>
			</div>
	    </div><!-- end #content -->
	    
	   <div id='counter' style="position:fixed;top:100px;right:5px;z-index:1000;width:190px;height:282px; background-image:url(img/loggedusers.png)" dir="rtl" align="center"> 
	   <br/>ارسال پیام به:<br/>
	   <table>
	   
	   <?php 
		$sql="select id, name from users LIMIT 5";
		$res=mysql_query($sql) or die (mysql_error());
		$i=1;
		while($rouser=mysql_fetch_array($res)){
			$idnum="";
			$idnum="chosenusers".$i;
			echo "<tr><td>$rouser[name] </td><td><input type='checkbox' id='$idnum' value='$rouser[id]' name='chosenusers[]' /></td></tr>";
			$i++;
			//echo $idnum;
		}
		echo "<input type='hidden' id='useramounts' value='$i'/>";
	   ?>
	   </table>
	   <hr/>
	   <b>پیام های دریافت شده: </b>
	   <hr/>
	   <?php
   //require_once("../library/RScounter/RSreader.php");
   ?>
  
  </div> <div id='counter' dir="rtl" style="position:fixed;top:380px;right:5px;z-index:1000;width:190px;height:110px; background-image:url(img/messagebox.png)" align="center"> 
	<br/><b>ارسال پیام:</b><img src="img/newmessage.png" width="20px" height="20px"/>
	<textarea cols="18" id="message" name="message" rows="3">
	
	</textarea><br/>
	<img src="img/sendmail.png" onclick="insertmessage()"  width="40px" height="35px"/>
 <?php
   //require_once("../library/RScounter/RSreader.php");
   ?>
  </div>
   
  <?php
	   include ("template_footer.php");
	   ?>
</div><!-- end container -->

</body>
</html>
