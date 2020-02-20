<?php

	require 'Classes/PHPExcel/IOFactory.php';

	$objPHPExcel=new PHPExcel();
	$objReader=PHPExcel_IOFactory::createReader('Excel2007');
	

	function plantilla(){
	global $objPHPExcel;
	global $objReader;
	 $objPHPExcel=$objReader->load('plantilla.xlsx');
	}
	function lista(){
	global $objPHPExcel;
	global $objReader;
	$objPHPExcel=$objReader->load('lista.xlsx');
	}
?>