<?php
/**
 * Daniel Fernández García
 * 12/12/2015
 * V: 1.0
 * Controlador busqueda de tareas
 */

include 'constantes.php';


include(MODEL_PATH.'tareas.php');

//Obtener provincias
$provincias=ConsultaProvincias();
//Array de modificadores comparación
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
	
	//Filtrado
	$errores=FiltradoBusqueda($_REQUEST['fecha_crea']);
	if (!empty($errores))
	{
		//Hay errores
		include (VIEW_PATH.'buscarform.php');
		exit;
	}
	else 
	{
		//No hat errores
		$datos['fecha_crea']='fecha_crea'.$_REQUEST['modificador'].'\''.implode('-',array_reverse(explode('/',$_REQUEST['fecha_crea']))).'\'';
	}
}	
//Si provincia es distinta de "CUALQUIERA"
if(!isset($_REQUEST['cualquiera']))
{
	//Añadir busqueda por provincia
	$datos['provincia']='provincia='.$_REQUEST['provincia'];
}

//Si estado es distinto de "TODOS"
if($_REQUEST['estado']!='T')
{
	//Añadir búsqueda por estado
	$datos['estado']='estado='.'\''.$_REQUEST['estado'].'\'';
}

//Si no hay criterios de búsqueda
if(empty($datos))
{
	//Mostrar todas las tareas
	$tareas=BuscarTarea();
}
else 
{
	//Montar cadena string "WHERE" para acoplar a la consulta		
	$condiciones='where '.implode(' and ',$datos);
	//Envío del WHERE al modelo para la consulta
	$tareas=BuscarTarea($condiciones);
	
	
}

//Mostramos la vista de resultados de la búsqueda
include (VIEW_PATH.'resultados.php');



