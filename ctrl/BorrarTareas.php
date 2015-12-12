
<?php
/**
 * Daniel Fernández García
 * 12/12/2015
 * V: 1.0
 * controlador borrado de tareas
 */

include 'constantes.php';

include(MODEL_PATH.'tareas.php');

//Captura del parámetro GET
$codigo = $_REQUEST['id'];

$tareas=array();
$tareas=VerTareas($codigo);

if (! $_POST)
{
	// Primera vez
	//Mostramos la vista de la tareas que se quiere borrar
	include(VIEW_PATH.'BorrarTareasForm.php');
	exit; // Fin scripta
}

$id=$_REQUEST['id_tarea'];

//Confirmación del borrado
if($_REQUEST['confirmar']==1)
{
	$mensaje="Tarea borrada";
	BorrarTarea($id);
}
else if($_REQUEST['confirmar']==0)
{
	$mensaje="Tarea NO borrada";
}
include(VIEW_PATH.'inicio.php');



