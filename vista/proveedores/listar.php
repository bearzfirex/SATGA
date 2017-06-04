<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Proveedores</title>
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
            <h1 class="text-center">Listado de Proveedores</h1>
            <!--Tabla-->
              <!-- Lista -->
              <table id="list" class="table table-striped table-hover table-bordered table-sm dt-responsive nowrap" width="100%" cellspacing="0">
                <thead class="thead">
                  <tr>
                    <th class="all">R.I.F.</th>
                    <th>Razon Social</th>
                    <th>Teléfono</th>
                    <th class="none">Dirección</th>
                    <th>Estado</th>
                    <th class="all">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>J-11111111-1</td>
                    <td>Razon Bolivariana</td>
                    <td>04261111111</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Activo</td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="opciones">
                          <button class="dropdown-item" type="button">Modificar</button>
                          <button class="dropdown-item" type="button">Desactivar</button>                          
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>J-2222222-1</td>
                    <td>Razon Bolivariana</td>
                    <td>04261111111</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Activo</td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="opciones">
                          <button class="dropdown-item" type="button">Modificar</button>
                          <button class="dropdown-item" type="button">Desactivar</button>                          
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>J-3333333-1</td>
                    <td>Razon Bolivariana</td>
                    <td>04261111111</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Activo</td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="opciones">
                          <button class="dropdown-item" type="button">Modificar</button>
                          <button class="dropdown-item" type="button">Desactivar</button>                          
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>J-4444444-1</td>
                    <td>Razon Bolivariana</td>
                    <td>04261111111</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Activo</td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="opciones">
                          <button class="dropdown-item" type="button">Modificar</button>
                          <button class="dropdown-item" type="button">Desactivar</button>                          
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>J-5555555-1</td>
                    <td>Razon Bolivariana</td>
                    <td>04261111111</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Activo</td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="opciones">
                          <button class="dropdown-item" type="button">Modificar</button>
                          <button class="dropdown-item" type="button">Desactivar</button>                          
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>J-6666666-1</td>
                    <td>Razon Bolivariana</td>
                    <td>04261111111</td>
                    <td>Direeccion bien pinche larga que caga tablas</td>
                    <td>Activo</td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="opciones">
                          <button class="dropdown-item" type="button">Modificar</button>
                          <button class="dropdown-item" type="button">Desactivar</button>                          
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="all">R.I.F.</th>
                    <th>Razon Social</th>
                    <th>Teléfono</th>
                    <th class="none">Dirección</th>
                    <th>Estado</th>
                    <th class="all">Opciones</th>
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