<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Buscar Cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Meta viewport requerido por el grid de bootstrap -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> <!-- CSS de bootstrap -->
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css"> <!-- Fuente de iconos generales -->
  <link rel="stylesheet" type="text/css" href="../css/font-mfizz.css"> <!-- Iconos de programacion -->
  <link rel="stylesheet" type="text/css" href="../css/estilos.css"> <!-- Estilos principales y personalizados -->
  <link rel="stylesheet" type="text/css" href="../css/form.css"> <!-- Estilos para formularios -->
  <!--- favicon/icono -->
  <link rel="shortcut icon" href="../complementos/favicon.ico">
  <link rel="icon" type="image/png" sizes="32x32" href="../complementos/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../complementos/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../complementos/favicon-16x16.png">
</head>
<body>
  <!-- Cabecera -->
  <header class="container-fluid">
    <div class="row">
<?php 
include('../complementos/cabecera.php');
?>

    </div>
  </header>

  <!-- Main -->
  <section class="container-fluid pagina-central">
    <div class="row">
      <!-- Menu/Aside -->
      <div class="col-md-3 columna-menu">
<?php
include('../complementos/menu.php');
?>
      </div> 
      <!-- Main -->
      <div class="col-12 col-md-9 main text-center">
        <section class="jumbotron jumbotron-fluid formulario-lg">
          <div class="container-fluid">
            <h1>Buscar un cliente</h1>
            <hr class="my-4">
            <!-- Busqueda de clientes -->
            <form method="POST" id="buscador" action="./listar_personas.php">
              <div class="row d-flex justify-content-center">
                <div class="col-8 col-md-6">
                  <p>Introduzca un dato del cliente a buscar</p>
                </div>                
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="cedula" class="col-2 col-md-2 col-form-label col-form-label-lg text-left sr-only"><b>Cliente</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="fa fa-address-card fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autofocus="true" autocomplete="off" 
                    type="search" name="dato" class="form-control" title="Cédula, R.I.F., Direccion o Nombre" maxlength="12"
                    required>
                  </div>
                </div>
              </div>

              <div class="form-check form-check-inline row">
                <label class="form-check-label col-12">
                  <input class="form-check-input" type="checkbox" onclick="formaction(this)" name="empresa" value="./listar_empresas.php"> <b>¿Está buscando a una empresa o firma personal?</b>
                </label>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-10 col-md-3">
                  <button type="submit" name="buscar" class="btn btn-success btn-block"><i class="fa fa-search"></i> Buscar</button>
                </div>
              </div>
        </section>
      </div>
    </div>
  </section>

  <!-- Pie de pagina/Footer -->
  <footer class="container-fluid" role="footer">
    <div class="row">
<?php
include('../complementos/footer.php');
?>
    </div>    
  </footer>
  <script src="../js/jquery.js"></script> <!-- Jquery -->
  <script src="../js/tether.min.js"></script> <!-- Libreria para mantener fijos los objetos (requerido por bootstrap) -->
  <script src="../js/bootstrap.min.js"></script> <!-- Javascript de bootstrap -->
  <script src="../js/main.js"></script> 
  <script src="../js/form.js"></script>    <!-- Javascript principal, funciones personalizadas -->
  
  <script type="text/javascript">
    function formaction(checkbox){
      var reset = "./listar_personas.php";
      if (checkbox.checked)
      {
        document.getElementById("buscador").action = checkbox.value;
      }
      else
      {
        document.getElementById("buscador").action = reset;
      }
    }
  </script>
</body>
</html>