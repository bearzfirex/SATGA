<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Top 10 Comprados</title>
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
            <div class="row my-2">
              <div class="col-3">
                <form method="POST" action="pdf_productos_populares_compra.php" target="_blank">
                  <button onclick="imprimir()"  class="btn btn-secondary btn-block btn-lg">Imprimir</button>
                </form>
              </div>
              <div class="col-12">
                <h1 class="text-center">Top 10 Productos Más Comprados</h1>
              </div>
            </div>
            <!--Gráfica-->
            <div id="grafica">
            </div>
            <!--Tabla-->
              <table title="Ganancia Neta" class="highchart"
              data-graph-container="#grafica"
              data-graph-type="column"
              style="display: none"
              data-graph-subtitle-text="Productos más comprados de los últimos 30 días">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>
<?php
  $productos_populares_compra=true;
  include ('../../controlador/reportes.php');
?>
                </tbody>              
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
   <script type="text/javascript" src="../js/highcharts.js"></script><!--Librería para generar gráficos con JS-->
  <script type="text/javascript" src="../js/highchartTables-2.0.min.js"></script><!--Librería para convertir tablas en JS-->  
  <script type="text/javascript" src="../js/main.js"></script>  <!-- Javascript principal, funciones personalizadas -->
  <script type="text/javascript">
    $(document).ready(function() {
    $('table.highchart').highchartTable();

    function submitForm()
    {
      document.form1.target = "ventanaImprimir";
      window.open("pdf_productos_populares_compra.php","ventanaImprimir","width=500,height=300,toolbar=0");
      document.form1.submit();
    }
    });
  </script>
</body>
</html>