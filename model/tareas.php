<?php

include 'patron.php';

//Devuelve array con el id y la descripcion de cada una de las tareas
function ListarTareas($nReg, $nElementosxPagina)
{
	//instanciamos y nos conectamos
	$db = Database::getInstance();

	$tareas= array();
	$sql ="select id_tarea as Codigo, descripcion as Tarea from tbl_tareas LIMIT $nReg, $nElementosxPagina";
		
	$db->Consulta($sql);
	while ($fila = $db->LeeRegistro())
	{
		$tareas[$fila['Codigo']]=$fila['Tarea'];
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

function BuscarTarea($datos)
{
	//instanciamos y nos conectamos
	$db = Database::getInstance();
	
	$tareas=array();
	$condiciones=implode(' and ',$datos);
	$sql ="select id_tarea as Codigo, descripcion as Tarea, fecha_crea, provincia, estado from tbl_tareas where $condiciones";
	
	$db->Consulta($sql);
	while ($fila = $db->LeeRegistro())
	{
		
		$tareas[]=[$fila['Codigo'], $fila['Tarea'],$fila['fecha_crea'],$fila['provincia'],$fila['estado']];
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
	echo EnlaceAPagina($url, $pag_actual-1, 'Anterior', $pag_actual>1);
	for($pag=1; $pag<=$nPags; $pag++)
	{
		echo EnlaceAPagina($url, $pag, $pag, $pag_actual!=$pag);
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
function EnlaceAPagina($url, $pag, $texto, $activo=true)
{
	if ($activo)
		return '<a href="'.$url.'?pag='.$pag.'">'.'<button style="width: 80px;">'.$texto.'</button></a> ';
	else
		return '<button style="width: 80px;">'.$texto.'</button>';
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


/*
function FiltradoTareas($codigo)
{
	/*Los campos descripci�n y persona de contacto debe tener alg�n valor
El tel�fono de contacto debe tener un valor y si existe debe tener un formato v�lido, s�lo n�meros, y caracteres de separaci�n (espacio, gui�n, y otros que estim�is oportuno).
El c�digo postal, si existe, debe tener un formato v�lido, 5 n�meros.
La provincia debe ser alg�na de las existentes en espa�a. Se debe permitir seleccionar la provincia de una lista deplegable. 
El correo electr�nico es obligatorio y debe tener un formato correcto.
La fecha de realizaci�n debe tener un formato v�lido y ser posterior a la fecha actual.
La fecha de creaci�n no se podr� modificar.
	$errores=array();

	//Expresi�nes regulares 
	$telefono="/^\d{9}/i";

	if (!preg_match($telefono, $provincia))
	{
		$errores['sololetras']="Debe introducir palabras compuestas de letras, que pueden estar separadas por un espacio";
	}

	//Provincia en blanco
	if ($provincia=="")
	{
		$errores['provincia']="Debe introducir algún nombre de provincia";
	}

	//Provincia existe
	$existe=false;
	global $provincias;
	foreach($provincias as $id => $nombre)
	{
		if($provincia==$nombre)
		{
			$existe=true;
		}
	}
	if ($existe) $errores['existe']="La provincia ya existe en la base de datos";

	return $errores;
}*/




