<?php 
session_start();
if(isset($_SESSION['valida'])){

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
<form action="constanciasEmitidas" class="constancias" method="POST">

				<p>Nivel:<select name="nivelIngles" required>
					<option value="">Seleccione el nivel</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
				</select></p>
				<p>Periodo: 
				<select class="periodo" name="periodo" required>
				<option value="">Seleccione un periodo</option>
				<?php 
							require 'conexion.php';
							$periodo="SELECT periodo FROM grupos GROUP BY periodo";
							$respuestaPeriodo=$conexion->query($periodo);
							while ($filasPeriodos=$respuestaPeriodo->fetch_assoc()) {
								?>
								<option><?php echo $filasPeriodos['periodo']; ?> </option>
								<?php 
							}
					?>	
				</select></p>
				<input type="submit" name="btnconstancias" value="Consultar" class="boton">
				<?php 

$_SESSION['constancias']=TRUE;

 ?>
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
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>