<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';

class Producto {

    private $id;
    public $descripcion;
    private $precio;
    private $cantidad;

    public function __construct($id, $descripcion, $precio) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
    }

    public function getId() {
        return $this->id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function listar() {
        try {

            $conexion = new conexion();
            
            $consulta = $conexion-> prepare("SELECT ID, DESCRIPCION, PRECIO
                FROM PRODUCTO");

            $consulta->execute();
            $registros = array_map( function($registro) {
                    return new self(
                    $registro['ID'],
                    $registro['DESCRIPCION'],
                    $registro['PRECIO']);
            }, $consulta->fetchAll());

            unset($conexion);
            return $registros;

        } catch(Exception $ex) {
            return null;
        }
    }
}