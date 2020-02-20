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
			<link rel="stylesheet" href="css/estilos.css">
			<link rel="stylesheet" href="fonts/style.css">
			<script src="js/jquery.js"></script>
			<script src="js/main.js"></script>
			<title>Alumno</title>
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
		<center >
				<?php 
					require 'conexion.php';
						if(!empty($_POST['matricula'])==1){
							$_SESSION['matricula']=$_POST['matricula'];
							$matricula=$_SESSION['matricula'];
							$query="SELECT count(matricula), matricula, nombres, apellido_paterno, apellido_materno FROM alumnos WHERE matricula='$matricula'";
						$apellidos=FALSE;
						$resultado=$conexion->query($query);
						}elseif(!empty($_POST['amaterno'])==1 && !empty($_POST['apaterno'])==1 && !empty($_POST['nombre'])==1){
							$nombres=trim(strtoupper($_POST['nombre']));
							$apellido_paterno=trim(strtoupper($_POST['apaterno']));
							$apellido_materno=trim(strtoupper($_POST['amaterno']));
							$query="SELECT matricula, nombres, apellido_paterno, apellido_materno FROM alumnos WHERE nombres='$nombres' and  apellido_paterno='$apellido_paterno' and apellido_materno='$apellido_materno'";
							$apellidos=TRUE;
							$resultado=$conexion->query($query);
						}
						while ($row=$resultado->fetch_assoc()){
							if($apellidos){
								$peticion="SELECT count(matricula) FROM 
								alumnos	WHERE apellido_paterno='$apellido_paterno' and apellido_materno='$apellido_materno' and nombres='$nombres'";
								$respuesta=$conexion->query($peticion);
								$fila=$respuesta->fetch_assoc();
								if($fila['count(matricula)']==1){
										$_SESSION['matricula']=$row['matricula'];
										$matricula=$_SESSION['matricula'];
										echo "<p><a href=\"nuevoNivel\">Inscribir a nuevo Nivel</a></p>";
								}else{
									echo "HOLA";
								}						
							}else{
								$peticion="SELECT count(matricula) FROM 
								alumnos	WHERE matricula='$matricula'";
								$respuesta=$conexion->query($peticion);
								$fila=$respuesta->fetch_assoc();
								if ($fila['count(matricula)']==0) {
									echo "<script>
									alert(\"Este Alumno no está registrado\");

									window.location.href=\"index\";</script>";
								}else{
									echo "<p><a href=\"nuevoNivel\">Inscribir a nuevo Nivel</a></p>";
								}
							}					
						?>
						<label><?php echo "Matricula: ",$row['matricula'],". ",$row['nombres'], " ", $row['apellido_paterno']," ",$row['apellido_materno']; ?></label>
						<?php 
						break;
						}
				 ?>
				
				

				<?php 

				$matricula=$_SESSION['matricula'];
				$peticion="SELECT count(matricula) FROM 
								alumnos	WHERE matricula='$matricula'";
								$respuesta=$conexion->query($peticion);
								$fila=$respuesta->fetch_assoc();
								if ($fila['count(matricula)']==0) {
									echo "<script>
									alert(\"Este Alumno no está registrado\");

									window.location.href=\"index\";</script>";
								}else{
									
									?>
									<p><select class="tipoInfo">
					<option>Seleccione una opción</option>
					<option>Kardex</option>
					<option>Curso</option>
				</select></p>

				<table class="kardex" width="70%" border="0.8">
									<?php 

				$query="SELECT count(*) FROM evaluacion, profesores WHERE Alumnos_matriculaEv='$matricula' and enCurso=0";
				$res=$conexion->query($query);
				$filaRes=$res->fetch_assoc();
				if($filaRes['count(*)']==0){
					?>
					<thead class="cabecera">
						<th>El Alumno no ha terminado ningun curso</th>
					</thead>
					<?php 

				}else{
				 ?>
				<thead class="cabecera">
						<th>Nivel</th>
						<th align="center">Calificación</th>
				</thead>
				<tbody>
				<?php 
				$preguntarNiveles="SELECT nivelActual FROM evaluacion WHERE Alumnos_matriculaEv='$matricula' group by nivelActual";
				$respuestaPreguntarNiveles=$conexion->query($preguntarNiveles);
				while ($filasPreguntarNiveles=$respuestaPreguntarNiveles->fetch_assoc()) {
					$niveles=$filasPreguntarNiveles['nivelActual'];
					$queryPromedioParcial="SELECT avg(calificacion), nivelActual FROM evaluacion WHERE nivelActual=$niveles and Alumnos_matriculaEv='$matricula'";
					$respuestaPromedioParcial=$conexion->query($queryPromedioParcial);
					while ($filasPromedioNivel=$respuestaPromedioParcial->fetch_assoc()) {
					?>	
						<tr>
						<td align="center"><?php echo $filasPromedioNivel['nivelActual']; ?></td>
						<td align="center"><?php echo number_format($filasPromedioNivel['avg(calificacion)'],1); ?></td>
						</tr>
					<?php 
					}
				}
				$queryPromedioGeneral="SELECT avg(calificacion) FROM evaluacion WHERE Alumnos_matriculaEv='$matricula'";
				$respuestaPromedioGeneral=$conexion->query($queryPromedioGeneral);
				$PromedioGeneral=$respuestaPromedioGeneral->fetch_assoc();
				 ?>	
				 <tr>
				 <th>Promedio:</th>
				 <th align="center"><?php echo number_format($PromedioGeneral['avg(calificacion)'],1) ; ?></th>
				 </tr>		
					
				</tbody>
				</table>
				<?php 
					}//if($filaRes['count(*)']>0){
				 ?>



				 <table class="semestre" width="70%" border="0.8">
				 <?php 
				 $queryInscrito="SELECT count(*) FROM alumnos_has_grupos WHERE Alumnos_matricula='$matricula' and inscrito=1";
				 $respuestaInscrito=$conexion->query($queryInscrito);
				 $filaInscrito=$respuestaInscrito->fetch_assoc();
				 if($filaInscrito['count(*)']==0){
				 	?>
				 	<thead>
				 		<th>El Alumno no esta inscrito en algun curso</th>
				 	</thead>
				 	<?php 
				 }else{
				  ?>
				<?php 
						 		
					$preguntarYaHayCalificaciones="SELECT count(*) FROM evaluacion WHERE Alumnos_matriculaEv='$matricula' and enCurso=1";
					$respuestaCalificaciones=$conexion->query($preguntarYaHayCalificaciones);
					$filaYaHayCalificaciones=$respuestaCalificaciones->fetch_assoc();

					if ($filaYaHayCalificaciones['count(*)']==0) {
						 ?>
						 <thead>
				 		<th>Aún no se han subido calificaciones</th>
				 	</thead>

						 <?php 

					}else{
						$preguntarNivel="SELECT nivelActual FROM evaluacion WHERE Alumnos_matriculaEv='$matricula' and enCurso=1";
					$respuestaNivel=$conexion->query($preguntarNivel);
					$filaNivel=$respuestaNivel->fetch_assoc();
				 ?>
				 	<thead><th colspan="2"><?php echo "Nivel:",$filaNivel['nivelActual']; ?></th></thead>

				 	<thead>
				 		<th>Parcial</th>
				 		<th>Calificación</th>
				 	</thead>

				 	<tbody>
				 	<?php 
				 		$preguntarParcialesClaificados="SELECT parcial FROM evaluacion WHERE Alumnos_matriculaEv='$matricula'and enCurso=1";
				 		$resultadoParcialesCalificados=$conexion->query($preguntarParcialesClaificados);
				 		while ($filaParciales=$resultadoParcialesCalificados->fetch_assoc()) {
				 			$parcialCalificado=$filaParciales['parcial'];
				 			$preguntarCalificaciones="SELECT calificacion, parcial FROM evaluacion WHERE Alumnos_matriculaEv='$matricula' and enCurso=1 and parcial=$parcialCalificado";
				 			$resultadoCalificaciones=$conexion->query($preguntarCalificaciones);
				 			while ($filaCalificaciones=$resultadoCalificaciones->fetch_assoc()) {
				 				
				 				?>
				 					<tr>
				 						<td align="center"><?php echo $filaCalificaciones['parcial']; ?></td>
				 						<td align="center"><?php echo $filaCalificaciones['calificacion'] ?></td>
				 					</tr>

				 				<?php 
				 			}

				 		}

				 		$preguntarPromedio="SELECT avg(calificacion) FROM evaluacion WHERE Alumnos_matriculaEv='$matricula' and enCurso=1";
				 		$respuestaPromedioCurso=$conexion->query($preguntarPromedio);
				 		$filasPromedioNivelActivo=$respuestaPromedioCurso->fetch_assoc();

				 	 ?>
				 	 <tr>
				 	 <th>Promedio</th>
				 	 <th><?php echo number_format($filasPromedioNivelActivo['avg(calificacion)'],1); ?></th>
				 	 </tr>

				 	</tbody>

				 	<?php 
				 
				 }
				}
				 	 ?>
				 </table>
									<?php 

								}
								?>

				<p><a href="alumno">Regresar</a></p>
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
	$_SESSION['matricula']=$matricula;
	$_SESSION['paginaAlumno2']=TRUE;
	$_SESSION['valida']=TRUE;
}else{
	echo "<script>window.location.href=\"index\";</script>";
}
?>
