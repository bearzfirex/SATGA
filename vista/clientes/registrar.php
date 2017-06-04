<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Cliente</title>
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
        <section class="jumbotron jumbotron-fluid formulario-lg">
          <div class="container-fluid">
            <h1>Registrar nuevo cliente</h1>
            <hr class="my-4">
            <!-- Busqueda en existencia -->
            <form method="POST" action="?" <?php if(isset($_POST['find'])){echo 'style="display: none;"';} ?>>
              
              <div class="row d-flex justify-content-center">
                <div class="col-8 col-md-6">
                  <p>Inserte la cedula del Cliente o Representante Legal</p>
                </div>                
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="cedula" class="col-2 col-md-2 col-form-label col-form-label-lg text-left sr-only"><b>Cedula</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="fa fa-address-card fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autofocus="true" autocomplete="off" 
                    type="search" name="cedula" class="form-control" placeholder="Cedula" maxlength="12" 
                    pattern='[Vv]{1}-[0-9]{7,8}|[Ee]{1}-[0-9]{7,8}' 
                    title='Ejemplo: V-01234567/v-9876472/E-12345678'
                    value="<?php if(isset($_POST['cedula'])){echo $_POST['cedula'];} ?>" required>
                  </div>
                </div>
              </div>
              <input type="hidden" name="find" value="True">

              <div class="form-check form-check-inline row">
                <label class="form-check-label col-12">
                  <input class="form-check-input" type="checkbox" name="empresa" value="True"> ¿Registrara una empresa o firma legal?
                </label>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-10 col-md-3">
                  <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-square-o"></i>Continuar</button>
                </div>
              </div>

            </form>
            <!--Formlario de cliente -->
            <form method="POST" action="?" <?php if(!isset($_POST['find'])){echo 'style="display: none;"';} ?>>

              <div class="form-group row d-flex justify-content-center">
                <label for="cedula" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Cedula</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-address-card fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autofocus="true" autocomplete="off" 
                    type="text" name="cedula" class="form-control" placeholder="Cedula" maxlength="12" 
                    pattern='[Vv]{1}-[0-9]{7,8}|[Ee]{1}-[0-9]{7,8}' 
                    title='Ejemplo: V-01234567/v-9876472/E-12345678'
                    <?php if(isset($_POST['cedula'])){echo 'value="'.$_POST['cedula'].'" disabled';} ?> required>
                  </div>
                </div>
              </div>

              <!-- Datos personales (No necesarios si ya esta registrado como vendedor) -->
              <div id="cliente" <?php if(isset($_POST['vendedor'])){ echo 'style="display: none;"'; } ?>>
                <div class="form-group row d-flex justify-content-center">
                  <label for="nombre" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Nombre</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autocomplete="off" maxlength="15" id="validar"
                      type="text" name="nombre" class="form-control form-control-sm" placeholder="Nombre"
                      pattern='[A-Za-zÁ-Úá-ú ]{2,15}' 
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
                      autocomplete="off" maxlength="15" id="validar"
                      type="text" name="apellido" class="form-control form-control-sm" placeholder="Apellido"
                      pattern='[A-Za-zÁ-Úá-ú ]+' 
                      title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas."
                      value="<?php if(isset($_POST['apellido'])){echo $_POST['apellido'];}?>" required>
                    </div>
                  </div>
                </div>

                <div class="form-group row d-flex justify-content-center">
                  <label for="telefono" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Telefono personal</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autocomplete="off" maxlength="11" id="validar"
                      type="text" name="telefono" class="form-control form-control-sm" placeholder="Telefono personal"
                      pattern='[0-9]{11}' 
                      title="Se permiten 11 digitos del 0 al 9, incluyendo el código de área; sin espacios ni separadores" 
                      value="<?php if(isset($_POST['telefono'])){echo $_POST['telefono'];}?>" required>
                    </div>
                  </div>
                </div>

                <div class="form-group row d-flex justify-content-center">
                  <label for="direccion" class="col-1 col-md-2 col-form-label col-form-label-sm text-left"><b>Dirección personal</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                      <input autocomplete="off" maxlength="120"
                      type="text" name="direccion" class="form-control form-control-sm" placeholder="Dirección personal"
                      value="<?php if(isset($_POST['direccion'])){echo $_POST['direccion'];}?>" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group row d-flex justify-content-center" <?php if(!isset($_POST['empresa'])){ echo 'style="display: none;"'; } ?>>
                <div class="col-10 col-md-6">
                  <a class="btn btn-primary btn-block" id="continuar"><b>Continuar</b></a>
                </div>
              </div>

              <!--Datos de firma legal/empresa -->
              <div id="empresa" style="display: none;">
                <div class="form-group row d-flex justify-content-center">
                  <label for="rif" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>R.I.F.</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-fw fa-archive"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autofocus="true" autocomplete="off" 
                      type="text" name="rif" class="form-control" placeholder="R.I.F." maxlength="12" 
                      pattern='[Vv]{1}-[0-9]{8}-[0-9]{1}|[Gg]{1}-[0-9]{8}-[0-9]{1}|[Jj]{1}-[0-9]{8}-[0-9]{1}' 
                      title='Ejemplo: V-01234567-8/G-12345678-1/J-12345678-9' 
                      value="<?php if(isset($_POST['rif'])){echo $_POST['rif'];} ?>" 
                      <?php if(isset($_POST['empresa'])){ echo 'required'; } ?>>
                    </div>
                  </div>
                </div>
              
                <div class="form-group row d-flex justify-content-center">
                  <label for="razon" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Razón Social</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autocomplete="off" maxlength="15" 
                      type="text" name="razon" class="form-control form-control-sm" placeholder="Razón Social"
                      pattern='[A-Za-zÁ-Úá-ú .,]+' 
                      title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas, el punto '.' y la coma ',' " 
                      value="<?php if(isset($_POST['razon'])){echo $_POST['razon'];} ?>" 
                      <?php if(isset($_POST['empresa'])){ echo 'required'; } ?>>
                    </div>
                  </div>
                </div>

                <div class="form-group row d-flex justify-content-center">
                  <label for="telefono_e" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Telefono de empresa</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autocomplete="off" maxlength="11" 
                      type="text" name="telefono_e" class="form-control form-control-sm" placeholder="Telefono de empresa"
                      pattern='[0-9]{11}' 
                      title="Se permiten 11 digitos del 0 al 9, incluyendo el código de área; sin espacios ni separadores" 
                      value="<?php if(isset($_POST['telefono_e'])){echo $_POST['telefono_e'];}?>" 
                      <?php if(isset($_POST['empresa'])){ echo 'required'; } ?>>
                    </div>
                  </div>
                </div>

                <div class="form-group row d-flex justify-content-center">
                  <label for="direccion_e" class="col-1 col-md-2 col-form-label col-form-label-sm text-left"><b>Dirección de empresa</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                      <input autocomplete="off" maxlength="120" 
                      type="text" name="direccion_e" class="form-control form-control-sm" placeholder="Dirección de empresa"
                      value="<?php if(isset($_POST['direccion_e'])){echo $_POST['direccion_e'];}?>" 
                      <?php if(isset($_POST['empresa'])){ echo 'required'; } ?>>
                    </div>
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