<?php

include 'patron.php';

//Devuelve array con el id y la descripcion de cada una de las tareas
function ListarTareas($nReg, $nElementosxPagina)
{
	//instanciamos y nos conectamos
	$db = Database::getInstance();

	$tareas= array();
	$sql ="select id_tarea, descripcion from tbl_tareas order by fecha_crea desc LIMIT $nReg, $nElementosxPagina ";
		
	$db->Consulta($sql);
	while ($fila = $db->LeeRegistro())
	{
		$tareas[$fila['id_tarea']]=$fila['descripcion'];
	}
		
	$db->cerrar();
	return $tareas;
}


function ConsultaProvincias()
{
	$db = Database::getInstance();
	$sql ="select cod, nombre from tbl_provincias";
	$db->Consulta($sql);
	//Empiezo a recorrer la consulta de las provincias
	while ($fila = $db->LeeRegistro())
	{		
		//array con indice codigo provincia y valores los nombre de las provincias
		$provincias[$fila['cod']]=$fila['nombre'];
	}
	return $provincias;
}

function ObtenerProvincia($codProvincia)
{
	$db = Database::getInstance();
	$sql ="select nombre from tbl_provincias where cod=$codProvincia";
	$db->Consulta($sql);
	$fila = $db->LeeRegistro();
	
	return $fila['nombre'];
}

function VerTareas($id)
{
	$db = Database::getInstance();
	$sql ="select * from tbl_tareas where id_tarea=$id";
	$db->Consulta($sql);
	$fila = $db->LeeRegistro();
	
	return $fila;
	
}

function NumeroTareas()
{
	//instanciamos y nos conectamos
	$db = Database::getInstance();

	$sql ='select count(*) as total from tbl_tareas';

	$db->Consulta($sql);
	$fila = $db->LeeRegistro();		
	//$db->cerrar();
	return $fila['total'];
}

function NuevaTarea($datos)
{
	//instanciamos y nos conectamos
	$db = Database::getInstance();
	
	$sql="insert into tbl_tareas (descripcion, 
								  contacto, 
								  telefono, 
								  email, 
								  direccion,
								  poblacion, 
								  cp, 
								  provincia, 
								  estado, 								 
								  operario, 
								  fecha_realiza, 
								  anot_antes, 
								  anot_despues)
			values (			  '$datos[descripcion]', 
							      '$datos[contacto]', 
							      '$datos[telefono]', 
							      '$datos[email]', 
							      '$datos[direccion]',
							      '$datos[poblacion]', 
							      '$datos[cp]', 
							      '$datos[provincia]', 
							      '$datos[estado]', 							     
							      '$datos[operario]', 
							      '$datos[fecha_realiza]',
							      '$datos[anot_antes]', 
								  '$datos[anot_despues]')";
	$db->Consulta($sql);
	$db->cerrar();
	

}

function ModificarTarea($datos)
{	
	//instanciamos y nos conectamos
	$db = Database::getInstance();
	
	$sql="update tbl_tareas set 
		descripcion='$datos[descripcion]',
		contacto='$datos[contacto]',
		telefono='$datos[telefono]',
		email='$datos[email]',
		direccion='$datos[direccion]',
		poblacion='$datos[poblacion]',
		cp='$datos[cp]',
		provincia='$datos[provincia]',
		estado='$datos[estado]',		
		operario='$datos[operario]',
		fecha_realiza='$datos[fecha_realiza]',
		anot_antes='$datos[anot_antes]',
		anot_despues='$datos[anot_despues]'
		where id_tarea=$datos[id_tarea]";
	
	$db->Consulta($sql);
	$db->cerrar();
}


function AnotarTarea($datos)
{
	//instanciamos y nos conectamos
	$db = Database::getInstance();
	
	$sql="update tbl_tareas set	
	estado='$datos[estado]',	
	anot_antes='$datos[anot_antes]',
	anot_despues='$datos[anot_despues]'
	where id_tarea=$datos[id_tarea]";
	
	$db->Consulta($sql);
	$db->cerrar();
}

function BuscarTarea($condiciones="")
{
	//instanciamos y nos conectamos
	$db = Database::getInstance();
	
	$tareas=array();
	
	$sql ="select id_tarea, descripcion, fecha_crea, provincia, estado from tbl_tareas $condiciones";
	
	$db->Consulta($sql);
	while ($fila = $db->LeeRegistro())
	{
		
		$tareas[]=['id_tarea'=>$fila['id_tarea'], 'descripcion'=>$fila['descripcion'], 'fecha_crea'=>$fila['fecha_crea'], 'provincia'=>$fila['provincia'], 'estado'=>$fila['estado']];
	}
	
	$db->cerrar();
	return $tareas;
}


function VerError($campo)
{

	global $errores;
	if (isset($errores[$campo]))
	{
		echo $errores[$campo];
	}
}


/**
 * Muestra un paginador para una lista de elementos
 *
 * @param int $pag_actual
 * @param unknown $nPags
 * @param unknown $url
 */
function MuestraPaginador($pag_actual, $nPags, $url)
{
	// Mostramos paginador
	echo '<div>';
	echo EnlaceAPagina($url,1, 'Inicio');
	echo EnlaceAPagina($url, $pag_actual-1, 'Anterior', $pag_actual>1, false);
	for($pag=1; $pag<=$nPags; $pag++)
	{
		echo EnlaceAPagina($url, $pag, $pag, $pag_actual!=$pag, true);
		
	}
	echo EnlaceAPagina($url, $pag_actual+1, 'Siguiente', $pag_actual<$nPags);
	echo EnlaceAPagina($url, $nPags, 'Fin');
	echo "</div>";
}



/**
 * Devuelve el texto de un enlace (etiqueta <a>) a la p�gina $url si el enlace est� activo,
 * en otro caso solo devuelve el texto
 *
 * @param string $url		URL de la p�gina que muestra la lista
 * @param int $pag			Nº de página al cual enlazamos
 * @param string $texto		Texto del enlace
 * @param bool $activo		Se muestra enlace (true) o no (false)
 * @return string
 */
function EnlaceAPagina($url, $pag, $texto, $activo=true, $botonpagina=false)
{
	if ($activo)
		return '<a href="'.$url.'?pag='.$pag.'">'.'<button style="width: 80px;">'.$texto.'</button></a> ';
	else		
	 	if($botonpagina) return '<button style="width: 80px;background-color: yellow;">'.$texto.'</button>';else return '<button style="width: 80px;">'.$texto.'</button>';
}

function CreaSelect($array, $name)
{
	echo "<select name=\"".$name."\">";

	foreach($array as $clave=>$valor)
	{

		echo "<option value=\"".$clave."\">".$valor;
	}

	echo "</select>";
}

function CreaSelect2($array, $name)
{
	echo "<select name=\"".$name."\">";

	foreach($array as $clave=>$valor)
	{

		echo "<option value=\"".$valor."\">".$valor;
	}

	echo "</select>";
}
//Función para crear selects
function CreaSelect3($array, $name, $selected='')
{
	echo "<select name=\"".$name."\">";

	foreach($array as $clave=>$valor)
	{
		if ($clave==$selected)
		{
			$htmlSel=" selected";
		}
		else 
		{
			$htmlSel='';
		}
		echo "<option $htmlSel value=\"".$clave."\">".$valor;
	}

	echo "</select>";
}



function BorrarTarea($id)
{
	
	$db = Database::getInstance();
	
	$sql ="delete from tbl_tareas where id_tarea=$id";
	
	$db->Consulta($sql);
	
	//$db->cerrar();
	
}



function FiltradoTareas($datos)
{
	
	$errores=array();

	//Expresiones regulares 
	$telefono="/^\d{9}/i";
	$cp="/^\d{5}/i";
	$email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
	$fecha="/^\d{2}\/\d{2}\/\d{4}$/i";

	//Descripción en blanco
	if ($datos['descripcion']=="")
	{
		$errores['descripcion']="Debe introducir alguna descripción de la tarea";
	}
	
	//Contacto en blanco
	if ($datos['contacto']=="")
	{
		$errores['contacto']="Debe introducir algun contacto";
	}
	
	//Teléfono en blanco o en formato inválido
	 if (!preg_match($telefono, $datos['telefono']))
	{
		$errores['telefono']="Debe introducir algun teléfono en formato válido de 9 digitos";
	}
	
	//Codigo postal en formato inválido
	 if (!preg_match($cp, $datos['cp']))
	 {
	 	$errores['cp']="Debe introducir un código postal en formato válido de 5 digitos";
	 }
	 
	 //Correo electrónico en formato inválido
	  if (!preg_match($email, $datos['email']))
	 {
	 	$errores['email']="Debe introducir un correo electrónico en formato válido";
	 }
	 
	 //Comprobación de formato correcto de fecha 
	 if (preg_match($fecha, $datos['fecha_realiza']))
	 {
	 	//Si formato correcto comprobar validez de la fecha
	 	if (!comprobarfecha($datos['fecha_realiza']))
	 	{
	 		$errores['fecha_realiza_posible']="La fecha introducida no existe";
	 	}
	 	else
	 	{ 		
	 		$fecha_in=date("Y-m-d",strtotime(implode('-',array_reverse(explode('/',$_REQUEST['fecha_realiza'])))));	 		
	 		$actual=date('Y-m-d');
	 		if($fecha_in<=$actual)
	 		{
	 			$errores['fecha_pasada']="La fecha de realización del trabajo debe ser posterior a la actual";
	 		}
	 		
	 	}
	 	
	 }
	 else 
	 {
	 	$errores['fecha_realiza_formato']="Debe introducir una fecha en el formato DD/MM/AAAA";
	 }
	 
	 
	 	

	return $errores;
}

//Filtrado de la búsqueda
function FiltradoBusqueda($fecha_in)
{

	$errores=array();

	//Expresiones regulares	
	$fecha="/^\d{2}\/\d{2}\/\d{4}$/i";	

	//Comprobación de formato correcto de fecha
	if (preg_match($fecha, $fecha_in))
	{
		//Si formato correcto comprobar validez de la fecha
		if (!comprobarfecha($fecha_in))
		{
			$errores['fecha_crea_posible']="La fecha introducida no existe";
		}		
		 
	}
	else
	{
		$errores['fecha_crea_formato']="Debe introducir una fecha en el formato DD/MM/AAAA";
	}


	 

	return $errores;
}

function comprobarfecha($fecha)
{
	
	$partes = explode('/',$fecha);
	
	$dia = $partes[0];
	
	$mes = $partes[1];
	
	$anio = $partes[2];	
	
	return checkdate($mes, $dia, $anio);
}




