<?php 

require 'Classes/PHPExcel/IOFactory.php';
require 'conexion.php';
calificarA();



function calificarA(){
require 'conexion.php';

//$ruta=$_POST['ruta'];

$hoja=0;

//$nombreArchivo='C:\\'.$ruta;

/*======TEMPORAL*/
$nombreArchivo='C:\CONSTANCIAS.xlsx';

/*======TEMPORAL*/


$objPHPExcel=PHPEXCEL_IOFactory::load($nombreArchivo);
$objPHPExcel->setActiveSheetIndex($hoja); 


$numRows=$objPHPExcel->setActiveSheetIndex($hoja)->getHighestRow();


$num=10;
$i=1;
while ($i!=0) {
 	$matricula=$objPHPExcel->getActiveSheet()->getCell('C'.$num)->getCalculatedValue();
	echo $matricula;
	if ($matricula!="") {
		$query="SELECT count(*) FROM ingles_tesi.alumnos where matricula='$matricula'";
	$resultado=$conexion->query($query);
	$existeAlumno=$resultado->fetch_assoc();
	if ($existeAlumno['count(*)']=="0") {
	 	echo "NO ESTA REGISTRADO"."<br>";

	 	$query="INSERT INTO `alumnos` (`matricula`, `nombres`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `telefono`, `sexo`, `correo`, `direccion`, `carrera`, `semestre`, `grupo_carrera`, `ultimo_nivel_ingles`) VALUES ('$matricula', '$nombre', '$apaterno', '$amaterno', '1900-01-01', '', '', '', '', '$carrera', '', '', '$ultimo_nivel_ingles')";
		$resultado=$conexion->query($query);


	 }else{
	 	echo "SE SUBIO LA CALIFICACION"."<br>";
	 }
	}else{
		$i=0;
	}
	$num++;

	
 } 
	
	


	/*$query="INSERT INTO `ingles_tesi`.`evaluacion` (`calificacion`, `parcial`, `Alumnos_matriculaEv`, `nivelActual`, `idGrupoEv`, `enCurso`) VALUES ('$calificacion', '$parcial', '$matricula', '$nivel', '$grupo','1')";

	$resultado=$conexion->query($query);*/
	

	echo "<script>alert(\"Se subieron correctamente las calificaciones\");";
}


 ?>