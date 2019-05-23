<?php
  header("Location: ../../../carrito_compras.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);
require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Empleado.php';

session_start();
if(isset($_SESSION["CuentaEmpleado"]) && isset($_SESSION["Empleado"])) {

  if(is_null($_SESSION["CuentaEmpleado"])) {
    header("Location: ../../../inicio_sesion.php");
  }

  $empleado = $_SESSION["Empleado"];
  $cargo = (is_null($empleado)) ? "" : $empleado->getCargo();

  $cargos_validos = array("Gerente", "Supervisor", "Contador");

  if(!in_array($cargo, $cargos_validos)) {
    echo "<script>alert('baia baia hdtpm')</script>";
    header( "refresh:1;url=../../../carrito_compras.php" );
  } 

} else {
  header("Location: ../../../index.html");
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dulcería La Bombonera</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">

  </head>

  <body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">Dulcería</span>
      <span class="site-heading-lower">LA BOMBONERA</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <ul class="navbar-nav mx-auto">
          <h4><span class="site-heading-upper text-primary mb-3">¡BIENVENIDO!</span></h4>
        </ul>
      </div>
    </nav>

    <section class="page-section cta">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 mx-auto">

            <div class="cta-inner text-center rounded">
              <div class="intro-button mx-auto" style="position: inherit;">
                <a class="btn btn-primary btn-x2" href="clientes_proveedores.html">Clientes y Proveedores</a>
              </div>
            <br/>
              <div class="intro-button mx-auto" style="position: inherit;">
                <a class="btn btn-primary btn-x2" href="inventario.html">Inventario de Productos</a>
              </div>
            <br/>
              <div class="intro-button mx-auto" style="position: inherit;">
                <a class="btn btn-primary btn-x2" href="carrito_compras.php">Carrito de compras</a>
              </div>
            </div>

            <br/>
            <form action="/php/controlador/cerrar_sesion.php" method="get">
              <div class="intro-button mx-auto" style="position: inherit;">
                <input type="submit" value="Cerrar Sesión" class="btn btn-danger btn-x2"/>
              </div>
            </form>
                
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
