<?php

require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/CuentaEmpleado.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Empleado.php';

if(isset($_POST["usuario"]) && isset($_POST["consigna"])) {

    $cuenta = (new CuentaEmpleado(null, null, $_POST["usuario"], $_POST["consigna"]))
        ->autenticar();

    if(is_null($cuenta)) {

        echo "<script> alert('Usuario inválido') </script>";
        header( "refresh:1;url=../../../inicio_sesion.php" );

    } else {

        $empleado = (new Empleado(null, null, null, null, null))
            ->consultar1($cuenta->getIdEmpleado());

        session_start();
        $_SESSION["CuentaEmpleado"] = $cuenta;
        $_SESSION["Empleado"] = $empleado;

        switch($empleado->getCargo()) {
            /* case "Gerente":
            case "Supervisor":
            case "Contador":
                header("Location: ../../../menuEmpleado.php");
                break; */
            default: header("Location: ../../../carrito_compras.php");
                break;
        }
    }

}

?>
