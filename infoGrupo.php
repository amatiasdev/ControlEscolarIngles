<?php 
session_start();
if(isset($_SESSION['seleccionarGrupo'])){
	$aprobados=0;
	$reprobados=0;
	$hombresAprobados=0;
	$hombresReprobados=0;
	$mujeresAprobadas=0;
	$mujeresReprobadas=0;
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

<div class="header"><a href="index" class="Inicio">Inicio</a>English TESI<a href="cerrarSesion" class="cerrarSesion">Cerrar Sesion</a></div>

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

<form class="formGrupo" action="subircal" method="POST">
<center>


<?php 
$parcial=$_POST['parcial'];
if($parcial==0){
	?>
	<div class="cerrarInss">
		<p><a class="cerrarIns" href="#"><strong>Cerrar Inscripciones</strong></a></p>
	</div>
	
		<table class="lista" border="0.9">
			<thead class="cabecera">
					<th># Lista</th>
					<th>Matricula</th>
					<th>Carrera</th>
					<th>Nombre</th>
			</thead>
			<tbody>
				<?php
				include("conexion.php");
				$grupoProfe=explode(",", $_POST['grupoProfe']);
				
				$_SESSION['grupo']=$grupoProfe[0];
				$_SESSION['profe']=$grupoProfe[1];
				$grupo=$_SESSION['grupo'];
				$query="SELECT matricula, nombres, apellido_paterno, apellido_materno, nivel, carrera FROM alumnos, alumnos_has_grupos, grupos WHERE grupos_idgrupo=$grupo and idgrupo=grupos_idgrupo and matricula=Alumnos_matricula and inscrito=1 Order By apellido_paterno,apellido_materno,nombres";
				$resultado=$conexion->query($query);
				$numeroLista=1;
				while ($row=$resultado->fetch_assoc()) {
				?>
				<tr>					
					<td><?php echo $numeroLista;?></td>
					<td><?php echo $row['matricula'];?></td>
					<td><?php echo $row['carrera'];?></td>					
					<td><?php echo $row['apellido_paterno'], " ", $row['apellido_materno'], " ", $row['nombres'];?></td>
				</tr>
				<?php
				$numeroLista++;	
				}
				?>
			</tbody>
		</table>
		<p><a href="imprimirLista">Imprimir Lista de Alumnos</a></p>

	<?php 

}else if($parcial==4){
	$parcialesCalificados=0;
	?>

	<table class="primer" border="0.9">
			<thead class="cabecera">
					<th># Lista</th>
					<th>Matricula</th>
					<th>Carrera</th>
					<th>Nombre</th>
					<th>Parcial 1</th>
					<th>Parcial 2</th>
					<th>Parcial 3</th>
					<th>Promedio</th>
			</thead>
			<tbody>
				<?php
				include("conexion.php");
				$grupoProfe=explode(",", $_POST['grupoProfe']);
				
				$_SESSION['grupo']=$grupoProfe[0];
				$_SESSION['profe']=$grupoProfe[1];
				$grupo=$_SESSION['grupo'];

				$matriculasInscritas="SELECT Alumnos_matricula FROM alumnos_has_grupos, alumnos WHERE grupos_idgrupo=$grupo and inscrito=1 and matricula=Alumnos_matricula ORDER BY apellido_paterno, apellido_materno, nombres;
";
				$resultadoMatriculas=$conexion->query($matriculasInscritas);
				$numeroLista=1;
				while ($matriculas=$resultadoMatriculas->fetch_assoc()) {
					$matricula_Alumno=$matriculas['Alumnos_matricula'];

					$query="SELECT matricula,nombres, apellido_paterno, apellido_materno, carrera FROM alumnos WHERE matricula=$matricula_Alumno order by apellido_paterno, apellido_materno, nombres";
				$resultado=$conexion->query($query);
				
				while ($row=$resultado->fetch_assoc()) {
				?>
				<tr>					
					<td><?php echo $numeroLista;?></td>
					<td><?php echo $row['matricula'];?></td>
					<td><?php echo $row['carrera'];?></td>					
					<td><?php echo $row['apellido_paterno'], " ", $row['apellido_materno'], " ", $row['nombres'];?></td>
					<?php 
					
					$matricula=$row['matricula'];

					$queryCalificacion="SELECT calificacion FROM evaluacion WHERE Alumnos_matriculaEv=$matricula and enCurso=1";
					$resultadoCalificacion=$conexion->query($queryCalificacion);
					while ($fila=$resultadoCalificacion->fetch_assoc()) {
						?>
						<td align="right"><?php echo $fila['calificacion']; ?></td>
						<?php 
						$parcialesCalificados++;
					}
					if($parcialesCalificados==3){
						$queryPromedio="SELECT avg(calificacion) FROM evaluacion WHERE Alumnos_matriculaEv=$matricula and enCurso=1";
					$respuestaPromedio=$conexion->query($queryPromedio);
					$promedioAlumno=$respuestaPromedio->fetch_assoc();


					 $sexoAlumno="SELECT sexo FROM alumnos WHERE matricula='$matricula'";
					 $respuestaSexo=$conexion->query($sexoAlumno);
					 $sexoAlumnoEvaluado=$respuestaSexo->fetch_assoc();

					 ?>
					<td align="right"><?php echo number_format($promedioAlumno['avg(calificacion)'],1 );?></td>
					<?php 
					$parcialesCalificados=0;
					if($promedioAlumno['avg(calificacion)']>=7){
					$aprobados++;
					if($sexoAlumnoEvaluado['sexo']=="H"){
						$hombresAprobados++;
					}else{
						$mujeresAprobadas++;
					}
				}else{
					$reprobados++;
					if($sexoAlumnoEvaluado['sexo']=="H"){
						$hombresReprobados++;
					}else{
						$mujeresReprobadas++;
					}
				}
					}
					?>
				</tr>
			<?php  				
				$numeroLista++;	
				
				}
			}
				?>
			</tbody>
		</table>
<?php

				
		if ($numeroLista>1) {
			?>
			<br><br>
			<table>
			<tbody>
				<thead>
					<th>Género</th>
					<th colspan="1">Aprobados</th>
					<th colspan="1">Reprobados</th>
				</thead>
				<tr>
				<td>Hombres</td>
				<td align="center"><?php echo $hombresAprobados; ?></td>
				<td align="center"><?php echo $hombresReprobados; ?></td>
				</tr>
				<tr>
				<td>Mujeres</td>
				<td align="center"><?php echo $mujeresAprobadas; ?></td>
				<td align="center"><?php echo $mujeresReprobadas; ?></td>
				</tr>
				
				<tr>
				<td>Total:</td>
				<td align="center"><?php echo $aprobados; ?></td>
				<td align="center"><?php echo $reprobados; ?></td>
				</tr>
			</tbody>
		</table>


			<?php 
		}
		 ?>
	<?php 
}else{
?>
		<table class="primer" border="0.9">
			<thead class="cabecera">
					<th># Lista</th>
					<th>Matricula</th>
					<th>Carrera</th>
					<th>Nombre</th>
					<th>Calificación</th>
			</thead>
			<tbody>
				<?php
				include("conexion.php");
				$grupoProfe=explode(",", $_POST['grupoProfe']);				
				$_SESSION['grupo']=$grupoProfe[0];
				$_SESSION['profe']=$grupoProfe[1];
				$grupo=$_SESSION['grupo'];
				$query="SELECT matricula, nombres, apellido_paterno, apellido_materno, sexo, nivel, carrera, calificacion FROM alumnos, alumnos_has_grupos, grupos, evaluacion WHERE grupos_idgrupo=$grupo and idgrupo=grupos_idgrupo and matricula=Alumnos_matricula and matricula=Alumnos_matriculaEv and parcial=$parcial and enCurso=1 and inscrito=1 Order By apellido_paterno,apellido_materno,nombres";
				$resultado=$conexion->query($query);
				$numeroLista=1;
				while ($row=$resultado->fetch_assoc()) {
				?>
				<tr>					
					<td><?php echo $numeroLista;?></td>
					<td><?php echo $row['matricula'];?></td>
					<td><?php echo $row['carrera'];?></td>					
					<td><?php echo $row['apellido_paterno'], " ", $row['apellido_materno'], " ", $row['nombres'];?></td>
					<td align="right"><?php echo $row['calificacion']; ?></td>
				</tr>
				<?php
				if($row['calificacion']>=7){
					$aprobados++;
					if($row['sexo']=="H"){
						$hombresAprobados++;
					}else{
						$mujeresAprobadas++;
					}
				}else{
					$reprobados++;
					if($row['sexo']=="H"){
						$hombresReprobados++;
					}else{
						$mujeresReprobadas++;
					}
				}
				$numeroLista++;	
				}
				?>

			</tbody>
		</table>
		<?php 
		if ($numeroLista>1) {
			?>

			<br><br>
			<table>
			<tbody>
				<thead>
					<th>Género</th>
					<th colspan="1">Aprobados</th>
					<th colspan="1">Reprobados</th>
				</thead>
				<tr>
				<td>Hombres</td>
				<td align="center"><?php echo $hombresAprobados; ?></td>
				<td align="center"><?php echo $hombresReprobados; ?></td>
				</tr>
				<tr>
				<td>Mujeres</td>
				<td align="center"><?php echo $mujeresAprobadas; ?></td>
				<td align="center"><?php echo $mujeresReprobadas; ?></td>
				</tr>
				
				<tr>
				<td>Total:</td>
				<td align="center"><?php echo $aprobados; ?></td>
				<td align="center"><?php echo $reprobados; ?></td>
				</tr>
			</tbody>
		</table>


			<?php 
		}

		 ?>
		
<?php 
}

$grupoProfe=explode(",", $_POST['grupoProfe']);
				
				$_SESSION['grupo']=$grupoProfe[0];
				$_SESSION['profe']=$grupoProfe[1];
				$_SESSION['seleccionarGrupo2']=TRUE;
				$_SESSION['valida']=TRUE;
 ?>				
		<p><a href="seleccionarGrupo">Regresar</a></p>
		</center>
</form>

</div>
</body>
<footer>
<center>
	  <p>Desarrollado por:Aldo Matias Contacto: aldo_rheazyk@hotmail.com</p>
</center>

</footer> 
</html>
<?php 
	}else{
		echo "<script>window.location.href=\"index\";</script>";
	} 
?>