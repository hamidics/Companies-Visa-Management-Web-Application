<?php 
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
?>
		
<?php
	$objReader = PHPExcel_IOFactory::createReader('Excel5');
	$objPHPExcel = $objReader->load("excel_templates/applicantlist.xls");
	
    

			
	$styleThinBlackBorderOutline = array(
	    'borders' => array(
		    'outline' => array(
			    'style' => PHPExcel_Style_Border::BORDER_THIN,
			        'color' => array('argb' => 'FF000000'),
		        ),
	        ),
        );
		
		//Getting the name of the Karvan
		$sq="select mosque_id from karvan where id='$_GET[karvanid]'";
		$rs=mysql_query($sq) or die (mysql_error());
		$rw=mysql_fetch_array($rs);
		$sq="select name from mosques where id='$rw[mosque_id]'";
		$rs=mysql_query($sq) or die (mysql_error());
		$rw=mysql_fetch_array($rs);
		
		//Getting the number of applicants included in this karvan
			$sql="select count(applicant_id) from karvan_applicants_getinfo where karvan_id='$_GET[karvanid]'";
			$rscount=mysql_query($sql) or die (mysql_error());
			$rwcount=mysql_fetch_array($rscount);
			
		//Printing the value of karvan name and number of applicants into excel file
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "فهرست اسامی افراد   ".$rw['name']);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "تعداد : ".$rwcount['count(applicant_id)']);
	$i=5;
	$j=1;
	$karvanid=$_GET['karvanid'];
	$sql="select applicant_id,last_address_id,karvan_id from karvan_applicants_getinfo where karvan_id='$karvanid'";
				$res=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($res)){
				$sql="select * from applicants where id='$row[applicant_id]'";
				$rs=mysql_query($sql) or die(mysql_error());
				$ro=mysql_fetch_array($rs);
					//Printing into excel file
						$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
						$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(30);
						$objPHPExcel->getActiveSheet()->getStyle("A".$i.":J".$i)->getFont()->setSize(11);
					
						$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $j);
						$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $ro['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $ro['father_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $ro['birth_date']);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $ro['passport_no']);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $ro['pass_validation_date']);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, "سیاحتی");
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, "30 روز");
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $ro['job']);
						
						
					$i++;
					
					}
					
				//Finished place for working
	  
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	ob_end_clean(); // Added by me
	ob_start(); // Added by me
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="karvanlist.xls"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');