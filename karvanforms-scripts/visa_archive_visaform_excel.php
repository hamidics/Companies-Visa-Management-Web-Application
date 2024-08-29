<?php		
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
require_once '../library/pdate.php';
			
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load("excel_templates/visa_form narrow.xls");
			

						// Add a visa form image to the worksheet
						$photo=$_GET['visaapplicant'].".jpg";
						$objDrawing = new PHPExcel_Worksheet_Drawing();
						$objDrawing->setName('photo');
						$objDrawing->setDescription('student photo');
						$objDrawing->setPath('visa_applicant_images/'.$photo);
						$objDrawing->setCoordinates('H6');
						$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
						
						
			            $sql1="Select * from visa_applicants where id='$_GET[visaapplicant]'";
				        $res1=mysql_query($sql1) or die(mysql_error());
				        $row1=mysql_fetch_array($res1);
						//Getting applicant visa info
			            $sql2="Select * from visa_info where applicant_id='$_GET[visaapplicant]'";
				        $res2=mysql_query($sql2) or die(mysql_error());
				        $row2=mysql_fetch_array($res2);
						//Getting the times that this person has gone to Iran
			            $sqlb="Select * from visa_applicants where id!='$_GET[visaapplicant]' and passport_num='$row1[passport_num]' and type='old' order by id desc LIMIT 2";
				        $resb=mysql_query($sqlb) or die(mysql_error());
				   				
						
						$i=35;
						while($rowc=mysql_fetch_array($resb)){
							$sqlc1="Select issue_date from visa_info where applicant_id='$rowc[id]'";
							$resc1=mysql_query($sqlc1) or die (mysql_error());
							$rowc1=mysql_fetch_array($resc1);
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rowc1['issue_date']);
							$i++;
						
						}
						//Getting applicants dependants
			            $sql3="Select * from visa_dependants where applicant_id='$_GET[visaapplicant]' LIMIT 7";
				        $res3=mysql_query($sql3) or die(mysql_error());
						$i=19;
						$j=19;
				        while($row3=mysql_fetch_array($res3)){
						// Add a customer image to the worksheet
						$photo=$row3['id'].".jpg";
						$objDrawing = new PHPExcel_Worksheet_Drawing();
						$objDrawing->setName('photo');
						$objDrawing->setDescription('student photo');
						$objDrawing->setPath('visa_dependants_images/'.$photo);
						$objDrawing->setCoordinates('H'.$j);
						$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
						$j+=2;
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row3['first_name']." ".$row3['last_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row3['father_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row3['birth_date']);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row3['relation']);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row3['education']);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row3['job']);
						$i++;
						}
						$objPHPExcel->getActiveSheet()->setCellValue('A5', $row1['created_at']);
						
						$objPHPExcel->getActiveSheet()->setCellValue('E7', $row2['command']);
						$objPHPExcel->getActiveSheet()->setCellValue('E8', $row2['specialist']);
						$objPHPExcel->getActiveSheet()->setCellValue('E9', $row2['num_center_mojavez']);
						$objPHPExcel->getActiveSheet()->setCellValue('E10', $row2['date_center_mojavez']);
						$objPHPExcel->getActiveSheet()->setCellValue('A6', $row2['visa_type']);
						$objPHPExcel->getActiveSheet()->setCellValue('A7', $row2['price']);
						$objPHPExcel->getActiveSheet()->setCellValue('A8', $row2['period_of_stay']);
						$objPHPExcel->getActiveSheet()->setCellValue('A9', $row2['arjaeat']);
						//$objPHPExcel->getActiveSheet()->setCellValue('G35', $row2['issue_date']);
						$objPHPExcel->getActiveSheet()->setCellValue('A4', $row2['visa_num']);
						$objPHPExcel->getActiveSheet()->setCellValue('E13', $row1['first_name']." ".$row1['last_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('E14', $row1['birth_date']." ".$row1['birth_place']);
						$objPHPExcel->getActiveSheet()->setCellValue('E15', $row1['passport_kind']." ".$row1['passport_num']);
						$objPHPExcel->getActiveSheet()->setCellValue('E16', $row1['education']);
						$objPHPExcel->getActiveSheet()->setCellValue('A13', $row1['father_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('A14', $row1['marital_status']);
						$objPHPExcel->getActiveSheet()->setCellValue('A15', $row1['passport_issue_date']." ".$row1['passport_issue_place']);
						$objPHPExcel->getActiveSheet()->setCellValue('A16', $row1['job']);
						$objPHPExcel->getActiveSheet()->setCellValue('A28', $row1['add_in_iran']." ".$row1['phone_in_iran']);
						$objPHPExcel->getActiveSheet()->setCellValue('A30', $row1['add_in_afghanistan']." ".$row1['phone_in_afghanistan']);
						$objPHPExcel->getActiveSheet()->setCellValue('A29', $row1['job_add_in_afghanistan']." ".$row1['job_phone_in_afghanistan']);
						
						$centerinfo="";
						

						//Getting the number of sends by a special center
						if($row1['visa_center_id']!="none"){
						//Getting the name of the center
						$sql5="Select name from visa_centers where id='$row1[visa_center_id]'";
						$res5=mysql_query($sql5) or die (mysql_error());
						$row5=mysql_fetch_array($res5);
						//Setting visa center info on the request
						$objPHPExcel->getActiveSheet()->setCellValue('E6', $row2['attach']." - ".$row5['name']);
						$centerinfo=$row5['name']." ";
						$sql4="Select count(id) from visa_applicants where visa_center_id='$row1[visa_center_id]'";
						$res4=mysql_query($sql4) or die(mysql_error());
						$row4=mysql_fetch_array($res4);
						$centerinfo.=$row4['count(id)']."  نفر  اعزام";
						$sql4="Select count(id) from visa_applicants where passport_num='$row1[passport_num]'";
						$res4=mysql_query($sql4) or die(mysql_error());
						$row4=mysql_fetch_array($res4);
						$centerinfo.="  (تعداد ویزای این فرد:  ".$row4['count(id)'].")";
						}else{
						//Setting visa center info on the request
						$objPHPExcel->getActiveSheet()->setCellValue('E6', $row2['attach']);
						$centerinfo="تعداد ویزاهای گرفته شده:  ";
						$sql4="Select count(id) from visa_applicants where passport_num='$row1[passport_num]'";
						$res4=mysql_query($sql4) or die(mysql_error());
						$row4=mysql_fetch_array($res4);
						$centerinfo.=$row4['count(id)'];
						}
						//Checking if the person is in the blacklist or not
						$sql6="select count(id) from blacklist where passport_no='$row1[passport_num]'";
						$res6=mysql_query($sql6) or die (mysql_error());
						$row6=mysql_fetch_array($res6);
						
						if($row6['count(id)']>0){
						$centerinfo.=" *";
						}
						$objPHPExcel->getActiveSheet()->setCellValue('A10', $centerinfo);
						
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			
			ob_end_clean(); // Added by me
			ob_start(); // Added by me
			
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="visa_form-'.$today.'.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter->save('php://output');
?>