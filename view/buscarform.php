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
			<td>Fecha creación</td>			
			<td><?=CreaSelect2($modificadores,'modificador')?><input type="text" name="fecha_crea" value="<?php if(isset($_POST['fecha_crea'])) echo $_POST['fecha_crea']?>"></td>
		</tr>
		<tr>
			<td>Provincia</td><td><input type="checkbox" name="cualquiera" value=1>Todas<?php	isset($datos['provincia']) ? CreaSelect3($provincias, "provincia",$datos['provincia']) : CreaSelect3($provincias, "provincia") ?>
		</tr>
		<tr>
		<td>Estado</td>
		<td>			
			<input type="radio" name="estado" value="T">Todos
			<input type="radio" name="estado" value="P" checked>Pendiente
			<input type="radio" name="estado" value="R">Realizada
			<input type="radio" name="estado" value="C">Cancelada			
		</td>
	</tr>
		<tr>
			<td><input type="submit" value="Enviar"></td>
	</table>
</form>
<?php 
if (isset($errores)) // Evaluamos Nº elementos
{
	foreach($errores as $clave=>$error)
	{
		VerError($clave);
		?><br><?php
	}
}
?>
<?php
include(TEMPLATE_PATH.'pie.php');
?>
</body>
</html>
