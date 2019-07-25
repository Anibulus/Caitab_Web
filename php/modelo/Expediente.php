<?php
require_once 'conexion.php';

class Expediente{
  //caracteristicas del expediente
  private $ID_Exp;
  private $ID_Emp;
  private $ID_Cli;
  private $ID_Cita;
  private $Hora_Inicio;
  private $Hora_Fin;
  private $Descripcion;
  private $Conclusion;

  public function __construct($ID_Exp,$ID_Emp,$ID_Cli,$ID_Cita,$Hora_Inicio,$Hora_Fin,$Descripcion,$Conclusion){
    $this->ID_Exp=$ID_Exp;
    $this->ID_Emp=$ID_Emp;
    $this->ID_Cli=$ID_Cli;
    $this->ID_Cita=$ID_Cita;
    $this->Hora_Inicio=$Hora_Inicio;
    $this->Hora_Fin=$Hora_Fin;
    $this->Descripcion=$Descripcion;
    $this->Conclusion=$Conclusion;
  }//fin de el Constructor

  public function getIdExp() {
      return $this->ID_EXp;
  }

  public function getIdEmp() {
      return $this->ID_Emp;
  }

  public function getIdCli() {
      return $this->ID_Cli;
  }

  public function getDIdCita() {
      return $this->ID_Cita;
  }

  public function getHoraIni() {
      return $this->Hora_Inicio;
  }

  public function getHoraFin(){
    return $this->Hora_Fin;
  }

  public function getDescripcion(){
    return $this->Descripcion;
  }

  public function getConclusion(){
    return $this->Conclusion;
  }

//Aqui estan los set de la clase
  public function setIdExp($ID_EXp) {
      $this->ID_EXp=$ID_EXp;
  }

  public function setIdEmp($ID_Emp) {
      $this->ID_Emp=$ID_Emp;
  }

  public function setIdCli($ID_Cli) {
      $this->ID_Cli=$ID_Cli;
  }

  public function setDIdCita($ID_Cita) {
      $this->ID_Cita=$ID_Cita;
  }

  public function setHoraIni($Hora_Inicio) {
      $this->Hora_Inicio=$Hora_Inicio;
  }

  public function setHoraFin($Hora_Fin){
    $this->Hora_Fin=$Hora_Fin;
  }

  public function setDescripcion($Descripcion){
    $this->Descripcion=$Descripcion;
  }

  public function setConclusion($Conclusion){
    $this->Conclusion=$Conclusion;
  }

  public function nuevoExpediente($idEmp,$idCli,$idCita,$horaIni,$horaFin,$Descripcion,$Conclusion){
    $resultado=false;
    $conexion = new Conexion();
    $consulta = $conexion-> prepare("insert into expediente(ID_Exp,ID_Emp,ID_Cli,ID_Cita,Hora_Inicio,Hora_Fin,Descripcion,Conclusion) values (null,:idEmp,:idCli,:idCita,:horaIni,:horaFin,:Descripcion,:Conclusion);");
    $consulta->bindParam(':idEmp', $idEmp);
    $consulta->bindParam(':idCli', $idCli);
    $consulta->bindParam(':idCita', $idCita);
    $consulta->bindParam(':horaIni', $horaIni);
    $consulta->bindParam(':horaFin', $horaFin);
    $consulta->bindParam(':Descripcion', $Descripcion);
    $consulta->bindParam(':Conclusion', $Conclusion);
    $consulta->execute();
    if($consulta->rowCount())
    {
      $resultado = true;
    }
    //Fin de validacion en caso de encontrar a un registro
    unset($conexion);//Destruye la variable conexion
    //var_dump($resultado);//Muestra lo que contiene la variable
    return $resultado;//Retorna el valor que contiene la variable
  }//Fin de la funcion nuevo expediente

}//Fin de la clase expediente
?>
