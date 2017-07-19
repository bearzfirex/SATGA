<?php
$servidor="p:localhost";
$nombrebd="satga";
$usuario="root";
$pass="123456";
$con = mysqli_connect($servidor,$usuario,$pass,$nombrebd);

$sql="CALL notificaciones(@notificacion,@lotes_vencidos,@lotes_casi_vencidos,@producto_bajo,@factura_vencida,@factura_por_vencerse,@comprobante_vencido,@comprobante_casi_vencido)";
$ejecutar=mysqli_query($con,$sql);

$sql="SELECT @notificacion AS notificacion, @lotes_vencidos AS lotes_vencidos, @lotes_casi_vencidos AS lotes_casi_vencidos, @producto_bajo AS producto_bajo, @factura_vencida AS factura_vencida, @factura_por_vencerse AS factura_por_vencerse, @comprobante_vencido AS comprobante_vencido, @comprobante_casi_vencido AS comprobante_casi_vencido";
$ejecutar=mysqli_query($con,$sql);
$notificacion=mysqli_fetch_assoc($ejecutar);
if($notificacion['notificacion'] > 0)
{
  if($notificacion['lotes_vencidos'] > 0)
  {
    $texto=$notificacion['lotes_vencidos']>1?"lotes han":"lote ha";
    echo "<a href='../productos/existencias.php'><div class='note'><i class='fa fa-fw fa-exclamation-triangle'></i> ". $notificacion['lotes_vencidos'] ." ". $texto ." vencido</div></a>";
  }
  if($notificacion['factura_vencida'] > 0)
  {
    $texto=$notificacion['factura_vencida']>1?"facturas estan vencidas":"factura esta vencida";
    echo "<a href='../facturas/listar_venta.php'><div class='note'><i class='fa fa-fw fa-exclamation-triangle'></i> ". $notificacion['factura_vencida'] ." ". $texto ."</div></a>";
  }
  if($notificacion['comprobante_vencido'] > 0)
  {
    $texto=$notificacion['comprobante_vencido']>1?"comprobantes han vencido":"comprobante ha vencido";
    echo "<a href='../facturas/listar_compra.php'><div class='note'><i class='fa fa-fw fa-exclamation-triangle'></i> ". $notificacion['comprobante_vencido'] ." ". $texto ."</div></a>";
  }
  if($notificacion['producto_bajo'] > 0)
  {
    $texto=$notificacion['producto_bajo']>1?"productos casi se agotan":"producto casi se agota";
    echo "<a href='../productos/existencias.php'><div class='note'><i class='fa fa-fw fa-exclamation-circle'></i> ". $notificacion['producto_bajo'] ." ". $texto ."</div></a>";
  }
  if($notificacion['lotes_casi_vencidos'] > 0)
  {
    $texto=$notificacion['lotes_casi_vencidos']>1?"lotes casi han":"lote casi ha";
    echo "<a href='../productos/existencias.php'><div class='note'><i class='fa fa-fw fa-exclamation-circle'></i> ". $notificacion['lotes_casi_vencidos'] ." ". $texto ."  vencido</div></a>";
  }
  if($notificacion['factura_por_vencerse'] > 0)
  {
    $texto=$notificacion['factura_por_vencerse']>1?"facturas casi han vencido":"factura casi ha vencido";
    echo "<a href='../facturas/listar_venta.php'><div class='note'><i class='fa fa-fw fa-exclamation-circle'></i> ". $notificacion['factura_por_vencerse'] ." ". $texto ."</div></a>";
  }
  if($notificacion['comprobante_casi_vencido'] > 0)
  {
    $texto=$notificacion['comprobante_casi_vencido']>1?"comprobantes casi han vencido":"comprobante casi ha vencido";
    echo "<a href='../facturas/listar_compra.php'><div class='note'><i class='fa fa-fw fa-exclamation-circle'></i> ". $notificacion['comprobante_casi_vencido'] ." ". $texto ."</div></a>";
  }
}

?>