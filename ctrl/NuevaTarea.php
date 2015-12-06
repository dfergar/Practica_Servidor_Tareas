<?php
include 'constantes.php';

include(MODEL_PATH.'tareas.php');


// Suponemos que no habr� errores
$provincias=ConsultaProvincias();

$errores=array();
if (! $_POST)
{
	// Primera vez
	include (VIEW_PATH.'NuevaTareaform.php');
	exit; // Fin scripta
}

$datos = array();

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
$fin=date("Y-m-d",strtotime(implode('-',array_reverse(explode('/',$_REQUEST['fecha_realiza'])))));
$datos['fecha_realiza']=$fin;
$datos['anot_antes']=$_REQUEST['anot_antes'];
$datos['anot_despues']=$_REQUEST['anot_despues'];




NuevaTarea($datos);
$mensaje="Tarea introducida ";

include 'inicio.php';




?>
























<?php 
/*51. Realiza una p�gina que nos permita a�adir nuevas provincias a nuestra base de datos.
 *  Las provincias creadas estar�n ubicadas en una nueva comunidad aut�noma que se llamar�
 *   �Nuevas provincias�.

La entrada ser� filtrada, de forma que no se permitir� que introduzcan provincias repetidas o
 que se introduzcan cadenas en blanco. Igualmente el nombre de la provincia no deber� contener 
 ning�n d�gito. V�ase el art�culo �Expresiones regulares en PHP� o el o el minimanual 
 Explicaciones y ejemplos para el manejo de expresiones regulares. 
El programa tendr� un formulario similar al siguiente:
Provincia:                   [A�adir]      Ver todas las provincias

Despu�s de cambiar, filtrando que los datos sean correctos, se seguir� preguntando para seguir cambiando el nombre.

Donde desde el enlace �Ver todas las provincias� mostraremos todas las provincias y comunidades aut�nomas que tenemos almacenadas.*/?>