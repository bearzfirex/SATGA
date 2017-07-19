<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Vendedor</title>
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
            <h1>Modificar vendedor</h1>
            <hr class="my-4">
            <form method="POST" action="../../controlador/vendedores.php">

              <div class="form-group row d-flex justify-content-center">
                <label for="cedula" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Cédula</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-address-card fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autofocus="on" autocomplete="off" 
                    type="text" name="cedula" class="form-control" placeholder="Cédula" maxlength="10" 
                    pattern='[Vv]{1}-[0-9]{7,8}|[Ee]{1}-[0-9]{7,8}' 
                    title='Ejemplo: V-01234567/v-9876472/E-12345678'
                    value="<?php if(isset($_POST['cedula'])){echo $_POST['cedula'];} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="nombre" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Nombre</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="15" 
                    type="text" name="nombre" class="form-control form-control-sm" placeholder="Nombre"
                    pattern='[A-Za-zÁ-Úá-ú ]+' 
                    title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas."
                    value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];}?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="apellido" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Apellido</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="15" 
                    type="text" name="apellido" class="form-control form-control-sm" placeholder="Apellido"
                    pattern='[A-Za-zÁ-Úá-ú ]+' 
                    title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas."
                    value="<?php if(isset($_POST['apellido'])){echo $_POST['apellido'];}?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="telefono" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Teléfono</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="11" 
                    type="text" name="telefono" class="form-control form-control-sm" placeholder="Teléfono"
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
                    pattern='.{3,}'
                    value="<?php if(isset($_POST['direccion'])){echo $_POST['direccion'];}?>" required>
                  </div>
                </div>
              </div>

              <h6>Datos Laborales</h6>
              <hr>

              <div class="form-group row d-flex justify-content-center">
                <label for="fecha_ingreso" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Fecha de Ingreso</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover' autocomplete="off" maxlength="10" 
                    type="text" name="fecha_ingreso" class="fecha form-control form-control-sm" placeholder="Fecha de Ingreso"
                    pattern='((31/(?:0[13578]|1[02]))|(?:30)/(?:(?!02)(?:0[1-9]|1[0-2]))|(?:0[1-9]|1[0-9]|2[0-9])/(?:(?:0[1-9]|1[0-2])))/[0-9]{4}' 
                    title="Ejemplo: 20/06/1995"
                    value="<?php if(isset($_POST['fecha_ingreso'])){$fecha=strtotime($_POST['fecha_ingreso']); echo date('d/m/Y',$fecha);} ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="cargo" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Cargo</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-user-md fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="20" 
                    type="text" name="cargo" class="form-control form-control-sm" placeholder="Cargo"
                    pattern='[A-Za-zÁ-Úá-ú ]+' 
                    title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas."
                    value="<?php if(isset($_POST['cargo'])){echo $_POST['cargo'];}?>" required>
                  </div>
                </div>
              </div>

              <input type="hidden" value="<?php if(isset($_POST['cedula'])){echo $_POST['cedula'];} ?>" name="key">

              <div class="row d-flex justify-content-center">
                <div class="col-5 col-md-3">
                  <button type="submit" name="registrar_cambios" class="btn btn-success btn-block"><i class="fa fa-check-square-o"></i> Modificar</button>
                </div>
                <div class="col-5 col-md-3">
                  <button type="reset" class="btn btn-danger btn-block">Deshacer <i class="fa fa-times-rectangle-o"></i></button>
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