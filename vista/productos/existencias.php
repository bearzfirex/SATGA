<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Existencias de Productos</title>
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
      <div class="col-12 col-md-9 main">
        <section class="jumbotron jumbotron-fluid listado">
          <div class="container-fluid">
            <h1 class="text-center">Existencias de Productos</h1>
            <!--Tabla-->
              <!-- Lista -->
              <table id="list" class="table table-striped table-hover table-bordered table-sm dt-responsive nowrap" width="100%" cellspacing="0">
                <thead class="thead">
                  <tr>
                    <th class="all print">Producto</th>
                    <th class="none">Descripción producto</th>
                    <th class="all print">Fecha vencimiento</th>
                    <th class="print">Precio compra</th>
                    <th class="print">Precio venta</th>
                    <th class="print">Cantidad</th>
                    <?php
                    if($_SESSION['privilegio']>1)
                    {
                      echo"<th class='all'>Opciones</th>";
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
<?php
  $listar_existencias=true;
  include ('../../controlador/productos.php');
?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="all">Producto</th>
                    <th class="none">Descripción producto</th>
                    <th class="none">Fecha vencimiento</th>
                    <th>Precio compra</th>
                    <th>Precio venta</th>
                    <th>Cantidad</th>
                    <?php
                    if($_SESSION['privilegio']>1)
                    {
                      echo"<th class='all'>Opciones</th>";
                    }
                    ?>
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

 <script type="text/javascript"> <!-- Javascript para las listas -->
    $(document).ready( function () {
      var lista = $('#list').DataTable( {
        pageLength: 5,
        language: {
          processing:     "Procesando...",
          lengthMenu:     "Mostrar _MENU_ registros",
          zeroRecords:    "No se encontraron resultados",
          emptyTable:     "No hay ningún dato disponible",
          info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          infoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
          infoFiltered:   "(filtrado de un total de _MAX_ registros)",
          infoPostFix:    "",
          search:         "Buscar:",
          url:            "",
          infothousands:  ",",
          loadingRecords: "Cargando...",
          paginate: {
            first:    "Primero",
            last:     "Último",
            next:     "Siguiente",
            previous: "Anterior"
          },
          aria: {
            sortAscending:  ": Activar para ordenar la columna de manera ascendente",
            sortDescending: ": Activar para ordenar la columna de manera descendente"
          }
      },
        lengthChange: false,
          buttons: [
            { 
              extend: 'print', text: 'Imprimir',
              exportOptions: {
                columns: '.print'
              },
              footer: true,
              autoPrint: true,
              customize: function ( win ) {
                $(win.document.body)
                  .css( 'font-size', '16pt' )
                  .prepend(
                    '<img src="http://localhost/SATGA/vista/complementos/portada_reporte.png" style="top:0; left:0;width:100%;height:100%;" />'
                  );

                $(win.document.body).find( 'h1' )
                  .addClass( 'col-12 text-center' )
                  .after(
                    '<div class="row sesion"></div>'
                  );

                $(win.document.body).find( '.sesion' )
                  .prepend(
                    '<div class="col-6 text-left"><p>Impreso por: <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></p</div>',
                    '<div class="col-6 text-right"><p><?php echo date('d/m/Y h:i:s a', time() - 21600); ?></p></div>'
                  );

                $(win.document.body).find( 'div' )
                  .css( 'font-size', 'inherit' );
   
                $(win.document.body).find( 'table' )
                  .css( 'font-size', 'inherit' );
   
   
                $(win.document.body).find( 'td' )
                  .css('text-align','center')
                  .css('vertical-align','middle');
                $(win.document.body).find( 'th' )
                  .css('text-align','center')
                  .css('vertical-align','middle');
              }        
            }
          ]
      } );

      lista.buttons().container()
          .appendTo( '#list_wrapper .col-md-6:eq(0)' );

    });
  </script>
  <script type="text/javascript" src="../js/main.js"></script>  <!-- Javascript principal, funciones personalizadas -->
</body>
</html>
