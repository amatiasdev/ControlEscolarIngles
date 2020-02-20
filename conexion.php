<?php
 $conexion=new mysqli("localhost","root","", "ingles_tesi");
 mysqli_set_charset($conexion, 'utf8');
 if($conexion){
 	echo " ";

 }else{
 	echo "NO SE PUDO CONECTAR A LA BD";
 }
?>