<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Top 10 Vendidos</title>
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
  <style type="text/css">
    h3 {
      text-align: center;
    }
    .listado {
      height: 8.5in;
      width: 100%%;
      float: left;
    }
    .pagina-central {
      height;
      8.5in;
      width: 11in;
      position: absolute;
      top: 0px;
      left: 0px;
    }
    @media print {
      .pagina-central {
        -ms-transform: rotate(270deg);
        /* IE 9 */
        -webkit-transform: rotate(270deg);
        /* Chrome, Safari, Opera */
        transform: rotate(270deg);
        top: 1.5in;
        left: -1in;
      }
    }
  </style>
  <!--- favicon/icono -->
  <link rel="shortcut icon" href="../complementos/favicon.ico">
  <link rel="icon" type="image/png" sizes="32x32" href="../complementos/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../complementos/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../complementos/favicon-16x16.png">
</head>
<body>
<?php session_start(); 
if(!isset($_SESSION['login']) || $_SESSION['login']==False)
{
  echo "<script>alert('Debe iniciar sesion para entrar al sistema'); window.location='../../'</script>";
}
?>
  <!-- Main -->
  <div class="container-fluid pagina-central">
    <div class="row">
      <!-- Main -->
      <div class="col-12 main">
        <section class="listado" style="overflow: visible;">
          <div class="container-fluid">
            <div class="row my-2">
              <img src="../complementos/banner.png" style="width: 100%;">
            </div>
            <div class="row my-2">
              <div class="col-12">
                <h1 class="text-center">Top 10 Productos Más Vendidos</h1>
              </div>
            </div>
            <div class="row my-2">
              <div class="col-4 text-left">
                <p>Impreso por: <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></p>
              </div>
              <div class="col-4">                
              </div>
              <div class="col-4 text-right">
                <p><?php echo date('d/m/Y h:i:s a'); ?></p>
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
              data-graph-subtitle-text="Productos más vendidos de los últimos 30 días">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>
<?php
  $productos_populares_venta=true;
  include ('../../controlador/reportes.php');
?>
                </tbody>              
              </table>
          </div>
        </section>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="../js/jquery.js"></script> <!-- Jquery -->
  <script type="text/javascript" src="../js/tether.min.js"></script> <!-- Libreria para mantener fijos los objetos (requerido por bootstrap) -->
  <script type="text/javascript" src="../js/bootstrap.min.js"></script> <!-- Javascript de bootstrap -->
   <script type="text/javascript" src="../js/highcharts.js"></script><!--Librería para generar gráficos con JS-->
  <script type="text/javascript" src="../js/highchartTables-2.0.min.js"></script><!--Librería para convertir tablas en JS-->  
  <script type="text/javascript" src="../js/main.js"></script>  <!-- Javascript principal, funciones personalizadas -->
  <script type="text/javascript">
    $(document).ready(function() {
    $('table.highchart').highchartTable();
  });
  </script>
  <script type="text/javascript">
    setTimeout(function () { window.print(); }, 500);
    window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
  </script>
</body>
</html>