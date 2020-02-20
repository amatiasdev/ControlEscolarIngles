<?php 
require 'conexion.php';
session_start();
if(isset($_SESSION['seleccionarGrupo2'])){

$grupo=$_SESSION['grupo'];
$cerrarInscripcion="UPDATE `ingles_tesi`.`grupos` SET `inscribiendo`='0' WHERE `idgrupo`='$grupo'";
$resultado=$conexion->query($cerrarInscripcion);
session_destroy();
session_start();
$_SESSION['valida']=TRUE;
echo "<script>window.location.href=\"index\";</script>";
}else{
		echo "<script>window.location.href=\"index\";</script>";
	} 
 ?>