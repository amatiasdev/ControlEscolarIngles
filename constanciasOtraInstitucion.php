<?php 
session_start();
if(isset($_SESSION['valida'])){

	?>
<!DOCTYPE html>
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
		<form action="constanciasEotraInstitucion" method="POST">
		<center >
			<?php 
			require 'conexion.php';
			$consultaMeses="SELECT fechaRegistro FROM constanciasexternas GROUP BY fechaRegistro";
			$resultadoMeses=$conexion->query($consultaMeses);
			 ?>
			<select name="periodo" required>
				<option value="">Seleccione un Mes</option>
				<?php 
				while ($filasMeses=$resultadoMeses->fetch_assoc()) {
					?>
				<option><?php echo $filasMeses['fechaRegistro']; ?></option>
				<?php 
				}

			 ?>
			</select>
			<p><input type="submit" name="btn" value="Consultar" class="boton"></p>
			
			
		</center>
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
$_SESSION['otraEscuela']=TRUE;
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>