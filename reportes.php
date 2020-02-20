<?php 
session_start();
if(isset($_SESSION['valida'])){

	?>


<!DOCTYPE html>
<html>
<head>
	<title>Reportes</title>
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
	
	<form action="hacerReporte" method="POST">
	<p>Opciones</p>
	<p><input type="radio" name="opcion" class="opcion" value="Grupo" checked>Grupo:<select name="grupoProfe" class="grupo" >
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
				<option value="<?php echo $fila['idgrupo'],$coma,$fila['idprofesores'];?>"><?php echo "Nivel: ", $fila['nivel'] ," Grupo: ", $fila['grupo']," Horario: ", $fila['horario']," Profesor: ",$fila['nombres']," ",$fila['apellido_paterno']; ?></option>
				<?php
				}}
				?>
		</select></p>

	<p><input type="radio" name="opcion" class="opcion" value="Nivel">Nivel: 
	<select class="nivel" name="nivel">
	<option>1</option>
	<option>2</option>
	<option>3</option>
	<option>4</option>
	<option>5</option>
	<option>6</option>
	</select></p>
	<p><input type="radio" name="opcion" class="opcion" value="Carrera">Carrera:  
	<select class="carrera" name="carrera">
					<option value="">Seleccione una carrera:</option>
					<option>Ing. Sistemas Computacionales</option>
					<option>Ing. Informatica</option>
					<option>Ing. Electronica</option>
					<option>Ing. Biomedica</option>
					<option>Ing. Ambiental</option>
					<option>Lic. Administración</option>
					<option>Arquitectura</option>
				</select>
	<p><input type="radio" name="opcion" class="opcion" value="Modalidad">Modalidad: <select class="modalidad" name="modalidad">
	<option value="">Seleccione un horario:</option>
	<option value="MATUTINO">MATUTINO 11:00-13:00 HRS.</option>
	<option value="INTERMEDIO">INTERMEDIO 13:00-15:00 HRS.</option>
	<option value="VESPERTINO">VESPERTINO 15:00-17:00 HRS.</option>
	<option value="SABATINO MATUTINO">SABATINO MATUTINO 08:00-16:00 HRS.</option>
	<option value="SABATINO VESPERTINO">SABATINO VESPERTINO 16:00-20:00 HRS.</option>
	<option value="INTERSEMESTRAL">INTERSEMESTRAL 08:00-12:00 HRS.</option>
</select></p>
	<p><input type="submit" name="btn" class="opcion" value="Hacer Reporte" id="boton"></p>

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
$_SESSION['reportes']=TRUE;
}else{
	echo "<script>window.location.href=\"login\";</script>";
}
?>