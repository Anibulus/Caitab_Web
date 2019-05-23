<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';

class ClienteProveedor {
    private $id;
    private $rfc;
    private $denominacion_uno;
    private $denominacion_dos;
    private $telefono;
    private $direccion;
    private $correo_electronico;
    private $activo;

    public function __construct($id, $rfc, $denominacion_uno, $denominacion_dos, $telefono, $direccion, $correo_electronico, $activo) {
        $this->id = $id;
        $this->rfc = $rfc;
        $this->denominacion_uno = $denominacion_uno;
        $this->denominacion_dos = $denominacion_dos;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->correo_electronico = $correo_electronico;
        $this->activo = (is_null($activo)) ? 1 : $activo;
    }

    public function getId() {
        return $this->id;
    }

    public function consultar($rfc) {
        try {

            $conexion = new conexion();
            
            $consulta = $conexion-> prepare("SELECT
                ID, RFC, DENOMINACION_UNO, DENOMINACION_DOS, TELEFONO, DIRECCION, CORREO_ELECTRONICO, ACTIVO
                FROM CLIENTE_PROVEEDOR 
                WHERE RFC = :RFC");

            $consulta->bindParam(':RFC', $rfc);
            $consulta->execute();

            $registro = $consulta->fetch();

            unset($conexion);
            return ($registro)
                ? $resultado = new self(
                    $registro['ID'],
                    $registro['RFC'],
                    $registro['DENOMINACION_UNO'],
                    $registro['DENOMINACION_DOS'],
                    $registro['TELEFONO'],
                    $registro['DIRECCION'],
                    $registro['CORREO_ELECTRONICO'],
                    $registro['ACTIVO'])
                : null ;

        } catch(Exception $ex) {
            return false;
        }
    }

    public function insertar() {
        try {

            $conexion = new conexion();            
            $consulta = $conexion-> prepare("INSERT INTO CLIENTE_PROVEEDOR (
                RFC,
                DENOMINACION_UNO,
                DENOMINACION_DOS,
                TELEFONO,
                DIRECCION,
                CORREO_ELECTRONICO
            ) VALUES (
                :RFC,
                :DENOMINACION_UNO, 
                :DENOMINACION_DOS,
                :TELEFONO,
                :DIRECCION,
                :CORREO_ELECTRONICO
            )");

            $consulta->bindParam(':RFC', $this->rfc);
            $consulta->bindParam(':DENOMINACION_UNO', $this->denominacion_uno);
            $consulta->bindParam(':DENOMINACION_DOS', $this->denominacion_dos);
            $consulta->bindParam(':TELEFONO', $this->telefono);
            $consulta->bindParam(':DIRECCION', $this->direccion);
            $consulta->bindParam(':CORREO_ELECTRONICO', $this->correo_electronico);
            $consulta->execute();

            $registro = $consulta->fetch();
            unset($conexion);

            return $this->consultar($this->rfc);

        } catch(Exception $ex) {
            return null;
        }
    }

}