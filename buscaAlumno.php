<?php 
session_start();
if(isset($_SESSION['valida'])){

	?>

<!DOCTYPE html>
<html>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="fonts/style.css">
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<title>Información del Alumno</title>
</head>
<body>
<div class="header"><a href="index" class="icon-home">Inicio</a>English TESI<a href="cerrarSesion" class="cerrarSesion">Cerrar Sesion</a></div>

<div class="menu-prin">
	<ul class="menu">
	<li><a href="#" >Alumnos</a>
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
<section class="sectionbuscar">
	<input type="input" name="buscar" id="busqueda" class="buscar" placeholder="  Buscar...">

</section>
<section>
	
	<form class="rr" action="hola.php" method="POST">
		<table class="tablaBuscar">
		<tr>
			<th>Matricula</th>
		    <th>Nombre</th>
		    <th>Carrera</th> 
		    <th>Nivel de Ingles</th>
		    <th>Info. Escolar</th> 
		    <th>Info. Personal</th>
  		</tr>
  		<tr>
  			<td id="Matricula">7777777</td>
  			<td>Aldo Rafael Matias Ortiz</td>
  			<td>ISC</td>
  			<td>4</td>
  			<input type="hidden" name="matricula" value="7777777">            
  			<td><span class="iconos"><button class="icon-eye"></button></span></td>
  			<td><span class="iconos"><button class="icon-eye"></button></span></td>
  			<td>
  						
  		</tr>
  		<tr>
			<td id="Matricula">5555555</td>
  			<td>Aldo Rafael Matias Ortiz</td>
  			<td>ISC</td>
  			<td>4</td>
  			<input type="hidden" name="matricula" id="matricula" value="5555555">            
  			<td><span class="iconos"><button class="icon-eye"></button></span></td>
  			<td><span class="iconos"><button class="icon-eye"></button></span></td>
  		</tr>
  		<tr>
  			<td id="Matricula">11111111</td>
  			<td>Aldo Rafael Matias Ortiz</td>
  			<td>ISC</td>
  			<td>4</td>
  			<input type="hidden" name="matricula" value="11111111">            
  			<td><span class="iconos"><button class="icon-eye"></button></span></td>
  			<td><span class="iconos"><button class="icon-eye"></button></span></td>
  		</tr>
  		<tr>
  			<td id="Matricula">222222222</td>
  			<td>Aldo Rafael Matias Ortiz</td>
  			<td>ISC</td>
  			<td>4</td>
  			<input type="hidden" name="matricula" value="222222222">            
  			<td><span class="iconos"><button class="icon-eye"></button></span></td>
  			<td><span class="iconos"><button class="icon-eye"></button></span></td>
  		</tr>

	</table>

</form>
	
</section>		
	<?php
	$_SESSION['paginaAlumno']=TRUE;
	 ?>

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