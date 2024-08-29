<?php
include("template_header.php");
?>
<script>

    function getkarvans(mosque_id){
        var divid="getkarvan";
        
     	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
 		 }
		else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
 		 }
			xmlhttp.onreadystatechange=function()
		 {
 			if (xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById(divid).innerHTML=xmlhttp.responseText;    }
			  }
			 
				xmlhttp.open('GET','kafil_report_getkarvans.php?mosque_id='+mosque_id,true);
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
		<?php
			$sql="select * from kafils where id='$_GET[kafilid]'";
			$res=mysql_query($sql) or die (mysql_error());
			$row=mysql_fetch_array($res);
		
		?>
		<div id="content_main" class="clearfix">
		<div align="right" dir="rtl">
			<fieldset>
				<legend align="right"><span >چاپ فرم های کفیل   ( نام کفیل:   <?php echo $row['name'];?>  | شهر : <?php if($row['city']==1){ echo "مشهد";}else if($row['city']==2){ echo "تهران";}else{ echo "دیگر شهرستانها"; } ?>)</span></legend>
		<form method="post" action="kafil_reports.php?kafilid=<?php echo $_GET['kafilid'];?>&city=<?php echo $row['city'];?>" accept-charset="utf-8" id="myform"  class="formular">
				</br></br>
				<hr style='width:920px'/>
				چاپ فرم کفیل مربوط به کاروانها
				<hr style='width:920px'/>
				<select id="mosque" name="mosque" width="200px" onchange="getkarvans(this.value)"  required>
					<option value="">انتخاب نام مرکز کاروان</option>
					<?php
						$sq="select * from mosques";
						$rs=mysql_query($sq) or die (mysql_error());
						while($rw=mysql_fetch_array($rs)){
							echo "<option value='$rw[id]'>$rw[name]</option>";
						}
					
					?>
				</select>
				
				<select id="getkarvan" name="getkarvan" width="200px" required>
					<option value="">انتخاب کاروان</option>
				</select>
				
				<input type="submit" name="printreport1" id="printreport1" style="width:80px" value="تایید" />
				<a href='kafil_report_excel.php?kafilid=<?php echo $_GET['kafilid'];?>&city=<?php echo $row['city'];?>' ><input type="button" name="printreport3" id="printreport3" style="width:130px" value="همه افراد تضمین شده" /></a>
				
			<?php
				if($_POST['printreport1']){
					if($_POST['getkarvan']!=""){
						$sq="select name from mosques where id='$_POST[mosque]'";
						$rs=mysql_query($sq) or die(mysql_error());
						$rowmosque=mysql_fetch_array($rs);
						echo "<b style='font-size:15px'><a style='color:blue;' href='kafil_report_excel.php?karvanid=$_POST[getkarvan]&kafilid=$_GET[kafilid]&city=$row[city]' >چاپ فرم کفیل مربوط کاروان 		$rowmosque[name]</a>";
					}
				
				}
			?>
			
			</form>
			<form id="myform2" action="kafil_reports.php?kafilid=<?php echo $_GET['kafilid'];?>&city=<?php echo $row['city'];?>" method="POST" class="formular">
				<br/><br/>
				<hr style='width:920px'/>
				چاپ فرم کفیل مربوط به ویزای انفرادی
				<hr style='width:920px'/>
				<select id="amount" name="amount" width="200px" required>
					<option value="">انتخاب تعداد افراد برای چاپ فرم کفیل</option>
					<?php
						$sql="select count(id) from visa_applicants where kafil_id='$_GET[kafilid]'";
						$rs=mysql_query($sql) or die (mysql_error());
						$rw=mysql_fetch_array($rs);
						$i=1;
						while($i<=$rw['count(id)']){
							
								echo "<option value='$i'>$i</option>";
							
							$i++;
						}
					
					?>
					
				</select>
				<input type="submit" name="printreport2" id="printreport2" style="width:80px" value="تایید" />
				<?php
				if($_POST['printreport2']){
					
						$rowmosque=mysql_fetch_array($rs);
						echo "  <b style='font-size:15px'><a style='color:blue;' href='kafil_report_excel.php?kafilid=$_GET[kafilid]&city=$row[city]&amount=$_POST[amount]' >چاپ فرم کفیل ویزای انفرادی</a></b>";
					
				
				}
			?>
			 </form>
 		</fieldset>
			
		
		</div>
		
</div><!-- end container -->
	   <?php
	   include ("template_footer.php");
	   ?>
</body>
</html>
