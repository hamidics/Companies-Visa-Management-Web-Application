<?php		
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
require_once '../library/excel_library/PHPExcel/Writer/Excel2007.php';
require_once '../library/pdate.php';
			
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load("excel_templates/visa_form narrow.xls");
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
			//$phpExcel = new PHPExcel();
/*
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FF0000'),
        'size'  => 15,
        'name'  => 'B Mitra'
    ));*/

						$sql1="Select applicant_id, passportnum, fromdate, visa_type, visaprice, visanumber,
						passissueplace, attachtype, orderforvisa, center_mojavez_num, center_mojavez_date, arjaeet, 
						visaissuedate, limitdays, supervisor, passissuedate, requestdate from visa_history where id='$_GET[resumeid]'";
				        $res1=mysql_query($sql1) or die(mysql_error());
				        $row1=mysql_fetch_array($res1);
						//Getting the visa type
						
						$sq="select name from visatypes where id='$row1[visa_type]'";
						$retype=mysql_query($sq) or die (mysql_error());
						$rwtype=mysql_fetch_array($retype);
						//Getting applicant visa info
			            $sql2="Select id, name, family, father_name, source_id, birthdate, birthplace, education, marital_status, work_field, address_iran, 
						address, address_afghanistan from vapplicants where id='$row1[applicant_id]'";
				        $res2=mysql_query($sql2) or die(mysql_error());
				        $row2=mysql_fetch_array($res2);
						
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
					if($_GET['ov']==1){
			            $sql3="Select * from dependent_visa_dependants where other_parentid='$_GET[resumeid]' LIMIT 7";
				        $res3=mysql_query($sql3) or die(mysql_error());
						$i=19;
						$j=19;
				        while($row3=mysql_fetch_array($res3)){
						
						$j+=2;
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row3['name']." ".$row3['family']);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row3['father_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row3['birthdate']);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row3['relation']);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row3['education']);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row3['job']);
						$i++;
						}
						}
						$objPHPExcel->getActiveSheet()->setCellValue('A5', $row1['requestdate']);
						
						$objPHPExcel->getActiveSheet()->setCellValue('E6', $row1['attachtype']);
						$objPHPExcel->getActiveSheet()->setCellValue('E7', $row1['orderforvisa']);
						//$objPHPExcel->getActiveSheet()->setCellValue('E8', $rwsuper['name']);
						$objPHPExcel->getActiveSheet()->setCellValue('E9', $row1['center_mojavez_num']);
						$objPHPExcel->getActiveSheet()->setCellValue('E10', $row1['center_mojavez_date']);
						//$phpExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->setCellValue('A6', $rwtype['name']);
						//$phpExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->setCellValue('A7', $row1['visaprice']."یورو");
						$objPHPExcel->getActiveSheet()->setCellValue('A8', $row1['limitdays']);
						$objPHPExcel->getActiveSheet()->setCellValue('A9', $row1['arjaeet']);
						
						//$objPHPExcel->getActiveSheet()->setCellValue('G35', $row2['issue_date']);
						//$objPHPExcel->getActiveSheet()->setCellValue('A4', $row1['visanumber']);
						$objPHPExcel->getActiveSheet()->setCellValue('E13', $row2['name']." ".$row2['family']);
						$objPHPExcel->getActiveSheet()->setCellValue('E14', $row2['birthdate']."  ".$row2['birthplace']);
						$objPHPExcel->getActiveSheet()->setCellValue('E15', "تجاری  ".$row1['passportnum']);
						$objPHPExcel->getActiveSheet()->setCellValue('E16', $row2['education']);
						$objPHPExcel->getActiveSheet()->setCellValue('A13', $row2['father_name']);
						$objPHPExcel->getActiveSheet()->setCellValue('A14', $row2['marital_status']);
						$objPHPExcel->getActiveSheet()->setCellValue('A15', $row1['passissuedate'].$row1['passissueplace']);
						$objPHPExcel->getActiveSheet()->setCellValue('A16', $row2['work_field']);
						$objPHPExcel->getActiveSheet()->setCellValue('A28', $row2['address_iran']);
						$objPHPExcel->getActiveSheet()->setCellValue('A30', $row2['address']);
						$objPHPExcel->getActiveSheet()->setCellValue('A29', $row2['address_afghanistan']);
						$objPHPExcel->getActiveSheet()->setCellValue('G35', $row1['visaissuedate']);
						$objPHPExcel->getActiveSheet()->setCellValue('G34', $row1['visanumber']);
						//$objPHPExcel->getDefaultStyle()->getFont()->setName('B Mitra');
						

						//Getting the name of company or etehadie
						//$objPHPExcel->getActiveSheet()->setCellValue('A10', "شرکت/ منبع معرفی".$centerinfo);
			//$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('B Mitra');		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			//$objWriter->getDefaultStyle()->getFont()->setName('B Mitra');
			ob_end_clean(); // Added by me
			ob_start(); // Added by me
			
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel; charset:utf-8');
			header('Content-Disposition: attachment;filename="visa_form-'.$today.'.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter->save('php://output');
?>