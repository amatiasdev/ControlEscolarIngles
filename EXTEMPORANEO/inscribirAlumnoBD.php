<?php 

include 'conexion.php';
require '../Classes/PHPExcel/IOFactory.php';
require 'conexion.php';


	$nombreArchivo="C:\REGISTRAR.xlsx";

	$objPHPExcel=PHPEXCEL_IOFactory::load($nombreArchivo);
	$objPHPExcel->setActiveSheetIndex(0);
	$numRows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
for ($i=10; $i <351; $i++){		
		$nivel=$objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
		$salon=$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
		$matricula=$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();

		if($nivel=='1' and $salon=='A'){ //1A
			$grupo=11;
		}elseif ($nivel=='1' and $salon=='B') {
			$grupo=14;
		}elseif ($nivel=='1' and $salon=='C') {
			$grupo=12;
		}elseif ($nivel=='2' and $salon=='A') {
			$grupo=13;
		}elseif ($nivel=='2' and $salon=='B') {
			$grupo=16;
		}elseif ($nivel=='3') {
			$grupo=10;
		}elseif ($nivel=='4') {
			$grupo=15;
		}elseif ($nivel=='5') {
			$grupo=17;
		}elseif ($nivel=='6') {
			$grupo=9;
		}










$query="INSERT INTO `ingles_tesi`.`alumnos_has_grupos` (`Alumnos_matricula`, `grupos_idgrupo`, `inscrito`) VALUES ('$matricula', '$grupo', '1')";
$resultado=$conexion->query($query);
if(!$resultado){
	echo "<script>alert(\"La matricula $matricula no se pudo registrar\");</script>";
}

//echo "$matricula $grupo <BR>";
}


 ?>