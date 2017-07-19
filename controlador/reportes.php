<?php
if(!isset($_SESSION['login']))
{
	session_start();
}

elseif($_SESSION['login']!=True)
{
	echo "<script>window.location='../'</script>";
}

elseif (isset($cuentas_por_pagar))
{
	include ('../../modelo/conexion.php');
	$conexion = new conexion;
	include ('../../modelo/clase_reportes.php');
	$obj = new reportes;
	$obj->cuentas_por_pagar($conexion->conectar());
}

elseif (isset($cuentas_por_cobrar))
{
	include ('../../modelo/conexion.php');
	$conexion = new conexion;
	include ('../../modelo/clase_reportes.php');
	$obj = new reportes;
	$obj->cuentas_por_cobrar($conexion->conectar());
}

elseif (isset($ganancia_neta))
{
	include ('../../modelo/conexion.php');
	$conexion = new conexion;
	include ('../../modelo/clase_reportes.php');
	$obj = new reportes;
	$obj->ganancia_neta($conexion->conectar());
}

elseif (isset($productos_populares_compra))
{
	include ('../../modelo/conexion.php');
	$conexion = new conexion;
	include ('../../modelo/clase_reportes.php');
	$obj = new reportes;
	$obj->productos_populares_compra($conexion->conectar());
}

elseif (isset($productos_populares_venta))
{
	include ('../../modelo/conexion.php');
	$conexion = new conexion;
	include ('../../modelo/clase_reportes.php');
	$obj = new reportes;
	$obj->productos_populares_venta($conexion->conectar());
}

elseif (isset($historial))
{
	include ('../../modelo/conexion.php');
	$conexion = new conexion;
	include ('../../modelo/clase_reportes.php');
	$obj = new reportes;
	$obj->historial($conexion->conectar());
}

elseif($_SESSION['login']==True)
{
	echo "<script>window.location='../vista/inicio';</script>;";
}
?>