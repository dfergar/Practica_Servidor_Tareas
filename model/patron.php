<?php

include '../config.php';

class Database 
{
	static private $instance;
	private $link;
	private $result;
	private $regActual;
	
	//constructor privado para evitar crear instancias desde el exterior
	private function __construct()
	{
		self::Conectar($GLOBALS['conf']);
	}
	
	// Evitamos el clonaje
	private function __clone(){}
	
	//Crear instancia �nica
	public static function getInstance()
	{
		if (self::$instance == null)
		{
			self::$instance = new Database();
		}
		return self::$instance;	
	}
	
	//Conectar
	public function Conectar($conf)
	{
		// Conectando, seleccionando la base de datos
		$this->link=new mysqli($conf['servidor'], $conf['usuario'], $conf['password']);
		$this->link->query("SET NAMES 'utf8'");
		$this->link->select_db($conf['base_datos']);
		
	}
	//Cerrar conexi�n
	public function Cerrar()
	{
// 		$this->link->close();
	}
		
	// Consulta
	public function Consulta($sql)
	{
		$this->result=$this->link->query($sql);
		if (! $this->result )
		{
			echo "<p>ERROR SQL</p><pre>$sql</pre><p style=\"background:#E33\">".$this->link->error."</p>";
			exit;
		}
		return $this->result;
	}
	
	//Devuelve el siguiente registro del result set devuelto por una consulta	
	public function LeeRegistro($result=NULL)
	{
		if (! $result)
		{
			if (! $this->result)
			{
				return NULL;

			}
			$result=$this->result;
		}
		$this->regActual=$result->fetch_array();
		return $this->regActual;
	}
	
	//Devuelve el �ltimo registro
	public function RegistroActual()
	{
		return $this->regActual;
	}
	
	//Dvuelve el valor del �ltimo campo autonum�rico insertado
	public function LastID()
	{
		return $this->link->insert_id;
	}
	
	//Devuelve el primer registro que cumple la condicion dada
	public function LeeUnRegistro($tabla, $condicion, $campos="*")
	{
		$sql="select $campos from $tabla where $condicion limit 1";
		$rs=$this->link->query($sql);
		if($rs)
		{
			return $rs->fetch_array();
		}
		else
		{
			return NULL;
		}
	}
}


?>