<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';

class TransaccionGranel {
    private $id;
    private $id_transaccion;
    private $id_producto;
    private $cantidad;
    private $precio;

    public function __construct($id, $id_transaccion, $id_producto, $cantidad, $precio) {
        $this->id = $id;
        $this->id_transaccion = $id_transaccion;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
    }

    public function getId() {
        return $this->id;
    }

    public function listarPorTransaccion() {
        try {

            $conexion = new conexion();
            
            $consulta = $conexion-> prepare("SELECT
                ID, ID_TRANSACCION, ID_PRODUCTO, CANTIDAD, PRECIO
                FROM TRANSACCION_GRANEL
                WHERE ID_TRANSACCION = :ID_TRANSACCION");

            $consulta->bindParam(':ID_TRANSACCION', $this->id_transaccion);
            $consulta->execute();

            $registro = $consulta->fetch();

            unset($conexion);
            return ($registro)
                ? $resultado = new self(
                    $registro['ID'],
                    $registro['ID_TRANSACCION'],
                    $registro['ID_PRODUCTO'],
                    $registro['CANTIDAD'],
                    $registro['PRECIO'])
                : null ;

        } catch(Exception $ex) {
            return false;
        }
    }

    public function insertar() {
        try {

            $conexion = new conexion();            
            $consulta = $conexion-> prepare("INSERT INTO TRANSACCION_GRANEL (
                ID_TRANSACCION,
                ID_PRODUCTO,
                CANTIDAD,
                PRECIO
            ) VALUES (
                :ID_TRANSACCION,
                :ID_PRODUCTO,
                :CANTIDAD,
                :PRECIO
            )");

            $consulta->bindParam(':ID_TRANSACCION', $this->id_transaccion);
            $consulta->bindParam(':ID_PRODUCTO', $this->id_producto);
            $consulta->bindParam(':CANTIDAD', $this->cantidad);
            $consulta->bindParam(':PRECIO', $this->precio);

            $consulta->execute();

            $registro = $consulta->fetch();
            unset($conexion);

            return $this->listarPorTransaccion();

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

/*

.execute("INSERT INTO TRANSACCION_GRANEL (ID_TRANSACCION, ID_PRODUCTO, CANTIDAD, PRECIO) VALUES ("
    + this.id_transaccion + ","
    + this.id_producto + ","
    + this.cantidad + ","
    + this.precio + ")");


*/