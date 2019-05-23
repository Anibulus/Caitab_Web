<?php

class conexion extends PDO
{
	private $tipo_de_base ='mysql';
	private $host = 'localhost';
	private $bd= 'elssemanager';
	private $usuario= 'root';
	private $contrasenia = '200798';
	private $puerto='3306';
	
	function __construct()
	//sobreescribo el metodo constructor de la clase PDO
	{
		
		try {

            parent::__construct($this->tipo_de_base.': host='.$this->host.':'.$this->puerto.';dbname='.$this->bd, $this->usuario, $this->contrasenia);	
			
		} catch (PDOException $e) {
			echo 'Ah ocurrido un error y no se puede conectar a la base de datos.Detalle: ' .$e->getMessage();
			exit;
			
		}
	}
}
?>