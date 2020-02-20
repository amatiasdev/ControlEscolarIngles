<?php 
session_start();
if(isset($_SESSION['seleccionarGrupo2'])){

include 'plantillaModificar.php';
require 'conexion.php';


$grupo=$_SESSION['grupo'];
$profe=$_SESSION['profe'];

$query="SELECT idgrupo, nivel, grupo, periodo, horario, nombres, apellido_paterno, apellido_materno FROM grupos, profesores WHERE idgrupo=$grupo and idprofesores=$profe and activo=1";
	

$resultado=$conexion->query($query);
$fila=$resultado->fetch_assoc();
$nombreArchivo="NIVEL ".$fila['nivel']." GRUPO ".$fila['grupo']." HORARIO ".$fila['horario']." PROFESOR ".$fila['nombres']." ".$fila['apellido_paterno']." ".$fila['apellido_materno'];


plantilla();

for ($i=0; $i <4 ; $i++) {
	$objPHPExcel->setActiveSheetIndex($i);

		$objPHPExcel->getActiveSheet()->SetCellValue('B7',$fila['grupo']);
		$objPHPExcel->getActiveSheet()->SetCellValue('B8',$fila['nombres']." ".$fila['apellido_paterno']." ".$fila['apellido_materno']);
		$objPHPExcel->getActiveSheet()->SetCellValue('G7',$fila['nivel']);
		if($fila['horario']=="MATUTINO"){
			$fila['horario']="11:00-13:00 HRS.";
		}elseif ($fila['horario']=="INTERMEDIO") {
			$fila['horario']="13:00-15:00 HRS.";
		}elseif ($fila['horario']=="VESPERTINO") {
			$fila['horario']="15:00-17:00 HRS.";
		}elseif ($fila['horario']=="SABATINO MATUTINO") {
			$fila['horario']="08:00-16:00 HRS.";
		}elseif ($fila['horario']=="SABATINO VESPERTINO") {
			$fila['horario']="16:00-20:00 HRS.";
		}elseif ($fila['horario']=="INTERSEMESTRAL") {
			$fila['horario']="08:00-12:00 HRS.";
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('G8',$fila['horario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('G9',$fila['periodo']);
}
$profesorIngles=$fila['nombres']." ".$fila['apellido_paterno']." ".$fila['apellido_materno'];
$grupoIngles=$fila['nivel'].$fila['grupo'];
$nivelIngles=$fila['nivel'];
$horarioIngles=$fila['horario'];
$periodoIngles=$fila['periodo'];



$query="SELECT matricula, nombres, apellido_paterno, apellido_materno, nivel, carrera FROM alumnos, alumnos_has_grupos, grupos WHERE grupos_idgrupo=$grupo and idgrupo=grupos_idgrupo and matricula=Alumnos_matricula Order By apellido_paterno,apellido_materno,nombres";


$alumnos="SELECT count(matricula)FROM alumnos, alumnos_has_grupos, grupos WHERE grupos_idgrupo=$grupo and idgrupo=grupos_idgrupo and matricula=Alumnos_matricula";
$resultado_alumnos=$conexion->query($alumnos);
$numeroAlumnos=$resultado_alumnos->fetch_assoc();
$numeroAlumnosReal=$numeroAlumnos['count(matricula)'];

for ($i=0; $i <4 ; $i++) {
	
	$resultado=$conexion->query($query);
	$j=11;
	$numeroLista=1;
	while ($fila=$resultado->fetch_assoc()) {
			$objPHPExcel->setActiveSheetIndex($i);
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$j,$numeroLista);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$j,$fila['matricula']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$j,$fila['carrera']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$j,$fila['apellido_paterno']." ".$fila['apellido_materno']." ".$fila['nombres']);
			$objPHPExcel->setActiveSheetIndex(3);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$j,"=('Primer Parcial'!G".$j."+'Segundo Parcial'!G".$j."+'Tercer Parcial'!G".$j.")/3");
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$j,"='Primer Parcial'!G".$j);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$j,"='Segundo Parcial'!G".$j);			
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$j,"='Tercer Parcial'!G".$j);
		$numeroLista++;
	$j++;
	}
}
	$objPHPExcel->setActiveSheetIndex(3);
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.($j+2),"ELABORÓ: ".$profesorIngles." ______________________    REVISÓ: MTRA. JOSEFINA RAMÍREZ NAVA________________");

	$objWrite=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	$ruta='excel\\'.'EVALUACIONES '.$nombreArchivo.'.xlsx';
	$objWrite->save($ruta);
	

	lista();

	//LISTA DE ALUMNOS
	$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('D4',$profesorIngles);
		$objPHPExcel->getActiveSheet()->SetCellValue('D5',$grupoIngles);
		$objPHPExcel->getActiveSheet()->SetCellValue('H5',"NIVEL:".$nivelIngles);		
		$objPHPExcel->getActiveSheet()->SetCellValue('S5',"HORARIO:".$horarioIngles);
		$objPHPExcel->getActiveSheet()->SetCellValue('AH5',"PERIODO:".$periodoIngles);
		$j=10;
		$numeroLista=1;
		$resultado=$conexion->query($query);
		while ($fila=$resultado->fetch_assoc()) {

			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$j,$numeroLista);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$j,$fila['matricula']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$j,$fila['apellido_paterno']." ".$fila['apellido_materno']." ".$fila['nombres']);

			if($fila['carrera']=="ISC"){
				$fila['carrera']="ING.SISTEMAS";
			}else if($fila['carrera']=="ELEC"){
				$fila['carrera']="ING.ELECTRONICA";
			}else if($fila['carrera']=="BIO"){
				$fila['carrera']="ING.BIOMEDICA";
			}else if($fila['carrera']=="AMB"){
				$fila['carrera']="ING.AMBIENTAL";
			}else if($fila['carrera']=="ADMON"){
				$fila['carrera']="LIC.ADMINISTRACION";
			}else if($fila['carrera']=="ARQ"){
				$fila['carrera']="ARQUITECTURA";
			}else if($fila['carrera']=="INFO"){
				$fila['carrera']="ING.INFORMATICA";
			}
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$j,$fila['carrera']);
			$j++;
			$numeroLista++;
		}

$queryHombre="SELECT count(*) FROM alumnos_has_grupos, alumnos WHERE grupos_idgrupo=$grupo and sexo='H' and matricula=Alumnos_matricula";
$resultadoHombre=$conexion->query($queryHombre);
$filaHombres=$resultadoHombre->fetch_assoc();

			$objPHPExcel->getActiveSheet()->SetCellValue('AQ9',$filaHombres['count(*)']);

$queryHombre="SELECT count(*) FROM alumnos_has_grupos, alumnos WHERE grupos_idgrupo=$grupo and sexo='M' and matricula=Alumnos_matricula";
$resultadoHombre=$conexion->query($queryHombre);
$filaHombres=$resultadoHombre->fetch_assoc();

			$objPHPExcel->getActiveSheet()->SetCellValue('AR9',$filaHombres['count(*)']);

	$objWrite=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	$ruta='excel\\'.'LISTA '.$nombreArchivo.'.xlsx';
	$objWrite->save($ruta);

	session_destroy();
	session_start();
	$_SESSION['valida']=TRUE;
	echo "<script>window.location.href=\"index\";</script>";
}else{
			echo "<script>window.location.href=\"index\";</script>";

}
 ?>
