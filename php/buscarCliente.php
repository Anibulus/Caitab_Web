<?php
session_start();
if(isset($_POST['nombreB'])){
//requiere del archvo empleado, y empleado a su vez de conexion.php
require_once 'clases/Cliente.php';//Requiere del objeto Cliente
$cliente = new Producto($_POST['nombreB'],$_POST['apellidoB'], $_POST['idB']);//Poner todas las caracteristicas en orden
$buscar = $cliente -> consultaIndividual($_POST['nombreB'],$_POST['apellidoB'], $_POST['idB']);
var_dump($buscar);
  if($buscar==true){
  	echo "Se mostraran los datos del cliente";
  }
  else{
  	echo "Ocurrio un error al Consultar";
  }
unset($cliente);//Se elimina la variable
}//Si se crea el POST
else{
  header("location:/old-caitab-web");//Si no se ha llenado el formulario
}
?>
