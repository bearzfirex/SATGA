<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
  <!-- Cabecera -->
  <header>
    <div class="container">
      <div class="row">
<?php 
include('../complementos/cabecera.php');
?>

      </div>
    </div>
  </header>

  <!-- Main -->
  <section class="container">
    <div class="row">
     <!-- Menu/Aside -->
      <nav class="col-4 menu text-center">
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
  <footer class="container">
    <div class="row">
      <div class="col pie text-ceter">
        <p>Pie de Pagina</p>
      </div>
    </div>    
  </footer>    
</body>
</html>