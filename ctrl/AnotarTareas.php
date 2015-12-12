<?php
/**
 * Daniel Fernández García
 * 12/12/2015
 * V: 1.0
 * Controlador Anotaciones/actualizaciones de tareas
 */

include 'constantes.php';

include(MODEL_PATH.'tareas.php');

//Obtener provincias para el select
$provincias=ConsultaProvincias();

//Captura del parámetro GET
$codigo = $_REQUEST['id'];

$tareas=array();
//Obtenemos datos de la tarea a anotar
$tareas=VerTareas($codigo);

if (! $_POST)
{
	// Primera vez
	include(VIEW_PATH.'AnotarTareaForm.php');
	exit; // Fin scripta
}

$datos = array();
//Guardamos datos introducidos en array,
$datos['id_tarea']=$_REQUEST['id_tarea'];
$datos['estado']=$_REQUEST['estado'];
$datos['anot_antes']=$_REQUEST['anot_antes'];
$datos['anot_despues']=$_REQUEST['anot_despues'];

//Pasamos datos al modelo para que los introduzca en la base de datos
AnotarTarea($datos);

$mensaje="Anotación Realizada";

include 'inicio.php';



