<?php

//require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';
require_once '/php/conexion/base_datos.php';

class Empleado {
    private $id;
    private $id_clienteproveedor;
    private $nombre;
    private $apellido;
    private $cargo;

    public function __construct($id, $id_clienteproveedor, $nombre, $apellido, $cargo) {
        $this->id = $id;
        $this->id_clienteproveedor = $id_clienteproveedor;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cargo = $cargo;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdClienteProveedor() {
        return $this->id_clienteproveedor;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function consultar1($id) {
        try {

            $conexion = new conexion();

            $consulta = $conexion-> prepare("SELECT ID, ID_CLIENTEPROVEEDOR, NOMBRE, APELLIDO, CARGO
                FROM EMPLEADO
                WHERE ID = :ID");

            $consulta->bindParam(':ID', $id);
            $consulta->execute();

            $registro = $consulta->fetch();

            unset($conexion);
            return ($registro)
                ? $resultado = new self(
                    $registro['ID'],
                    $registro['ID_CLIENTEPROVEEDOR'],
                    $registro['NOMBRE'],
                    $registro['APELLIDO'],
                    $registro['CARGO'])
                : null;

        } catch(Exception $ex) {
            return null;
        }
    }

    public function consultar2($id_clienteproveedor, $nombre, $apellido, $cargo) {
        try {

            $conexion = new conexion();

            $consulta = $conexion-> prepare("SELECT ID, ID_CLIENTEPROVEEDOR, NOMBRE, APELLIDO, CARGO
                FROM EMPLEADO
                WHERE ID_CLIENTEPROVEEDOR = :ID_CLIENTEPROVEEDOR
                AND NOMBRE = :NOMBRE
                AND APELLIDO = :APELLIDO
                AND CARGO = :CARGO");

            $consulta->bindParam(':ID_CLIENTEPROVEEDOR', $id_clienteproveedor);
            $consulta->bindParam(':NOMBRE', $nombre);
            $consulta->bindParam(':APELLIDO', $apellido);
            $consulta->bindParam(':CARGO', $cargo);
            $consulta->execute();

            $registro = $consulta->fetch();

            unset($conexion);
            return ($registro)
                ? $resultado = new self(
                    $registro['ID'],
                    $registro['ID_CLIENTEPROVEEDOR'],
                    $registro['NOMBRE'],
                    $registro['APELLIDO'],
                    $registro['CARGO'])
                : null;

        } catch(Exception $ex) {
            return null;
        }
    }

    public function insertar() {
        try {

            $conexion = new conexion();
            $consulta = $conexion-> prepare("INSERT INTO EMPLEADO (
                ID_CLIENTEPROVEEDOR,
                NOMBRE,
                APELLIDO,
                CARGO
            ) VALUES (
                :ID_CLIENTEPROVEEDOR,
                :NOMBRE,
                :APELLIDO,
                :CARGO
            )");

            $consulta->bindParam(':ID_CLIENTEPROVEEDOR', $this->id_clienteproveedor);
            $consulta->bindParam(':NOMBRE', $this->nombre);
            $consulta->bindParam(':APELLIDO', $this->apellido);
            $consulta->bindParam(':CARGO', $this->cargo);
            $consulta->execute();

            $registro = $consulta->fetch();
            unset($conexion);

            return $this->consultar2($this->id_clienteproveedor, $this->nombre, $this->apellido, $this->cargo);

        } catch(Exception $ex) {
            return null;
        }
    }

}
