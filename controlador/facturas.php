<?php
//Se verifica que el usuario haya iniciado sesion correctamente o se le retorna a la pantalla de login
if(!isset($_SESSION['login']))
{
  session_start();
}
if($_SESSION['login']!=True)
{
  echo "<script>window.location='../'</script>";
}

//Registro de una factura de compra
if(isset($_POST['registrar_compra']))
{
  include('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $numero=$_POST['numero'];
  $serie=$_POST['serie'];
  $rif=mb_strtoupper($_POST['ci_rif']);
  $tipo=$_POST['tipo'];
  $fecha_i=$_POST['fecha_i'];

  if($tipo=='P')  //Verificar si se trata de un crédito (Las facturas tipo "P" son créditos) y colocar la fecha en concordancia
  {
    $fecha_f=$_POST['fecha_f'];
  }
  else
  {
    $fecha_f=$fecha_i;
  }
  $subtotal=$_POST['subtotal'];
  $iva=$_POST['iva'];
  $total=$subtotal+($subtotal*($iva/100));
  $factura='compra';
  $usuario=$_SESSION['cedula'];
  $obj=new facturas($numero,$serie,$rif,$tipo,$fecha_i,$fecha_f,'',$subtotal,$iva,$total);
  $obj->registrar($conectar->conectar(),$factura,$usuario,'');
}

//Registro de una factura de venta
elseif(isset($_POST['registrar_venta']))
{
  include('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $numero=$_POST['numero'];
  $serie=mb_strtoupper($_POST['serie']);
  $ci_rif=mb_strtoupper($_POST['ci_rif']);
  $tipo=$_POST['tipo'];
  $fecha_i=$_POST['fecha_i'];

  if($tipo=='P')  //Verificar si se trata de un crédito (Las facturas tipo "P" son créditos) y colocar la fecha en concordancia.
  {
    $fecha_f=$_POST['fecha_f'];
  }
  else
  {
    $fecha_f=$_POST['fecha_i'];
  }
  $ci_vendedor=mb_strtoupper($_POST['ci_vendedor']);
  $subtotal=$_POST['subtotal'];
  $iva=$_POST['iva'];
  $total=$subtotal+($subtotal*($iva/100));
  $factura='venta';
  $usuario=$_SESSION['cedula'];
  if(isset($_POST['natural']))
  {
    $natural=$_POST['natural'];
  }
  else {
    $natural='';
  }
  $obj=new facturas($numero,$serie,$ci_rif,$tipo,$fecha_i,$fecha_f,$ci_vendedor,$subtotal,$iva,$total);
  $obj->registrar($conectar->conectar(),$factura,$usuario,$natural);
}

elseif(isset($listar_compra))
{
  include('../../modelo/conexion.php');
  $conectar=new conexion;
  include('../../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->listar_compra($conectar->conectar());
}

elseif(isset($_POST['modificar_compra']))
{
  $key1=$_POST['key1'];
  $key2=$_POST['key2'];
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->modificar_compra($key1,$key2,$conectar->conectar());
}

elseif(isset($_POST['registrar_cambios_compra']))
{
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include ('../modelo/clase_facturas.php');
  $numero=$_POST['numero'];
  $serie=mb_strtoupper($_POST['serie']);
  $rif=mb_strtoupper($_POST['ci_rif']);
  $tipo=$_POST['tipo'];
  $fecha_i=$_POST['fecha_i'];
  if($tipo=='P')  //Verificar si se trata de un crédito (Las facturas tipo "P" son créditos) y colocar la fecha en concordancia.
  {
    $fecha_f=$_POST['fecha_f'];
  }
  else
  {
    $fecha_f=$_POST['fecha_i'];
  }
  $subtotal=$_POST['subtotal'];
  $iva=$_POST['iva'];
  $total=$subtotal+($subtotal*($iva/100));
  $key1=mb_strtoupper($_POST['key1']);
  $key2=mb_strtoupper($_POST['key2']);
  $obj=new facturas($numero,$serie,$rif,$tipo,$fecha_i,$fecha_f,'',$subtotal,$iva,$total);
  $obj->modificar_compra($key1,$key2,$conectar->conectar());
}

elseif(isset($_POST['modificar_venta']))
{
  $key1=$_POST['key1'];
  $key2=$_POST['key2'];
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->modificar_venta('',$key1,$key2,$conectar->conectar());
}

elseif(isset($_POST['registrar_cambios_venta']))
{
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include ('../modelo/clase_facturas.php');
  $numero=$_POST['numero'];
  $serie=mb_strtoupper($_POST['serie']);
  $ci_rif=mb_strtoupper($_POST['ci_rif']);
  $tipo=$_POST['tipo'];
  $fecha_i=$_POST['fecha_i'];
  if($tipo=='P')  //Verificar si se trata de un crédito (Las facturas tipo "P" son créditos) y colocar la fecha en concordancia.
  {
    $fecha_f=$_POST['fecha_f'];
  }
  else
  {
    $fecha_f=$_POST['fecha_i'];
  }
  $ci_vendedor=$_POST['ci_vendedor'];
  $subtotal=$_POST['subtotal'];
  $iva=$_POST['iva'];
  $total=$subtotal+($subtotal*($iva/100));
  if(isset($_POST['natural']))
  {
    $natural=$_POST['natural'];
  }
  else
  {
    $natural='';
  }
  $key1=mb_strtoupper($_POST['key1']);
  $key2=mb_strtoupper($_POST['key2']);
  $obj=new facturas($numero,$serie,$ci_rif,$tipo,$fecha_i,$fecha_f,$ci_vendedor,$subtotal,$iva,$total);
  $obj->modificar_venta($natural,$key1,$key2,$conectar->conectar());
}

elseif(isset($listar_venta))
{
  include('../../modelo/conexion.php');
  $conectar=new conexion;
  include('../../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->listar_venta($conectar->conectar());
}

//Guarda el cocnepto correspondiente a una factura de compra y añade el correspondiente lote de productos.
elseif(isset($_POST['registrar_concepto_compra']))
{
  include('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $codigo=$_POST['codigo'];
  $fecha_vencimiento=$_POST['fecha_vencimiento'];
  $precio_compra=$_POST['precio_compra'];
  $precio_venta=$_POST['precio_venta'];
  $cantidad=$_POST['cantidad'];
  $obj=new facturas('','','','','','','','','','');
  $obj->registrar_concepto_compra($conectar->conectar(),$codigo,$fecha_vencimiento,$precio_compra,$precio_venta,$cantidad);
}

elseif(isset($mostrar_concepto_compra))
{
  include('../../modelo/conexion.php');
  $conectar=new conexion;
  include('../../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->mostrar_concepto_compra($conectar->conectar());
}

elseif(isset($_POST['eliminar_concepto_compra']))
{
  include('../modelo/conexion.php');
  $conectar= new conexion;
  include('../modelo/clase_facturas.php');
  $key=$_POST['key'];
  $obj=new facturas('','','','','','','','','','');
  $obj->eliminar_concepto_compra($conectar->conectar(),$key);
}

elseif(isset($_POST['cancelar_factura_compra']))
{
  include('../modelo/conexion.php');
  $conectar= new conexion;
  include('../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->cancelar_factura_compra($conectar->conectar());
}

elseif(isset($_POST['confirmar_factura_compra']))
{
  include('../modelo/conexion.php');
  $conectar= new conexion;
  include('../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->confirmar_factura_compra($conectar->conectar());
}

//Guarda el concepto de una factura de venta y descuenta la cantidad de productos correspondiente del lote seleccionado.
elseif(isset($_POST['registrar_concepto_venta']))
{
  include('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $codigo=$_POST['codigo'];
  $fecha_vencimiento=$_POST['fecha_vencimiento'];
  $cantidad=$_POST['cantidad'];
  $obj=new facturas('','','','','','','','','','');
  $obj->registrar_concepto_venta($conectar->conectar(),$codigo,$fecha_vencimiento,$cantidad);
}

//Muestra una lista de los lotes de productos en existencias para asociarlos a una factura de venta.
elseif(isset($seleccionar_concepto_venta))
{
  include('../../modelo/conexion.php');
  $conectar= new conexion;
  include('../../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->seleccionar_concepto_venta($conectar->conectar());

}

elseif(isset($mostrar_concepto_venta))
{
  include('../../modelo/conexion.php');
  $conectar=new conexion;
  include('../../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->mostrar_concepto_venta($conectar->conectar());
}

elseif(isset($_POST['eliminar_concepto_venta']))
{
  include('../modelo/conexion.php');
  $conectar= new conexion;
  include('../modelo/clase_facturas.php');
  $key=$_POST['key'];
  $obj=new facturas('','','','','','','','','','');
  $obj->eliminar_concepto_venta($conectar->conectar(),$key);
}

elseif(isset($_POST['cancelar_factura_venta']))
{
  include('../modelo/conexion.php');
  $conectar= new conexion;
  include('../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->cancelar_factura_venta($conectar->conectar());
}

elseif(isset($_POST['confirmar_factura_venta']))
{
  include('../modelo/conexion.php');
  $conectar= new conexion;
  include('../modelo/clase_facturas.php');
  $obj=new facturas('','','','','','','','','','');
  $obj->confirmar_factura_venta($conectar->conectar());
}

elseif((isset($_POST['activar_venta'])) || (isset($_POST['anular_venta'])))
{
  include('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $key1=$_POST['key1'];
  $key2=$_POST['key2'];
  $obj=new facturas('','','','','','','','','','');
  $obj->activar_desactivar_venta($conectar->conectar(),$key1,$key2);
}

elseif((isset($_POST['activar_compra'])) || (isset($_POST['anular_compra'])))
{
  include('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $key1=$_POST['key1'];
  $key2=$_POST['key2'];
  $obj=new facturas('','','','','','','','','','');
  $obj->activar_desactivar_compra($conectar->conectar(),$key1,$key2);
}

elseif(isset($_POST['pagar_compra']))
{
  include('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $key1=$_POST['key1'];
  $key2=$_POST['key2'];
  $obj=new facturas('','','','','','','','','','');
  $obj->pagar_compra($conectar->conectar(),$key1,$key2);
}

elseif(isset($_POST['pagar_venta']))
{
  include('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_facturas.php');
  $key1=$_POST['key1'];
  $key2=$_POST['key2'];
  $obj=new facturas('','','','','','','','','','');
  $obj->pagar_venta($conectar->conectar(),$key1,$key2);
}

//Si el usuario ha iniciado sesion correctamente, pero accedió al controlador por medio de la barra de navegación.
elseif($_SESSION['login']==True)
{
  echo "<script>window.location='../vista/inicio'</script>";
}
?>