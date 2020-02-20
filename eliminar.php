<?php 
include 'conexion.php';
session_start();
if(isset($_SESSION['paginaAlumno3'])){
$matricula=$_POST['matricula'];

$query="DELETE FROM `ingles_tesi`.`alumnos` WHERE `matricula`='$matricula';";
$query2="DELETE FROM `ingles_tesi`.`alumnos_has_grupos` WHERE Alumnos_matricula='$matricula'";
$query3="DELETE FROM `ingles_tesi`.`evaluacion` WHERE `Alumnos_matriculaEv`='$matricula'";

$resultado=$conexion->query($query);
$resultado=$conexion->query($query2);
$resultado=$conexion->query($query3);
echo "<script>alert(\"Alumno Eliminado\");
window.location.href=\"index\";
</script>";
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
 ?>