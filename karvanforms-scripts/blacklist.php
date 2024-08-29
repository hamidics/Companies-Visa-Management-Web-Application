<?php
include("template_header.php");
?>
<script>
function editapplicant(appid)
{
var divid='edit'+appid;
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
			 
				xmlhttp.open('GET','blacklist_editajax.php?applicantid='+appid,true);
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
		<form method="post" action="blacklist.php" accept-charset="utf-8" id="myform"  class="formular">
			<fieldset>
				<legend align="right"><span >سوابق ویزا</span></legend>
				</br>
						<a href="#" id="addlink" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه کردن جدید</b></a>
						<a href="#" id="addlinkback" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه کردن جدید</b></a>
						<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
						

						</br>
						<div id="addlinkdata">
						تاریخ:</br>
						<input type="text" name="created_at" id="created_at"  class="validate[required]" />
						<input type="button" style="background-color:white; border:0; background-image:url(img/cal.png); width:24px;height:24px " onclick="displayDatePicker('created_at', this);"/></br></br>
						نام: </br><input type="text" name="appname" id="appname" class="validate[required]"/>
						</br></br>
						شماره پاسپورت: </br><input type="text" name="apppass" id="apppass" class="validate[required]"/></br></br>
						توضیحات:</br><textarea type="text" name="appdetails" cols="20" rows="6" id="appdetails" class="validate[required]"></textarea>
			
						
						</br></br>
						<input type="submit" class="submit"  id="insertapp" name="insertapp" value="ذخیره" id="linkdatabutton"/>
						<input type="button" id="cancel_cash" onclick="window.open ('blacklist.php','_parent')" name="cancel" value="انصراف"/></br></br></br>
					</div>
					<?php
						if(isset($_POST['insertapp'])){
							$sql="Insert into blacklist (created_at, name, passport_no, details) values ('$_POST[created_at]', '$_POST[appname]', '$_POST[apppass]', '$_POST[appdetails]')";
							mysql_query($sql) or die (mysql_error());
							header("location:blacklist.php");
							die();
						}
					?>
				
				نوع جستجو :
				<select name="search_type" id="search_type" >
					<option value="%">انتخاب</option>
					<option value="name">نام</option>
					<option value="passport_num">شماره گذر نامه</option>
					<option value="all">همه لیست</option>
				</select>
				<input type="text" id="search_data" name="search_data"  size='30'/>
				<input type="submit" class="submit"  name="search" value="جستجو"/>
				<h3 class="ico_mug"></h3>
				<div id="tabledata" class="section">
				<table width="90%" id="table" >
				<tr>
				<th style="width:5%">شماره</th>
				<th>تاریخ </th>
				<th>نام متقاضی</th>
				<th>شماره گذرنامه</th>
				<th>توضیحات</th>
				<?php
				$usertype=$_SESSION['user_type'];
					if($usertype=="admin"){
				?>
				<th>عملیات</th>
				<?php
				}
				?>
				</tr>
				<?php
				    if(isset($_POST['search'])){
					    $number = 0;

					    if($_POST['search_type'] == "name"){
						
						   $sql="Select * from blacklist where name LIKE '%".$_POST['search_data']."%' order by id desc";
						}
						
						else if($_POST['search_type'] == "passport_num"){
						   $sql="Select * from blacklist where passport_no LIKE '%".$_POST['search_data']."%' order by id desc";
					}else{
						$sql="Select * from blacklist order by id desc";
					}
					$res=mysql_query($sql) or die(mysql_error());
				           while($row=mysql_fetch_array($res)){
						      $number++;
						      $id = $row['id'];
					          $first_name = $row['name'];
					          $passport_num = $row['passport_no'];
						      $created_at = $row['created_at'];
							  $details=$row['details'];
							   echo"<tr>
						      <td class='table_date'  align='center'>$number</td>
						      <td class='table_date'  align='center'>$created_at</td>
						      <td class='table_date'  align='center'>$first_name </td>
						      <td class='table_date'  align='center'>$passport_num </td>
							  <td class='table_date'  align='center'>$details </td>
						      ";
							  if($usertype=="admin"){
							  echo "
							  <td class='table_date'  align='center' >
							  <a href='blacklist.php?accept_id=$passport_num'><img src='img/accept.png' width='15px' height='15px'/></a>
							  <img src='img/edit.png' style='cursor:pointer' onclick='editapplicant(\"$id\")'  width='15px' height='15px'/>
						      </td>";
							  }
							  echo "</tr>";
							  echo "<tr><td colspan='6' id='edit$id'></td></tr>";
						    }	
					}else{
						   $sql="Select * from blacklist order by id desc";
				          $res=mysql_query($sql) or die(mysql_error());
				           while($row=mysql_fetch_array($res)){
						      $number++;
						      $id = $row['id'];
					          $first_name = $row['name'];
					          $passport_num = $row['passport_no'];
						      $created_at = $row['created_at'];
							  $details=$row['details'];
							   echo"<tr>
						      <td class='table_date'  align='center'>$number</td>
						      <td class='table_date'  align='center'>$created_at</td>
						      <td class='table_date'  align='center'>$first_name </td>
						      <td class='table_date'  align='center'>$passport_num </td>
							  <td class='table_date'  align='center'>$details </td>
						      ";
							  if($usertype=="admin"){
							  echo "
							  <td class='table_date'  align='center' >
							  <a href='blacklist.php?accept_id=$passport_num'><img src='img/accept.png' width='15px' height='15'/></a>
							  <img src='img/edit.png' style='cursor:pointer' onclick='editapplicant(\"$id\")'  width='15px' height='15px'/>
						      </td>
							  ";
							  }
							  echo "</tr>";
							   echo "<tr><td colspan='6' id='edit$id'></td></tr>";
						    }	
					}
				
				?>
				</table>
				</div>
			 </div>
			<?php
			if(isset($_POST['acceptedit'])){
			$sql="Update blacklist set name='$_POST[appname]', passport_no='$_POST[apppass]', created_at='$_POST[cdate]', details='$_POST[appdetails]' where id='$_POST[app_id]'";
			$res=mysql_query($sql) or die (mysql_error());
			header("location:blacklist.php");
			die();
			}
			?>
 		</fieldset>
			
		</form>
		<?php

		if(isset($_GET['accept_id'])){
			$sql="Delete from blacklist where passport_no='$_GET[accept_id]'";
			mysql_query($sql) or die(mysql_error());
			header("location:blacklist.php");
			die();
		}

		?>
		</div>
		
</div><!-- end container -->
	   <?php
	   
	   include ("template_footer.php");
	   ?>
</body>
</html>
