<?php
	include("conexion.php");
	require '../Classes/PHPExcel/IOFactory.php';
	require 'conexion.php';

//	session_start();
//if(isset($_SESSION['registroAlumnos'])){

	$noregistrados=0;
	$registrados=0;
	$nombreArchivo="C:\REGISTRAR.xlsx";

	$objPHPExcel=PHPEXCEL_IOFactory::load($nombreArchivo);
	$objPHPExcel->setActiveSheetIndex(0);
	$numRows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	for ($i=10; $i <351; $i++){		
		$apaterno=$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$amaterno=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$nombre=$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$matricula=$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$ultimo_nivel_ingles=$objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();	
	
	$nacimiento="1900/01/01";
	$telefono="";
	$sexo="H";
	$email="";
	$direccion="";
	$semestre="";
	$grupocarr="";	
	$carrera="ADMON";
	$ultimo_nivel_ingles=$ultimo_nivel_ingles-1;


	$existeAlumno="SELECT count(*) FROM alumnos WHERE matricula='$matricula'";
	$respuestaExisteAlumno=$conexion->query($existeAlumno);
	$resultado=$respuestaExisteAlumno->fetch_assoc();
	if($resultado['count(*)']==0){
		
		
		$query="INSERT INTO `alumnos` (`matricula`, `nombres`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `telefono`, `sexo`, `correo`, `direccion`, `carrera`, `semestre`, `grupo_carrera`, `ultimo_nivel_ingles`) VALUES ('$matricula', '$nombre', '$apaterno', '$amaterno', '$nacimiento', '$telefono', '$sexo', '$email', '$direccion', '$carrera', '$semestre', '$grupocarr', '$ultimo_nivel_ingles')";
		$resultado=$conexion->query($query);
		if($resultado){
			echo "$matricula EXITOSO <br>";
			
		}else{
			echo "$matricula FALLO <br>"; 
		}

	}else{
		echo "$matricula ESTABA <br>";
		
	}
	} 

		
//ISSET}
?>