<?php		
require_once("../library/db.php");
require_once ('../library/excel_library/PHPExcel.php');
require_once '../library/excel_library/PHPExcel/IOFactory.php';
require_once '../library/pdate.php';
			
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load("excel_templates/applicants.xls");
			$today=pdate("Y-m-d");
			$objPHPExcel->getActiveSheet()->setCellValue('A4', $today);
			
			$i = 6;
			
			$styleThinBlackBorderOutline = array(
	            'borders' => array(
		           'outline' => array(
			           'style' => PHPExcel_Style_Border::BORDER_THIN,
			                'color' => array('argb' => 'FF000000'),
		            ),
	            ),
            );
			//Finding Mosque name and setting the header information
			$sql="select applicant_id,count(id) from karvan_applicants_getinfo where karvan_id='$_GET[karvanid]'";
			$res=mysql_query($sql) or die(mysql_error());
			$responsiblename="";
			$responsiblepass="";
			$responsiblefathername="";
			while($row=mysql_fetch_array($res)){
				$numbers=$row['count(id)'];
				$sq="select *from applicants where id='$row[applicant_id]'";
				$rs=mysql_query($sq)or die (mysql_error());
				$ro=mysql_fetch_array($rs);
				
				$responsiblename=$ro['name'];
				$responsiblepass=$ro['passport_no'];
				$responsiblefathername=$ro['father_name'];
				$sq="select mosque_id from karvan where id='$_GET[karvanid]'";
				$rs=mysql_query($sq) or die(mysql_error());
				$ro1=mysql_fetch_array($rs);
				$sq="select name from mosques where id='$ro1[mosque_id]'";
				$rs=mysql_query($sq) or die(mysql_error());
				$ro2=mysql_fetch_array($rs);
				$mosquename=$ro2['name'];
				if($ro['applicant_type']=="سرپرست"){
					break;
				}
			}
			//Finished Mosque name and setting header information
			
			//Printing name of responsible and other information on the header of the excel file
			$objPHPExcel->getActiveSheet()->setCellValue('A1', "لیست کاروان ".$numbers."نفره ".$mosquename);
			$objPHPExcel->getActiveSheet()->setCellValue('B4', $responsiblename."فرزند".$responsiblefathername." با شماره گذرنامه : ".$responsiblepass);
			//Printing of header information is finished
			$sql="select * from karvan_applicants_getinfo where karvan_id='$_GET[karvanid]'";
			$res=mysql_query($sql) or die(mysql_error());
			$i=7;
			$j=1;
			while($row=mysql_fetch_array($res)){
				$sq="select id,name,father_name,applicant_type,passport_no from applicants where id='$row[applicant_id]'";
				$rs=mysql_query($sq) or die(mysql_error());
				$ro=mysql_fetch_array($rs);
				$name=$ro['name'];
				$fathername=$ro['father_name'];
				$type=$ro['applicant_type'];
				$passno=$ro['passport_no'];
				$photo=$ro['id'].".jpg";
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleThinBlackBorderOutline);
	            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleThinBlackBorderOutline);
	            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleThinBlackBorderOutline);
	            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleThinBlackBorderOutline);
	            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				// Add a student image to the worksheet
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setPath("applicant_images/".$photo);
				$objDrawing->setCoordinates('A'.$i);
				$objDrawing->setHeight(70);
				$objDrawing->setWidth(70);
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
				//Finished Creating Object
				
				//Printing data into excel file
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $passno);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $type);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $fathername);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $name);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $j);
			$i++;
			$j++;
			}
			
						
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			
			ob_end_clean(); // Added by me
			ob_start(); // Added by me
			
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="karvan-list.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter->save('php://output');
?>