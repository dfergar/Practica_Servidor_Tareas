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
<h1>Búsqueda de Tareas</h1>
<form action="#" method="POST">
	<table>
		<tr>
			<td>Descripción</td><td><input type="text" name="descripcion"></td>
		</tr>
		<tr>
			<td>Provincia</td><td><?php	CreaSelect($provincias, "provincia");?>
		</tr>
		<tr>
			<td>
				<input type="radio" name="estado" value="P">Pendiente
				<input type="radio" name="estado" value="R">Realizada
				<input type="radio" name="estado" value="C">Cancelada
			</td>
		</tr>
		<tr>
			<td><input type="submit" value="Enviar"></td>
	</table>
</form>
<?php
include(TEMPLATE_PATH.'pie.php');
?>
</body>
</html>
