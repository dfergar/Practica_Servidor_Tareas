<?php
include 'constantes.php';


include(MODEL_PATH.'tareas.php');

$provincias=ConsultaProvincias();
$modificadores= array('<','=','>');
$errores=array();
if (! $_POST)
{
	// Primera vez
	include (VIEW_PATH.'buscarform.php');
	exit; // Fin script
}

$datos = array();

if(!empty($_REQUEST['fecha_crea']))
{
	
	
	$errores=FiltradoBusqueda($_REQUEST['fecha_crea']);
	if (!empty($errores))
	{
		include (VIEW_PATH.'buscarform.php');
	}
	else 
	{
		$datos['fecha_crea']='fecha_crea'.$_REQUEST['modificador'].'\''.implode('-',array_reverse(explode('/',$_REQUEST['fecha_crea']))).'\'';
	}
}	
if(!isset($_REQUEST['cualquiera']))
{
	$datos['provincia']='provincia='.$_REQUEST['provincia'];
}

if($_REQUEST['estado']!='T')
{
	$datos['estado']='estado='.'\''.$_REQUEST['estado'].'\'';
}

if(empty($datos))
{
	
	$tareas=BuscarTarea();
}
else 
{
			
	$condiciones='where '.implode(' and ',$datos);
	$tareas=BuscarTarea($condiciones);
	
	
}


include (VIEW_PATH.'resultados.php');



