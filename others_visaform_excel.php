<?php		
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
require_once '../library/pdate.php';
			
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load("excel_templates/visa_form narrow.xls");
			
						$sql1="Select * from dependent_visa where id='$_GET[appid]'";
				        $res1=mysql_query($sql1) or die(mysql_error());
				        $row1=mysql_fetch_array($res1);
						//Getting the visa type
						
						$sq="select name from visatypes where id='$row1[visa_type]'";
						$retype=mysql_query($sq) or die (mysql_error());
						$rwtype=mysql_fetch_array($retype);
						
						
						/*// Add a visa form image to the worksheet
						$photo=$row2['id'].".jpg";
						$objDrawing = new PHPExcel_Worksheet_Drawing();
						
						$objDrawing->setName('photo');
						$objDrawing->setDescription('student photo');
						
						$objDrawing->setPath('appphotos/'.$photo);
						
						$objDrawing->setCoordinates('H6');
						$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
						*/
						
						$centerinfo="";
						//Getting the sourcename
						$sql="select name from sources where id='$row2[source_id]'";
						$rssource=mysql_query($sql) or die (mysql_error());
						$rwsource=mysql_fetch_array($rssource);
						$centerinfo=$rwsource['name'];
						
						
						
						
						//Getting applicants dependants
			            $sql3="Select * from dependent_visa_dependants where parent_id='$_GET[appid]' LIMIT 7";
				        $res3=mysql_query($sql3) or die(mysql_error());
						$i=19;
						$j=19;
				        while($row3=mysql_fetch_array($res3)){
						/*// Add a customer image to the worksheet
						$photo=$row3['id'].".jpg";
						$objDrawing = new PHPExcel_Worksheet_Drawing();
						$objDrawing->setName('photo');
						$objDrawing->setDescription('student photo');
						$objDrawing->setPath('visa_dependants_images/'.$photo);
						$objDrawing->setCoordinates('H'.$j);
						$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
						*/
						$j+=2;
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row3['name']." ".$row3['family']);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row3['father_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row3['birthdate']);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row3['relation']);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row3['education']);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row3['job']);
						$i++;
						}
						
						$objPHPExcel->getActiveSheet()->setCellValue('A5', $row1['requestdate']);
						$objPHPExcel->getActiveSheet()->setCellValue('E6', $row1['attachtype']);
						$objPHPExcel->getActiveSheet()->setCellValue('E7', $row1['visaorder']);
						//$objPHPExcel->getActiveSheet()->setCellValue('E8', $rwsuper['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('E9', $row1['centernum']);
						$objPHPExcel->getActiveSheet()->setCellValue('E10', $row1['centerdate']);
						$objPHPExcel->getActiveSheet()->setCellValue('A6', $rwtype['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('A7', $row1['visaprice']);
						$objPHPExcel->getActiveSheet()->setCellValue('A8', $row1['limitdays']);
						$objPHPExcel->getActiveSheet()->setCellValue('A9', $row1['arjaeet']);
						
						//$objPHPExcel->getActiveSheet()->setCellValue('G35', $row2['issue_date']);
						//$objPHPExcel->getActiveSheet()->setCellValue('A4', $row1['visanumber']);
						$objPHPExcel->getActiveSheet()->setCellValue('E13', $row1['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('E14', $row1['birthdate'].$row1['birthplace']);
						$objPHPExcel->getActiveSheet()->setCellValue('E15', $row1['passportnum']);
						$objPHPExcel->getActiveSheet()->setCellValue('E16', $row1['education']);
						$objPHPExcel->getActiveSheet()->setCellValue('A13', $row1['father_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('A14', $row1['marital_status']);
						$objPHPExcel->getActiveSheet()->setCellValue('A15', $row1['passissueplace'].$row1['passissuedate']);
						//$objPHPExcel->getActiveSheet()->setCellValue('A16', $row1['work_field']);
						$objPHPExcel->getActiveSheet()->setCellValue('A28', $row1['iranaddress']);
						//$objPHPExcel->getActiveSheet()->setCellValue('A30', $row2['address']);
						$objPHPExcel->getActiveSheet()->setCellValue('A29', $row1['afghanistanadd']);
						$objPHPExcel->getActiveSheet()->setCellValue('G35', $row1['visadate']);
						$objPHPExcel->getActiveSheet()->setCellValue('G34', $row1['visanum']);
						
						

						//Getting the name of company or etehadie
						//$objPHPExcel->getActiveSheet()->setCellValue('A10', "شرکت/ منبع معرفی".$centerinfo);
						
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			
			ob_end_clean(); // Added by me
			ob_start(); // Added by me
			
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="visa_form-'.$today.'.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter->save('php://output');
?>