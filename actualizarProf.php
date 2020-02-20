<?php 
session_start();

if(isset($_SESSION['datosProfe'])){
	$profe=$_SESSION['idProfe'];
	$camposModificar="";
	$modificarNombre=FALSE;
	$modificarpaterno=FALSE;
	$modificarmaterno=FALSE;
	$modificarnac=FALSE;
	$modificarptel=FALSE;
	$modificarmail=FALSE;
	$nombre=strtoupper($_POST['nombre']);
	$apaterno=strtoupper($_POST['apaterno']);
	$amaterno=strtoupper($_POST['amaterno']);
	$telefono=strtoupper($_POST['telefono']);
	$email=$_POST['email'];

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
if(!empty($telefono)){
	$camposModificar.=" Telefono,";
	$modificarptel=TRUE;
}
if(!empty($email)){
	$camposModificar.=" e-mail,";
	$modificarmail=TRUE;
}
	if(empty($camposModificar)){
		echo "<script type=\"text/javascript\">alert(\"No se modificara ningun dato del alumno\");</script>";
	}else{
		include 'conexion.php';
			if($modificarNombre){
				$query="UPDATE `ingles_tesi`.`profesores` SET `nombres`='$nombre' WHERE `idprofesores`='$profe';";
				$resultado=$conexion->query($query);
			}
			if($modificarpaterno){
				$query="UPDATE `ingles_tesi`.`profesores` SET `apellido_paterno`='$apaterno' WHERE `idprofesores`='$profe';";
				$resultado=$conexion->query($query);
			}
			if($modificarmaterno){
				$query="UPDATE `ingles_tesi`.`profesores` SET `apellido_materno`='$amaterno' WHERE `idprofesores`='$profe';";
				$resultado=$conexion->query($query);
			}
			if($modificarptel){
				$query="UPDATE `ingles_tesi`.`profesores` SET `telefono`='$telefono' WHERE `idprofesores`='$profe';";
				$resultado=$conexion->query($query);
			}
			if($modificarmail){
				$query="UPDATE `ingles_tesi`.`profesores` SET `correo`='$email' WHERE `idprofesores`='$profe';";
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