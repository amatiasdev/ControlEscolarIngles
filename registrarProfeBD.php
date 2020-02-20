<?php 
session_start();
if(isset($_SESSION['registrarProfe'])){
require 'conexion.php';

$nombres=trim(strtoupper($_POST['nombre']));
$apaterno=trim(strtoupper($_POST['apaterno']));
$amaterno=trim(strtoupper($_POST['amaterno']));
$mail=trim($_POST['mail']);
$cel=trim($_POST['cel']);

$query="INSERT INTO `ingles_tesi`.`profesores` (`nombres`, `apellido_paterno`, `apellido_materno`, `correo`, `telefono`, `profeActivo`) VALUES ('$nombres', '$apaterno', '$amaterno', '$mail', '$cel', '1');
";
$resultado=$conexion->query($query);
echo "<script>alert(\"Los datos han sido guardados correctamente\");
	window.location.href=\"index\";
</script>";
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>