<?php 

include 'conexion.php';

session_start();
$grupoProfe=explode(",", $_POST['nuevoGrupo']);
$matricula=$_SESSION['matricula'];
$grupo=$grupoProfe[0];
$nivel=$grupoProfe[1];


$checarRecurse="SELECT count(Alumnos_matriculaEv) FROM evaluacion WHERE Alumnos_matriculaEv='$matricula' and nivelActual=$nivel";
$respuesta=$conexion->query($checarRecurse);
$recurse=$respuesta->fetch_assoc();

if($recurse['count(Alumnos_matriculaEv)']>0){
	$eliminar="DELETE FROM `ingles_tesi`.`evaluacion` WHERE `Alumnos_matriculaEv`='$matricula' and nivelActual=$nivel";
	$resultado=$conexion->query($eliminar);
	$eliminarGrupoAlumno="DELETE FROM `ingles_tesi`.`alumnos_has_grupos` WHERE `Alumnos_matricula`='$matricula'";
	$resultado=$conexion->query($eliminarGrupoAlumno);
}	

	$query="INSERT INTO `ingles_tesi`.`alumnos_has_grupos` (`Alumnos_matricula`, `grupos_idgrupo`, `inscrito`) VALUES ('$matricula', '$grupo', '1')";
	$resultado=$conexion->query($query);


session_destroy();

echo "<script>
alert(\"El alumno se inscribio correctamente\");
window.location.href=\"index\"</script>";



 ?>