<?php
session_start();
//require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/CuentaEmpleado.php';
//require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Empleado.php';

require_once 'modelo/Empleado.php';//requiere del archvo empleado, y empleado a su vez de conexion.php

//Poner :: es hacer el objeto y ademas mandarlo a llamar
$empleado = Empleado::validarInicio($_POST['usu'], $_POST['pass']);
var_dump($empleado); //Esto es para verificar que datos contiene

if($empleado){
  //echo "Bienvenido al sistema ".$empleado->getNomEmpleado();
    $_SESSION['usuario']="Soy un coso raro";
    $_SESSION['contrasena']=$empleado->getNombre();
    var_dump($_SESSION);
    header("old-caitab-web/index.html");
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
?>
