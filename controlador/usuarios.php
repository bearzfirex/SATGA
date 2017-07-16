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

//Si se llegó al controlador por medio del formulario para registrar.
if (isset($_POST['registrar']))
{
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_usuarios.php');
	$cedula=mb_strtoupper($_POST['cedula']);
	$nombre=mb_strtoupper($_POST['nombre']);
	$apellido=mb_strtoupper($_POST['apellido']);
	$usuario=$_POST['usuario'];
	$contrasena=$_POST['contrasena'];
	$privilegio=mb_strtoupper($_POST['privilegio']);
	$telefono=mb_strtoupper($_POST['telefono']);
	$direccion=mb_strtoupper($_POST['direccion']);
	$obj=new usuarios($cedula,$nombre,$apellido,$usuario,$contrasena,$privilegio,$telefono,$direccion);
	$obj->registrar($conectar->conectar());
}

//Si el controlador se está empleando desde la opción "Listar".
elseif(isset($listar))
{
	include ('../../modelo/conexion.php');
	$conectar=new conexion;
	include ('../../modelo/clase_usuarios.php');
	$obj=new usuarios('','','','','','','','');
	$obj->listar($conectar->conectar());
}

//Al presionar la opción "Modificar" de un usuario en la lista.
elseif(isset($_POST['modificar']))
{

	$key=$_POST['key'];
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include('../modelo/clase_usuarios.php');
	$obj=new usuarios('','','','','','','','');
	$obj->modificar($key,$conectar->conectar());
}

//Se cambia la información del usuario y se presiona "Aceptar".
elseif (isset($_POST['registrar_cambios']))
{
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_usuarios.php');
	$cedula=mb_strtoupper($_POST['cedula']);
	$nombre=mb_strtoupper($_POST['nombre']);
	$apellido=mb_strtoupper($_POST['apellido']);
	$usuario=$_POST['usuario'];
	$contrasena=$_POST['contrasena'];
	$privilegio=mb_strtoupper($_POST['privilegio']);
	$telefono=mb_strtoupper($_POST['telefono']);
	$direccion=mb_strtoupper($_POST['direccion']);
	$key=mb_strtoupper($_POST['key']);
	$obj=new usuarios($cedula,$nombre,$apellido,$usuario,$contrasena,$privilegio,$telefono,$direccion);
	$obj->modificar($key,$conectar->conectar());
}

//Al pulsar en la opción "Activar" o "Desactivar" de la lista de usaurios.
elseif (isset($_POST['activar']) || isset($_POST['desactivar']))
{
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_usuarios.php');
	$key=mb_strtoupper($_POST['key']);
	$obj=new usuarios('','','','','','','','');
	$obj->activar_desactivar($key,$conectar->conectar());
}

//Si el usuario ha iniciado sesion correctamente, pero accedió al controlador por medio de la barra de navegación.
elseif($_SESSION['login']==True)
{
	echo "<script>window.location='../vista/inicio'</script>";
}
?>