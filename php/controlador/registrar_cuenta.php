<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/ClienteProveedor.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/CuentaEmpleado.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Empleado.php';

if(
    !isset($_POST['rfc']) ||
    !isset($_POST['razon_social']) ||
    !isset($_POST['nombre_comercial']) ||
    !isset($_POST['telefono']) ||
    !isset($_POST['direccion']) ||
    !isset($_POST['correo']) ||
    !isset($_POST['nombre']) ||
    !isset($_POST['apellidos']) ||
    !isset($_POST['usuario']) ||
    !isset($_POST['consigna']) ||
    !isset($_POST['consigna_2'])
) {
    echo "<script>alert('Error: todos los campos deben ser llenados')</script>";
    header( "refresh:1;url=../../../inicio_sesion.php" );
} else if(strcmp($_POST['consigna'], $_POST['consigna_2']) !== 0) {
    echo "<script>alert('Error: las contraseñas no coinciden')</script>";
    header( "refresh:1;url=../../../inicio_sesion.php" );
} else if (!(new CuentaEmpleado(null, null, $_POST['usuario'], null))->estaDisponible()) {
    echo "<script>alert('Error: usuario ya existe')</script>";
    header( "refresh:1;url=../../../inicio_sesion.php" );
} else {

    $cliente_proveedor = (new ClienteProveedor(
        null,
        $_POST['rfc'],
        $_POST['razon_social'],
        $_POST['nombre_comercial'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['correo'],
        null
    ))->insertar();

    $empleado = (new Empleado(
        null,
        $cliente_proveedor->getId(),
        $_POST['nombre'],
        $_POST['apellidos'],
        'Vendedor'
    ))->insertar();

    (new CuentaEmpleado(
        null, $empleado->getId(), $_POST['usuario'], $_POST['consigna']
    ))->insertar();

    echo "<script>alert('OK: usuario creado correctamente')</script>";
    header( "refresh:1;url=../../../inicio_sesion.php" );

}

?>