<?php
session_start();
if(isset($_POST['nombreB'])){
//requiere del archvo empleado, y empleado a su vez de conexion.php
require_once 'clases/Cliente.php';//Requiere del objeto Cliente
$cliente = new Cliente($_POST['idB'], $_POST['nombreB'],$_POST['apellidoB']);//verificar que se cree de esa manera
$buscar = $cliente -> consultaIndividual($_POST['idB'], $_POST['nombreB'],$_POST['apellidoB']);
var_dump($buscar);
echo "
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <script type='text/javascript' src='js/validarCampos.js'></script><!--Esta linea ayudara a la validaciones de los campos-->

    <title>CAITAB A.C.</title>

    <!-- Bootstrap core CSS -->
    <link href='img/logoCaitab' rel='icon'>
    <link href='vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom fonts for this template -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='css/business-casual.min.css' rel='stylesheet'>

  </head>

  <body>

    <h1 class='site-heading text-center text-white d-none d-lg-block'>
      <span class='site-heading-upper text-primary mb-3'>Consulta y Asesoría Integral para el Tratamiento de la Anorexia y la Bulimia A.C.</span>
      <span class='site-heading-lower'>CAITAB A.C.</span>
    </h1>

        <nav class='navbar navbar-expand-lg navbar-dark py-lg-4' id='mainNav'>
      <div class='container'>
        <a class='navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none' href='#'>Start Bootstrap</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarResponsive'>
          <ul class='navbar-nav mx-auto'>
            <li class='nav-item active px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='Agenda.html'>
                AGENDA
                <span class='sr-only'>(current)</span>
              </a>
            </li>
            <li class='nav-item px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='Cita.html'>
                CITAS
              </a>
            </li>
            <li class='nav-item px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='products.html'>
                SESION
              </a>
            </li>
            <li class='nav-item px-lg-4'>
              <a class='nav-link text-uppercase text-expanded' href='store.html'>
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
                <!--Formulario para iniciar la sesion-->
                ";
                if($buscar==true){
                  //Se mostraran los datos del cliente
                  //Aqui lo que hace falta es sacar la informacion del objeto cliente y dejar que sea visible para las personas
                  //PENDIENTE
                  echo "<h2>
                    <span class='section-heading mb-3'>Resultado</span>
                  </h2>
                      <div class='row'>
                      <div class='col-md-3'>
                        <span class='input-group-addon'>NOMBRE</span>
                      </div>
                      <div class='col-md-6'>";
                      //Aqui se deja el nombre
                      //echo $cliente->getNombre();
                      //Aun no esta muy claro
                      echo"
                      </div>
                      <div class='col-md-3'></div>
                    </div>
                    <div class='row'>
                      <div class='col-md-3'>
                        <span class='input-group-addon'>APELLIDO</span>
                      </div>
                      <div class='col-md-6'>
                        <input type='text' class='form-control' name='apellido' id='apellidos' placeholder='Apellido'/>
                      </div>
                    <div class='col-md-3'></div>
                    </div>
                    <div class='row'>
                      <div class='col-md-3'>
                        <span class='input-group-addon'>DIRECCION</span>
                      </div>
                      <div class='col-md-6'>
                        <input type='text' class='form-control' name='direccion' id='direccion' placeholder='Direccion'/>
                      </div>
                      <div class='col-md-3'></div>
                    </div>
                    <div class='row'>
                      <div class='col-md-3'>
                        <span class='input-group-addon'>TELEFONO</span>
                      </div>
                      <div class='col-md-6'>
                        <input type='text' class='form-control' name='telefono' id='telefono' placeholder='Telefono'/>
                      </div>
                    <div class='col-md-3'></div>
                    </div>
                    <div class='row'>
                      <div class='col-md-3'>
                        <span class='input-group-addon'>TEL. DE EMERGENCIA</span>
                      </div>
                      <div class='col-md-6'>
                        <input type='text' class='form-control' name='telefonoEme' id='telefonoEme' placeholder='Telefono de emergencia'/>
                      </div>
                    <div class='col-md-3'></div>
                    </div>
                    <div class='row'>
                      <div class='col-md-3'>
                        <span class='input-group-addon'>E-MAIL</span>
                      </div>
                      <div class='col-md-6'>
                        <input type='text' class='form-control' name='email' id='email' placeholder='E-Mail'/>
                      </div>
                    <div class='col-md-3'></div>";
                }
                else{
                  echo "Ocurrio un error al Consultar o No se encontro a la persona";
                }//Esto muestra la informacion del cliente
                echo "
                  <div class='intro-button mx-auto' style='margin-top:15px'>
                    <a href='/Agenda.html'><button value='Regresar' class='btn btn-success btn-x2' /><a/>
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
}//Si se crea el POST
else{
  header('location:/old-caitab-web');//Si no se ha llenado el formulario
}
?>
