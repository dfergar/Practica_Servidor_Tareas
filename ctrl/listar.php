<?php
/**
 * Daniel Fernández García
 * 12/12/2015
 * V: 1.0
 * Controlador para listar tareas paginadas
 */

include 'constantes.php';

include(MODEL_PATH.'tareas.php');

// Ruta URL desde la que ejecutamos el script
$myURL='listar.php';

//Elementos por página
$nElementosxPagina=5;

// Calculamos el número de página que mostraremos
if (isset($_GET['pag']))
{
	// Leemos de GET el número de página
	$nPag=$_GET['pag'];
}
else
{
	// Mostramos la primera página
	$nPag=1;
}
$totalRegistros=NumeroTareas()-1;

$totalPaginas=floor($totalRegistros/$nElementosxPagina)+1;


// Calculamos el registro por el que se empieza en la sentencia LIMIT
$nReg=($nPag-1)*$nElementosxPagina;
/* Muesta la lista de tareas */
$tareas= ListarTareas($nReg, $nElementosxPagina);

//Mostramos la vista del listado de tareas
include(VIEW_PATH.'listar.php');



