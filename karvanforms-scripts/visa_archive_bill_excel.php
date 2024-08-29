<?php		
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
require_once '../library/pdate.php';
			
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load("excel_templates/bill.xls");
			


			            $sql1="Select * from visa_applicants where id='$_GET[visaapplicant]'";
				        $res1=mysql_query($sql1) or die(mysql_error());
				        $row1=mysql_fetch_array($res1);
						//Getting applicant visa info
			            $sql2="Select * from visa_info where applicant_id='$_GET[visaapplicant]'";
				        $res2=mysql_query($sql2) or die(mysql_error());
				        $row2=mysql_fetch_array($res2);
						//Getting applicants dependants
			            $sql3="Select count(id) from visa_dependants where applicant_id='$_GET[visaapplicant]' LIMIT 7";
				        $res3=mysql_query($sql3) or die(mysql_error());
						$row3=mysql_fetch_array($res3);
						//Printing information into Excel File
						$objPHPExcel->getActiveSheet()->setCellValue('A17', $row2['visa_num']."  ( ".$row1['created_at']." )");
						$objPHPExcel->getActiveSheet()->setCellValue('D7', $row1['passport_num']);
						$objPHPExcel->getActiveSheet()->setCellValue('D11', $row2['visa_type']);
						$objPHPExcel->getActiveSheet()->setCellValue('D15', $row2['price']);
						$objPHPExcel->getActiveSheet()->setCellValue('D19', $row3['count(id)']);
						//$objPHPExcel->getActiveSheet()->setCellValue('G35', $row2['issue_date']);
						$objPHPExcel->getActiveSheet()->setCellValue('A4', $row1['first_name']." ".$row1['last_name']."(نام پدر: ".$row1['father_name'].")" );
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