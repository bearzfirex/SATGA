<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Usuario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Meta viewport requerido por el grid de bootstrap -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> <!-- CSS de bootstrap -->
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css"> <!-- Fuente de iconos generales -->
  <link rel="stylesheet" type="text/css" href="../css/font-mfizz.css"> <!-- Iconos de programacion -->
  <link rel="stylesheet" type="text/css" href="../css/estilos.css"> <!-- Estilos principales y personalizados -->
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
        <section class="jumbotron jumbotron-fluid formulario">
          <div class="container-fluid">
            <h1>Registrar nuevo usuario</h1>
            <hr class="my-4">
            <form>
              <div class="form-group row d-flex justify-content-center">
                <label for="cedula" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Cedula</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon">icono</span>
                    <input type="text" id="cedula" class="form-control" placeholder="Cedula">
                  </div>
                </div>
              </div>
              <div class="form-group row d-flex justify-content-center">
                <label for="nombre" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Nombre</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon">icono</span>
                    <input type="text" id="nombre" class="form-control form-control-sm" placeholder="Nombre">
                  </div>
                </div>
              </div>
              <div class="form-group row d-flex justify-content-center">
                <label for="apellido" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Apellido</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon">icono</span>
                    <input type="text" id="apellido" class="form-control form-control-sm" placeholder="Apellido">
                  </div>
                </div>
              </div>
              <div class="form-group row d-flex justify-content-center">
                <label for="usuario" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Usuario</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon">icono</span>
                    <input type="text" id="usuario" class="form-control form-control-sm" placeholder="Usuario">
                  </div>
                </div>
              </div>
              <div class="form-group row d-flex justify-content-center">
                <label for="contrasena" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Contraseña</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon">icono</span>
                    <input type="text" id="contrasena" class="form-control form-control-sm" placeholder="Contraseña">
                  </div>
                </div>
              </div>
              <div class="form-group row d-flex justify-content-center">
                <label for="privilegio" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Privilegio</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon">icono</span>
                    <select id="privilegio" class="custom-select form-control form-control-sm">
                      <option hidden="on">Seleccione...</option>
                      <option>Administrador</option>
                      <option>Usuario</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group row d-flex justify-content-center">
                <label for="telefono" class="col-2 col-md-2 col-form-label col-form-label-sm text-left"><b>Telefono</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon">icono</span>
                    <input type="text" id="telefono" class="form-control form-control-sm" placeholder="Telefono">
                  </div>
                </div>
              </div>
              <div class="form-group row d-flex justify-content-center">
                <label for="direccion" class="col-1 col-md-2 col-form-label col-form-label-sm text-left"><b>Dirección</b></label>
                <div class="col-8 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon">icono</span>
                    <input type="text" id="direccion" class="form-control form-control-sm" placeholder="Dirección">
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
  <script src="../js/main.js"></script>     <!-- Javascript principal, funciones personalizadas -->
</body>
</html>