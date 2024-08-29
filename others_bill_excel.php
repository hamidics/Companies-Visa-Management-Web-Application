<?php		
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
require_once '../library/pdate.php';
			
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load("excel_templates/bill.xls");
			


			            $sql1="Select id, passportnum, visadate, visa_type, visaprice, visanum, name, father_name, dependentamount, requestdate from dependent_visa where id='$_GET[appid]'";
				        $res1=mysql_query($sql1) or die(mysql_error());
				        $row1=mysql_fetch_array($res1);
						//Getting the visa type
						$sq="select name from visatypes where id='$row1[visa_type]'";
						$retype=mysql_query($sq) or die (mysql_error());
						$rwtype=mysql_fetch_array($retype);
						
						
						//Printing information into Excel File
						$objPHPExcel->getActiveSheet()->setCellValue('B20', $row1['requestdate']);
						$objPHPExcel->getActiveSheet()->setCellValue('E11', $row1['passportnum']);
						$objPHPExcel->getActiveSheet()->setCellValue('E15', $rwtype['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('F19', $row1['visaprice']);
						$objPHPExcel->getActiveSheet()->setCellValue('F23', $row1['dependentamount']);
						$objPHPExcel->getActiveSheet()->setCellValue('B6', $row1['name']." "."(نام پدر: ".$row1['father_name'].")" );
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