<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Producto</title>
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
            <h1>Registrar nuevo producto</h1>
            <hr class="my-4">
            <form method="POST" action="?">

              <div class="form-group row d-flex justify-content-center">
                <label for="codigo" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Código</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autofocus="true" autocomplete="off" 
                    type="text" name="codigo" class="form-control" placeholder="Codigo" maxlength="6"
                    value="<?php if(isset($_POST['codigo'])){echo $_POST['codigo'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="nombre" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Nombre</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-angle-right"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="15" 
                    type="text" name="nombre" class="form-control form-control-sm" placeholder="Nombre"
                    pattern='[A-Za-zÁ-Úá-ú .,]+' 
                    title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas, el punto '.' y la coma ',' "
                    value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="tipo_bebida" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Tipo de Bebida</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-glass"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="10" 
                    type="text" name="tipo_bebida" class="form-control form-control-sm" placeholder="Tipo de Bebida"
                    pattern='[A-Za-zÁ-Úá-ú .,]+' 
                    title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas, el punto '.' y la coma ',' "
                    value="<?php if(isset($_POST['tipo_bebida'])){echo $_POST['tipo_bebida'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="contenido_neto" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Contenido Neto</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-balance-scale"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="6" 
                    type="text" name="contenido_neto" class="form-control form-control-sm" placeholder="Contenido Neto"
                    value="<?php if(isset($_POST['contenido_neto'])){echo $_POST['contenido_neto'];} ?>" required>
                  </div>
                </div>
              </div> 

              <div class="form-group row d-flex justify-content-center">
                <label for="envase" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Tipo de Envase</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-flask"></i></span>
                    <select name="envase" class="form-control form-control-sm" required>
                      <option value="" hidden="on">Seleccione el envase</option>
                      <option value="plastico">Plástico</option>
                      <option value="vidrio_nr">Vidrio NR</option>
                      <option value="vidrio_r">Vidrio R</option>
                      <option value="lata">Lata</option>
                    </select>
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