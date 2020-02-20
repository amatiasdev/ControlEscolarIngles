<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="fonts/style.css">
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<title>Registrar grupo</title>
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
<form action="insertarGrupoBD" method="POST">
<p>Agregar un nuevo Grupo:</p>
<p><input type="text" name="nivel" placeholder="Nivel" required class="caja"></p>
<p><select name="horario" required>
	<option value="">Seleccione un horario:</option>
	<option value="MATUTINO">MATUTINO 11:00-13:00 HRS.</option>
	<option value="INTERMEDIO">INTERMEDIO 13:00-15:00 HRS.</option>
	<option value="VESPERTINO">VESPERTINO 15:00-17:00 HRS.</option>
	<option value="SABATINO MATUTINO">SABATINO MATUTINO 08:00-16:00 HRS.</option>
	<option value="SABATINO VESPERTINO">SABATINO VESPERTINO 16:00-20:00 HRS.</option>
	<option value="INTERSEMESTRAL">INTERSEMESTRAL 08:00-12:00 HRS.</option>
</select></p>
<p>Grupo:<select name="grupo" required>
	<option>A</option>
	<option>B</option>
	<option>C</option>
</select></p>
<p><input type="text" name="salon" placeholder="Salon" required class="caja"></p>
<p><input type="text" name="periodo" placeholder="Periodo" required class="caja"></p>
<p>Teacher: <select name="profe" required>
<?php 
include 'conexion.php';
$peticion="SELECT count(idprofesores) FROM profesores WHERE profeActivo=1";
$respuesta=$conexion->query($peticion);

$query="SELECT idprofesores,nombres,apellido_paterno FROM profesores WHERE profeActivo=1";
$resultado=$conexion->query($query);
$row=$respuesta->fetch_assoc();
if($row['count(idprofesores)']==0){
		?>
		<option value="">NO TIENE A NINGUN TEACHER REGISTRADO</option>
		<?php 
		}else{
		?>
		<option value="">Seleccione al profesor responsable del grupo</option>
		<?php 
		while ($fila=$resultado->fetch_assoc()){
		
		?>
		
		<option value="<?php echo $fila['idprofesores']; ?>"> <?php echo $fila['nombres']." ".$fila['apellido_paterno']; ?></option>
		<?php
	}
}
session_start();
$_SESSION['crearGrupos']=TRUE;

?>
</select></p>
<p><input type="submit" name="btnCrearGrupos" value="Registrar Grupo" class="boton"></p>
</form>
</div>
<footer>
<center>
	  <p>Desarrollado por:Aldo Matias Contacto: aldo_rheazyk@hotmail.com</p>
</center>

</footer> 
</body>
</html>