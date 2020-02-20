<?php 

require 'Classes/PHPExcel/IOFactory.php';
require 'conexion.php';
session_start();
if(isset($_SESSION['subir'])){
	
$ruta=$_POST['ruta'];

$grupoProfe=explode(",", $_POST['grupo']);
$grupo=$grupoProfe[0];
$parcial=$_POST['parcial'];
$nivel=$grupoProfe[1];
$hoja=$parcial-1;


$parciales="SELECT count(parcial) FROM evaluacion WHERE idGrupoEv=$grupo";
$resultadoParciales=$conexion->query($parciales);
$parcialUNO_ACTIVO=$resultadoParciales->fetch_assoc();

if($parcialUNO_ACTIVO['count(parcial)']>0){
	$queryNiveles="SELECT parcial FROM evaluacion WHERE idGrupoEv=$grupo group by parcial";

	$respuesta=$conexion->query($queryNiveles);




	while ($niveles=$respuesta->fetch_assoc()) {
		$ultimoParcial=$niveles['parcial'];
	}

	if($ultimoParcial+1==2 && $parcial==2){
		calificar();
		
	}else if($ultimoParcial+1==3 && $parcial==3){
		calificar();

	}else{
		echo "<script>alert(\"ASEGURATE DE HABER SELECCIONADO EL PARCIAL CORRECTO\");
		window.location.href=\"subirCalificacionesGrupo\";
		</script>";
	}
}else{
	if($parcial==1){
		calificar();
	}else{

		echo "<script>alert(\"NO HAS CALIFICADO EL PARCIAL UNO\");
		window.location.href=\"subirCalificacionesGrupo\";
		</script>";


	}
}
}else{
	echo "<script>
	window.location.href=\"index\";</script>";
}



function calificar(){
require 'conexion.php';

$ruta=$_POST['ruta'];

$grupoProfe=explode(",", $_POST['grupo']);
$grupo=$grupoProfe[0];
$parcial=$_POST['parcial'];
$nivel=$grupoProfe[1];
$hoja=$parcial-1;

$nombreArchivo='C:\\'.$ruta;


$objPHPExcel=PHPEXCEL_IOFactory::load($nombreArchivo);
$objPHPExcel->setActiveSheetIndex($hoja); 

$numRows=$objPHPExcel->setActiveSheetIndex($hoja)->getHighestRow();
$query="SELECT count(Alumnos_matricula) FROM alumnos_has_grupos WHERE grupos_idgrupo=$grupo and inscrito=1";
$resultado=$conexion->query($query);
$numeroAlumnos=$resultado->fetch_assoc();
for ($i=11; $i <$numeroAlumnos['count(Alumnos_matricula)']+11 ; $i++) { 
	$calificacion=$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();

	if($calificacion=="NP"){
		$calificacion=0;
	}
	$matricula=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	$query="INSERT INTO `ingles_tesi`.`evaluacion` (`calificacion`, `parcial`, `Alumnos_matriculaEv`, `nivelActual`, `idGrupoEv`, `enCurso`) VALUES ('$calificacion', '$parcial', '$matricula', '$nivel', '$grupo','1')
";

	$resultado=$conexion->query($query);
	

	echo "<script>alert(\"Se subieron correctamente las calificaciones\");

	window.location.href=\"index\";</script>";
}
}


 ?>