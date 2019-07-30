<?php
session_start();
if(isset($_POST['nombre'])){
  require_once 'modelo/Cliente.php';//Requiere del objeto Cliente

  require_once 'modelo/Expediente.php';
  $expediente=new Expediente(0,$_SESSION['idEmpleado'],0,$_SESSION['idCita'],'Hora','Hora','Descipcion','Conclusion');
  $expediente=$expediente->modificarExpediente($_SESSION['idCita'],$_POST['desc'],$_POST['con']);

  echo"
  <!DOCTYPE html>
  <html lang='en'>
    <head>
      <meta charset='utf-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
      <meta name='description' content=''>
      <meta name='author' content=''>
      <script type='text/javascript' src='/old-caitab-web/js/validarCampos.js'></script><!--Esta linea ayudara a la validaciones de los campos-->

      <title>CAITAB A.C.</title>

      <!-- Bootstrap core CSS -->
      <link href='/old-caitab-web/img/logoCaitab' rel='icon'>
      <link href='/old-caitab-web/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>

      <!-- Custom fonts for this template -->
      <link href='https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>
      <link href='https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i' rel='stylesheet'>

      <!-- Custom styles for this template -->
      <link href='/old-caitab-web/css/business-casual.min.css' rel='stylesheet'>

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
              <li class='nav-item px-lg-4'>
                <a class='nav-link text-uppercase text-expanded' href='/old-caitab-web/Cita.php'>
                  CITAS
                </a>
              </li>
              <li class='nav-item active px-lg-4'>
                <a class='nav-link text-uppercase text-expanded' href='/old-caitab-web/Sesion.php'>
                  SESIONES
                </a>
              </li>
              <li class='nav-item px-lg-4'>
                <a class='nav-link text-uppercase text-expanded' href='cerrar_session.php'>
                  CERRAR SESION
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!--Seccion para formulario-->
      <section> <!--class='page-section about-heading'-->
          <div class='about-heading-content'>
            <div class='row'>
              <div class='col-xl-9 col-lg-10 mx-auto'>
                <div class='bg-faded rounded p-5'>
                  <h2>
                    <span class='section-heading mb-3'>Se ha modificado correctamente la Sesion de ".$_POST['nombre']."</span>
                  </h2>
                  </div>
              </div>
            </div>
          </div>
          <div class='intro-button mx-auto' style='margin-top:15px'>
            <a href='/old-caitab-web/Sesion.php'><input type='button' value='Regresar' class='btn btn-success btn-x2' /><a/>
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
  unset($expediente);
  unset($cliente);

}else{
  header('location:/old-caitab-web/Sesion.php');
}




?>
