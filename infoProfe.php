<!DOCTYPE html>
<html>
<head>
	<title>Información del Profesor</title>
	<meta charset="utf-8">
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
<form action="datosProfes" method="POST">
	
Profesor(a): <select name="profe" required>
<option value="">Seleccione a un profesor</option>
<?php 
include 'conexion.php';
$peticion="SELECT count(idprofesores) FROM profesores WHERE profeActivo=1";
$respuesta=$conexion->query($peticion);

$query="SELECT idprofesores,nombres,apellido_paterno, apellido_materno FROM profesores WHERE profeActivo=1";
$resultado=$conexion->query($query);
$row=$respuesta->fetch_assoc();
if($row['count(idprofesores)']==0){
		?>
		<option>NO TIENE A NINGUN TEACHER REGISTRADO</option>
		<?php 
		}else{
		while ($fila=$resultado->fetch_assoc()){
		
		?>
		<option value="<?php echo $fila['idprofesores']; ?>"> <?php echo $fila['nombres']." ".$fila['apellido_paterno']." ".$fila['apellido_materno']; ?></option>
		<?php
	}
}
?>
 </select>
 	<p><input type="submit" name="btn" value="Enviar" class="boton"></p>
	
</form>

</div>
<?php 

session_start();
$_SESSION['infoProfe']=TRUE;
 ?>

<footer>
<center>
	  <p>Desarrollado por:Aldo Matias Contacto: aldo_rheazyk@hotmail.com</p>
</center>

</footer> 
</body>
</html>