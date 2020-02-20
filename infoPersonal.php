<?php 
if(!empty($_POST['matricula'])==1){
	session_start();
	$_SESSION['matricula']=$_POST['matricula'];

}elseif (!empty($_POST['amaterno'])==1 && !empty($_POST['apaterno'])==1 && !empty($_POST['nombre'])==1) {
	session_start();

}

if(isset($_SESSION['paginaAlumno'])){
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Información Personal</title>
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
<form class="form" action="actualizar" method="POST">
<?php 
include('conexion.php');

if(!empty($_POST['matricula'])){
					$_SESSION['matricula']=$_POST['matricula'];
					$matricula=$_SESSION['matricula'];

			$query="SELECT * FROM alumnos WHERE matricula='$matricula'";
			$apellidos=FALSE;
				
}elseif(!empty($_POST['amaterno'])==1 && !empty($_POST['apaterno'])==1 && !empty($_POST['nombre'])==1){
					$apellido_paterno=trim(strtoupper($_POST['apaterno']));
					$apellido_materno=trim(strtoupper($_POST['amaterno']));
					$nombres=trim(strtoupper($_POST['nombre']));
	$query="SELECT * FROM alumnos WHERE nombres='$nombres' and apellido_paterno='$apellido_paterno' and apellido_materno='$apellido_materno'";
				$apellidos=TRUE;
}
				$resultado=$conexion->query($query);
				while ($row=$resultado->fetch_assoc()) {
					if($apellidos){

						$_SESSION['matricula']=$row['matricula'];
						$matricula=$_SESSION['matricula'];
					}

 ?>
 <center class="campos">
 Matricula: <?php echo $row['matricula'];?><input type="text" name="matricula" class="matricula" value="<?php echo $row['matricula'];?>" id="caja">
<p>Nombre(s): <label><?php echo $row['nombres']; ?></label> <input type="text" name="nombre" placeholder="<?php echo $row['nombres']; ?>"></p>
<p>Apellido Paterno: <label><?php echo $row['apellido_paterno']; ?></label> <input type="text" name="apaterno" placeholder="<?php echo $row['apellido_paterno']; ?>"></p>
<p>Apellido Materno: <label><?php echo $row['apellido_materno']; ?></label> <input type="text"   name="amaterno" placeholder="<?php echo $row['apellido_materno']; ?>"></p>
<p>Fecha de nacimiento: <label><?php echo $row['fecha_nacimiento']; ?></label><input type="text"   name="nacimiento" placeholder="<?php echo $row['fecha_nacimiento']; ?>"> aaaa/mm/dd</p>
<p>Telefono: <label><?php echo $row['telefono']; ?></label> <input type="text"   name="telefono" placeholder="<?php echo $row['telefono']; ?>"> </p>
<p>Sexo: <label><?php echo $row['sexo']; ?></label> <select name="sexo">
	<option>H</option>
	<option>M</option>
</select></p>
<p>E-Mail: <label><?php echo $row['correo']; ?></label><input type="text"   name="email" placeholder="<?php echo $row['correo']; ?>"></p>
<p>Dirección: <label><?php echo $row['direccion']; ?></label> <textarea name="direccion" placeholder="<?php echo $row['direccion']; ?>"></textarea></p>
<p>Carrera: <label><?php echo $row['carrera']; ?></label> 
<select name="carrera">
					<option value="">Seleccione una carrera</option>
					<option>Ing. Sistemas Computacionales</option>
					<option>Ing. Informatica</option>
					<option>Ing. Electronica</option>
					<option>Ing. Biomedica</option>
					<option>Ing. Ambiental</option>
					<option>Lic. Administración</option>
					<option>Arquitectura</option>
				</select>

</p>
<p>Semestre: <label><?php echo $row['semestre']; ?></label> <input type="text"   name="semestre" placeholder="<?php echo $row['semestre']; ?>"></p>
<p>Grupo (Carrera): <label><?php echo $row['grupo_carrera']; ?></label> <input type="text"   name="grupocarr" placeholder="<?php echo $row['grupo_carrera']; ?>"></p>
<p>Ultimo Nivel de ingles Cursado: Nivel <label><?php echo $row['ultimo_nivel_ingles']; ?></label> <select name="nivelIngles">
					<option value="">Seleccione un nivel</option>
					<option value="0">Nuevo Ingreso</option>
					<option name="uno">1</option>
					<option name="dos">2</option>
					<option name="tres">3</option>
					<option name="cuatro">4</option>
					<option name="cinco">5</option>
					<option name="seis">6</option>
				</select> </p>
 </center>
<?php 
} 
?>
<a onclick="actualizar()" href="#" class="editar">Editar </a>|
<a onclick="eliminar()" href="#"> Eliminar Alumno</a>
<p></p>
<p><a href="alumno">Regresar</a></p>
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
$_SESSION['paginaAlumno3']=TRUE;
$_SESSION['valida']=TRUE;
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>