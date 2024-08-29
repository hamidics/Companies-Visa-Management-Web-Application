<?php		
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
require_once '../library/pdate.php';
			
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load("excel_templates/bill.xls");
			


			           $sql1="Select applicant_id, passportnum, requestdate, visa_type, visaprice, visanumber from visa_history where id='$_GET[did]'";
				        $res1=mysql_query($sql1) or die(mysql_error());
				        $row1=mysql_fetch_array($res1);
						//Getting the visa type
						$sq="select name from visatypes where id='8'";
						$retype=mysql_query($sq) or die (mysql_error());
						$rwtype=mysql_fetch_array($retype);
						//Getting applicant visa info
			            $sql2="Select name, family, father_name, passportnum  from vapplicants where id='$_GET[appid]'";
				        $res2=mysql_query($sql2) or die(mysql_error());
				        $row2=mysql_fetch_array($res2);
						
						//Printing information into Excel File
						$objPHPExcel->getActiveSheet()->setCellValue('B20', $row1['requestdate']);
						$objPHPExcel->getActiveSheet()->setCellValue('E11', $row2['passportnum']);
						$objPHPExcel->getActiveSheet()->setCellValue('E15', $rwtype['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('F19', "350یورو");
						$objPHPExcel->getActiveSheet()->setCellValue('F23', "0");
						$objPHPExcel->getActiveSheet()->setCellValue('B6', $row2['name']." ".$row2['family']."(نام پدر: ".$row2['father_name'].")" );
						//$objPHPExcel->getActiveSheet()->setCellValue('E15', $row1['passport_kind']." ".$row1['passport_num']);

						
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			
			ob_end_clean(); // Added by me
			ob_start(); // Added by me
			
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="bill.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter->save('php://output');
?>