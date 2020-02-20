<?php 

require 'conexion.php';

$hombresAprobados=0;
$hombresReprobados=0;
$mujeresAprobadas=0;
$mujeresReprobadas=0;

$existeGrupo="SELECT count(*) FROM grupos WHERE horario='INTERSEMESTRAL' and activo=1";
$respExisteGrupo=$conexion->query($existeGrupo);
$respExisteGrupo=$respExisteGrupo->fetch_assoc();
if($respExisteGrupo['count(*)']>0){


$query2="SELECT idgrupo FROM grupos WHERE horario='INTERSEMESTRAL' and activo=1";
$resp=$conexion->query($query2);

while ($filaGrupo=$resp->fetch_assoc()) {

	$grupo=$filaGrupo['idgrupo'];
	$hayEvalucaciones="SELECT count(idGrupoEv) from evaluacion where idGrupoEv=$grupo";
	$respHayEvaluaciones=$conexion->query($hayEvalucaciones);
	$filasHayEval=$respHayEvaluaciones->fetch_assoc();
	if($filasHayEval['count(idGrupoEv)']>0){

		$matriculasInscritas="SELECT Alumnos_matricula FROM alumnos_has_grupos WHERE inscrito=1 and grupos_idgrupo=$grupo";
		$respuestaMatriculasInscritas=$conexion->query($matriculasInscritas);
		while ($filaMatriculas=$respuestaMatriculasInscritas->fetch_assoc()) {
			$matricula=$filaMatriculas['Alumnos_matricula'];
			$promedio="SELECT avg(calificacion), Alumnos_matriculaEv, nivelActual, sexo FROM evaluacion, alumnos  WHERE Alumnos_matriculaEv='$matricula' and idGrupoEv=$grupo and enCurso=1";
			$promedioRespuesta=$conexion->query($promedio);
			while ($filasPromedio=$promedioRespuesta->fetch_assoc()) {
				$nivel=$filasPromedio['nivelActual'];
				if($filasPromedio['avg(calificacion)']>=7){
					$cambiarNivel="UPDATE `ingles_tesi`.`alumnos` SET `ultimo_nivel_ingles`='$nivel' WHERE `matricula`='$matricula'";
					$respuesta=$conexion->query($cambiarNivel);
					if($filasPromedio['sexo']=="H"){
						$hombresAprobados++;
					}else{
						$mujeresAprobadas++;
					}

				}else{
					if($filasPromedio['sexo']=="H"){
						$hombresReprobados++;
					}else{
						$mujeresReprobadas++;
					}
				}

			}

			
			$aprobadosYReprobados="UPDATE `ingles_tesi`.`grupos` SET `hombresAprobados`=$hombresAprobados, `mujeresAprobadas`=$mujeresAprobadas, `hombresReprobados`=$hombresReprobados, `mujeresReprobadas`=$mujeresReprobadas WHERE `idgrupo`=$grupo";
			$hacerConsultaAprobadosReprobados=$conexion->query($aprobadosYReprobados);
		}
	}
}


$numeroGrupos="SELECT count(*) FROM grupos WHERE activo=1 and horario='INTERSEMESTRAL'";
$respuestaNumeroGrupos=$conexion->query($numeroGrupos);
$filaNumeroGrupos=$respuestaNumeroGrupos->fetch_assoc();
$i=1;
while ($i<=$filaNumeroGrupos['count(*)']) {


$query2="SELECT idgrupo FROM grupos WHERE horario='INTERSEMESTRAL'";
$resp=$conexion->query($query2);


while ($fila=$resp->fetch_assoc()) {
	
$grupo=$fila['idgrupo'];

$query="UPDATE `ingles_tesi`.`alumnos_has_grupos` SET `inscrito`='0' WHERE `grupos_idgrupo`=$grupo";
$respuesta=$conexion->query($query);
$query4="UPDATE `ingles_tesi`.`evaluacion` SET `enCurso`='0' WHERE `idGrupoEv`=$grupo";
$respuestaQuery4=$conexion->query($query4);
$query3="UPDATE `ingles_tesi`.`grupos` SET `activo`='0',`inscribiendo`='0' WHERE `idgrupo`='$grupo'";
$respuesta=$conexion->query($query3);
}
echo "<script>
window.location.href=\"index\";
</script>";
}
}else{
	echo "<script>
window.location.href=\"index\";
</script>";
}
 ?>