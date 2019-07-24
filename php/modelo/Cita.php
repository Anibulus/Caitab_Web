<?php
require_once 'conexion.php';
class Cita{
  //Aqui las caracteristicas de la citas
  //Estas caracteristicas si estan segun nombre(Especifico) y orden de la base de datos
  private $ID_Cita;
  private $ID_Emp;
  private $ID_Cli;
  private $Fecha_Hora;
  private $Consultorio;

  public function __construct($ID_Cita, $ID_Emp, $ID_Cli,$Fecha_Hora, $Consultorio) {
    $this->ID_Cita=$ID_Cita;
    $this->ID_Emp=$ID_Emp;
    $this->ID_Cli=$ID_Cli;
    $this->Fecha_Hora=$Fecha_Hora;
    $this->Consultorio=$Consultorio;
  }//Fin del constructor

  //Setters y Getters
  public function getIDCita(){
    return $this->ID_Cita;
  }
  public function getIDEmpleado(){
    return $this->ID_Emp;
  }
  public function getIDCliente(){
    return $this->ID_Cli;
  }
  public function getFecha(){
    return $this->Fecha_Hora;
  }
  public function getConsultorio(){
    return $this->Consultorio;
  }

  public function setIDCita($ID_Cita){
    $this->ID_Cita=$ID_Cita;
  }
  public function setIDEmpleado($ID_Emp){
    $this->ID_Emp=$ID_Emp;
  }
  public function setIDCliente($ID_Cli){
    $this->ID_Cli=$ID_Cli;
  }
  public function setFecha($Fecha_Hora){
    $this->Fecha_Hora=$Fecha_Hora;
  }
  public function setConsultorio($Consultorio){
    $this->Consultorio=$Consultorio;
  }

  //funcion de consultar citas
  public function consultarCita($idC,$Fecha,$idE){
    $conexion = new Conexion();
    $consulta = $conexion-> prepare("select * from cita where ID_Cli =:idC and Fecha_Hora =:fec and ID_Emp =:idE;");
    $consulta->bindParam(':idC', $idC);
    $consulta->bindParam(':fec', $Fecha);
    $consulta->bindParam(':idE', $idE);
    $consulta->execute();
    $registro = $consulta->fetch();//La variable registro almacena lo que halla devuelto la consulta
    //var_dump($registro);//Esta linea se puede quitar
    if($registro)
    {
      $resultado = new self($registro['ID_Cita'], $registro['ID_Emp'], $registro['ID_Cli'], $registro['Fecha_Hora'],$registro['Consultorio']);
    }
    else
    {
      $resultado = false;
    }//Fin de validacion en caso de encontrar a un registro
    unset($conexion);//Destruye la variable conexion
    var_dump($resultado);//Muestra lo que contiene la variable
    return $resultado;//Retorna el valor que contiene la variable
  }
}//Fin de la clase
?>
