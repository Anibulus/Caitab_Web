<?php
//require_once $_SERVER['DOCUMENT_ROOT'].'/php/conexion/base_datos.php';
require_once 'conexion.php';

class Empleado {
  //Caracteristicas de la clase
    private $idCliente;
    private $nombre;
    private $apellido;
    private $domicilio;
    private $fechaNac;//fecha de nacimiento
    private $telefono;
    private $telefonoEme;//Telefono de emergencia
    private $estatus;
    private $email;
    private $idUsuario;
//Constructor de la clase
    public function __construct($idE,$nom,$app,$dom,$fec,$tel,$telE,$est,$ema,$idU) {
        $this->idEmpleado = $idE;
        $this->nombre = $nom;
        $this->apellido = $app;
        $this->domicilio = $dom;
        $this->fechaNac = $fec;
        $this->telefono = $tel;
        $this->telefonoEme = $telE;
        $this->estatus = $est;
        $this->email = $ema;
        $this->idUsuario = $idU;
    }
//Constructor de prueba
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

    public static function consultaIndividual($id, $nombre, $apellido) {
      $conexion = new Conexion();
      $consulta = $conexion-> prepare("select * from Empleado where ID_Cliente =:id or Nombre_C =:nom or Apellidos_C =:app;");
      $consulta->bindParam(':id', $id);
      $consulta->bindParam(':nom', $nombre);
      $consulta->bindParam(':app', $apellido);
      $consulta->execute();
      $registro = $consulta->fetch();//La variable registro almacena lo que halla devuelto la consulta
      var_dump($registro);//Esta linea se puede quitar
      if($registro)
  		{
  			$resultado = new self($registro['ID_Cliente'], $registro['Nombre_C'], $registro['Apellidos_C'], $registro['Domicilio_C'],$registro['Fecha_Nac_C'], $registro['Telefono_C'],$registro['Telefono_Eme_C'], $registro['Estatus_C'], $registro['Email_C'], $registro['ID_Usu']);
  		}
  		else
  		{
  			$resultado = false;
  		}//Fin de validacion en caso de encontrar a un registro
  		unset($conexion);//Destruye la variable conexion
      var_dump($resultado);//Muestra lo que contiene la variable
  		return $resultado;//Retorna el valor que contiene la variable
    }//Fin de la consulta individual

//Ver si se anadiran mas funciones para cliente
?>
