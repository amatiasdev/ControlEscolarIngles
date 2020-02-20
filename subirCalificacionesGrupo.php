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

<script src="js/jquery.js"></script>
<script src="js/main.js"></script>

<div class="contenido">
<form action="subirCalificaciones" method="POST">
	<center>
		<p>Grupo:<select name="grupo" required>
		<option value="">SELECCIONE EL GRUPO QUE DESEA EVALUAR</option>

		<?php
		include("conexion.php");
		$hayGrupos="SELECT count(idgrupo) FROM grupos, profesores WHERE activo=1 and idprofesor=idprofesores order by nivel, grupo, apellido_paterno";
		$respuesta=$conexion->query($hayGrupos);
		$hayGrupos2=$respuesta->fetch_assoc();
		if($hayGrupos2['count(idgrupo)']==0){

			?>
			<option>NO HAY NINGUN GRUPO ACTIVOS</option>
			<?php  
		}else{
				$query="SELECT idgrupo,idprofesores, nivel, grupo, horario, nombres, apellido_paterno FROM grupos, profesores WHERE activo=1 and idprofesor=idprofesores order by nivel, grupo, apellido_paterno";
				$resultado=$conexion->query($query);
				while ($fila=$resultado->fetch_assoc()) {
					$coma=",";
				?>
				<option value="<?php echo $fila['idgrupo'],$coma,$fila['nivel'];?>"><?php echo "Nivel: ", $fila['nivel'] ," Grupo: ", $fila['grupo']," Horario: ", $fila['horario']," Profesor: ",$fila['nombres']," ",$fila['apellido_paterno']; ?></option>
				<?php
				}}
				?>
		</select></p>
		<p>Parcial:<select name="parcial" required>
			<option value="">Seleccione el parcial</option>
			<option>1</option>
			<option>2</option>
			<option>3</option>
		</select></p>
		<p>Seleecione la hoja de calculo del grupo:<input type="file" name="ruta" accept=".xlsx" required></p>
		<p><input type="submit" name="enviar" value="Subir calificaciones" class="boton"></p>
	</center>
	<?php 
	$_SESSION['subir']=TRUE;

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