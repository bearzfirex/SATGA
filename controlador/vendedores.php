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
  include ('../modelo/clase_vendedores.php');
  $cedula=mb_strtoupper($_POST['cedula']);
  $nombre=mb_strtoupper($_POST['nombre']);
  $apellido=mb_strtoupper($_POST['apellido']);
  $telefono=mb_strtoupper($_POST['telefono']);
  $direccion=mb_strtoupper($_POST['direccion']);
  $fecha_ingreso=$_POST['fecha_ingreso'];
  $cargo=mb_strtoupper($_POST['cargo']);
  $obj=new vendedores($cedula,$nombre,$apellido,$telefono,$direccion,$fecha_ingreso,$cargo);
  $obj->registrar($conectar->conectar());
}

//Si el controlador se está empleando desde la opción "Listar".
elseif(isset($listar))
{
  if(isset($_POST['buscar']))
  {
    $buscar=$_POST['buscar'];
  }
  else {
    $buscar='';
  }
  include ('../../modelo/conexion.php');
  $conectar=new conexion;
  include ('../../modelo/clase_vendedores.php');
  $obj=new vendedores('','','','','','','','');
  $obj->listar($conectar->conectar(),$buscar);
}

//Al presionar la opción "Modificar" de un vendedor en la lista.
elseif(isset($_POST['modificar']))
{
  $key=$_POST['key'];
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include('../modelo/clase_vendedores.php');
  $obj=new vendedores('','','','','','','','');
  $obj->modificar($key,$conectar->conectar());
}

//Se cambia la información del vendedor y se presiona "Aceptar".
elseif (isset($_POST['registrar_cambios']))
{
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include ('../modelo/clase_vendedores.php');
  $cedula=mb_strtoupper($_POST['cedula']);
  $nombre=mb_strtoupper($_POST['nombre']);
  $apellido=mb_strtoupper($_POST['apellido']);
  $telefono=mb_strtoupper($_POST['telefono']);
  $direccion=mb_strtoupper($_POST['direccion']);
  $fecha_ingreso=$_POST['fecha_ingreso'];
  $cargo=mb_strtoupper($_POST['cargo']);
  $key=mb_strtoupper($_POST['key']);
  $obj=new vendedores($cedula,$nombre,$apellido,$telefono,$direccion,$fecha_ingreso,$cargo);
  $obj->modificar($key,$conectar->conectar());
}

//Al pulsar en la opción "Activar" o "Desactivar" de la lista de vendedores.
elseif (isset($_POST['activar']) || isset($_POST['desactivar']))
{
  include ('../modelo/conexion.php');
  $conectar=new conexion;
  include ('../modelo/clase_vendedores.php');
  $key=mb_strtoupper($_POST['key']);
  $obj=new vendedores('','','','','','','');
  $obj->activar_desactivar($key,$conectar->conectar());
}

//Si el usuario ha iniciado sesion correctamente, pero accedió al controlador por medio de la barra de navegación.
elseif($_SESSION['login']==True)
{
  echo "<script>window.location='../vista/inicio'</script>";
}
?>