<?php
/**
 * Daniel Fernández García
 * 12/12/2015
 * V: 1.0
 * Controlador modificar Tareas
 */

include 'constantes.php';

include(MODEL_PATH.'tareas.php');
//Obtener las provincias para el select
$provincias=ConsultaProvincias();
//Captura del id que viene en el parámetro GET
$codigo = $_REQUEST['id'];
$tareas=array();
//Extraemos los datos de la tarea de la tarea que se quiere modificar de la base de datos 
$tareas=VerTareas($codigo);
//Conversión de fecha de YYYY-MM-DD a DD/MM/AAAA
$tareas['fecha_realiza']=date('d/m/Y',strtotime($tareas['fecha_realiza']));

if (! $_POST)
{
	// Primera vez
	include(VIEW_PATH.'ModificarTareaForm.php');
	exit; // Fin script
}

$datos = array();
//Nuevos datos introducidos en el form
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

//Filtrado
$errores=FiltradoTareas($datos);
if (!empty($errores))
{
	//Hay errores, pasamos los campos introducidos al array que usará el form isset para rectificación
	$tareas=$datos;
	//Mostramos la vista de la modificación
	include (VIEW_PATH.'ModificarTareaform.php');
}
else
{
	//No hay errores
	//Conversión de fecha de DD/MM/AAAA a YYYY-MM-DD
	$datos['fecha_realiza']=date("Y-m-d",strtotime(implode('-',array_reverse(explode('/',$_REQUEST['fecha_realiza'])))));
	//Envío de datos al modelo
	ModificarTarea($datos);
	$mensaje="Tarea Modificada";
	include 'inicio.php';
}





