<?php
/**
 * VISTA QUE MUESTA LA LISTA DE TAREAS TRAS LA BUSQUEDA
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
<div style="height: 300px;">
<table>
    <tr>
        <th>Código</th>
        <th>Tarea</th>
        <th>Fecha creación</th>
        <th>Provincia</th>
        <th>Estado</th>
        <td></td>
    </tr>
<?php foreach($tareas as $tarea) : ?>
    <tr>    	
		<td><?=$tarea['id_tarea']?></td>
		<td><?=$tarea['descripcion']?></td>
		<td><?=date('d/m/Y',strtotime($tarea['fecha_crea']));?></td>
		<td><?=ObtenerProvincia($tarea['provincia']);?></td>
		<td><?=$tarea['estado']?></td>
        <td><a href="VerTareas.php?id=<?=$tarea['id_tarea']?>">Ver Tarea</a></td>
        <td><a href="ModificarTareas.php?id=<?=$tarea['id_tarea']?>">Modificar</a></td>
        <td><a href="BorrarTareas.php?id=<?=$tarea['id_tarea']?>">Borrar</a></td>
        <td><a href="AnotarTareas.php?id=<?=$tarea['id_tarea']?>">Anotar</a></td>        	 
    </tr>    
<?php endforeach; ?>
</table>

<?php
include(TEMPLATE_PATH.'pie.php');

?>
</body>
</html>