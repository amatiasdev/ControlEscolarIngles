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
<form action="insertarBD" method="post">
		<p>Campos requeridos (*)</p>
			<center class="h">
				<p>Alumno Interno</p>
				<p><input type="radio" class="interno" name="interno" value="si" checked>Si 
				<input type="radio" class="interno" name="interno" value="no">No
				<p><input type="text"   class="matricula" name="matricula" placeholder="Matricula *"></p>
				<p><input type="text"  required name="nombre" placeholder="Nombre *" class="caja"></p>
				<p><input type="text"  required name="apaterno" placeholder="Apellido Paterno *" class="caja"></p>
				<p><input type="text"  required name="amaterno" placeholder="Apellido Materno *" class="caja"></p>
				<p>Sexo: * <select name="sexo">
					<option>H</option>
					<option>M</option>
				</select></p>
				<p><label class="carreraAlumno">Carrera: * </label><select class="carreraAlumno" name="carrera">
					<option>Ing. Sistemas Computacionales</option>
					<option>Ing. Informatica</option>
					<option>Ing. Electronica</option>
					<option>Ing. Biomedica</option>
					<option>Ing. Ambiental</option>
					<option>Lic. Administración</option>
					<option>Arquitectura</option>

				</select></p>
				<p>Ultimo Nivel de Ingles: * <select name="nivelIngles">
					<option name="nuevoingre">Nuevo Ingreso</option>
					<option name="uno">1</option>
					<option name="dos">2</option>
					<option name="tres">3</option>
					<option name="cuatro">4</option>
					<option name="cinco">5</option>
					<option value="6" name="seis">Graduado</option>
				</select>
				</p>
				<p><input type="text"  name="nacimiento" placeholder="Fecha de Nacimiento" class="caja">aaaa/mm/dd</p>
				<p><input type="tel"   name="telefono" placeholder="Telefono" class="caja"></p>
				
				<p><input type="email"  name="email" placeholder="E-Mail" class="caja"></p>
				<p><textarea name="direccion" placeholder="Dirección" class="caja"></textarea>
				
				<p><input type="text"  class="semestreAlumno" name="semestre" placeholder="Semestre" class="caja"></p>
				<p><input type="text" class="grupocarr" name="grupocarr" placeholder="Grupo" class="caja"></p>

				
				<p><input type="submit" name="enviar" value="Enviar" class="boton"></p>
			</center>
			<?php
		$_SESSION['registroAlumnos']=TRUE;
		$_SESSION['valida']=TRUE;
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
	echo "<script>window.location.href=\"login\";</script>";
}
?>