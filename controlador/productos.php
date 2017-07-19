<?php
//Controlador de la clase productos
if(!isset($_SESSION['login']))
{
	session_start();
}
if($_SESSION['login']!=True)
{
	echo "<script>window.location='../'</script>";
}

//Se accede al controlador desde el formulario de registro
if (isset($_POST['registrar']))
{
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_productos.php');
	$codigo=$_POST['codigo'];
	$nombre=mb_strtoupper($_POST['nombre']);
	$tipo_bebida=mb_strtoupper($_POST['tipo_bebida']);
	$contenido_neto=mb_strtoupper($_POST['contenido_neto']);
	$envase=mb_strtoupper($_POST['envase']);
	$obj=new producto ($codigo,$nombre,$tipo_bebida,$contenido_neto,$envase);
	$obj->registrar($conectar->conectar());
}

//Si el controlador se invoca en la pantalla de "listar"
elseif(isset($listar))
{
	include ('../../modelo/conexion.php');
	$conectar=new conexion;
	include ('../../modelo/clase_productos.php');
	$obj=new producto('','','','','');
	$obj->listar($conectar->conectar());
}

//Se accede al controlador mediante la opcion "Modificar" de las listas
elseif(isset($_POST['modificar']))
{
	$key=$_POST['key'];
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include('../modelo/clase_productos.php');
	$obj=new producto('','','','','');
	$obj->modificar($key,$conectar->conectar());
}

//Al presionar el botón "Modificar" del formulario
elseif (isset($_POST['registrar_cambios']))
{
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_productos.php');
	$codigo=$_POST['codigo'];
	$nombre=mb_strtoupper($_POST['nombre']);
	$tipo_bebida=mb_strtoupper($_POST['tipo_bebida']);
	$contenido_neto=mb_strtoupper($_POST['contenido_neto']);
	$envase=mb_strtoupper($_POST['envase']);
	$key=$_POST['key'];
	$obj=new producto($codigo,$nombre,$tipo_bebida,$contenido_neto,$envase);
	$obj->modificar($key,$conectar->conectar());
}

//Al intentar activar o desactivar un producto
elseif (isset($_POST['activar']) || isset($_POST['desactivar']))
{
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_productos.php');
	$key=$_POST['key'];
	$obj=new producto('','','','','');
	$obj->activar_desactivar($key,$conectar->conectar());
}

//Al momento de agregar un lote de manera irregular, toma la informacion del producto para el form
elseif(isset($_POST['agregar_existencias']))
{

	$key=$_POST['key'];
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include('../modelo/clase_productos.php');
	$obj=new producto('','','','','');
	$obj->registrar_lote($key,'','','','','',$conectar->conectar());
}

//Cuando se acepta el registro del lote
elseif(isset($_POST['registrar_existencias']))
{
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_productos.php');
	$key=$_POST['codigo'];
	$fecha_fabricacion=$_POST['fecha_fabricacion'];
	$fecha_vencimiento=$_POST['fecha_vencimiento'];
	$precio_compra=$_POST['precio_compra'];
	$precio_venta=$_POST['precio_venta'];
	$cantidad=$_POST['cantidad'];
	$obj=new producto('','','','','');
	$obj->registrar_lote($key,$fecha_fabricacion,$fecha_vencimiento,$precio_compra,$precio_venta,$cantidad,$conectar->conectar());
}

//Lista de existencias
elseif(isset($listar_existencias))
{
	include ('../../modelo/conexion.php');
	$conectar=new conexion;
	include ('../../modelo/clase_productos.php');
	$obj=new producto('','','','','');
	$obj->listar_existencias($conectar->conectar());
}

//Desincorporar existencias
elseif(isset($_POST['desincorporar']))
{
	$codigo=$_POST['codigo'];
	$fecha_v=$_POST['fecha_v'];
	$razon=$_POST['razon'];
	$cantidad=$_POST['cantidad'];
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_productos.php');
	$obj=new producto("$codigo",'','','','');
	$obj->desincorporar($conectar->conectar(),"$fecha_v","$cantidad","$razon");
}

//Existencias desincorporadas
elseif(isset($desincorporados))
{
	include ('../../modelo/conexion.php');
	$conectar=new conexion;
	include ('../../modelo/clase_productos.php');
	$obj=new producto('','','','','');
	$obj->desincorporados($conectar->conectar());
}

//Reincorporar una existencia
elseif(isset($_POST['reincorporar']))
{
	$id=$_POST['id'];
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_productos.php');
	$obj=new producto('','','','','');
	$obj->reincorporar($conectar->conectar(),$id);
}

elseif($_SESSION['login']==True)
{
	echo "<script>window.location='../vista/inicio'</script>";
}
?>