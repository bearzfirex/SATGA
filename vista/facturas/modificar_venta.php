<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Factura</title>
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
            <h1>Modificar una factura</h1>
            <hr class="my-4">            

            <form method="POST" action="../../controlador/facturas.php">

              <div class="form-group row d-flex justify-content-center">
                <label for="numero" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Número</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-paperclip"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                    autocomplete="off" 
                    type="text" name="numero" class="form-control" placeholder="Número de factura" maxlength="10" 
                    pattern="[0-9]+"
                    title="Solo se aceptan números" 
                    value="<?php if(isset($_POST['numero'])){echo $_POST['numero'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="serie" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Serie</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-hashtag"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                    autocomplete="off" maxlength="1" 
                    type="text" name="serie" class="form-control form-control-sm" placeholder="Serie de factura"
                    pattern="[A-Fa-f]"
                    title="Solo se aceptan letras de la A a la F"
                    value="<?php if(isset($_POST['serie'])){echo $_POST['serie'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="ci_rif" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>C.I. o R.I.F.</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-address-card"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                    autocomplete="off" maxlength="12" 
                    type="text" name="ci_rif" class="form-control form-control-sm" placeholder="C.I. o R.I.F. del Cliente"
                    pattern='[Vv]{1}-[0-9]{8}-[0-9]{1}|[Gg]{1}-[0-9]{8}-[0-9]{1}|[Jj]{1}-[0-9]{8}-[0-9]{1}|[Vv]{1}-[0-9]{7,8}|[Ee]{1}-[0-9]{7,8}|[Vv]{1}-[0-9]{8}-[0-9]{1}|[Gg]{1}-[0-9]{8}-[0-9]{1}|[Jj]{1}-[0-9]{8}-[0-9]{1}|[Ee]{1}-[0-9]{8}-[0-9]{1}'
                    title='Ejemplo: V-0123456743/G-12345678-1/J-12345678-9'
                    value="<?php if(isset($_POST['ci_rif'])){echo $_POST['ci_rif'];} ?>" required>
                  </div>
                </div>
              </div>              

              <div class="form-group row d-flex justify-content-center">
                <label for="privilegio" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Tipo de Pago</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-file-text"></i></span>
                    <select name="tipo" id="tipo1" class="form-control form-control-sm" required>
                      <option value="" hidden="on">Seleccione...</option>
                      <option value="P" <?php if(isset($_POST['tipo']) && ($_POST['tipo']=='P')){echo 'selected';} ?>>Credito</option>
                      <option value="C" <?php if(isset($_POST['tipo']) && ($_POST['tipo']=='C')){echo 'selected';} ?>>Contado</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="fecha_i" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Fecha de Emisión</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-calendar-check-o fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' autocomplete="off" maxlength="10" 
                    type="text" name="fecha_i" class="fecha fecha-inicial-venta form-control form-control-sm" placeholder="Fecha de Emisión de Factura"
                    pattern='((31/(?:0[13578]|1[02]))|(?:30)/(?:(?!02)(?:0[1-9]|1[0-2]))|(?:0[1-9]|1[0-9]|2[0-9])/(?:(?:0[1-9]|1[0-2])))/[0-9]{4}' 
                    title="Ejemplo: 20/06/1995"
                    value="<?php if(isset($_POST['fecha_i'])){echo $_POST['fecha_i'];} ?>" required>
                  </div>
                </div>
              </div>

              <div style="display: none;" id="credito1">
                <div class="form-group row d-flex justify-content-center">
                  <label for="fecha_f" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Fecha Final</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-calendar-times-o fa-fw"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                      id='P1' autocomplete="off" maxlength="10" 
                      type="text" name="fecha_f" class="fecha fecha-final-venta form-control form-control-sm" placeholder="Fecha Final de Pago"
                      pattern='((31/(?:0[13578]|1[02]))|(?:30)/(?:(?!02)(?:0[1-9]|1[0-2]))|(?:0[1-9]|1[0-9]|2[0-9])/(?:(?:0[1-9]|1[0-2])))/[0-9]{4}'
                      title="Ejemplo: 20/06/1995"
                      value="<?php if(isset($_POST['fecha_f'])){echo $_POST['fecha_f'];} ?>">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="ci_vendedor" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>C.I. Vendedor</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-black-tie"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="10" 
                    type="text" name="ci_vendedor" class="form-control form-control-sm" placeholder="C.I. del Vendedor"
                    pattern='[Vv]{1}-[0-9]{7,8}|[Ee]{1}-[0-9]{7,8}' 
                    title='Ejemplo: V-01234567/v-9876472/E-12345678' 
                    value="<?php if(isset($_POST['ci_vendedor'])){echo $_POST['ci_vendedor'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="subtotal" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Subtotal</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-shopping-cart"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' autocomplete="off" maxlength="10" 
                    type="text" name="subtotal" class="form-control form-control-sm" placeholder="Subtotal"
                    pattern='[0-9]+.[0-9]{2}|[0-9]+|[0-9]+.[0-9]{1}' 
                    title="Números con hasta 2 decimales, utilice la coma '.' como separador"
                    value="<?php if(isset($_POST['subtotal'])){echo $_POST['subtotal'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="iva" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>I.V.A. Porcentaje</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-fw fa-cart-plus"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' autocomplete="off" maxlength="10" 
                    type="number" min="0" max="100" name="iva" class="form-control form-control-sm" placeholder="I.V.A. en Porcentaje"
                    pattern='[0-9]+' 
                    title="Solo se aceptan numeros"
                    value="<?php if(isset($_POST['iva'])){echo $_POST['iva'];} ?>" required>
                    <span class="input-group-addon">%</span>
                  </div>
                </div>
              </div>

              <div class="form-check row d-flex justify-content-center">
                <div class="col-10 col-md-10">
                  <label for="natural" class="form-check-label">
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' 
                    type="checkbox" name="natural" value="N" class="form-check-input"
                    title="¿Registrara la factura a nombre de una empresa o firma legal?"
                    <?php if((isset($_POST['natural'])) && ($_POST['natural']=='N')){echo 'checked';} ?>>
                    <b>¿Persona Juridica?</b>
                  </label>
                </div>
              </div>

              <input type="hidden" name="key1" value="<?php echo $_POST['key1'];?>">
              <input type="hidden" name="key2" value="<?php echo $_POST['key2'];?>">        
              
              <div class="row d-flex justify-content-center">
                <div class="col-5 col-md-3">
                  <button type="submit" name="registrar_cambios_venta" class="btn btn-success btn-block"><i class="fa fa-check-square-o"></i> Modificar</button>
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
  <script type="text/javascript">
    var type = $('#tipo1').val();
    if(type == 'P') {
      $('#credito1').show(1000);
      $('#p1').attr('required','required')
    }
  </script>
</body>
</html>