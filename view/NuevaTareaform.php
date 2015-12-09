
<?php
/**
 * VISTA QUE MUESTA FORMULARIO DE ALTA
 * 
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

<form action="#" method="POST">
<h2>Alta de nueva Tarea</h2>
<table>

	<tr>
		<td>Descripción</td><td><input type="text" name="descripcion" value="<?php if(isset($_POST['descripcion'])) echo $_POST['descripcion']?>"></td>
	</tr>
	<tr>	
		<td>Persona de contacto</td><td><input type="text" name="contacto" value="<?php if(isset($_POST['contacto'])) echo $_POST['contacto']?>"></td>
	<tr>
		<td>Teléfono</td><td><input type="text" name="telefono" value="<?php if(isset($_POST['telefono'])) echo $_POST['telefono']?>"></td>
	</tr>
	<tr>
		<td>Correo electrónico</td><td><input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>"></td>
	</tr>
	<tr>
		<td>Dirección</td><td><input type="text" name="direccion" value="<?php if(isset($_POST['direccion'])) echo $_POST['direccion']?>"></td>
	</tr>
	<tr>
		<td>Población</td><td><input type="text" name="poblacion" value="<?php if(isset($_POST['poblacion'])) echo $_POST['poblacion']?>"></td>
	</tr>
	<tr>
		<td>Provincia</td><td><?php	isset($datos['provincia']) ? CreaSelect3($provincias, "provincia",$datos['provincia']) : CreaSelect3($provincias, "provincia") ?></td>
	</tr>
	<tr>
		<td>cp</td><td><input type="text" name="cp" value="<?php if(isset($_POST['cp'])) echo $_POST['cp']?>"></td>
	</tr>
	<tr>
		<td>Estado</td>
		<td>
			<input type="radio" name="estado" value="P" checked>Pendiente
			<input type="radio" name="estado" value="R" <?php if(isset($_POST['estado']) && $_POST['estado']=='R') echo "checked";?>>Realizada
			<input type="radio" name="estado" value="C" <?php if(isset($_POST['estado']) && $_POST['estado']=='C') echo "checked";?>>Cancelada
		</td>
	</tr>
		<tr>
		<td>Operario encargado</td><td><input type="text" name="operario" value="<?php if(isset($_POST['operario'])) echo $_POST['operario']?>"></td>
	</tr>
	<tr>
		<td>Fecha de realización</td><td><input type="text" name="fecha_realiza" value="<?php if(isset($_POST['fecha_realiza'])) echo $_POST['fecha_realiza']?>"></td>
	</tr>
	<tr>
		<td>Anotaciones anteriores</td><td><input type="text" name="anot_antes" value="<?php if(isset($_POST['poblacion'])) echo $_POST['poblacion']?>"></td>
	</tr>
	<tr>
		<td>Anotaciones posteriores</td><td><input type="text" name="anot_despues" value="<?php if(isset($_POST['anot_despues'])) echo $_POST['anot_despues']?>"></td>
	</tr>
	<tr>
		<td><input type="submit" value="Enviar"></td>
	</tr>

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




	






