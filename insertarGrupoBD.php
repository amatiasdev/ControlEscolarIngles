<?php 
session_start();
if(isset($_SESSION['crearGrupos'])){
include 'conexion.php';

$nivel=trim(strtoupper($_POST['nivel']));
$horario=trim(strtoupper($_POST['horario']));
$grupo=trim(strtoupper($_POST['grupo']));
$salon=trim(strtoupper($_POST['salon']));
$periodo=trim(strtoupper($_POST['periodo']));
$teacher=trim(strtoupper($_POST['profe']));

$peticion="INSERT INTO `ingles_tesi`.`grupos` (`grupo`, `nivel`, `periodo`, `horario`, `salon`, `idprofesor`, `inscribiendo`, `activo`) VALUES ('$grupo', '$nivel', '$periodo', '$horario', '$salon', '$teacher', '1', '1')";
$resultado=$conexion->query($peticion);
echo "<script>alert(\"Se ha registrado al grupo corectamente.\");
window.location.href=\"index\";
</script>";
}else{
		echo "<script>window.location.href=\"index\";</script>";
	} 

 ?>