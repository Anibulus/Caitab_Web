<?php
session_start();
//require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/CuentaEmpleado.php';
//require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Empleado.php';
if(isset($_POST['usu'])){
require_once 'modelo/Empleado.php';//requiere del archvo empleado, y empleado a su vez de conexion.php
//Poner :: es hacer el objeto y ademas mandarlo a llamar
echo"Esto contiene_POST";
var_dump($_POST);
echo $_POST['usu'];echo $_POST['pass'];
$empleado = Empleado::validarInicio($_POST['usu'], $_POST['pass']);
var_dump($empleado); //Esto es para verificar que datos contiene

if($empleado){
  //echo "Bienvenido al sistema ".$empleado->getNomEmpleado();
    $_SESSION['usuario']="Soy un coso raro";
    //$_SESSION['contrasena']=$empleado->getNombre();
    var_dump($_SESSION);
  }
  else{
    echo 'Usuario ó contraseña incorrectos';
  	echo "<script type='text/javascript'>";
  	echo "alert ('Usuario ó Contraseña Incorrectos')";
  	echo "</script>";
    //var_dump($empleado);
    //var_dump($_SESSION);
    //header("location:IniciarSesion.html");
    header("location:/old-caitab-web");
  }
  header("location:/old-caitab-web");
unset($empleado);
}//Si se crea el POST
else{
  header("location:/old-caitab-web");
}
?>
