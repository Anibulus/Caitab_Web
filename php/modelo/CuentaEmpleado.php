<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';

class CuentaEmpleado {
    private $id;
    private $id_empleado;
    private $usuario;
    private $consigna;

    public function __construct($id, $id_empleado, $usuario, $consigna) {
        $this->id = $id;
        $this->id_empleado = $id_empleado;
        $this->usuario = $usuario;
        $this->consigna = $consigna;
    }

    public function getIdEmpleado() {
        return $this->id_empleado;
    }

    public function insertar() {
        try {

            $conexion = new conexion();            
            $consulta = $conexion-> prepare("INSERT INTO CUENTA_EMPLEADO (
                ID_EMPLEADO,
                USUARIO,
                CONSIGNA
            ) VALUES (
                :ID_EMPLEADO,
                :USUARIO, 
                :CONSIGNA
            )");

            $consulta->bindParam(':ID_EMPLEADO', $this->id_empleado);
            $consulta->bindParam(':USUARIO', $this->usuario);
            $consulta->bindParam(':CONSIGNA', $this->consigna);
            $consulta->execute();

            $registro = $consulta->fetch();
            unset($conexion);

            return !$this->estaDisponible();

        } catch(Exception $ex) {
            return null;
        }
    }

    public function estaDisponible() {
        try {

            $conexion = new conexion();
            
            $consulta = $conexion-> prepare("SELECT USUARIO
                FROM CUENTA_EMPLEADO 
                WHERE USUARIO = :USUARIO");

            $consulta->bindParam(':USUARIO', $this->usuario);
            $consulta->execute();

            $registro = $consulta->fetch();
            $disponible = ($consulta->rowCount() <= 0);

            unset($conexion);
            return $disponible;

        } catch(Exception $ex) {
            return false;
        }
    }

    public function autenticar() {
        try {

            $conexion = new conexion();
            
            $consulta = $conexion-> prepare("SELECT ID, ID_EMPLEADO, USUARIO, CONSIGNA 
                FROM CUENTA_EMPLEADO 
                WHERE USUARIO = :USUARIO AND CONSIGNA = :CONSIGNA");

            $consulta->bindParam(':USUARIO', $this->usuario);
            $consulta->bindParam(':CONSIGNA', $this->consigna);
            $consulta->execute();

            $registro = $consulta->fetch();

            unset($conexion);
            return ($registro)
                ? $resultado = new self(
                    $registro['ID'],
                    $registro['ID_EMPLEADO'],
                    $registro['USUARIO'],
                    $registro['CONSIGNA'])
                : null;

        } catch(Exception $ex) {
            return null;
        }
    }

}