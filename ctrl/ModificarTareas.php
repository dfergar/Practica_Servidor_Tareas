<?php
include 'constantes.php';

include(MODEL_PATH.'tareas.php');
$provincias=ConsultaProvincias();
$codigo = $_REQUEST['id'];
$tareas=array();
$tareas=VerTareas($codigo);
$tareas['fecha_realiza']=date('d/m/Y',strtotime($tareas['fecha_realiza']));

if (! $_POST)
{
	// Primera vez
	include(VIEW_PATH.'ModificarTareaForm.php');
	exit; // Fin scripta
}

$datos = array();

$datos['id_tarea']=$_REQUEST['id_tarea'];
$datos['descripcion']=$_REQUEST['descripcion'];
$datos['contacto']=$_REQUEST['contacto'];
$datos['telefono']=$_REQUEST['telefono'];
$datos['email']=$_REQUEST['email'];
$datos['direccion']=$_REQUEST['direccion'];
$datos['poblacion']=$_REQUEST['poblacion'];
$datos['cp']=$_REQUEST['cp'];
$datos['provincia']=$_REQUEST['provincia'];
$datos['estado']=$_REQUEST['estado'];
$datos['fecha_crea']=$_REQUEST['estado'];
$datos['operario']=$_REQUEST['operario'];
$datos['fecha_realiza']=$_REQUEST['fecha_realiza'];
$datos['anot_antes']=$_REQUEST['anot_antes'];
$datos['anot_despues']=$_REQUEST['anot_despues'];

$errores=FiltradoTareas($datos);
if (!empty($errores))
{
	$tareas=$datos;
	
	include (VIEW_PATH.'ModificarTareaform.php');
}
else
{
	$datos['fecha_realiza']=date("Y-m-d",strtotime(implode('-',array_reverse(explode('/',$_REQUEST['fecha_realiza'])))));
	ModificarTarea($datos);
	$mensaje="Tarea Modificada";
	include 'inicio.php';
}





