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
        <td>Código</td><td><?=$tareas['id_tarea'];?></td>
   </tr>
   <tr>
        <td>Descripción</td><td><?=$tareas['descripcion'];?></td>
   </tr>
   <tr>
        <td>Contacto</td><td><?=$tareas['contacto'];?></td>
   </tr>
   <tr>     
        <td>Teléfono</td><td><?=$tareas['telefono'];?></td>
   </tr>
   <tr>
        <td>eMail</td><td><?=$tareas['email'];?></td>
   </tr>
   <tr>    
        <td>Dirección</td><td><?=$tareas['direccion'];?></td>
   </tr>
   <tr>
        <td>Población</td><td><?=$tareas['poblacion'];?></td>
   </tr>
   <tr>    
        <td>Código Postal</td><td><?=$tareas['cp'];?></td> 
   </tr>
   <tr>    
        <td>Provincia</td><td><?=ObtenerProvincia($tareas['provincia']);?></td> 
   </tr>
   <tr>    
        <td>Estado</td><td><?=$tareas['estado'];?></td>  
   </tr>
   <tr>    
        <td>Fecha Creación</td><td><?=date('d/m/Y',strtotime($tareas['fecha_crea']));?></td>
   </tr>
   <tr>    
        <td>Operario</td><td><?=$tareas['operario'];?></td>
   </tr>
   <tr>    
        <td>Fecha Realización</td><td><?=date('d/m/Y',strtotime($tareas['fecha_realiza']));?></td>
   </tr>
   </tr>
   <tr>    
        <td>Anotaciones anteriores</td><td><?=$tareas['anot_antes'];?></td>
   </tr>
   <tr>    
        <td>Anotaciones posteriores</td><td><?=$tareas['anot_despues'];?></td>  
   </tr>
   <tr>
		<td>
			<a href="ModificarTareas.php?id=<?=$codigo?>"><button>Modificar</button></a>
        	<a href="BorrarTareas.php?id=<?=$codigo?>"><button>Borrar</button></a>
        	<a href="AnotarTareas.php?id=<?=$codigo?>"><button>Anotar</button></a>
		</tr>
    

</table>




<?php
include(TEMPLATE_PATH.'pie.php');

?>
</body>
</html>
