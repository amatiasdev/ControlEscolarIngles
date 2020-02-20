<?php 

require 'conexion.php';

	$matricula=trim($_POST['matricula']);
	$nombre=trim(strtoupper($_POST['nombre']));
	$apaterno=trim(strtoupper($_POST['apaterno']));
	$amaterno=trim(strtoupper($_POST['amaterno']));
	$email=trim($_POST['email']);
	$telefono=trim(strtoupper($_POST['telefono']));
	$carrera=$_POST['carrera'];
	$nivel=trim(strtoupper($_POST['nivel']));
	$sexo=trim(strtoupper($_POST['sexo']));
	$institucion=trim(strtoupper($_POST['institucion']));


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
$fechaRegistro=date("F").",".date("y");

$insertarAlumno="INSERT INTO `ingles_tesi`.`constanciasexternas` (`matricula`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `sexo`, `carrera`, `institucion`, `nivel`, `fechaRegistro`, `email`, `telefono`) VALUES ('$matricula', '$nombre', '$apaterno', '$amaterno', '$sexo', '$carrera', '$institucion', '$nivel', '$fechaRegistro', '$email', '$telefono')";
$insertarBD=$conexion->query($insertarAlumno);
echo "<script>window.location.href=\"index\";</script>";

 ?>