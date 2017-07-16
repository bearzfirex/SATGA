<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Usuario</title>
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
  <?php
if(isset($_SESSION['login']) && $_SESSION['privilegio']<2)
{
  echo "<script>alert('Debe tener privilegios de administrador para usar esta función'); window.location='../'</script>";
}
?>

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
            <h1>Modificar nuevo usuario</h1>
            <hr class="my-4">
            <form method="POST" action="../../controlador/usuarios.php">

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
                <label for="usuario" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Usuario</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-user-secret fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="15" 
                    type="text" name="usuario" class="form-control form-control-sm" placeholder="Usuario"
                    pattern='[A-Za-zÁ-Úá-ú0-9]+{4,15}' 
                    title="Se admiten entre 4 y 10 caracteres, letras de la 'A' a la 'Z' y números" 
                    value="<?php if(isset($_POST['usuario'])){echo $_POST['usuario'];}?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="contrasena" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Contraseña</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                    <input data-toggle='tooltip' data-placement='bottom' data-trigger='hover'
                    autocomplete="off" maxlength="20" 
                    type="password" name="contrasena" class="form-control form-control-sm" placeholder="Contraseña"
                    pattern='(?=^.{8,20}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' 
                    title='La contraseña debe contener entre 8 y 20 carácteres, debe incluir al menos una letra minúscula, al menos una letra mayúscula y al menos un número' 
                    value="<?php if(isset($_POST['contrasena'])){echo $_POST['contrasena'];}?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <label for="privilegio" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Privilegio</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-id-badge fa-fw"></i></span>
                    <select name="privilegio" class="form-control form-control-sm" required>
                      <option value="" hidden="on">Seleccione...</option>
                      <option value="2" <?php if((isset($_POST['privilegio'])) && ($_POST['privilegio']=='2')){echo 'selected';} ?>>Administrador</option>
                      <option value="1" <?php if((isset($_POST['privilegio'])) && ($_POST['privilegio']=='1')){echo 'selected';} ?>>Usuario</option>
                    </select>
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

<?php
  echo "<input type='hidden' name='key' value='".$_POST['key']."'>";
?>
              <div class="row d-flex justify-content-center">
                <div class="col-5 col-md-3">
                  <button type="submit" name="registrar_cambios" class="btn btn-success btn-block"><i class="fa fa-check-square-o"></i> Modificar</button>
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