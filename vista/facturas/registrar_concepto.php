<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Concepto</title>
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
            <h1>Registrar concepto</h1>
            <hr class="my-4">            
            
            <form method="POST" action="../../controlador/facturas.php" id="venta">

              <div class="form-group row d-flex justify-content-center">
                <label for="codigo" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Codigo de Producto</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-paperclip"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                    autocomplete="off" 
                    type="text" name="codigo" class="form-control" placeholder="Codigo de Producto" maxlength="6" 
                    value="<?php if(isset($_POST['codigo'])){echo $_POST['codigo'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="fecha_vencimiento" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Fecha de Vencimiento</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-calendar-minus-o fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' autocomplete="off" maxlength="10" 
                    type="text" name="fecha_vencimiento" class="fecha form-control form-control-sm" placeholder="Fecha de Vencimiento"
                    pattern='((31/(?:0[13578]|1[02]))|(?:30)/(?:(?!02)(?:0[1-9]|1[0-2]))|(?:0[1-9]|1[0-9]|2[0-9])/(?:(?:0[1-9]|1[0-2])))/[0-9]{4}' 
                    title="Ejemplo: 20/06/1995"
                    value="<?php if(isset($_POST['fecha_vencimiento'])){echo $_POST['fecha_vencimiento'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="precio_compra" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Precio de Compra</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-money"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                    autocomplete="off" maxlength="20" 
                    type="text" name="precio_compra" class="form-control form-control-sm" placeholder="Precio de Compra"
                    pattern='[0-9.,]+' 
                    title="Solo se permiten numeros; el punto '.' y la coma ',' "
                    value="<?php if(isset($_POST['precio_compra'])){echo $_POST['precio_compra'];} ?>" required>
                  </div>
                </div>
              </div>              

              <div class="form-group row d-flex justify-content-center">
                <label for="precio_venta" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Precio de Venta</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-balance-scale"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                    autocomplete="off" maxlength="20" 
                    type="text" name="precio_venta" class="form-control form-control-sm" placeholder="Precio de Venta"
                    pattern='[0-9.,]+' 
                    title="Solo se permiten numeros; el punto '.' y la coma ',' "
                    value="<?php if(isset($_POST['precio_venta'])){echo $_POST['precio_venta'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="cantidad" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Cantidad</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-shopping-cart"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                    autocomplete="off" maxlength="14" 
                    type="text" name="cantidad" class="form-control form-control-sm" placeholder="Cantidad"
                    pattern='[0-9]+' 
                    title="Solo se permiten numeros"
                    value="<?php if(isset($_POST['cantidad'])){echo $_POST['cantidad'];} ?>" required>
                  </div>
                </div>
              </div>  
              
              <div class="row d-flex justify-content-center">
                <div class="col-5 col-md-3">
                  <button type="submit" name="registrar_concepto_compra" class="btn btn-success btn-block"><i class="fa fa-check-square-o"></i> Registrar</button>
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