<?php
session_start();
//require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/CuentaEmpleado.php';
//require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Empleado.php';

require_once '/php/modelo/Empleado.php';//requiere del archvo empleado, y empleado a su vez de conexion.php

//Poner :: es hacer el objeto y ademas mandarlo a llamar
$empleado = Empleado::validarInicio($_POST['usu'], $_POST['pass']);
var_dump($empleado); //Esto es para verificar que datos contiene

if($empleado){
  //echo "Bienvenido al sistema ".$empleado->getNomEmpleado();
    $_SESSION['numEmpleado']=$empleado->getNumEmpleado();
    $_SESSION['nomEmpleado']=$empleado->getNomEmpleado();
    $_SESSION['puesto']=$empleado->getPuesto();
    $_SESSION['usuario']=$empleado->getUsuario();
    header("location:gestion-e.php"); //Aun no la creo
  }
  else{
    echo 'Usuario ó contraseña incorrectos';
  	echo "<script type='text/javascript'>";
  	echo "alert ('Usuario ó Contraseña Incorrectos')";
  	echo "</script>";
    //var_dump($empleado);
    //var_dump($_SESSION);
    header("location:IniciarSesion.html");
  }
unset($empleado);


//aqui termina mi wea
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
