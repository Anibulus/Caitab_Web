<?php

//require $_SERVER['DOCUMENT_ROOT'].'/php/controlador/autenticacion.php';
require_once 'php/controlador/autenticacion.php';

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="js/validarCampos.js"></script><!--Esta linea ayudara a la validaciones de los campos-->

    <title>CAITAB A.C.</title>

    <!-- Bootstrap core CSS -->
    <link href="img/logoCaitab" rel="icon">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">

  </head>

  <body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">Consulta y Asesoría Integral para el Tratamiento de la Anorexia y la Bulimia A.C.</span>
      <span class="site-heading-lower">CAITAB A.C.</span>
    </h1>

    <!-- Navegacion -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="index.html">
                INICIO
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="about.html">
                ACERCA DE NOSOTROS
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="products.html">
                NUESTROS PRODUCTOS
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="store.html">
                CONTACTO
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="inicio_sesion.php">
                Inicio Sesión
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Seccion para formulario-->
    <section> <!--class="page-section about-heading"-->
      <div class="container">
        <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="img/background/1inicioSesion.jpg">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2>
                  <span class="section-heading mb-3">Ingresa a tu cuenta</span>
                </h2>
                <!--Formulario para iniciar la sesion-->
                <form action="/php/controlador/autenticacion.php" method="POST">
                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">USUARIO</span>
                    </div>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="usuario" placeholder="Ingresa tu usuario">
                    </div>
                    <div class="col-md-3"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">CONTRASE&Ntilde;A</span>
                    </div>
                    <div class="col-md-6">
                      <input type="password" class="form-control" name="consigna" placeholder="Ingresa tu contraseña">
                    </div>
                  <div class="col-md-3"></div>
                  <div class="intro-button mx-auto" style="margin-top:15px">
                    <input type="submit" value="Ingresar" class="btn btn-success btn-x2" />
                  </div>

                </form>


              <!--</div>

                <br/>
                <h5>
                  <span>¿No tienes una cuenta?</span>
                </h5>
                <h2>
                  <span class="section-heading mb-3">Registrate aquí</span>
                </h2>

                <form action="/php/controlador/registrar_cuenta.php" method="post">

                  <div>
                    <div class="row">
                      <div class="col-md-3">
                        <span class="input-group-addon">RFC</span>
                      </div>
                      <div class="col-md-6">
                        <input name='rfc' type="text" class="form-control" placeholder="Ingresa tu RFC">
                      </div>
                      <div class="col-md-3"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <span lass="input-group-addon">Razón Social</span>
                    </div>
                    <div class="col-md-6">
                      <input name='razon_social' type="text" class="form-control" placeholder="Ejem: RAVI S.A de C.V.">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">Nombre Comercial</span>
                    </div>
                    <div class="col-md-6">
                      <input name='nombre_comercial' type="text" class="form-control" placeholder="Ejem: DULCES RAVI">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">Télefono</span>
                    </div>
                    <div class="col-md-6">
                      <input name='telefono' type="text" class="form-control" placeholder="Ingresa un teléfono">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">Dirección</span>
                    </div>
                    <div class="col-md-6">
                      <input name='direccion' ype="text" class="form-control" placeholder="Ingresa una direccción">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">Correo Electronico</span>
                    </div>
                    <div class="col md-6">
                      <input name='correo' type="text" class="form-control" placeholder="Ingresa tu correo">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row" style="margin-top: 10px">
                    <div class="col-md-3">
                      <span class="input-group-addon">Nombre(s)</span>
                    </div>
                    <div class="col-md-6">
                      <input name='nombre' type="text" class="form-control" placeholder="Ingresa tu Nombre(s)">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">Apellidos</span>
                    </div>
                    <div class="col-md-6">
                      <input name='apellidos' type="text" class="form-control" placeholder="Ingresa tus apellidos">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row" style="margin-top: 30px">
                    <div class="col-md-3">
                      <span class="input-group-addon">Usuario</span>
                    </div>
                    <div class="col-md-6">
                      <input name='usuario' type="text" class="form-control" placeholder="Ingresa tu usuario">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">Contraseña</span>
                    </div>
                    <div class="col-md-6">
                      <input name='consigna' type="password" class="form-control" placeholder="Ingresa tu contraseña">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <span class="input-group-addon">Repite contraseña</span>
                    </div>
                    <div class="col-md-6">
                      <input name='consigna_2' type="password" class="form-control" placeholder="Repite tu contraseña">
                    </div>
                    <div class="col-md-3"></div>
                  </div>

                  <div class="intro-button mx-auto" style="margin-top: 20px">
                      <input type='submit' class="btn btn-primary btn-x2" value='Registrarse'>
                  </div>
                </form>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; ELSSE 2018</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

  <!-- Script to highlight the active date in the hours list -->
  <script>
    $('.list-hours li').eq(new Date().getDay()).addClass('today');
  </script>

</html>
