<?php 
include 'conexion.php';
session_start();
if(isset($_SESSION['datosProfe'])){
	$profe=$_SESSION['idProfe'];
	$query="UPDATE `ingles_tesi`.`profesores` SET `profeActivo`='0' WHERE `idprofesores`='$profe'";
$resultado=$conexion->query($query);
echo "<script>alert(\"Profesor Eliminado\");
window.location.href=\"index\";
</script>";

}else{
	echo "<script>window.location.href=\"index\";</script>";
}