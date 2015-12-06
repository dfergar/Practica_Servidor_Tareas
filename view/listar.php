<?php
/**
 * VISTA QUE MUESTA LA LISTA DE TAREAS.
 * El controlador será el que nos proporcine en la variable $tareas
 * las tareas a mostrar
 */
?>
<html>
    <head>
        <title>Controlador frontal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>    
<body>
<?php 
include(TEMPLATE_PATH.'encabezado.php');
include(TEMPLATE_PATH.'menu.php'); 
?>
<h1>Listado de tareas</h1>
<table>
    <tr>
        <th>Código</th>
        <th>Tarea</th>
        <td></td>
    </tr>
<?php foreach($tareas as $codigo=>$tarea) : ?>
    <tr>
        <td><?=$codigo?></td>
        <td><?=$tarea?></td>
         <td><a href="VerTareas.php?id=<?=$codigo?>">Ver Tarea</a></td>
        <td><a href="ModificarTareas.php?id=<?=$codigo?>">Modificar</a></td>
        <td><a href="BorrarTareas.php?id=<?=$codigo?>">Borrar</a></td>
        <td><a href="AnotarTareas.php?id=<?=$codigo?>">Anotar</a></td>
    </tr>
<?php endforeach; ?>
</table>
<br>
<div style="margin-left: 240px;" id="paginador"><?php MuestraPaginador($nPag, $totalPaginas, $myURL)?></div>



<?php
include(TEMPLATE_PATH.'pie.php');

?>
</body>
</html>