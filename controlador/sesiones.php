<?php
session_start();
include('../modelo/clase_sesiones.php');

//Inicio de sesion.
if (isset($_POST['login']))
{
	$usuario=$_POST['usuario'];
	$contrasena=$_POST['contrasena'];
	include('../modelo/conexion.php');
	$conectar=new conexion;
	unset($_POST['login']);
	$obj=new sesiones($usuario,$contrasena);
	$obj->iniciar_sesion($conectar->conectar());
}

//Se accede a este controlador de manera erronea
elseif(!isset($_SESSION['login']) || $_SESSION['login']!=True)
{
	echo "<script>window.location='../'</script>";
}

//Cierre de sesión.
else
{
	include('../modelo/conexion.php');
	$conectar=new conexion;
	$obj=new sesiones('','');
	$obj->cerrar_sesion($conectar->conectar());
}
?>