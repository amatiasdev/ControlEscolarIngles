<?php 
session_start();
if(isset($_SESSION['reportes'])){

	?>

<!DOCTYPE html>
<html>
<head>
	<title>Reporte</title>
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="fonts/style.css">
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<meta charset="UTF-8">
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
<center>
	<?php 
require 'conexion.php';
$opcion=$_POST['opcion'];

if($opcion=="Grupo"){



	$grupoProfe=explode(",", $_POST['grupoProfe']);
	$grupo=$grupoProfe[0];


	if($grupo!="NO HAY NINGUN GRUPO ACTIVOS"){
		$Nombregrupo="SELECT nivel, grupo FROM grupos WHERE idgrupo=$grupo";
	$respuestaNombregrupo=$conexion->query($Nombregrupo);
	$filaNombregrupo=$respuestaNombregrupo->fetch_assoc();
	$nomGrupo=$filaNombregrupo['nivel'].$filaNombregrupo['grupo'];


		echo "FILTRO POR GRUPO $nomGrupo";
	$numeroAlumnos="SELECT count(*) FROM alumnos_has_grupos WHERE grupos_idgrupo=$grupo";
	$respuestaNumeroAlumnos=$conexion->query($numeroAlumnos);
	$filaNumeroAlumnos=$respuestaNumeroAlumnos->fetch_assoc();
	echo "<BR>Total de alumnos:".$filaNumeroAlumnos['count(*)'];

	$numeroHombres="SELECT count(*) FROM alumnos_has_grupos, alumnos WHERE grupos_idgrupo=$grupo and sexo='H' and matricula=Alumnos_matricula";
	$respuestaNumeroHombres=$conexion->query($numeroHombres);
	$filaNumeroHombres=$respuestaNumeroHombres->fetch_assoc();
	echo "<BR>Total de hombres:".$filaNumeroHombres['count(*)'];

	$numeroMujeres="SELECT count(*) FROM alumnos_has_grupos, alumnos WHERE grupos_idgrupo=$grupo and sexo='M' and matricula=Alumnos_matricula";
	$respuestaNumeroMujeres=$conexion->query($numeroMujeres);
	$filaNumeroMujeres=$respuestaNumeroMujeres->fetch_assoc();
	echo "<BR>Total de mujeres:".$filaNumeroMujeres['count(*)'];
	}else{
		echo "<script>window.location.href=\"index\";</script>";
	}
	

}elseif ($opcion=="Nivel") {
	$nivel=$_POST['nivel'];

	echo "FILTRO POR NIVEL $nivel";
	$numeroAlumnos="SELECT count(*) FROM grupos, alumnos_has_grupos WHERE nivel=$nivel and activo=1 and inscrito=1 and grupos_idgrupo=idgrupo";
	$respuestaNumeroAlumnos=$conexion->query($numeroAlumnos);
	$filaNumeroAlumnos=$respuestaNumeroAlumnos->fetch_assoc();
	echo "<BR>Total de Alumnos:".$filaNumeroAlumnos['count(*)'];

	$numeroHombres="SELECT count(*) FROM grupos, alumnos_has_grupos, alumnos WHERE nivel=$nivel and activo=1 and inscrito=1 and grupos_idgrupo=idgrupo and sexo='H' and matricula=Alumnos_matricula";
	$respuestaNumeroHombres=$conexion->query($numeroHombres);
	$filaNumeroHombres=$respuestaNumeroHombres->fetch_assoc();
	echo "<BR>Total de hombres:".$filaNumeroHombres['count(*)'];

	$numeroMujeres="SELECT count(*) FROM grupos, alumnos_has_grupos, alumnos WHERE nivel=$nivel and activo=1 and inscrito=1 and grupos_idgrupo=idgrupo and sexo='M' and matricula=Alumnos_matricula";
	$respuestaNumeroMujeres=$conexion->query($numeroMujeres);
	$filaNumeroMujeres=$respuestaNumeroMujeres->fetch_assoc();
	echo "<BR>Total de mujeres:".$filaNumeroMujeres['count(*)'];

}elseif ($opcion=="Carrera") {
	$carrera=$_POST['carrera'];
	if($carrera=="Ing. Sistemas Computacionales"){
		$carrera="ISC";
	}elseif ($carrera=="Ing. Informatica"){
		$carrera="INFO";		
	}elseif ($carrera=="Ing. Electronica") {
		$carrera="ELEC";
	}elseif ($carrera=="Ing. Biomedica") {
		$carrera="BIO";
	}elseif ($carrera=="Ing. Ambiental") {
		$carrera="AMB";
	}elseif ($carrera=="Lic. Administración") {
		$carrera="ADMON";
	}elseif ($carrera=="Arquitectura") {
		$carrera="ARQ";
	}

	if($carrera!=""){

	echo "FILTRO POR CARRERA $carrera";
	$numeroAlumnos="SELECT count(*) FROM alumnos, alumnos_has_grupos WHERE carrera='$carrera' and inscrito=1 and Alumnos_matricula=matricula";
	$respuestaNumeroAlumnos=$conexion->query($numeroAlumnos);
	$filaNumeroAlumnos=$respuestaNumeroAlumnos->fetch_assoc();
	echo "<BR>Total de alumnos:".$filaNumeroAlumnos['count(*)'];

	$numeroHombres="SELECT count(*) FROM alumnos, alumnos_has_grupos WHERE carrera='$carrera' and sexo='H' and inscrito=1 and Alumnos_matricula=matricula;";
	$respuestaNumeroHombres=$conexion->query($numeroHombres);
	$filaNumeroHombres=$respuestaNumeroHombres->fetch_assoc();
	echo "<BR>Total de alumnos:".$filaNumeroHombres['count(*)'];

	$numeroMujeres="SELECT count(*) FROM alumnos, alumnos_has_grupos WHERE carrera='$carrera' and sexo='M' and inscrito=1 and Alumnos_matricula=matricula;";
	$respuestaNumeroMujeres=$conexion->query($numeroMujeres);
	$filaNumeroMujeres=$respuestaNumeroMujeres->fetch_assoc();
	echo "<BR>Total de mujeres:".$filaNumeroMujeres['count(*)'];
}else{
	echo "<script>window.location.href=\"index\";</script>";
}

}elseif ($opcion=="Modalidad") {
	$modalidad=$_POST['modalidad'];

	if($modalidad!=""){
		echo "FILTRO POR MODALIDAD: $modalidad";
	$numeroAlumnos="SELECT count(*) FROM alumnos_has_grupos, grupos WHERE inscrito=1 and horario='$modalidad' and grupos_idgrupo=idgrupo and activo=1";
	$respuestaNumeroAlumnos=$conexion->query($numeroAlumnos);
	$filaNumeroAlumnos=$respuestaNumeroAlumnos->fetch_assoc();
	echo "<BR>Total de alumnos:".$filaNumeroAlumnos['count(*)'];

	$numeroHombres="SELECT count(*) FROM alumnos_has_grupos, grupos, alumnos WHERE inscrito=1 and horario='$modalidad' and grupos_idgrupo=idgrupo and activo=1 and Alumnos_matricula=matricula and sexo='H'";
	$respuestaNumeroHombres=$conexion->query($numeroHombres);
	$filaNumeroHombres=$respuestaNumeroHombres->fetch_assoc();
	echo "<BR>Total de hombres:".$filaNumeroHombres['count(*)'];

	$numeroMujeres="SELECT count(*) FROM alumnos_has_grupos, grupos, alumnos WHERE inscrito=1 and horario='$modalidad' and grupos_idgrupo=idgrupo and activo=1 and Alumnos_matricula=matricula and sexo='M'";
	$respuestaNumeroMujeres=$conexion->query($numeroMujeres);
	$filaNumeroMujeres=$respuestaNumeroMujeres->fetch_assoc();
	echo "<BR>Total de mujeres:".$filaNumeroMujeres['count(*)'];
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
	
}
 ?>
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
session_destroy();
session_start();
$_SESSION['valida']=TRUE;
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>