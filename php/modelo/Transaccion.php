<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';

class Transaccion {
    private $id;
    private $id_clienteproveedor;
    private $tipo_transaccion;
    private $fecha;
    private $entregado;

    public function __construct($id, $id_clienteproveedor, $tipo_transaccion, $fecha, $entregado) {
        $this->id = $id;
        $this->id_clienteproveedor = $id_clienteproveedor;
        $this->tipo_transaccion = $tipo_transaccion;
        $this->fecha = $fecha;
        $this->entregado = is_null($entregado) ? 0 : $entregado;
    }

    public function getId() {
        return $this->id;
    }

    public function consultarUltimo() {
        try {

            $conexion = new conexion();
            
            $consulta = $conexion-> prepare("SELECT
                ID, ID_CLIENTEPROVEEDOR, TIPO_TRANSACCION, FECHA, ENTREGADO
                FROM TRANSACCION
                ORDER BY ID DESC LIMIT 1");

            $consulta->execute();

            $registro = $consulta->fetch();

            unset($conexion);
            return ($registro)
                ? $resultado = new self(
                    $registro['ID'],
                    $registro['ID_CLIENTEPROVEEDOR'],
                    $registro['TIPO_TRANSACCION'],
                    $registro['FECHA'],
                    $registro['ENTREGADO'])
                : null ;

        } catch(Exception $ex) {
            return false;
        }
    }

    public function insertar() {
        try {

            $conexion = new conexion();            
            $consulta = $conexion-> prepare("INSERT INTO TRANSACCION (
                ID_CLIENTEPROVEEDOR,
                TIPO_TRANSACCION,
                ENTREGADO
            ) VALUES (
                :ID_CLIENTEPROVEEDOR,
                :TIPO_TRANSACCION,
                :ENTREGADO
            )");

            $consulta->bindParam(':ID_CLIENTEPROVEEDOR', $this->id_clienteproveedor);
            $consulta->bindParam(':TIPO_TRANSACCION', $this->tipo_transaccion);
            $consulta->bindParam(':ENTREGADO', $this->entregado);

            $consulta->execute();

            $registro = $consulta->fetch();
            unset($conexion);

            return $this->consultarUltimo();

        } catch(Exception $ex) {
            return null;
        }
    }

}

/*

.execute("INSERT INTO TRANSACCION (ID_CLIENTEPROVEEDOR, TIPO_TRANSACCION) VALUES ("
    + this.id_clienteproveedor + ", "
    + "'" + this.tipo_transaccion + "')");

*/