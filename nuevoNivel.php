<?php 
session_start();
if(isset($_SESSION['paginaAlumno2'])){
	?>		
		<!DOCTYPE html>
		<html>
		<head>
			<title>Inscribir a nuevo Nivel</title>
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

		<?php
		require 'conexion.php';
		$matricula=$_SESSION['matricula'];

		$peticion2="SELECT  count(*) FROM alumnos_has_grupos WHERE Alumnos_matricula='$matricula' and inscrito=1";
		$resultado2=$conexion->query($peticion2);
		$inscrito=$resultado2->fetch_assoc();

		if($inscrito['count(*)']==1){
			session_destroy();
			echo "<script>
			alert(\"El alumno ya ha sido inscrito\");
			window.location.href=\"index\";

			</script>";
		}else{
		$peticion="SELECT idgrupo, nivel, grupo, horario, nombres, apellido_paterno FROM grupos, profesores WHERE nivel=(SELECT ultimo_nivel_ingles FROM alumnos WHERE matricula='$matricula')+1 and activo=1 and idprofesor=idprofesores and inscribiendo=1"; 
		$resultado=$conexion->query($peticion);

		$numeroDeGrupos="SELECT count(idgrupo) FROM grupos, profesores WHERE nivel=(SELECT ultimo_nivel_ingles FROM alumnos WHERE matricula='$matricula')+1 and activo=1 and idprofesor=idprofesores and inscribiendo=1";
		$resultadoNumeroGrupos=$conexion->query($numeroDeGrupos);
		$numeroGrupos=$resultadoNumeroGrupos->fetch_assoc();
		?>

		<?php 
			if($numeroGrupos['count(idgrupo)']>0){
				?>

				<form action="inscribirAlumnoBD" method="POST">
				<p>Seleccione un grupo:</p>
				<select name="nuevoGrupo">
				<?php 
				while ($grupos=$resultado->fetch_assoc()) {
				
				$coma=",";
		?>
			<option value="<?php echo $grupos['idgrupo'],$coma,$grupos['nivel']; ?>"><?php echo "Nivel: " .$grupos['nivel']." Horario ".$grupos['horario']." Grupo: ".$grupos['grupo']." Profesor: ".$grupos['nombres']." ".$grupos['apellido_paterno']; ?></option>
		<?php 
			}
		}else{
			$query="SELECT ultimo_nivel_ingles+1 FROM alumnos WHERE matricula='$matricula'";
			$resultado=$conexion->query($query);
			$grupos=$resultado->fetch_assoc();
			$nivel=$grupos['ultimo_nivel_ingles+1'];

			if($nivel==7){
				echo "<script>
			alert(\"Este Alumno ya se ha graduado\");
			window.location.href=\"index\";
			</script>";
			}else{
			echo "<script>
			alert(\"No hay grupos para el nivel: $nivel\");
			window.location.href=\"crearGrupos\";
			</script>";
			}

			session_destroy();
			
		}
		?>
		<?php 
		}
		 ?>
		 </select>
		<p><input type="submit" name="btn" value="Inscribir" class="boton"></p>
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
