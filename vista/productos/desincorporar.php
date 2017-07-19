<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Desincorporar Lote de Productos</title>
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
        <section class="jumbotron jumbotron-fluid formulario-sm">
          <div class="container-fluid">
            <h1>Desincorporar Lote de Productos</h1>
            <hr class="my-4">
            <form method="POST" action="../../controlador/productos.php">

              <div class="form-group row d-flex justify-content-center">
                <label for="codigo" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Código de Producto</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                    <input autocomplete="off" 
                    type="text" name="codigo" class="form-control" placeholder="Codigo" maxlength="6"
                    value="<?php if(isset($_POST['key1'])){echo $_POST['key1'];} ?>" required readonly>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="fecha_v" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Fecha de Vencimiento</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-calendar-check-o fa-fw"></i></span>
                    <input autocomplete="off" maxlength="10" 
                    type="text" name="fecha_v" class="form-control form-control-sm" placeholder="Fecha de Vencimiento"
                    pattern='((31/(?:0[13578]|1[02]))|(?:30)/(?:(?!02)(?:0[1-9]|1[0-2]))|(?:0[1-9]|1[0-9]|2[0-9])/(?:(?:0[1-9]|1[0-2])))/[0-9]{4}' 
                    value="<?php if(isset($_POST['key2'])){echo $_POST['key2'];} ?>" required readonly>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="cantidad" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Cantidad</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-cart-plus"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' autocomplete="off" maxlength="10" 
                    type="number" max="<?php echo $_POST['cantidad_max']; ?>" name="cantidad" class="form-control form-control-sm" placeholder="Cantidad de productos"
                    pattern='[0-9]+' 
                    title="Solo se aceptan numeros"
                    value="<?php if(isset($_POST['cantidad'])){echo $_POST['cantidad'];} ?>" required>
                    <input type="hidden" value="<?php echo $_POST['cantidad_max']; ?>" name="cantidad_max">
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="razon" class="col-1 col-md-2 col-form-label col-form-label-sm text-left"><b>Razón</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-edit fa-fw"></i></span>
                    <input autocomplete="off" maxlength="120"
                    type="text" name="razon" class="form-control form-control-sm" placeholder="Razón para desincorporar"
                    value="<?php if(!empty($_POST['razon'])){echo $_POST['razon'];}?>">
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-5 col-md-3">
                  <button type="submit" name='desincorporar' class="btn btn-success btn-block"><i class="fa fa-trash"></i> Desincorporar</button>
                </div>
                <div class="col-5 col-md-3">
                  <button type="reset" class="btn btn-danger btn-block">Limpiar <i class="fa fa-times-rectangle-o"></i></button>
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