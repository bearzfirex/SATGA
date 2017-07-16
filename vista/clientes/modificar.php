<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Cliente</title>
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
            <h1>Modificar cliente</h1>
            <hr class="my-4">

            <!--Formulario de persona -->
            <form method="POST" action="../../controlador/clientes.php">
            <div id="cliente" <?php if(empty($_POST['mod_p'])){ echo 'style="display: none;"'; } ?>>
              <div class="form-group row d-flex justify-content-center">
                <label for="cedula" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Cédula</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-address-card fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autofocus="true" autocomplete="off" 
                    type="text" name="cedula" class="form-control" placeholder="Cédula" maxlength="12" 
                    pattern='[Vv]{1}-[0-9]{7,8}|[Ee]{1}-[0-9]{7,8}' 
                    title='Ejemplo: V-01234567/v-9876472/E-12345678'
                    value="<?php if(!empty($_POST['cedula'])){echo $_POST['cedula'];} ?>"
                           <?php if (!empty($_POST['mod_p'])){echo "required";} ?>>
                  </div>
                </div>
              </div>
            
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
                      value="<?php if(!empty($_POST['nombre'])){echo $_POST['nombre'];}?>" 
                             <?php if (!empty($_POST['mod_p'])){echo "required";} ?>>
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
                      value="<?php if(!empty($_POST['apellido'])){echo $_POST['apellido'];}?>" 
                             <?php if (!empty($_POST['mod_p'])){echo "required";} ?>>
                    </div>
                  </div>
                </div>

                <div class="form-group row d-flex justify-content-center">
                  <label for="telefono_p" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Teléfono personal</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autocomplete="off" maxlength="11" id="validar"
                      type="text" name="telefono_p" class="form-control form-control-sm" placeholder="Teléfono personal"
                      pattern='[0-9]{11}' 
                      title="Se permiten 11 dígitos del 0 al 9, incluyendo el código de área; sin espacios ni separadores" 
                      value="<?php if(!empty($_POST['telefono_p'])){echo $_POST['telefono_p'];}?>" 
                             <?php if (!empty($_POST['mod_p'])){echo "required";} ?>>
                    </div>
                  </div>
                </div>

                <div class="form-group row d-flex justify-content-center">
                  <label for="direccion_p" class="col-1 col-md-2 col-form-label col-form-label-sm text-left"><b>Dirección personal</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                      <input autocomplete="off" maxlength="120"
                      type="text" name="direccion_p" class="form-control form-control-sm" placeholder="Dirección personal"
                      pattern='.{3,}'
                      value="<?php if(!empty($_POST['direccion_p'])){echo $_POST['direccion_p'];}?>" 
                             <?php if (!empty($_POST['mod_p'])){echo "required";} ?>>
                    </div>
                  </div>
                </div>
              </div>

              <!--Datos de firma legal/empresa -->
              <div id="empresa" <?php if (empty($_POST['mod_e'])){echo 'style="display: none"';}?>>
                <div class="form-group row d-flex justify-content-center">
                  <label for="rif" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>R.I.F.</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-fw fa-archive"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autofocus="true" autocomplete="off" 
                      type="text" name="rif" class="form-control" placeholder="R.I.F." maxlength="12" 
                      pattern='[Vv]{1}-[0-9]{8}-[0-9]{1}|[Gg]{1}-[0-9]{8}-[0-9]{1}|[Jj]{1}-[0-9]{8}-[0-9]{1}|[Ee]{1}-[0-9]{8}-[0-9]{1}' 
                      title='Ejemplo: V-01234567-8/G-12345678-1/J-12345678-9' 
                      value="<?php if(!empty($_POST['rif'])){echo $_POST['rif'];} ?>" 
                      <?php if(!empty($_POST['mod_e'])){ echo 'required'; } ?>>
                    </div>
                  </div>
                </div>
              
                <div class="form-group row d-flex justify-content-center">
                  <label for="razon" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Razón Social</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autocomplete="off" maxlength="40" 
                      type="text" name="razon" class="form-control form-control-sm" placeholder="Razón Social"
                      pattern='[A-Za-zÁ-Úá-ú .,]+' 
                      title="Solo se admiten letras de la 'A' a la 'Z'; mayúsculas o minúsculas, el punto '.' y la coma ',' " 
                      value="<?php if(!empty($_POST['razon'])){echo $_POST['razon'];} ?>" 
                      <?php if(!empty($_POST['mod_e'])){ echo 'required'; } ?>>
                    </div>
                  </div>
                </div>

                <div class="form-group row d-flex justify-content-center">
                  <label for="telefono_e" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Teléfono de empresa</b></label>
                  <div class="col-8 col-md-4">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                      <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                      autocomplete="off" maxlength="11" 
                      type="text" name="telefono_e" class="form-control form-control-sm" placeholder="Teléfono de empresa"
                      pattern='[0-9]{11}' 
                      title="Se permiten 11 dígitos del 0 al 9, incluyendo el código de área; sin espacios ni separadores" 
                      value="<?php if(!empty($_POST['telefono_e'])){echo $_POST['telefono_e'];}?>" 
                      <?php if(!empty($_POST['mod_e'])){ echo 'required'; } ?>>
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
                      pattern='.{3,}'
                      value="<?php if(!empty($_POST['direccion_e'])){echo $_POST['direccion_e'];}?>" 
                      <?php if(!empty($_POST['mod_e'])){ echo 'required'; } ?>>
                    </div>
                  </div>
                </div>
              </div>
<?php
echo "<input type='hidden' name='key_ci' value='".$_POST['key']."'>";
if (!empty($_POST['mod_e']))
{
  echo "<input type='hidden' name='key_rif' value='".$_POST['rif']."'>";
}
?>
              <div class="row d-flex justify-content-center">
                <div class="col-5 col-md-3">
                  <button type="submit" name="modificar" class="btn btn-success btn-block"><i class="fa fa-check-square-o"></i> Actualizar</button>
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