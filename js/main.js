var clic=0;
$(document).ready(function(){
	//PLANTILLA PAGINA
	$('.menu li:has(ul)').click(function(e){
		e.preventDefault();
	if ($(this).hasClass('activado')) {
		$(this).removeClass('activado');

		$(this).children('ul').slideUp();
	}else{
		$('.menu li ul').slideUp();
		$('.menu li').removeClass('activado');
		$(this).addClass('activado');
		$(this).children('ul').slideDown();
	}
	});

	$('.menu li ul li a').click(function(){

		window.location.href = $(this).attr("href");
	});


	$('.semestre').hide();
	$('.kardex').hide();

$('#boton').click(function(){
			if($('#opcion').val()=='Información Escolar'){
				$('.formAlumn').attr("action","infoAlumno.php")
			}else{
				$('.formAlumn').attr("action","infoPersonal.php")
			}
	});
$('.tipoInfo').change(function(){
	if($(this).val()=="Kardex"){		
		$('.semestre').hide();
		$('.kardex').show();

	}else if ($(this).val()=="Curso"){
		$('.kardex').hide();
		$('.semestre').show();
	}else if($(this).val()=="Seleccione una opción"){

		$('.semestre').hide();
		$('.kardex').hide();
	}
});


$('.interno').change(function(){
	if($(this).val()=="no"){
		$('.matricula').hide();

		$('.carreraAlumno').hide();
		$('.semestreAlumno').hide();
		$('.grupocarr').hide();
	}else{
		$('.matricula').show();
		$('.carreraAlumno').show();
		$('.semestreAlumno').show();
		$('.grupocarr').show();
	}
});



$('.nivel').hide();
$('.carrera').hide();
$('.modalidad').hide();
$('.grupo').show();
$('.opcion').change(function(){
if($(this).val()=="Grupo"){
	$('.nivel').hide();
	$('.carrera').hide();
	$('.modalidad').hide();
	$('.grupo').show();
}else if($(this).val()=="Nivel"){
	$('.carrera').hide();
	$('.modalidad').hide();
	$('.grupo').hide();
	$('.nivel').show();
}else if($(this).val()=="Carrera"){
	$('.modalidad').hide();
	$('.grupo').hide();
	$('.nivel').hide();
	$('.carrera').show();
}else if($(this).val()=="Modalidad"){
	$('.grupo').hide();
	$('.nivel').hide();
	$('.carrera').hide();
	$('.modalidad').show();
}
});






var indice=0;
var campos="";
$('.campos input').hide();
$('.campos textarea').hide();
$('.campos .matricula').hide();
$('.campos select').hide();
$('.editar').click(function(){

if(indice==1){
	$('.form').submit();
		indice++;
}else{
$('.campos label').hide();

$('.campos input').show();
$('.campos textarea').show();
$('.campos select').show();
$('.editar').text("Actualizar Datos");
$('.campos .matricula').hide();
indice++;
clic++;
}

});


var indice2=0;
var clic2=0;
$('.campos input').hide();
$('.editarProf').click(function(){
if(indice2==1){
	$('.formProf').submit();
		indice2++;
}else{
$('.campos label').hide();
$('.campos input').show();
indice2++;
clic2++;
}
});



$('.semestral').click(function(){
	 eliminar=confirm("¿Esta seguro que desea terminar todos los cursos Semestrales?");
   if (eliminar){
     $(this).attr("href","terminarSemestrales.php");
 }
});

$('.inter').click(function(){
	 eliminar=confirm("¿Esta seguro que desea terminar todos los cursos Intersemestrales?");
   if (eliminar){
     $(this).attr("href","terminarIntersemestrales.php");
 }
});

$('.sabados').click(function(){
	console.log("HOLA");
	 eliminar=confirm("¿Esta seguro que desea terminar todos los cursos Sabatinos?");
   if (eliminar){
     $(this).attr("href","terminarSabatinos.php");
 }
});

$('.cerrarIns').click(function(){
	console.log("hola");
	eliminar=confirm("¿Esta seguro que desea cerrar las incripciones para este grupo?");
   if (eliminar){
     $('.formGrupo').attr("action","cerrarInscripcionGrupo.php");
   		$('.formGrupo').submit();
 }
});

});

function eliminar(){
   eliminar=confirm("¿Deseas eliminar a este Alumno?");
   if (eliminar){
     $('.form').attr("action","eliminar.php");
   		$('.form').submit();
 }
}

function actualizar(){

	if(clic==1){
		eliminar=confirm("¿Deseas modificar los datos de este Alumno?");
   if (eliminar){
   	 window.location.href = "actualizar.php"; //página web a la que te redirecciona si confirmas la eliminación
   }else{
   	window.location.href = "index.php";
   }
	}
}

function eliminarProf(){
   eliminar=confirm("¿Deseas eliminar a este Profesor?");
   if (eliminar){
     $('.formProf').attr("action","eliminarProfe.php");
   		$('.formProf').submit();
 }
}

function actualizarProf(){

	
   if(clic2==1){
		eliminar=confirm("¿Deseas modificar los datos de este Profesor?");
   if (eliminar){
   	 window.location.href = "actualizarProf.php"; //página web a la que te redirecciona si confirmas la eliminación
   }else{
   	window.location.href = "index.php";
   }
	}
}
/*
function cerrarInscripciones(){
   eliminar=confirm("¿Esta seguro que desea cerrar las incripciones para este grupo?");
   if (eliminar){
     $('.formGrupo').attr("action","cerrarInscripcionGrupo.php");
   		$('.formGrupo').submit();
 }
}*/
