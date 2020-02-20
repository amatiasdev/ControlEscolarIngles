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



<div class="cursos">

<div class="semestrales"><a class="semestral"  href="#">Terminar todos los cursos semestrales</a><br><br><br><h1>Semestrales</h1>

<?php 
require 'conexion.php';

$numeroGruposActivos="SELECT count(*) FROM grupos WHERE activo=1 and (horario='VESPERTINO' OR horario='MATUTINO' OR horario='INTERMEDIO')";
$respuestaNumeroGruposActivos=$conexion->query($numeroGruposActivos);
$filaNumeroGruposActivos=$respuestaNumeroGruposActivos->fetch_assoc();


if ($filaNumeroGruposActivos['count(*)']>=1) {
$gruposActivos="SELECT idgrupo FROM grupos WHERE activo=1 and (horario='VESPERTINO' OR horario='MATUTINO' OR horario='INTERMEDIO') ORDER BY nivel, grupo";
$respuestaGruposActivos=$conexion->query($gruposActivos);
while ($filaGruposActivos=$respuestaGruposActivos->fetch_assoc()) {
	$grupo=$filaGruposActivos['idgrupo'];

	$inscripcionesAbiertas="SELECT idgrupo, inscribiendo FROM grupos WHERE activo=1 and idgrupo=$grupo";
	$respuestaInscripcionesAbiertas=$conexion->query($inscripcionesAbiertas);
	while ($filaInscripcionesAbiertas=$respuestaInscripcionesAbiertas->fetch_assoc()) {
		echo "<br>";
		$infoGrupo="SELECT nivel, grupo, horario, salon,nombres, apellido_paterno, apellido_materno FROM grupos, profesores WHERE idprofesores=idprofesor and idgrupo=$grupo";
			$respuestaInfoGrupo=$conexion->query($infoGrupo);
			$filaInfoGrupo=$respuestaInfoGrupo->fetch_assoc();

			$numeroAlumnosInscritos="SELECT count(*) FROM alumnos_has_grupos WHERE inscrito=1 and grupos_idgrupo=$grupo";
			$resultadoNumeroAlumnos=$conexion->query($numeroAlumnosInscritos);
			$filaAlumnosInscritos=$resultadoNumeroAlumnos->fetch_assoc();
			$numeroAlumnosInscritosGrupo=$filaAlumnosInscritos['count(*)'];
			$nivel=$filaInfoGrupo['nivel'];
			$grupoActual=$filaInfoGrupo['grupo'];
			$horario=$filaInfoGrupo['horario'];
			$salon=$filaInfoGrupo['salon'];
			$profesor=$filaInfoGrupo['nombres']." ".$filaInfoGrupo['apellido_paterno']." ".$filaInfoGrupo['apellido_materno'];
		if($filaInscripcionesAbiertas['inscribiendo']==1){
			echo "<div style=\"width: 100%; height: 100%; border: 3px solid #009551; padding: 5px; background: #00A65A;color: #E6E6E6;\">NIVEL: <strong><i>$nivel</i></strong> GRUPO: <strong><i>$grupoActual</i></strong> <br>HORARIO: <strong><i> $horario </i></strong> SALON: <strong><i>$salon</i></strong> <br>PROFESOR: <strong><i>$profesor</i></strong> <br>ALUMNOS INSCRITOS: <strong><i>$numeroAlumnosInscritosGrupo</i></strong> </div>";
		}else{

		echo "<div style=\"width: 100%; height: 100%; border: 3px solid #C94435; padding: 5px; background: #DD4C39; color: #E6E6E6;\">NIVEL: <strong><i>$nivel</i></strong> GRUPO: <strong><i>$grupoActual</i></strong> <br>HORARIO: <strong><i> $horario </i></strong> SALON: <strong><i>$salon</i></strong> <br>PROFESOR: <strong><i>$profesor</i></strong><br>ALUMNOS INSCRITOS: <strong><i>$numeroAlumnosInscritosGrupo</i></strong>
		  </div>";
		}
	}


}
}else{
	echo "<h2 style=\"color: #686a69;\"><br><br><br><br><br><br>No hay ningun grupo Activo</h2>";
}
?>
</div>

<div class="intersemestrales"><a class="inter" href="#">Terminar todos los cursos intersemestrales</a><br><br><br><h1>Intersemestrales</h1>


<?php 
require 'conexion.php';


$numeroGruposActivos="SELECT count(*) FROM grupos WHERE activo=1 and horario='INTERSEMESTRAL'";
$respuestaNumeroGruposActivos=$conexion->query($numeroGruposActivos);
$filaNumeroGruposActivos=$respuestaNumeroGruposActivos->fetch_assoc();


if ($filaNumeroGruposActivos['count(*)']>=1) {
	

$gruposActivos="SELECT idgrupo FROM grupos WHERE activo=1 and horario='INTERSEMESTRAL' ORDER BY nivel, grupo";
$respuestaGruposActivos=$conexion->query($gruposActivos);
while ($filaGruposActivos=$respuestaGruposActivos->fetch_assoc()) {
	$grupo=$filaGruposActivos['idgrupo'];

	$inscripcionesAbiertas="SELECT idgrupo, inscribiendo FROM grupos WHERE activo=1 and idgrupo=$grupo";
	$respuestaInscripcionesAbiertas=$conexion->query($inscripcionesAbiertas);
	while ($filaInscripcionesAbiertas=$respuestaInscripcionesAbiertas->fetch_assoc()) {
		echo "<br>";
		$infoGrupo="SELECT nivel, grupo, horario, salon,nombres, apellido_paterno, apellido_materno FROM grupos, profesores WHERE idprofesores=idprofesor and idgrupo=$grupo";
			$respuestaInfoGrupo=$conexion->query($infoGrupo);
			$filaInfoGrupo=$respuestaInfoGrupo->fetch_assoc();

			$numeroAlumnosInscritos="SELECT count(*) FROM alumnos_has_grupos WHERE inscrito=1 and grupos_idgrupo=$grupo";
			$resultadoNumeroAlumnos=$conexion->query($numeroAlumnosInscritos);
			$filaAlumnosInscritos=$resultadoNumeroAlumnos->fetch_assoc();
			$numeroAlumnosInscritosGrupo=$filaAlumnosInscritos['count(*)'];
			$nivel=$filaInfoGrupo['nivel'];
			$grupoActual=$filaInfoGrupo['grupo'];
			$horario=$filaInfoGrupo['horario'];
			$salon=$filaInfoGrupo['salon'];
			$profesor=$filaInfoGrupo['nombres']." ".$filaInfoGrupo['apellido_paterno']." ".$filaInfoGrupo['apellido_materno'];
		if($filaInscripcionesAbiertas['inscribiendo']==1){
			echo "<div style=\"width: 100%; height: 100%; border: 3px solid #009551; padding: 5px; background: #00A65A;color: #E6E6E6;\">NIVEL: <strong><i>$nivel</i></strong> GRUPO: <strong><i>$grupoActual</i></strong> <br>HORARIO: <strong><i> $horario </i></strong> SALON: <strong><i>$salon</i></strong> <br>PROFESOR: <strong><i>$profesor</i></strong> <br>ALUMNOS INSCRITOS: <strong><i>$numeroAlumnosInscritosGrupo</i></strong> </div>";
		}else{

		echo "<div style=\"width: 100%; height: 100%; border: 3px solid #C94435; padding: 5px; background: #DD4C39; color: #E6E6E6;\">NIVEL: <strong><i>$nivel</i></strong> GRUPO: <strong><i>$grupoActual</i></strong> <br>HORARIO: <strong><i> $horario </i></strong> SALON: <strong><i>$salon</i></strong> <br>PROFESOR: <strong><i>$profesor</i></strong><br>ALUMNOS INSCRITOS: <strong><i>$numeroAlumnosInscritosGrupo</i></strong>
		  </div>";
		}
	}


}
}else{
	echo "<h2 style=\"color: #686a69;\"><br><br><br><br><br><br>No hay ningun grupo Activo</h2>";
}
?>


</div>
<div class="sabatinos"><a class="sabados" href="#">Terminar todos los cursos sabatinos</a><br><br><br><h1>Sabatinos</h1>

<?php 
require 'conexion.php';


$numeroGruposActivos="SELECT count(*) FROM grupos WHERE activo=1 and (horario='SABATINO MATUTINO' or horario='SABATINO VESPERTINO')";
$respuestaNumeroGruposActivos=$conexion->query($numeroGruposActivos);
$filaNumeroGruposActivos=$respuestaNumeroGruposActivos->fetch_assoc();


if ($filaNumeroGruposActivos['count(*)']>=1) {
	

$gruposActivos="SELECT idgrupo FROM grupos WHERE activo=1 and (horario='SABATINO MATUTINO' or horario='SABATINO VESPERTINO') ORDER BY nivel, grupo";
$respuestaGruposActivos=$conexion->query($gruposActivos);
while ($filaGruposActivos=$respuestaGruposActivos->fetch_assoc()) {
	$grupo=$filaGruposActivos['idgrupo'];

	$inscripcionesAbiertas="SELECT idgrupo, inscribiendo FROM grupos WHERE activo=1 and idgrupo=$grupo";
	$respuestaInscripcionesAbiertas=$conexion->query($inscripcionesAbiertas);
	while ($filaInscripcionesAbiertas=$respuestaInscripcionesAbiertas->fetch_assoc()) {
		echo "<br>";
		$infoGrupo="SELECT nivel, grupo, horario, salon,nombres, apellido_paterno, apellido_materno FROM grupos, profesores WHERE idprofesores=idprofesor and idgrupo=$grupo";
			$respuestaInfoGrupo=$conexion->query($infoGrupo);
			$filaInfoGrupo=$respuestaInfoGrupo->fetch_assoc();

			$numeroAlumnosInscritos="SELECT count(*) FROM alumnos_has_grupos WHERE inscrito=1 and grupos_idgrupo=$grupo";
			$resultadoNumeroAlumnos=$conexion->query($numeroAlumnosInscritos);
			$filaAlumnosInscritos=$resultadoNumeroAlumnos->fetch_assoc();
			$numeroAlumnosInscritosGrupo=$filaAlumnosInscritos['count(*)'];
			$nivel=$filaInfoGrupo['nivel'];
			$grupoActual=$filaInfoGrupo['grupo'];
			$horario=$filaInfoGrupo['horario'];
			$salon=$filaInfoGrupo['salon'];
			$profesor=$filaInfoGrupo['nombres']." ".$filaInfoGrupo['apellido_paterno']." ".$filaInfoGrupo['apellido_materno'];
		if($filaInscripcionesAbiertas['inscribiendo']==1){
			echo "<div style=\"width: 100%; height: 100%; border: 3px solid #009551; padding: 5px; background: #00A65A;color: #E6E6E6;\">NIVEL: <strong><i>$nivel</i></strong> GRUPO: <strong><i>$grupoActual</i></strong> <br>HORARIO: <strong><i> $horario </i></strong> SALON: <strong><i>$salon</i></strong> <br>PROFESOR: <strong><i>$profesor</i></strong> <br>ALUMNOS INSCRITOS: <strong><i>$numeroAlumnosInscritosGrupo</i></strong> </div>";
		}else{

		echo "<div style=\"width: 100%; height: 100%; border: 3px solid #C94435; padding: 5px; background: #DD4C39; color: #E6E6E6;\">NIVEL: <strong><i>$nivel</i></strong> GRUPO: <strong><i>$grupoActual</i></strong> <br>HORARIO: <strong><i> $horario </i></strong> SALON: <strong><i>$salon</i></strong> <br>PROFESOR: <strong><i>$profesor</i></strong><br>ALUMNOS INSCRITOS: <strong><i>$numeroAlumnosInscritosGrupo</i></strong>
		  </div>";
		}
	}


}
}else{
	echo "<h2 style=\"color: #686a69;\"><br><br><br><br><br><br>No hay ningun grupo Activo</h2>";
}
?>

</div>

</div>
<footer>
<center>
	  <p>V0.2 Desarrollado por:Aldo Matias Contacto: aldo_rheazyk@hotmail.com</p>
</center>

</footer> 
</body>


</html>
<?php 
}else{
	echo "<script>window.location.href=\"login\";</script>";
}
?>