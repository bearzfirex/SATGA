<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Proveedor</title>
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
            <h1>Registrar nuevo proveedor</h1>
            <hr class="my-4">
            <form method="POST" action="?">

              <div class="form-group row d-flex justify-content-center">
                <label for="rif" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>R.I.F.</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-archive"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autofocus="true" autocomplete="off" 
                    type="text" name="rif" class="form-control" placeholder="R.I.F." maxlength="12" 
                    pattern='[Vv]{1}-[0-9]{8}-[0-9]{1}|[Gg]{1}-[0-9]{8}-[0-9]{1}|[Jj]{1}-[0-9]{8}-[0-9]{1}' title='Ejemplo: V-01234567-8/G-12345678-1/J-12345678-9'
                    value="<?php if(isset($_POST['rif'])){echo $_POST['rif'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="razon_social" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Razon Social</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="40" 
                    type="text" name="razon_social" class="form-control form-control-sm" placeholder="Razon Social"
                    pattern='[A-Za-zÁ-Úá-ú .,]+' title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas, el punto '.' y la coma ',' "
                    value="<?php if(isset($_POST['razon_social'])){echo $_POST['razon_social'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="telefono" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Telefono</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="11" 
                    type="text" name="telefono" class="form-control form-control-sm" placeholder="Telefono"
                    pattern='[0-9]{11}' 
                    title="Se permiten 11 digitos del 0 al 9, incluyendo el código de área; sin espacios ni separadores" 
                    value="<?php if(isset($_POST['telefono'])){echo $_POST['telefono'];}?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="direccion" class="col-1 col-md-2 col-form-label col-form-label-sm text-left"><b>Dirección</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                    <input autocomplete="off" maxlength="120" 
                    type="text" name="direccion" class="form-control form-control-sm" placeholder="Dirección"
                    value="<?php if(isset($_POST['direccion'])){echo $_POST['direccion'];}?>" required>
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