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
	$datos['fecha_crea']='fecha_crea'.$_REQUEST['modificador'].implode('/',array_reverse(explode('/',$_REQUEST['fecha_crea'])));
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
	$mensaje='NO INTRODUJO NINGUN CRITERIO DE BUSQUEDA, SI DESEA VER TODOS LOS REGISTROS PULSE [LISTAR], O BIEN, REPITA LA BUSQUEDA';
	include'inicio.php';
}
else 
{
	print_r(BuscarTarea($datos));
}

