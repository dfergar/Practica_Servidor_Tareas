<?php
include 'constantes.php';

include(MODEL_PATH.'tareas.php');

// Ruta URL desde la que ejecutamos el script
$myURL='listar.php';

$nElementosxPagina=10;

// Calculamos el número de página que mostraremos
if (isset($_GET['pag']))
{
	// Leemos de GET el n�mero de p�gina
	$nPag=$_GET['pag'];
}
else
{
	// Mostramos la primera p�gina
	$nPag=1;
}
$totalRegistros=NumeroTareas();

$totalPaginas=floor($totalRegistros/$nElementosxPagina)+1;


// Calculamos el registro por el que se empieza en la sentencia LIMIT
$nReg=($nPag-1)*$nElementosxPagina;
/* Muesta la lista de tareas */
$tareas= ListarTareas($nReg, $nElementosxPagina);


include(VIEW_PATH.'listar.php');



