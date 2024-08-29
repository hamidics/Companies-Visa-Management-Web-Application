<?php 
require_once("../library/db.php");
require_once '../library/excel_library/PHPExcel/IOFactory.php';
?>
		
<?php
	$objReader = PHPExcel_IOFactory::createReader('Excel5');
	if($_GET['city']==1 and $_GET['amount']=="" and $_GET['karvanid']!=""){
		$excelfile="mashadkafilform.xls";
	}else if($_GET['city']==2 and $_GET['amount']=="" and $_GET['karvanid']!=""){
		$excelfile="tehrankafilform.xls";
	}else if($_GET['city']==3 and $_GET['amount']=="" and $_GET['karvanid']!=""){
		$excelfile="otherkafilform.xls";
	}else if($_GET['amount']!="" and $_GET['city']==1){
		$excelfile="singlekafilform1.xls";
	}else if($_GET['amount']!="" and $_GET['city']==2){
		$excelfile="singlekafilform2.xls";
	}else if($_GET['amount']!="" and $_GET['city']==3){
		$excelfile="singlekafilform3.xls";
	}else{
		$excelfile="allkafilform.xls";
	}
	
	$objPHPExcel = $objReader->load("excel_templates/".$excelfile);
	
    

			
	$styleThinBlackBorderOutline = array(
	    'borders' => array(
		    'outline' => array(
			    'style' => PHPExcel_Style_Border::BORDER_THIN,
			        'color' => array('argb' => 'FF000000'),
		        ),
	        ),
        );
		$mosquename="";
		$headname="";
		$sql="select * from kafils where id='$_GET[kafilid]'";
		$res=mysql_query($sql) or die (mysql_error());
		$rowkafil=mysql_fetch_array($res);
		$sq="";
		if($_GET['karvanid']!="" and $_GET['amount']==""){
		
		//Getting the name of the Karvan
		$sq="select applicants.name, karvan_applicants_getinfo.applicant_id, karvan.mosque_id from karvan, applicants, karvan_applicants_getinfo
		where karvan.id='$_GET[karvanid]' and karvan_applicants_getinfo.karvan_id=karvan.id and applicants.id=karvan_applicants_getinfo.applicant_id and applicant_type='سرپرست'";
		$rs=mysql_query($sq) or die (mysql_error());
		$rw1=mysql_fetch_array($rs);
		$sq="select name from mosques where id='$rw1[mosque_id]'";
		$rs=mysql_query($sq) or die (mysql_error());
		$rw=mysql_fetch_array($rs);
		$mosquename=$rw['name'];
		$headname=$rw1['name'];
		$objPHPExcel->getActiveSheet()->setCellValue('A1', $mosquename);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $headname);
		
		$sq="select applicants.id as appid, name, f_name, father_name, passport_no, kafil_relation from applicants, karvan_applicants_getinfo where applicants.kafil_id='$_GET[kafilid]'
		and karvan_applicants_getinfo.karvan_id='$_GET[karvanid]' and karvan_applicants_getinfo.applicant_id=applicants.id";
		$rs=mysql_query($sq) or die (mysql_error());
			$i=6;
			$j=1;
			while($rwapplicant=mysql_fetch_array($rs)){
				$sq="select count(id) from applicants where applicant_parent='$rwapplicant[appid]'";
				$rscountapp=mysql_query($sq) or die (mysql_error());
				$rwcountapp=mysql_fetch_array($rscountapp);
				
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $j);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $rwapplicant['name']." (".$rwapplicant['f_name']." )");
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $rwapplicant['father_name']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rwapplicant['passport_no']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $rwcountapp['count(id)']);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rwapplicant['kafil_relation']);
				$i++;
				$j++;
			}
		}else if($_GET['karvanid']=="" and $_GET['amount']!=""){
		$sq="select first_name, last_name, father_name, passport_num, kafil_relation from visa_applicants where kafil_id='$_GET[kafilid]' order by id desc LIMIT $_GET[amount]";
		$rs=mysql_query($sq) or die (mysql_error());
			$i=6;
			$j=1;
			while($rwapplicant=mysql_fetch_array($rs)){
				$sq="select count(id) from visa_dependants where applicant_id='$rwapplicant[appid]'";
				$rscountapp=mysql_query($sq) or die (mysql_error());
				$rwcountapp=mysql_fetch_array($rscountapp);
				
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $j);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $rwapplicant['first_name']." (".$rwapplicant['last_name']." )");
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $rwapplicant['father_name']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rwapplicant['passport_num']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $rwcountapp['count(id)']);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rwapplicant['kafil_relation']);
				$i++;
				$j++;
			}
		}else{
			$sq="select applicants.id as appid, name, f_name, father_name, passport_no, kafil_relation from applicants where applicants.kafil_id='$_GET[kafilid]'";
		$rs=mysql_query($sq) or die (mysql_error());
			$i=6;
			$j=1;
			while($rwapplicant=mysql_fetch_array($rs)){
				$sq="select count(id) from applicants where applicant_parent='$rwapplicant[appid]'";
				$rscountapp=mysql_query($sq) or die (mysql_error());
				$rwcountapp=mysql_fetch_array($rscountapp);
				
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $j);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $rwapplicant['name']." (".$rwapplicant['f_name']." )");
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $rwapplicant['father_name']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rwapplicant['passport_no']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $rwcountapp['count(id)']);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rwapplicant['kafil_relation']);
				$i++;
				$j++;
			}
			$sq="select first_name, last_name, father_name, passport_num, kafil_relation from visa_applicants where kafil_id='$_GET[kafilid]' order by id desc ";
			$rs=mysql_query($sq) or die (mysql_error());
			
			
			while($rwapplicant=mysql_fetch_array($rs)){
				$sq="select count(id) from visa_dependants where applicant_id='$rwapplicant[appid]'";
				$rscountapp=mysql_query($sq) or die (mysql_error());
				$rwcountapp=mysql_fetch_array($rscountapp);
				
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $j);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $rwapplicant['first_name']." (".$rwapplicant['last_name']." )");
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $rwapplicant['father_name']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rwapplicant['passport_num']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $rwcountapp['count(id)']);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rwapplicant['kafil_relation']);
				$i++;
				$j++;
			}
		}
		
		//Counting number of all applicants from karvans
			$sq="select count(id) from applicants where kafil_id='$rowkafil[id]'";
			$rs=mysql_query($sq) or die (mysql_error());
			$rw1=mysql_fetch_array($rs);
		//Counting number of kafils from visa applicants
			$sq="select count(id) from visa_applicants where kafil_id='$rowkafil[id]'";
			$rs=mysql_query($sq) or die (mysql_error());
			$rw2=mysql_fetch_array($rs);
			$numofkafils =  $rw1['count(id)']+$rw2['count(id)'];
			//Information about the Kafil
			$objPHPExcel->getActiveSheet()->setCellValue('H14', $rowkafil['name']);
			$objPHPExcel->getActiveSheet()->setCellValue('G14', $rowkafil['father_name']);
			$objPHPExcel->getActiveSheet()->setCellValue('F14', $numofkafils);
			$objPHPExcel->getActiveSheet()->setCellValue('D14', $rowkafil['idcardno']);
			$objPHPExcel->getActiveSheet()->setCellValue('D15', $rowkafil['passportno']);
			$objPHPExcel->getActiveSheet()->setCellValue('C14', $rowkafil['idcard_issue_date']);
			$objPHPExcel->getActiveSheet()->setCellValue('C15', $rowkafil['passport_issue_date']);
			$objPHPExcel->getActiveSheet()->setCellValue('B14', $rowkafil['idcard_end_date']);
			$objPHPExcel->getActiveSheet()->setCellValue('B15', $rowkafil['passport_end_date']);
			$objPHPExcel->getActiveSheet()->setCellValue('A14', $rowkafil['job']);
			$objPHPExcel->getActiveSheet()->setCellValue('C16', $rowkafil['work_address']);
			$objPHPExcel->getActiveSheet()->setCellValue('A15', $rowkafil['work_phone']);
			$objPHPExcel->getActiveSheet()->setCellValue('E17', $rowkafil['home_address']);
			$objPHPExcel->getActiveSheet()->setCellValue('A16', $rowkafil['phone_no']);
			$objPHPExcel->getActiveSheet()->setCellValue('A17', $rowkafil['mobile_no']);
			
			//Second part of file
			$objPHPExcel->getActiveSheet()->setCellValue('F19', $rowkafil['name']);
			$objPHPExcel->getActiveSheet()->setCellValue('D19', $rowkafil['father_name']);
			$objPHPExcel->getActiveSheet()->setCellValue('A23', $rowkafil['name']);
			$objPHPExcel->getActiveSheet()->setCellValue('E24', $rowkafil['passportno']);
					
				//Finished place for working
	  
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	ob_end_clean(); // Added by me
	ob_start(); // Added by me
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="kafilform.xls"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	