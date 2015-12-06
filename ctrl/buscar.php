<?php
include 'constantes.php';


include(MODEL_PATH.'tareas.php');

$provincias=ConsultaProvincias();

$errores=array();
if (! $_POST)
{
	// Primera vez
	include (VIEW_PATH.'buscar.php');
	exit; // Fin script
}

$datos = array();

$datos['descripcion']=$_REQUEST['descripcion'];
$datos['provincia']=$_REQUEST['provincia'];
$datos['estado']=$_REQUEST['estado'];



//BuscarTarea($datos);
