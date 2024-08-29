<?php
include("template_header.php");
//Unzip a folder and store it into a folder
 require_once('../library/pclzip-2-8-2/pclzip.lib.php');
  require_once('../library/restore-script.php');
  require_once('../library/zipandcopy-script.php');

?>


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
			<form action="backup.php" method="post" id="myform"  enctype="multipart/form-data" class="formular"   >
			<fieldset>
				<legend align="right"><span dir="rtl">بخش پشتیبانی سیستم</span></legend>
			<div id="tabs" align="right" style='font-family:tahoma;' >
	
				<ul>
					<li><a href="#tabs-1"> تهیه فایل پشتیبان از اطلاعات ذخیره شده</a></li>
					<li><a href="#tabs-2">آپلود نمودن اطلاعات به دیتابیس</a></li>
					
				</ul>
				<div id="tabs-1">
				برای تهیه فایل پشتیبان از اطلاعات ذخیره شده روی تصویر ذیل کلیک نمایید:</br></br></br>
				<center>
				<a href="../library/backup-script.php" target="_blank"><img src="img/backsmall.png"/></a>
				<br />
				
				<br />
				<?php
				//if(isset($_GET['createbackup'])){
				// backup_tables("applicants", "backup/");
				// echo "<p style='color:green;font-size:22px' align='center' >فایل پشتیبان موفقانه تهیه شد، لطفا به آدرس زیر رفته و فایل زیپ که حاوی اطلاعات ذخیره شده می باشد را کپی نمایید.</p>";
				
				//}
				
				?>

			    </div>
				

					     
				<div id="tabs-2">
				برای اضافه نمودن اطلاعات جدید به دیتابیس فایل زیبپ مربوطه را آپلود نمایید:
				</br></br><center>
				<img src="img/backupsmall1.png"  /></br>
				<input type="file" name="fileupload" id="fileupload" class="validate[required]" />
				<input type="submit" class="submit" name="upload" value="تایید"/>
				</center>
				</br></br>
				<?php
				if(isset($_POST["upload"])){
						 $filename=$_FILES['fileupload']['name'];
						 if($filename=="ackup-info.zip"){
						 $file_ext = substr($filename, strripos($filename, '.'));
						  $newfilename ="backup".$file_ext;
						  $destination = "uploads/".$newfilename;
						  $temp_file = $_FILES['fileupload']['tmp_name'];
						  //Unlinking Resources
					$files = glob("uploads/*"); 
					foreach($files as $file) unlink($file);
					$files = glob("uploads/ckup-info/applicant_images/*"); 
					foreach($files as $file) unlink($file);
					$files = glob("uploads/ckup-info/backup/*"); 
					foreach($files as $file) unlink($file);
					$files = glob("uploads/ckup-info/visa_applicant_images/*"); 
					foreach($files as $file) unlink($file);
					$files = glob("uploads/ckup-info/visa_dependants_images/*"); 
					foreach($files as $file) unlink($file);
					echo "hi";
						  move_uploaded_file($temp_file,$destination);
				
						  $archive = new PclZip('uploads/backup.zip');
						  if (($v_result_list = $archive->extract(PCLZIP_OPT_PATH, 'uploads/')) == 0) {
							die("Error : ".$archive->errorInfo(true));
						  }
						  echo "<pre>";
						  var_dump($v_result_list);
						  echo "</pre>";
						  //echo "<p style='color:green;font-size:20px'>اطلاعات موفقانه به دیتابیس ذخیره گردید!</p>";
							
						  run_query_batch($handledb, "uploads/ckup-info/backup/backup.sql");
						  copy_all("uploads/ckup-info/applicant_images/","applicant_images/");
						  copy_all("uploads/ckup-info/visa_applicant_images/","visa_applicant_images/");
						  copy_all("uploads/ckup-info/visa_dependants_images/","visa_dependants_images/");						 

						  header("location:restoresuccess.php");
						  die();
						  }else{
						  echo "<b style='color:red; font-size:18'>فایل آپلود شده درست نمی باشد، لطفا فایل ackup-info.zip را آپلود نمایید.</b>";
						  }
				}
				?>
				</div>
				</br>
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
