<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';

class Inventario {

    private $id;
    private $descripcion;
    private $precio;
    private $tipo_transaccion;
    private $cantidad;


    public function __construct($id, $descripcion, $precio, $tipo_transaccion, $cantidad) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->tipo_transaccion = is_null($tipo_transaccion) ? ' - ' : $tipo_transaccion;
        $this->cantidad = $cantidad;

    }

    public function getId() {
        return $this->id;
    }

    public function getTipoTransaccion() {
        return $this->tipo_transaccion;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function listar() {
        try {

            $conexion = new conexion();
            
            $consulta = $conexion-> prepare("SELECT 
                    P.ID, 
                    P.DESCRIPCION, 
                    P.PRECIO, 
                    T.TIPO_TRANSACCION, 
                    SUM(TG.CANTIDAD) AS CANTIDAD 
                FROM PRODUCTO P 
                INNER JOIN TRANSACCION_GRANEL TG ON TG.ID_PRODUCTO = P.ID
                INNER JOIN TRANSACCION T ON T.ID = TG.ID_TRANSACCION
                GROUP BY P.ID, T.TIPO_TRANSACCION
            ");

            $consulta->execute();
            $registros = array_map( function($registro) {
                    return new self(
                    $registro['ID'],
                    $registro['DESCRIPCION'],
                    $registro['PRECIO'],
                    $registro['TIPO_TRANSACCION'],
                    $registro['CANTIDAD']);
            }, $consulta->fetchAll());

            unset($conexion);
            return $registros;

        } catch(Exception $ex) {
            return null;
        }
    }

    public function listarCompras($registros) {
        return array_filter((is_null($registros) ? $this->listar() : $registros), function($registro) {
            return strcmp($registro->getTipoTransaccion(), 'Compra') == 0;
        });
    }

    public function listarVentas($registros) {
        return array_filter((is_null($registros) ? $this->listar() : $registros), function($registro) {
            return strcmp($registro->getTipoTransaccion(), 'Venta') == 0;
        });
    }

    public function listarExistencias($consulta) {

        $registros = (is_null($consulta)) ? $this->listar() : $consulta;

        $totales_compra = [];
        $totales_venta = [];
        $totales = [];

        foreach ($this->listarCompras($registros) as $K => $V) {
            $total = isset($totales_compra[$V->getId()]) ? $totales_compra[$V->getId()] : 0;
            $totales_compra[$V->getId()] = $total += $V->getCantidad();
        }

        foreach ($this->listarVentas($registros) as $K => $V) {
            $total = isset($totales_venta[$V->getId()]) ? $totales_venta[$V->getId()] : 0;
            $totales_venta[$V->getId()] = $total += $V->getCantidad();
        }

        foreach ($totales_compra as $K => $V) {
            $compras = isset($totales_compra[$K]) ? $totales_compra[$K] : 0;
            $ventas = isset($totales_venta[$K]) ? $totales_venta[$K] : 0;
            $totales[$K] = ($compras - $ventas);

        }

        return $totales;
    }

    public function listarIdsConExistencia() {
        $registros = $this->listar();
        $existencias = $this->listarExistencias($registros);
        
        $ids = [];

        foreach ($existencias as $K => $V) {
            if($V > 0) {
                $ids[$K] = $V;
            }
        }

        return $ids;
    }
}
/* 

 */