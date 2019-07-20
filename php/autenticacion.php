<?php
session_start();
if(isset($_POST['usu'])){
require_once 'modelo/Empleado.php';//requiere del archvo empleado, y empleado a su vez de conexion.php
//Poner :: es hacer el objeto y ademas mandarlo a llamar
$empleado = Empleado::validarInicio($_POST['usu'], $_POST['pass']);
if($empleado){
  //echo "Bienvenido al sistema ".$empleado->getNomEmpleado();
    $_SESSION['idEmpleado']=$empleado->getId();
    $_SESSION['nombre']=$empleado->getNombre();
    $_SESSION['apellidos']=$empleado->getApellido();
    $_SESSION['puesto']=$empleado->getPuesto();
    $_SESSION['domicilio']=$empleado->getDomicilio();
    $_SESSION['fechaNac']=$empleado->getFechaNac();
    $_SESSION['turno']=$empleado->getTurno();
    $_SESSION['telefono']=$empleado->getTelefono();
    $_SESSION['TelefonoEme']=$empleado->getTelefonoEmergencia();
    $_SESSION['estatus']=$empleado->getEstatus();
    $_SESSION['email']=$empleado->getEmail();
    $_SESSION['idUsuario']=$empleado->getIdUsuario();
    $_SESSION['Usuario']=$empleado->getUsuario();
    //Fecha nacimiento
    var_dump($_SESSION);
    //header("location:/old-caitab-web/menuEmpleado.php");
    header("location:/old-caitab-web/IniEmp.html");
  }//Si se entrontro el registro
  else{
  	echo "<script type='text/javascript'>";
  	echo "alert ('Usuario ó Contraseña Incorrectos')";
  	echo "</script>";
    var_dump($empleado);
    header("location:/old-caitab-web/inicio_sesion.php");
  }//Si no se inicio sesion correctamenre
unset($empleado);//Se elimina la variable
}//Si se crea el POST
else{
  header("location:/old-caitab-web");//Si no se ha llenado el formulario
}
?>
