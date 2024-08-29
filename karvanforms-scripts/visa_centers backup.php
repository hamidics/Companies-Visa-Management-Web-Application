<?php
include("template_header.php");
?>
<script>
function editcenter(centerid)
{
var divid='edit'+centerid;
	if (centerid=='')
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
			 
				xmlhttp.open('GET','visa_center_editajax.php?cid='+centerid,true);
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
		<form action="visa_centers.php" method="post" accept-charset="utf-8" id="myform"  class="formular">
			<fieldset>
				<legend align="right"><span >مدیریت مراکز معرفی کننده ویزای انفرادی</span></legend>

				<a href="#" id="addlink" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه کردن مرکز جدید</b></a>
				<a href="#" id="addlinkback" onclick="jQuery('#myform').validationEngine('hide')"><b>اضافه کردن مرکز جدید</b></a>
				<input type="button" style=" width:20px; background-color:white; border:0;background-image:url(img/back.png)" /></br>
				<hr align="right"style=" width:150px"/>
				</br>

				</br>
				<div id="addlinkdata">
				<?php
			//Getting the code number for the new product
				$q="select code from visa_centers  order by id desc LIMIT 1";
				$res=mysql_query($q) or die(mysql_error());
				$r=mysql_fetch_array($res);
				if($r){
					$last_code_num=$r['code'];
					$last_code_num++;
					$code=$last_code_num;
				}else{
					$code="CV-000001";
				}
				?>
				<table width="100%" >
				<tr >
					<th height="30px" width="10%">کد</th>
					<th>نام مرکز</th>
					<th>مسئول مرکز </th>
					<th>شماره تماس</th>
					<th>آدرس مرکز</th>
					<th></th>
				</tr>
				<tr>
					<td align="center"><?php echo $code;?></td>
					<td >
						<input type="text" id="name" class="validate[required] text-input" size="24" name="name"/>
					</td>
					<td >
						<input type="text" id="responsible" class="validate[required] text-input" name="responsible"/>
					</td>
					<td >
						<input type="text" id="phone" class="validate[required] text-input" size="14" name="phone"/>
					</td>
					<td >
						<input type="text" id="address" class="validate[required] text-input" size="28" name="address"/>
					</td>
					<td>
						<input type="submit" class="submit"  name="insertnew" value="ذخیره کردن" id="linkdatabutton"/>
						<input type="button" onclick="window.open ('visa_centers.php','_parent')" name="cancel" value="انصراف" id="linkdatabutton1"/>
					</td>
				</tr>
				<?php
				    if(isset($_POST['insertnew'])){
					    $sql="Insert into  visa_centers(code, name, address, responsible, phone) values('$code', '$_POST[name]', '$_POST[address]', '$_POST[responsible]', '$_POST[phone]')";
				        mysql_query($sql) or die(mysql_error());
				        header("location: visa_centers.php");
					
					}
				?>
				</table>
				</div>
				جستجوی متنی مراکز ویزا:
				<input type="text" id="searchdata"  name="searchdata"/>
				<input type="submit" class="submit"  name="searchcenter" value="نمایش مرکز" />
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
						<th>کد مرکز</th>
						<th>نام مرکز</th>
						<th>آدرس مرکز</th>
						<th>شماره تماس</th>
						<th>مسئول مرکز</th>
						<th>تعداد معرفی شده</th>
						<th>عملیات</th>
					</tr>
				<?php
					$sql="select * from visa_centers where name LIKE '%$searchval%'";
					$res=mysql_query($sql) or die(mysql_error());
					while($row=mysql_fetch_array($res)){
					echo "<tr align='center'>
					<td>$row[code]</td>
					<td>$row[name]</td>
					<td>$row[address]</td>
					<td>$row[phone]</td>
					<td>$row[responsible]</td>
					";
					$sq="select count(id) from visa_applicants where visa_center_id='$row[id]'";
					$rs=mysql_query($sq) or die (mysql_error());
					$rw=mysql_fetch_array($rs);
					echo "<td>".$rw['count(id)']."</td>
					";
					if($rw['count(id)']==0){
					echo"<td><a href='visa_centers_view.php?viewid=$row[id]'><img src='img/folder.png' /></a><a href='visa_centers.php?delid=$row[id]' class='confirm'><img src='img/cancel.png'/></a>";
					}else{
					echo"<td><a href='visa_centers_view.php?viewid=$row[id]'><img src='img/folder.png' /></a>
					<img src='img/cancel1.png'/>";
					}
					echo "
					<img src='img/edit.png' style='cursor:pointer' onclick='editcenter(\"$row[id]\")' />
					</td>
					</tr>
					<tr> <td colspan='7' id='edit".$row['id']."' align='center'></td></tr>";
					}
				
				
				?>
				</table>
				<br />
			    </div>
				<?php
				if(isset($_POST['acceptedit'])){
				$sql="update visa_centers set name='$_POST[name]', address='$_POST[maddress]', phone='$_POST[nphone]', responsible='$_POST[mresponsible]' where id='$_POST[centerid]'";
				mysql_query($sql) or die (mysql_error());
				header("location:visa_centers.php");
				die();
				}
				if(isset($_GET['delid'])){
				$sq="delete from visa_centers where id='$_GET[delid]'";
				mysql_query($sq) or die (mysql_query($sq));
				header("location:visa_centers.php");
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
