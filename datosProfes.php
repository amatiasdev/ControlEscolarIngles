<?php 
session_start();

if(isset($_SESSION['infoProfe'])){
	$profe=$_POST['profe'];
$_SESSION['idProfe']=$profe;
	?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="fonts/style.css">
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<title>Datos Profe</title>
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


<form class="formProf" action="actualizarProf" method="POST">
<center class="campos">	
<?php 

require 'conexion.php';

$query="SELECT nombres, apellido_paterno, apellido_materno, correo, telefono FROM profesores WHERE  idprofesores=$profe";
$resultado=$conexion->query($query);


$fila=$resultado->fetch_assoc();

 ?>
 <p>Nombre(s): <label><?php echo $fila['nombres']; ?></label> <input type="text" name="nombre" placeholder="<?php echo $fila['nombres']; ?>" class="caja"></p>
 <p>Apellido Paterno: <label><?php echo $fila['apellido_paterno']; ?></label> <input type="text" name="apaterno" placeholder="<?php echo $fila['apellido_paterno']; ?>" class="caja"></p>
<p>Apellido Materno: <label><?php echo $fila['apellido_materno']; ?></label> <input type="text"   name="amaterno" placeholder="<?php echo $fila['apellido_materno']; ?>" class="caja"></p>
<p>Telefono: <label><?php echo $fila['telefono']; ?></label> <input type="text"   name="telefono" placeholder="<?php echo $fila['telefono']; ?>" class="caja"> </p>
<p>E-Mail: <label><?php echo $fila['correo']; ?></label><input type="text" name="email" placeholder="<?php echo $fila['correo']; ?>" class="caja"></p>

<a onclick="actualizarProf()" href="#" class="editarProf">Editar </a>|
<a onclick="eliminarProf()" href="#"> Eliminar Profesor</a>
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
	$_SESSION['idProfe']=$profe;
	$_SESSION['datosProfe']=TRUE;
	$_SESSION['valida']=TRUE;
	}else{
		echo "<script>window.location.href=\"index\";</script>";
	} 
?>