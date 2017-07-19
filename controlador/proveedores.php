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
  include ('../modelo/clase_proveedores.php');
  $rif=mb_strtoupper($_POST['rif']);
  $razon_social=mb_strtoupper($_POST['razon_social']);
  $telefono=mb_strtoupper($_POST['telefono']);
  $direccion=mb_strtoupper($_POST['direccion']);
  $obj=new proveedores($rif,$razon_social,$telefono,$direccion);
  $obj->registrar($conectar->conectar());
}

//Si el controlador se está empleando desde la opción "Listar".
elseif(isset($listar))
{
  include ('../../modelo/conexion.php');
  $conectar=new conexion;
  include ('../../modelo/clase_proveedores.php');
  $obj=new proveedores('','','','');
  $obj->listar($conectar->conectar());
}

//Al presionar la opción "Modificar" de un proveedor en la lista.
elseif(isset($_POST['modificar']))
{
  $key=$_POST['key'];
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_proveedores.php');
  $obj=new proveedores('','','','');
  $obj->modificar($key,$conectar->conectar());
}

//Se cambia la información del proveedor y se presiona "Aceptar".
elseif (isset($_POST['registrar_cambios']))
{
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include ('../modelo/clase_proveedores.php');
  $rif=mb_strtoupper($_POST['rif']);
  $razon_social=mb_strtoupper($_POST['razon_social']);
  $telefono=mb_strtoupper($_POST['telefono']);
  $direccion=$_POST['direccion'];
  $key=mb_strtoupper($_POST['key']);
  $obj=new proveedores($rif,$razon_social,$telefono,$direccion);
  $obj->modificar($key,$conectar->conectar());
}

//Al pulsar en la opción "Activar" o "Desactivar" de la lista de proveedores.
elseif (isset($_POST['activar']) || isset($_POST['desactivar']))
{
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include ('../modelo/clase_proveedores.php');
  $key=mb_strtoupper($_POST['key']);
  $obj=new proveedores('','','','');
  $obj->activar_desactivar($key,$conectar->conectar());
}

//Si el usuario ha iniciado sesion correctamente, pero accedió al controlador por medio de la barra de navegación.
elseif($_SESSION['login']==True)
{
  echo "<script>window.location='../vista/inicio'</script>";
}
?>