<?php

class Conexion extends PDO
{
	//Caracteristicas de la clase con los valosres para entrar a la base de datos
	private $tipo_de_base ='mysql';
	private $host = 'localhost';
	//private $bd= 'elssemanager';
	private $bd= 'elsse';
	private $usuario= 'root';
	//private $contrasenia = '200798';
	private $contrasenia = '';
	private $puerto='3306';

//funcion/Constructor para entrar a la base de datos
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
