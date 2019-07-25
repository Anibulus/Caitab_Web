<?php
session_start();
if(isset($_POST['nombreB'])){
//requiere del archvo empleado, y empleado a su vez de conexion.php
require_once 'modelo/Cliente.php';//Requiere del objeto Cliente
$cliente = new Cliente(0,$_POST['nombreB'],$_POST['apellidoB'],'Domicilio','Fecha','Tel','TelE','Est','Email',0);//verificar que se cree de esa manera
$buscar = $cliente -> consultaIndividual(null,$_POST['nombreB'],$_POST['apellidoB']);
require_once 'modelo/Cita.php';
$cita=new Cita(0,0,0,0,0);
$cita=$cita->consultarCita($buscar->getId(),$_POST['fechaB'],$_SESSION['idEmpleado']);
//Se otorga el numero de la cita en la variable de sesion para utilizarla globalmente sin necesidad de seguir consultando
if($cita!=null){
$_SESSION['idCita']=$cita->getIDCita();
}
//var_dump($_SESSION);
//var_dumb($cita);
//var_dump($cliente);
//var_dump($buscar);
echo "
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <script type='text/javascript' src='/old-caitab-web/js/validarCampos.js'></script><!--Esta linea ayudara a la validaciones de los campos-->

    <title>CAITAB A.C.</title>

    <link href='/old-caitab-web/img/logoCaitab' rel='icon'>
    <link href='/old-caitab-web/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom fonts for this template -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='/old-caitab-web/css/business-casual.min.css' rel='stylesheet'>
    <script type='/old-caitab-web/text/javascript' src='js/cambio.js'></script>

  </head>

  <body>

    <h1 class='site-heading text-center text-white d-none d-lg-block'>
      <span class='site-heading-upper text-primary mb-3'>Consulta y Asesoría Integral para el Tratamiento de la Anorexia y la Bulimia A.C.</span>
      <span class='site-heading-lower'>CAITAB A.C.</span>
    </h1>

        <nav class='navbar navbar-expand-lg navbar-dark py-lg-4' id='mainNav'>
      <div class='container'>
        <a class='navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none' href='#'></a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarResponsive'>
          <ul class='navbar-nav mx-auto'>
            <li class='nav-item px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='/old-caitab-web/IniEmp.html'>
                INICIO
                <span class='sr-only'>(current)</span>
              </a>
            </li>
            <li class='nav-item px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='/old-caitab-web/Agenda.php'>
                AGENDA
                <span class='sr-only'>(current)</span>
              </a>
            </li>
            <li class='nav-item active px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='/old-caitab-web/Cita.php'>
                CITAS
              </a>
            </li>
            <li class='nav-item px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='/old-caitab-web/Sesion.php'>
                SESION
              </a>
            </li>
            <li class='nav-item px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='cerrar_sesion.php'>
                CERRAR SESION
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section> <!--class='page-section about-heading'-->
        <div class='about-heading-content'>
          <div class='row'>
            <div class='col-xl-9 col-lg-10 mx-auto'>
              <div class='bg-faded rounded p-5'>";
              if($cita!=null){
                echo"
<h2>
  <span class='section-heading mb-3'>Resultado</span>
</h2>
<form id='Inicio'  method='POST' action='modificarCita.php'>
    <div class='row'>
    <div class='col-md-3'>
      <span class='input-group-addon'>NOMBRE</span>
    </div>
    <div class='col-md-6'>
      <input type='text' class='form-control' name='nombre' value='".$buscar->getNombre()."' id='nombre' placeholder='Nombre' readonly />
    </div>
    <div class='col-md-3'></div>
  </div>
  <div class='row'>
    <div class='col-md-3'>
      <span class='input-group-addon'>APELLIDO</span>
    </div>
    <div class='col-md-6'>
      <input type='text' class='form-control' name='apellido' value='".$buscar->getApellido()."' id='apellido' placeholder='Apellido' readonly />
    </div>
  <div class='col-md-3'></div>
  </div>
  <div class='row'>
    <div class='col-md-3'>
      <span class='input-group-addon'>CONSULTORIO</span>
    </div>
    <div class='col-md-6'>
        <input type='number' class='form-control' name='consultorio' value='".$cita->getConsultorio()."' id='consultorio' placeholder='Consultorio'/>
    </div>
    <div class='col-md-3'></div>
  </div>
  <div class='row'>
    <div class='col-md-3'>
      <span class='input-group-addon'>TELEFONO</span>
    </div>
    <div class='col-md-6'>
      <input type='tel' class='form-control' name='telefono' value='".$buscar->getTelefono()."' id='telefono' placeholder='Telefono' readonly/>
    </div>
  <div class='col-md-3'></div>
  </div>
  <div class='row'>
    <div class='col-md-3'>
      <span class='input-group-addon'>E-MAIL</span>
    </div>
    <div class='col-md-6'>
      <input type='text' class='form-control' name='email' value='".$buscar->getEmail()."' id='email' placeholder='E-Mail' readonly/>
    </div>
    </div>
  <div class='row'>
    <div class='col-md-3'>
      <span class='input-group-addon'>HORA/FECHA CITA</span>
    </div>
    <div class='col-md-6'>
    <input type='text' class='form-control' name='fecha' value='".$cita->getFecha()."' id='fecha' placeholder='Fecha' maxlength=10/>
    </div>
  <div class='col-md-3'></div>
  <div class='intro-button mx-auto' style='margin-top:15px'>
    <input type='submit' value='Modificar' class='btn btn-success btn-x2' onclick='' />
  </div>
  <div class='intro-button mx-auto' style='margin-top:15px'>
    <a href='/old-caitab-web/Cita.php'><input type='button' value='Regresar' class='btn btn-success btn-x2'/><a/>
  </div>
</form>
";
}else{
  echo"
  <span class='section-heading mb-3'>No tienene citas pendientes con ".$cliente->getNombre()." ".$cliente->getApellido()."</span>"
;
}
echo"
</div>
</div>
</div>
</div>
</section>


<footer class='footer text-faded text-center py-5'>
<div class='container'>
<p class='m-0 small'>Copyright &copy; ELSSE 2018</p>
</div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src='vendor/jquery/jquery.min.js'></script>
<script src='vendor/bootstrap/js/bootstrap.bundle.min.js'></script>

</body>

<!-- Script to highlight the active date in the hours list -->
<script>
$('.list-hours li').eq(new Date().getDay()).addClass('today');
</script>

</html>
";
unset($cliente);//Se elimina la variable
unset($cita);
}//Si se crea el POST
else{
  header('location:/old-caitab-web');//Si no se ha llenado el formulario
}
?>
