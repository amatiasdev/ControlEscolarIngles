<?php 
session_start();

if(isset($_SESSION['constancias'])){

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Constancias</title>
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="fonts/style.css">
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>

</head>
<body>
<div class="header"><a href="index" class="icon-home">Inicio</a>English TESI<a href="cerrarSesion" class="cerrarSesion">Cerrar Sesion</a></div>

<div class="menu-prin">
	<ul class="menu">
	<li><a href="#">Alumnos</a>
	<ul>
		<li><a href="alumno">Información</a></li>
		<li><a href="registroAlumnos">Registro</a></li>
	</ul>
	</li>

	<li><a href="#">Grupos</a>
		<ul>
			<li><a href="seleccionarGrupo">Información del Grupo</a></li>
			<li><a href="crearGrupos">Agregar nuevo Grupo</a></li>
		</ul>
	</li>

	<li><a href="#">Profesores</a>
	<ul>
		<li><a href="infoProfe">Información Profesor</a></li>
		<li><a href="registrarProfe">Registrar Profesor</a></li>
		<li><a href="subirCalificacionesGrupo">Subir Calificaciones</a></li>

	</ul>
	</li>
	<li><a href="reportes">Reportes</a></li>
	<li><a href="#">Constancias</a>
	<ul>
		
		<li><a href="registrarConstancia">Registrar Constancia</a></li>
		<li><a href="constancias">TESI</a></li>
		<li><a href="constanciasOtraInstitucion">Otra Institucion</a></li>
	</ul>
	</li>
	</ul>
</div>
<div class="contenido">
<form>
<?php 
require 'conexion.php';

$nivel=$_POST['nivelIngles'];
$periodo=$_POST['periodo'];



$hombresAprobados=0;
$mujeresAprobadas=0;
$hombresReprobados=0;
$mujeresReprobadas=0;

$constanciasEmitidas="SELECT hombresAprobados FROM grupos WHERE nivel=$nivel and periodo='$periodo'";
$resultadoConstancias=$conexion->query($constanciasEmitidas);
while ($filasConstanciasEmitidas=$resultadoConstancias->fetch_assoc()) {
	$hombresAprobados+=$filasConstanciasEmitidas['hombresAprobados'];
}

$constanciasEmitidas="SELECT mujeresAprobadas FROM grupos WHERE nivel=$nivel and periodo='$periodo'";
$resultadoConstancias=$conexion->query($constanciasEmitidas);
while ($filasConstanciasEmitidas=$resultadoConstancias->fetch_assoc()) {
	$mujeresAprobadas+=$filasConstanciasEmitidas['mujeresAprobadas'];
}

$constanciasEmitidas="SELECT hombresReprobados FROM grupos WHERE nivel=$nivel and periodo='$periodo'";
$resultadoConstancias=$conexion->query($constanciasEmitidas);
while ($filasConstanciasEmitidas=$resultadoConstancias->fetch_assoc()) {
	$hombresReprobados+=$filasConstanciasEmitidas['hombresReprobados'];
}

$constanciasEmitidas="SELECT mujeresReprobadas FROM grupos WHERE nivel=$nivel and periodo='$periodo'";
$resultadoConstancias=$conexion->query($constanciasEmitidas);
while ($filasConstanciasEmitidas=$resultadoConstancias->fetch_assoc()) {
	$mujeresReprobadas+=$filasConstanciasEmitidas['mujeresReprobadas'];
}


 ?>
 <table>
 	<tbody>
 		<thead>
 			<th colspan="5">Constancias Emitidas del Nivel: <?php echo $nivel; ?> Periodo: <?php echo $periodo; ?></th>
 		</thead>
 		<thead>
 			<th>Género</th>
 			<th colspan="2">Aprobados</th>
 			<th colspan="2">Reprobados</th>
 		</thead>
 		<tr>
 			<td>Hombres</td>
 			<td colspan="2"><?php echo $hombresAprobados; ?></td>
 			<td colspan="2"><?php echo $hombresReprobados;?></td>
 		</tr>
 		<tr>
 			<td>Mujeres</td>
 			<td colspan="2"><?php echo $mujeresAprobadas; ?></td>
 			<td colspan="2"><?php echo $mujeresReprobadas; ?></td>
 		</tr>
 		<tr>
 			<td>Total</td>
 			<td colspan="2"><?php echo $hombresAprobados+$mujeresAprobadas; ?></td>
 			<td colspan="2"><?php echo $mujeresReprobadas+$hombresReprobados; ?></td>

 		</tr>
 		
 	</tbody>
 </table>
 
</form>	
</div>
<footer>
<center>
	  <p>Desarrollado por:Aldo Matias Contacto: aldo_rheazyk@hotmail.com</p>
</center>

</footer> 
</body>
</html>
<?php 
session_destroy();
session_start();
$_SESSION['valida']=TRUE;
}else{
	echo "<script>window.location.href=\"index\";</script>";
}

 ?>