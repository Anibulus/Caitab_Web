<?php

//require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';
require_once '/php/conexion/base_datos.php';

class Empleado {
  //Caracteristicas de la clase
    private $idEmpleado;
    private $nombre;
    private $apellido;
    private $domicilio;
    private $fechaNac;//fecha de nacimiento
    private $puesto;
    private $turno;
    private $telefono;
    private $telefonoEme;//Telefono de emergencia
    private $estatus;
    private $email;
    private $idUsuario;
//Constructor de la clase
    public function __construct($idE,$nom,$app,$dom,$fec,$pues,$tur,$tel,$telE,$est,$ema,$idU) {
        $this->idEmpleado = $idE;
        $this->nombre = $nom;
        $this->apellido = $app;
        $this->domicilio = $dom;
        $this->fechaNac = $fec;
        $this->puesto = $pue;
        $this->turno = $tur;
        $this->telefono = $tel;
        $this->telefonoEme = $telE;
        $this->estatus = $est;
        $this->email = $ema;
        $this->idUsuario = $idU;
    }
//Aqui estan los det de la clase
    public function getId() {
        return $this->idEmpleado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function getFechaNac() {
        return $this->fechaNac;
    }

    public function getPuesto() {
        return $this->puesto;
    }

    public function getTurno(){
      return $this->turno;
    }

    public function getTelefono(){
      return $this->telefono;
    }

    public function getTelefonoEmergencia(){
      return $this->telefonoEme;
    }

    public function getEstatus(){
      return $this->estatus;
    }

    public function getEmail(){
      return $this->email;
    }

    public function getIdUsuario(){
      return $this->idUsuario;
    }

//Aqui estan los set de la clase
    public function setId($idE) {
        $this->idEmpleado=$idE;
    }

    public function setNombre($nom) {
        $this->nombre=$nom;
    }

    public function setApellido($app) {
        $this->apellido=$app;
    }

    public function setDomicilio($dom) {
        $this->domicilio=$dom;
    }

    public function setFechaNac($fec) {
        $this->fechaNac=$fec;
    }

    public function setPuesto($pue) {
        $this->puesto=$pue;
    }

    public function setTurno($tur){
        $this->turno=$tur;
    }

    public function setTelefono($tel){
        $this->telefono=$tel;
    }

    public function setTelefonoEmergencia($telE){
        $this->telefonoEme=$telE;
    }

    public function setEstatus($est){
        $this->estatus=$est;
    }

    public function setEmail($ema){
        $this->email=$ema;
    }

    public function setIdUsuario($idU){
        $this->idUsuario=$idU;
    }

    //Aqui estan las funciones que se conectan con la base de datos
    public static function consultaIndividual($id, $nombre) {
      $conexion = new Conexion();
      $consulta = $conexion-> prepare("select * from Empleado where ID_Empleado =:id or Nombre_E =:nom");
      $consulta->bindParam(':id', $id);
      $consulta->bindParam(':nom', $nombre);
      $consulta->execute();
      $registro = $consulta->fetch();//La variable registro almacena lo que halla devuelto la consulta
      var_dump($registro);//Esta linea se puede quitar
      if($registro)
  		{
  			$resultado = new self($registro['ID_Empleado'], $registro['Nombre_E'], $registro['Apellidos_E'], $registro['Domicilio_E'],$registro['Fecha_Nac_E'], $registro['Especialidad_Puesto'], $registro['Turno'], $registro['Telefono_E'],$registro['Telefono_Eme_E'], $registro['Estatus_E'], $registro['Email_E'], $registro['ID_Usuario']);
  		}
  		else
  		{
  			$resultado = false;
  		}//Fin de validacion en caso de encontrar a un registro
  		unset($conexion);//Destruye la variable conexion
      var_dump($resultado);//Mjestra lo que contiene la variable
  		return $resultado;//Retorna el valor que contiene la variable
    }//Fin de la consulta individual

    public function nuevoEmpleado() {\
      $insercion=false;
      $conexion = new Conexion();//Preguntar por procedimientos almacenados para inserciones y modificaciones
      $consulta = $conexion->prepare("insert into Empleado (Nombre_E,Apellidos_E,Domicilio_E,Especialidad_Puesto,Fecha_Nac_E,Turno,Telefono_E,Telefono_Eme_E,Estatus_E,Email_E,ID_Usuario) values (:nom,:app,:dom,:fec,:pue,:tur,:tel,:telE,:est,:ema,:idU)");//Preguntar por procedimientos almacenados
      $consulta->bindParam(':nom', $this->nombre);
      $consulta->bindParam(':app', $this->apellido);
      $consulta->bindParam(':dom', $this->domicilio);
      $consulta->bindParam(':fec', $this->fechaNac);
      $consulta->bindParam(':pue', $this->puesto);
      $consulta->bindParam(':tur', $this->turno);
      $consulta->bindParam(':tel', $this->telefono);
      $consulta->bindParam(':telE', $this->telefonoEme);
      $consulta->bindParam(':est', $this->estatus);
      $consulta->bindParam(':ema', $this->email);
      $consulta->bindParam(':idU', $this->idUsuario);
      $consulta->execute();//Despues de llenar la consulta de los datos correctos, la ejecuta
      if($consulta->fetch()>0){//Si afecto filas,inserto y se valida directamente en el IF
        return true;
        echo "Se inserto correctamente";
      }else{
        echo "Ocurrio un error al insertar";
      }
      unset($conexion);
    }//Termina la funcion de insertar a la base de datos

    //Falta modificar y eliminar empleado
