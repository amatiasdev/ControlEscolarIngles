<?php 
session_start();
if(isset($_SESSION['otraEscuela'])){

	?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>MENU</title>	
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
				$fechaRegistro=$_POST['periodo'];
				$numeroHombres="SELECT count(*) FROM constanciasexternas WHERE fechaRegistro='$fechaRegistro' and sexo='H'";
				$resultadoHombres=$conexion->query($numeroHombres);
				$filaHombres=$resultadoHombres->fetch_assoc();
				$hombres=$filaHombres['count(*)'];
				$numeroMujeres="SELECT count(*) FROM constanciasexternas WHERE fechaRegistro='$fechaRegistro' and sexo='M'";
				$resultadoMujeres=$conexion->query($numeroMujeres);
				$filaMujeres=$resultadoMujeres->fetch_assoc();
				$mujeres=$filaMujeres['count(*)'];

			 ?>
		<center >
			<table>
				<tbody>
					<thead>
						<th colspan="3">Constancias Emitidas Por Otra Institución</th>
					</thead>
					<thead>
						<th>Género</th>
						<th>Num. Alumnos</th>
					</thead>
					<tr>
						<td align="center">Hombres</td>
						<td align="center"><?php echo $hombres; ?></td>
					</tr>
					<tr>
						<td align="center">Mujeres</td>
						<td align="center"><?php echo $mujeres; ?></td>
					</tr>
					<tr>
						<td align="center">Total</td>
						<td align="center"><?php echo $hombres+$mujeres; ?></td>
					</tr>
				</tbody>
			</table>
			
		</center>
		</form>
</div>
</body>
</html>
<?php 
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>