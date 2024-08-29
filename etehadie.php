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
			 
				xmlhttp.open('GET','etehadie_editajax.php?code='+code,true);
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
		<form action="etehadie.php" method="post" accept-charset="utf-8" id="myform"  class="formular">
			<fieldset>
				<legend align="right"><span >مدیریت اتحادیه ها</span></legend>

				<a href="#" id="addlink" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه کردن اتحادیه جدید</b></a>
				<a href="#" id="addlinkback" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه کردن اتحادیه جدید</b></a>
				<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
				<hr align="right"style=" width:150px"/>
				</br>

				</br>
				<div id="addlinkdata">
				<?php
			//Getting the code number for the new product
				$q="select code from sources where type='4' order by code desc LIMIT 1";
				$res=mysql_query($q) or die(mysql_error());
				$r=mysql_fetch_array($res);
				if($r){
					$last_code_num=$r['code'];
					$last_code_num++;
					$code=$last_code_num;
				}else{
					$code="E-0000001";
				}
				?>
				<table width="70%" >
				<tr >
					<th height="30px" width="20%">کد</th>
					<th>نام اتحادیه</th>
					<th>مسئول اتحادیه </th>
				</tr>
				<tr>
					<td align="center"><?php echo $code;?></td>
					<td >
						<input type="text" id="name" class="validate[required] text-input" size="28" name="name"/>
					</td>
					<td >
						<input type="text" id="responsible" class="validate[required] text-input" name="responsible"/>
					</td>
					
					<td>
						<input type="submit" class="submit"  name="insertnew" value="ذخیره کردن" id="linkdatabutton"/>
						<input type="button" onclick="window.open ('etehadie.php','_parent')" name="cancel" value="انصراف" id="linkdatabutton1"/>
					</td>
				</tr>
				<?php
				    if(isset($_POST['insertnew'])){
					    $sql="Insert into  sources(code, name, responsible, type) values('$code', '$_POST[name]', '$_POST[responsible]', '4')";
				        mysql_query($sql) or die(mysql_error());
				        header("location: etehadie.php");
						die();
					}
				?>
				</table>
				<br/><br/>
				</div>
				
				جستجوی متنی اتحایه ها:
				<input type="text" id="searchdata"  name="searchdata"/>
				<input type="submit" class="submit"  name="searchmosque" value="نمایش اتحادیه" />
				</br>
				<?php 
					
						$searchval=$_POST['searchdata'];
						if($searchval==""){
							$searchval="%";
						}
					
				
				?>
				<br />
				<table width="100%" id="table">
					<tr align="center">
						<th>کد اتحادیه</th>
						<th>نام اتحادیه</th>
						<th>مسئول مرکز</th>
						<th>نمایش عملکرد</th>
						<th>عملیات</th>
					</tr>
				<?php
					$sql="select * from sources where name LIKE '%$searchval%' and type='4'";
					$res=mysql_query($sql) or die(mysql_error());
					while($row=mysql_fetch_array($res)){
					echo "<tr align='center'>
					<td>$row[code]</td>
					<td>$row[name]</td>
					<td>$row[responsible]</td>
					<td><a style='color:blue' href='etehadie_applicants.php?ecode=$row[code]'>نمایش افراد معرفی شده</a>
					<td>
					";
					$sq="select count(id) from vapplicants where source_id='$row[code]'";
					$rs=mysql_query($sq) or die (mysql_error());
					$rw=mysql_fetch_array($rs);
					if($rw['count(id)']==0){
					echo"<a href='etehadie.php?delid=$row[code]' class='confirm'><img src='img/cancel.png'/></a>";
					}else{
					echo"<img src='img/cancel1.png'/>";
					}
					echo "
					<img src='img/edit.png' style='cursor:pointer' onclick='editetehadie(\"$row[code]\")' /></td>
					</tr>
					<tr> <td colspan='5' id='edit".$row['code']."' align='center'></td></tr>";
					}
				
				
				?>
				</table>
				<br />
			    </div>
				<?php
				if(isset($_POST['acceptedit'])){
				$sql="update sources set name='$_POST[name]', responsible='$_POST[mresponsible]' where code='$_POST[etehadieid]'";
				mysql_query($sql) or die (mysql_error());
				header("location:etehadie.php");
				die();
				}
				if(isset($_GET['delid'])){
				$sq="delete from sources where code='$_GET[delid]'";
				mysql_query($sq) or die (mysql_query($sq));
				header("location:etehadie.php");
				die();
				}

				?>
 		</fieldset>
			
		</form>
		</div>
		
</div><!-- end container -->
<?php
include("template_footer.php");
?>
</body>
</html>
