<?php
session_start();
if(isset($_POST['consultorio'])){
  require_once 'modelo/Cliente.php';//Requiere del objeto Cliente
  $cliente = new Cliente(0,$_POST['nombre'],$_POST['apellido'],'Domicilio','Fecha','Tel','TelE','Est','Email',0);//verificar que se cree de esa manera
  $cliente = $cliente -> consultaIndividual(null,$_POST['nombre'],$_POST['apellido']);
  require_once 'modelo/Cita.php';
  $cita=new Cita(0,0,0,0,0);
  $modificar=$cita->modificarCita($_SESSION['idCita'],$_SESSION['idEmpleado'],$cliente->getId(),$_POST['fecha'],$_POST['consultorio']);
  //var_dumb($modificar);
  //var_dump($cliente->getId());
  //var_dumb($_SESSION['idEmpleado']);
  //var_dumb($_SESSION['idCita']);
  //var_dump($_POST['fecha']);
  //var_dump($_POST['consultorio']);
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
                  PAGINA PRINCIPAL
                  <span class='sr-only'>(current)</span>
                </a>
              </li>
              <li class='nav-item px-lg-4'>
                <a class='nav-link text-uppercase text-expanded' href='/old-caitab-web/Agenda.php'>
                  AGENDA PACIENTES
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
                  SESIONES
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
              if($modificar){
                echo"
                <h2>
                  <span class='section-heading mb-3'>Se ha modificado correctamente el registro. </span>
                </h2>";
              }
              else{
                echo"
                <h2>
                  <span class='section-heading mb-3'>No se ha podido completar la accion</span>
                </h2>";
              }
  echo "
  <div class='intro-button mx-auto' style='margin-top:15px'>
    <a href='/old-caitab-web/Cita.php'><input type='button' value='Regresar' class='btn btn-success btn-x2' /><a/>
  </div>
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
  unset($modificar);
}else{
  header('location:/old-caitab-web/Cita.php');
}
?>
