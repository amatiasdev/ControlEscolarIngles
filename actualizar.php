<?php 
session_start();
if(isset($_SESSION['paginaAlumno3'])){

$camposModificar="";
	$matricula=$_POST['matricula'];
	$nombre=strtoupper($_POST['nombre']);
	$apaterno=strtoupper($_POST['apaterno']);
	$amaterno=strtoupper($_POST['amaterno']);
	$nacimiento=strtoupper($_POST['nacimiento']);
	$telefono=strtoupper($_POST['telefono']);
	$sexo=strtoupper($_POST['sexo']);
	$email=$_POST['email'];
	$direccion=strtoupper($_POST['direccion']);
	$carrera=$_POST['carrera'];
	$semestre=strtoupper($_POST['semestre']);
	$grupocarr=strtoupper($_POST['grupocarr']);
	$ultimo_nivel_ingles=$_POST['nivelIngles'];


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

	$modificarNombre=FALSE;
	$modificarpaterno=FALSE;
	$modificarmaterno=FALSE;
	$modificarnac=FALSE;

	$modificarptel=FALSE;
	$modificarsexo=FALSE;
	$modificarmail=FALSE;
	$modificardire=FALSE;
	$modificarcar=FALSE;

	$modificarsem=FALSE;

	$modificargrup=FALSE;
	$modificarnivel=FALSE;

if(!empty($nombre)){
	$camposModificar.=" Nombre,";

	$modificarNombre=TRUE;
}
if(!empty($apaterno)){
	$camposModificar.=" Apellido Paterno,";
	$modificarpaterno=TRUE;
}
if(!empty($amaterno)){
	$camposModificar.=" Apellido Materno,";
	$modificarmaterno=TRUE;
}
if(!empty($nacimiento)){
	$camposModificar.=" Fecha de nacimiento,";
	$modificarnac=TRUE;
}
if(!empty($telefono)){
	$camposModificar.=" Telefono,";
	$modificarptel=TRUE;
}
if(!empty($sexo)){
	$camposModificar.=" Sexo,";
	$modificarsexo=TRUE;
}
if(!empty($email)){
	$camposModificar.=" e-mail,";
	$modificarmail=TRUE;
}
if(!empty($direccion)){
	$camposModificar.=" Direccion,";
	$modificardire=TRUE;
}
if(!empty($carrera)){
	$camposModificar.=" Carrera,";
	$modificarcar=TRUE;
}
if(!empty($semestre)){
	$camposModificar.=" Semestre,";
	$modificarsem=TRUE;
}
if(!empty($grupocarr)){
	$camposModificar.=" Grupo,";
	$modificargrup=TRUE;
}
if(!empty($ultimo_nivel_ingles)|| $ultimo_nivel_ingles==0){
	$camposModificar.=" Ultimo Nivel de ingles,";
	$modificarnivel=TRUE;
}
if(empty($camposModificar)){
	echo "<script type=\"text/javascript\">alert(\"No se modificara ningun dato del alumno\");</script>";
}else {
	
			include 'conexion.php';
			if($modificarNombre){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `nombres`='$nombre' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarpaterno){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `apellido_paterno`='$apaterno' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarmaterno){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `apellido_materno`='$amaterno' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarnac){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `fecha_nacimiento`='$nacimiento' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarptel){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `telefono`='$telefono' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarsexo){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `sexo`='$sexo' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarmail){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `correo`='$email' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificardire){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `direccion`='$direccion' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarcar){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `carrera`='$carrera' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarsem){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `semestre`='$semestre' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificargrup){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `grupo_carrera`='$grupocarr' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}
			if($modificarnivel){
				$query="UPDATE `ingles_tesi`.`alumnos` SET `ultimo_nivel_ingles`='$ultimo_nivel_ingles' WHERE `matricula`='$matricula';";
				$resultado=$conexion->query($query);
			}

			echo "<script type=\"text/javascript\">
			alert(\"Los datos han sido modificados\");
			window.location.href = \"index\";</script>";

	}
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>