<?php 
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
?>
		
<?php
	$objReader = PHPExcel_IOFactory::createReader('Excel5');
	$objPHPExcel = $objReader->load("excel_templates/karvans.xls");
	
    $bank_name = $_GET['bank_name'];
	$currency = $_GET['currency'];
	$bank_num = $_GET['bank_num'];
	$bank_id = $_GET['bank_id'];
	$date = $_GET['date'];
	$bank_info = $bank_name." ".$bank_num;
	
	$objPHPExcel->getActiveSheet()->setCellValue('F4', $bank_info);
	$objPHPExcel->getActiveSheet()->setCellValue('A4', $date);

	$i = 6;
			
	$styleThinBlackBorderOutline = array(
	    'borders' => array(
		    'outline' => array(
			    'style' => PHPExcel_Style_Border::BORDER_THIN,
			        'color' => array('argb' => 'FF000000'),
		        ),
	        ),
        );
	
					//Here is for working
					$date1=$_GET['date_1'];
					$date2=$_GET['date_2'];
					$sql="select * from karvan where  recipe_date between '$date1' and '$date2' order by id asc";
					$res=mysql_query($sql) or die(mysql_error());
					$i=1;
					$j=6;
					while($row=mysql_fetch_array($res)){
						$sql="select name from mosques where id='$row[mosque_id]'";
						$res1=mysql_query($sql) or die(mysql_error());
						$row1=mysql_fetch_array($res1);
						$sql="select applicant_id,count(id) from  karvan_applicants_getinfo where karvan_id='$row[id]'";
						$res2=mysql_query($sql) or die(mysql_error());
						$row2=mysql_fetch_array($res2);
						$sql="select name from applicants where id='$row2[applicant_id]' and  applicant_type ='سرپرست'";
						$res3=mysql_query($sql) or die(mysql_error());
						$row3=mysql_fetch_array($res3);
						//Printing into excel file
						$objPHPExcel->getActiveSheet()->getStyle('A'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('B'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('C'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('E'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('F'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('G'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('H'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('I'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('J'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('K'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('L'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('M'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('N'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('O'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('P'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('Q'.$j)->applyFromArray($styleThinBlackBorderOutline);
						$objPHPExcel->getActiveSheet()->getStyle('R'.$j)->applyFromArray($styleThinBlackBorderOutline);

						$objPHPExcel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
						$objPHPExcel->getActiveSheet()->getStyle('D'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('E'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('F'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('G'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('H'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('I'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('J'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('K'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('L'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('M'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('N'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('O'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('P'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('Q'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->getActiveSheet()->getStyle('R'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						//Checking dates in the database
						$resume=$row['resume'];
						$omana=$row['omana'];
						$monifest=$row['monifest'];
						$interview=$row['interview'];
						$warranty=$row['warranty'];
						$lab=$row['laboratory'];
						$visaform=$row['visa_price'];
						$consul=$row['consultency'];
						$carintro=$row['car'];
						$border=$row['border'];
						$najacode=$row['naja_code'];
						$report=$row['report'];
						//Checking if they are full or not
						if($resume!="" and $resume!="0000-00-00"){
							$resume="√";
						}else{
							$resume="";
						}
						if($omana!="" and $omana!="0000-00-00"){
							$omana="√";
						}else{
							$omana="";
						}
						if($monifest!="" and $monifest!="0000-00-00"){
							$monifest="√";
						}else{
							$monifest="";
						}
						if($interview!="" and $interview!="0000-00-00"){
							$interview="√";
						}else{
							$interview="";
						}
						if($warranty!="" and $warranty!="0000-00-00"){
							$warranty="√";
						}else{
							$warranty="";
						}
						if($lab!="" and $lab!="0000-00-00"){
							$lab="√";
						}else{
							$lab="";
						}
						if($visaform!="" ){
							$visaform="√";
						}else{
							$visaform="";
						}
						if($consul!="" and $consul!="0000-00-00"){
							$consul="√";
						}else{
							$consul="";
						}
						if($carintro!="" and $carintro!="0000-00-00"){
							$carintro="√";
						}else{
							$carintro="";
						}
						if($border!="" and $border!="0000-00-00"){
							$border="√";
						}else{
							$border="";
						}
						if($najacode!=""){
							$najacode="√";
						}	else{
							$najacode="";
						}
						if($report!="" and $report!="0000-00-00"){
							$report="√";
						}else{
							$report="";
						}
						

						$objPHPExcel->getActiveSheet()->setCellValue('R'.$j, $i);
						$objPHPExcel->getActiveSheet()->setCellValue('Q'.$j, $row1['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('P'.$j, $row3['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('O'.$j, $row2['count(id)']);
							if(($border=="√") ){
								$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, "اعزام شد");
							}else if($border!="√"){
								$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, "در حال طی مراحل");
							}
						$objPHPExcel->getActiveSheet()->setCellValue('N'.$j, $row['send_number']);
						//Printing the information about different dates
						
						$objPHPExcel->getActiveSheet()->setCellValue('M'.$j, $resume);
						$objPHPExcel->getActiveSheet()->setCellValue('L'.$j, $omana);
						$objPHPExcel->getActiveSheet()->setCellValue('K'.$j, $monifest);
						$objPHPExcel->getActiveSheet()->setCellValue('J'.$j, $interview);
						$objPHPExcel->getActiveSheet()->setCellValue('I'.$j, $warranty);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$j, $lab);
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$j, $visaform);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $consul);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $carintro);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $border);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $najacode);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $report);
						
						
						
					$i++;
					$j++;
					}
					
				//Finished place for working
	  
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	ob_end_clean(); // Added by me
	ob_start(); // Added by me
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="report'.$date1.'-'.$date2.'.xls"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');