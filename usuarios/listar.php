<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Meta viewport requerido por el grid de bootstrap -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> <!-- CSS de bootstrap -->
  <!-- Estilos para la libreria de dataTables -->
  <link rel="stylesheet" type="text/css" href="../css/datatables/dataTables.bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="../css/datatables/buttons.bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="../css/datatables/responsive.bootstrap.min.css"/>

  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css"> <!-- Fuente de iconos generales -->
  <link rel="stylesheet" type="text/css" href="../css/font-mfizz.css"> <!-- Iconos de programacion -->
  <link rel="stylesheet" type="text/css" href="../css/estilos.css"> <!-- Estilos principales y personalizados -->
  <link rel="stylesheet" type="text/css" href="../css/list.css"> <!-- Estilos personalizados para las listas -->
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
  <div class="container-fluid pagina-central">
    <div class="row">
      <!-- Menu/Aside -->
      <div class="col-md-3 columna-menu">
<?php
include('../complementos/menu.php');
?>
      </div> 
      <!-- Main -->
      <div class="col col-md-9 main">
        <section class="jumbotron jumbotron-fluid listado">
          <div class="container-fluid">
            <h1 class="text-center">Listado de Usuarios</h1>
            <!--Tabla-->
              <!-- Lista -->
              <table id="list" class="table table-striped table-hover table-bordered table-sm dt-responsive nowrap" width="100%" cellspacing="0">
                <thead class="thead">
                  <tr>
                    <th class="all">Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Teléfono</th>
                    <th class="none">Dirección</th>
                    <th>Privilegio</th>
                    <th>Estado</th>
                    <th class="all">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>V-11111111</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Admin</td>
                    <td>Activo</td>
                    <td><button class="btn btn-primary">Opciones</button></td>
                  </tr>
                  <tr>
                    <td>V-22222222</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Admin</td>
                    <td>Activo</td>
                    <td><button class="btn btn-primary">Opciones</button></td>
                  </tr>
                  <tr>
                    <td>V-33333333</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Admin</td>
                    <td>Activo</td>
                    <td><button class="btn btn-primary">Opciones</button></td>
                  </tr>
                  <tr>
                    <td>V-44444444</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Admin</td>
                    <td>Activo</td>
                    <td><button class="btn btn-primary">Opciones</button></td>
                  </tr>
                  <tr>
                    <td>V-55555555</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Admin</td>
                    <td>Activo</td>
                    <td><button class="btn btn-primary">Opciones</button></td>
                  </tr>
                  <tr>
                    <td>V-66666666</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Test1</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Admin</td>
                    <td>Activo</td>
                    <td><button class="btn btn-primary">Opciones</button></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Privilegio</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </tfoot>                
              </table>
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- Pie de pagina/Footer -->
  <footer class="container-fluid">
    <div class="row">
<?php
include('../complementos/footer.php');
?>
    </div>    
  </footer>
  <script type="text/javascript" src="../js/jquery.js"></script> <!-- Jquery -->
  <script type="text/javascript" src="../js/tether.min.js"></script> <!-- Libreria para mantener fijos los objetos (requerido por bootstrap) -->
  <script type="text/javascript" src="../js/bootstrap.min.js"></script> <!-- Javascript de bootstrap -->
  <!-- Libreria y dependencias de dataTables -->
  <script type="text/javascript" src="../js/datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../js/datatables/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/datatables/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="../js/datatables/buttons.bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/datatables/buttons.print.min.js"></script>
  <script type="text/javascript" src="../js/datatables/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="../js/datatables/responsive.bootstrap.min.js"></script>
  
  <script type="text/javascript" src="../js/list.js"></script> <!-- Javascript para las listas -->
  <script type="text/javascript" src="../js/main.js"></script>  <!-- Javascript principal, funciones personalizadas -->
</body>
</html>