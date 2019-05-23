<?php

require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Empleado.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Inventario.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Producto.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/Transaccion.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/modelo/TransaccionGranel.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if(!isset($_SESSION["CuentaEmpleado"]) || !isset($_SESSION["Empleado"])) {

  echo "<script>alert('Inicie sesión plox')</script>";
  header( "refresh:1;url=../../../inicio_sesion.php" );

} else {

  $empleado = $_SESSION["Empleado"];
  $cargo = (is_null($empleado)) ? "" : $empleado->getCargo();

  $cargos_validos = array("Gerente", "Supervisor", "Contador");
  $ids_existencia = (new Inventario(null, null, null, null, null))->listarIdsConExistencia();
  $productos = array_filter((new Producto(null, null, null))->listar(), function($V) use ($ids_existencia){
    return isset($ids_existencia[$V->getId()]);
  });

  $cattito = [];
  $total = 0.0;

  if(isset($_SESSION["carrito"])) {
    if(isset($_GET["producto_id"])) {      
      array_push($_SESSION["carrito"], $_GET["producto_id"]);
      header("Location: ../../../carrito_compras.php");
    }
  } else {
    $_SESSION["carrito"] = [];
  }

  if(isset($_GET["remover_elemento"])) {
    array_splice($_SESSION["carrito"], $_GET["remover_elemento"], 1);
    header("Location: ../../../carrito_compras.php");
  }
  
  if(isset($_GET["limpiar"])) {
    unset($_SESSION["carrito"]);
    $_SESSION["carrito"] = [];
    header("Location: ../../../carrito_compras.php");
  }

  if(isset($_SESSION["carrito"])) {
    $tmp = [];

    foreach ($_SESSION["carrito"] as $K => $V) {
      $cantidad = isset($tmp[$V]) ? $tmp[$V] : 0;
      $tmp[$V] = $cantidad += 1;
    }

    $cattito = $tmp;
  }

  if(isset($_GET["aceptar"])) {
    $destino = $_GET["aceptar"];

    $id_clienteproveedor = $_SESSION['Empleado']->getIdClienteProveedor();
    $transaccion = (new Transaccion(null, $id_clienteproveedor, 'Venta', null, null))->insertar();

    
    foreach ($cattito  as $K => $V) {
      $producto = null;

      foreach ($productos as $k => $v) {

        if($v->getId() == $K) {
          $producto = $v;
          break;
        }
      }

      (new TransaccionGranel(
        null, $transaccion->getId(), $K, $V, $producto->getPrecio()
      ))->insertar();      
    }

    unset( $_SESSION["carrito"]);
    echo "<script>alert('Pedido realizado: Pase a sucursal con el número ". $transaccion->getId() ."')</script>";
    header( "refresh:1;url=../../../". $destino . ".php" );
  }
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
          <h4><span class="site-heading-upper text-primary mb-3">Carrito de Compras</span></h4>
        </ul>
      </div>
    </nav>

    <section class="page-section cta">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 mx-auto">
            
            <div class="cta-inner text-center rounded">
                <div class="col-md-12">

                    <div class="dropdown" style="margin-bottom: 10px">
                        <button style="width:400px;" class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Producto
                            <span class="caret"></span>
                        </button>
                        <form action="carrito_compras.php" method="post">
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                              <?php

                                foreach ($productos as $K => $V) {
                                  echo "<li> <a href='carrito_compras.php?producto_id=". $V->getId() ."'>" . $V->getDescripcion() . "</a> </li>";
                                }
                                                      
                              ?>
                                
                            </ul>
                        <form>
                    </div>

                </div>
                <div>
                    <div class="row">
                      <div class="col-lg-1"></div>
                        <div class="col-lg-11">

                            <?php


                              foreach ($cattito  as $K => $V) {
                                $producto = null;

                                foreach ($productos as $k => $v) {
                                  if($v->getId() == $K) {
                                    $producto = $v;
                                    break;
                                  }
                                }

                                $total += ($producto->getPrecio() * $cattito[$K]);

                                
                                echo "<div class='row'>
                                  <div class='col-md-9'>
                                    <input disabled type='text' value='" . $producto->getDescripcion() . " (" . $producto->getPrecio() . ")" .  "' class='form-control' aria-label=''/>
                                  </div>
                                 
                                  <div class='col-md-1'>
                                    <input disabled class='form-control' type='text' value='" . $V . "'/>
                                  </div>

                                  <div class='col-md-1'>
                                    <a class='btn btn-danger' href='carrito_compras.php?remover_elemento=". $K ."'> X </a>
                                  </div>
                                </div>";
                                
                              }
                              
                            ?>
                        </div>
                    </div>
                </div>
                <br/>                    

                <div class="row">
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-2">
                  <span class="input-group-addon">Total a pagar</span>
                  </div>
                  <div class="col-md-4">
                  <?php echo '<input disabled type="text" class="form-control" name="Total" value='.$total.'>' ?>
                  </div>
                  <div class="col-md-3"></div>
                </div>
                
                <br/>
                    
                <div class="row">
                    <div class="col-md-6">

                      <?php

                            echo "<a class='btn btn-danger btn-x2' href='./php/controlador/cerrar_sesion.php' > Cerrar Sesión </a>";

                        /* if(in_array($cargo, $cargos_validos)) {
                          //echo "<a class='btn btn-danger btn-x2' href='carrito_compras.php?Cerrar=menuEmpleado'> Salir </a>";
                        } else {
                          echo "<a class='btn btn-danger btn-x2' href='./php/controlador/cerrar_sesion.php'> Salir </a>";
                        } */

                      ?>

                    </div>
                    <div class="col-md-2">
                      <?php echo "<a class='btn btn-info btn-x2' href='carrito_compras.php?limpiar=true'> Limpiar </a>"; ?>
                    </div>
                    <div class="col-md-2">
                      <?php

                        if(in_array($cargo, $cargos_validos)) {
                          //echo "<a class='btn btn-success btn-x2' href='carrito_compras.php?aceptar=menuEmpleado'> Aceptar </a>";
                          echo "<a class='btn btn-success btn-x2' href='carrito_compras.php?aceptar=carrito_compras'> Aceptar </a>";
                        } else {
                          echo "<a class='btn btn-success btn-x2' href='carrito_compras.php?aceptar=carrito_compras'> Aceptar </a>";
                        }

                      ?>   
                    </div>
                    <div class="col-md-2"></div>
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
