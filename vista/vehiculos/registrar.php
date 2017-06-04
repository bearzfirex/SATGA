<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Vehiculo</title>
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
      <div class="col-3 columna-menu">
<?php
include('../complementos/menu.php');
?>
      </div> 
      <!-- Main -->
      <div class="col main text-center">
        <section class="jumbotron jumbotron-fluid formulario-sm">
          <div class="container-fluid">
            <h1>Registrar nuevo vehiculo</h1>
            <hr class="my-4">
            <form method="POST" action="?">

              <div class="form-group row d-flex justify-content-center">
                <label for="matricula" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Matricula</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-qrcode fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autofocus="true" autocomplete="off" 
                    type="text" name="matricula" class="form-control" placeholder="Matricula" maxlength="7"
                    pattern='[A-Za-zÁ-Úá-ú0-9 \-]+' 
                    title="Solo se permiten valores alfa-numericos; mayúsculas o minúsculas y guiones '-'" 
                    value="<?php if(isset($_POST['matricula'])){echo $_POST['matricula'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="marca" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Marca</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-trademark fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="15" 
                    type="text" name="marca" class="form-control form-control-sm" placeholder="Marca"
                    pattern='[A-Za-zÁ-Úá-ú .,]+' 
                    title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas, el punto '.' y la coma ',' " 
                    value="<?php if(isset($_POST['marca'])){echo $_POST['marca'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="modelo" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Modelo</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-truck fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="15" 
                    type="text" name="modelo" class="form-control form-control-sm" placeholder="Modelo"
                    pattern='[A-Za-zÁ-Úá-ú0-9 .,\-]+' 
                    title="Solo se admiten valores alfa-numericos; mayúsculas o minúsculas, el punto '.', el guión '-' y la coma ',' " 
                    value="<?php if(isset($_POST['modelo'])){echo $_POST['modelo'];} ?>" required>
                  </div>
                </div>
              </div>          

              <div class="row d-flex justify-content-center">
                <div class="col-5 col-md-3">
                  <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-square-o"></i> Registrar</button>
                </div>
                <div class="col-5 col-md-3">
                  <button type="submit" class="btn btn-danger btn-block">Limpiar <i class="fa fa-times-rectangle-o"></i></button>
                </div>
              </div>
            </form>
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
</body>
</html>