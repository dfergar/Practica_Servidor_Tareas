<?php
include 'constantes.php';

include(MODEL_PATH.'tareas.php');
$provincias=ConsultaProvincias();
$codigo = $_REQUEST['id'];
$tareas=array();
$tareas=VerTareas($codigo);

if (! $_POST)
{
	// Primera vez
	include(VIEW_PATH.'AnotarTareaForm.php');
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
$datos['operario']=$_REQUEST['operario'];
$datos['fecha_realiza']=implode('/',array_reverse(explode('/',$_REQUEST['fecha_realiza'])));;
$datos['anot_antes']=$_REQUEST['anot_antes'];
$datos['anot_despues']=$_REQUEST['anot_despues'];

AnotarTarea($datos);

$mensaje="Anotación Realizada";

include 'inicio.php';



