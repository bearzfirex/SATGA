<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/estilos.css">
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
  <section class="container-fluid">
    <div class="row">
     <!-- Menu/Aside -->
      <nav class="col-3 menu text-center">
<?php
include('../complementos/menu.php');
?>
      </nav>
     <!-- Main -->
      <section class="col main text-center">
        <p>Principal</p>
      </section>
    </div>
  </section>

  <!-- Pie de pagina/Footer -->
  <footer class="container-fluid">
    <div class="row">
      <div class="col pie text-ceter">
        <p>Pie de Pagina</p>
      </div>
    </div>    
  </footer>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>    
</body>
</html>