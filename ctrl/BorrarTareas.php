<?php
include 'constantes.php';

include(MODEL_PATH.'tareas.php');

$codigo = $_REQUEST['id'];

$tareas=array();
$tareas=VerTareas($codigo);

if (! $_POST)
{
	// Primera vez
	include(VIEW_PATH.'BorrarTareasForm.php');
	exit; // Fin scripta
}

$id=$_REQUEST['id_tarea'];

if($_REQUEST['confirmar']==1)
{
	$mensaje="Tarea borrada";
	BorrarTarea($codigo);
}
else if($_REQUEST['confirmar']==0)
{
	$mensaje="Tarea NO borrada";
}
include(VIEW_PATH.'inicio.php');



