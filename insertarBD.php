<?php
	include("conexion.php");

	session_start();
if(isset($_SESSION['registroAlumnos'])){
	
	
	$nombre=trim(mb_strtoupper($_POST['nombre']));
	$apaterno=trim(mb_strtoupper($_POST['apaterno']));
	$amaterno=trim(mb_strtoupper($_POST['amaterno']));
	$nacimiento=trim(mb_strtoupper($_POST['nacimiento']));
	$telefono=trim(mb_strtoupper($_POST['telefono']));
	$sexo=trim(mb_strtoupper($_POST['sexo']));
	$email=trim($_POST['email']);
	$direccion=trim(mb_strtoupper($_POST['direccion']));
	$ultimo_nivel_ingles=trim($_POST['nivelIngles']);


	if (empty($_POST['nacimiento'])) {
		$nacimiento="1900/01/01";
	}
	
	if($ultimo_nivel_ingles=="Nuevo Ingreso"){
		$ultimo_nivel_ingles=0;
	}

if($_POST['interno']=="no"){
	$principioMatricula="F".idate("Y").idate("m").idate("d");
	$query="SELECT count(*) FROM alumnos WHERE matricula LIKE '$principioMatricula%';
 ";
$resultado=$conexion->query($query);
$numeroAlumno;
$alumnoInterno=TRUE;
while ($fila=$resultado->fetch_assoc()){
	$numeroAlumno=1+$fila['count(*)'];

}
$matricula = "F".idate("Y").idate("m").idate("d").$numeroAlumno;

$query="INSERT INTO `ingles_tesi`.`alumnos` (`matricula`, `nombres`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `telefono`, `sexo`, `correo`, `direccion`, `ultimo_nivel_ingles`) VALUES ('$matricula', '$nombre', '$apaterno', '$amaterno', '$nacimiento', '$telefono', '$sexo', '$email', '$direccion', '$ultimo_nivel_ingles')";
}else{
	$matricula=strtoupper($_POST['matricula']);
	$carrera=$_POST['carrera'];
	$semestre=strtoupper($_POST['semestre']);
	$grupocarr=strtoupper($_POST['grupocarr']);
	$alumnoInterno=FALSE;
	if($carrera=='Ing. Sistemas Computacionales'){
	$carrera="ISC";
	}elseif ($carrera=="Ing. Electronica") {
		$carrera="ELEC";
	}elseif ($carrera=="Ing. Biomedica") {
		$carrera="BIO";
	}elseif ($carrera=="Ing. Ambiental") {
		$carrera="AMB";
	}elseif ($carrera=="Lic. Administración") {
		$carrera="ADMON";
	}elseif ($carrera=="Arquitectura") {
		$carrera="ARQ";
	}elseif($carrera=="Ing. Informatica"){
		$carrera="INFO";
	}


	$existeAlumno="SELECT count(*) FROM alumnos WHERE matricula='$matricula'";
	$respuestaExisteAlumno=$conexion->query($existeAlumno);
	$resultado=$respuestaExisteAlumno->fetch_assoc();
	if($resultado['count(*)']==0){
		$query="INSERT INTO `alumnos` (`matricula`, `nombres`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `telefono`, `sexo`, `correo`, `direccion`, `carrera`, `semestre`, `grupo_carrera`, `ultimo_nivel_ingles`) VALUES ('$matricula', '$nombre', '$apaterno', '$amaterno', '$nacimiento', '$telefono', '$sexo', '$email', '$direccion', '$carrera', '$semestre', '$grupocarr', '$ultimo_nivel_ingles')";
		$resultado=$conexion->query($query);
		if($resultado){
			echo "<script type=\"text/javascript\">alert(\"El alumno ha sido guardado exitosamente en la Base de datos\");</script>";
			if($alumnoInterno){
			echo "<script type=\"text/javascript\">alert(\"La matricula asignada al alumno es la siguiente: $matricula\");</script>";
			}
			echo "<script type=\"text/javascript\">window.location=\"index\"</script>";
		}else{
			echo "El usuario no se pudo crear, vuelva a intentarlo"; 
		}
	}else{
		echo "<script>alert(\"Este Alumno ya ha sido registrado Anteriormente\");
		window.location.href=\"index\";
		</script>";
	}
}		
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>