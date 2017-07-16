<?php
if(!isset($_SESSION['login']))
{
	session_start();
}

elseif($_SESSION['login']!=True)
{
	echo "<script>window.location='../'</script>";
}

if (isset($_POST['continuar_registro']))
{
	$key=$_POST['cedula'];
	$empresa=isset($_POST['empresa'])?'true':'';
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_clientes.php');
	$obj=new clientes('','','','','','','','','','');
	$obj->registrar($conectar->conectar(),$key,$empresa);
}

if (isset($_POST['registrar']))
{
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	$cedula=$_POST['cedula'];
	if (!empty($_POST['nombre']))
	{
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono_p=$_POST['telefono_p'];
		$direccion_p=$_POST['direccion_p'];
	}
	else
	{
		$nombre='';
		$apellido='';
		$telefono_p='';
		$direccion_p='';
	}
	if (!empty($_POST['rif']))
	{
		$rif=$_POST['rif'];
		$razon=$_POST['razon'];
		$telefono_e=$_POST['telefono_e'];
		$direccion_e=$_POST['direccion_e'];
	}
	else
	{
		$rif='';
		$razon='';
		$telefono_e='';
		$direccion_e='';
	}
	include ('../modelo/clase_clientes.php');
	$obj=new clientes($cedula,$nombre,$apellido,$telefono_p,$direccion_p,'',$rif,$razon,$telefono_e,$direccion_e);
	$obj->registrar($conectar->conectar(),'','');
}

elseif(isset($_POST['buscar']))
{
	$dato=$_POST['dato'];
	$empresa=empty($_POST['empresa'])?'n':'s';
	include ('../../modelo/conexion.php');
	$conectar=new conexion;
	include ('../../modelo/clase_clientes.php');
	$obj=new clientes('','','','','','','','','','');
	if ($empresa == 's')
	{
		$obj->buscar_empresa($conectar->conectar(),$dato);
	}
	elseif ($empresa == 'n')
	{
		$obj->buscar_persona($conectar->conectar(),$dato);
	}
	
}

elseif((isset($_POST['activar']))||(isset($_POST['desactivar'])))
{
	$key=$_POST['key'];
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	include ('../modelo/clase_clientes.php');
	$obj=new clientes('','','','','','','','','','');
	$obj->activar_desactivar($conectar->conectar(),$key);
}

elseif (isset($_POST['modificar']))
{
	$key_ci = $_POST['key_ci'];
	$key_rif = isset($_POST['key_rif']) ? $_POST['key_rif']:'';
	include ('../modelo/conexion.php');
	$conectar=new conexion;
	$cedula=$_POST['cedula'];
	if (!empty($_POST['nombre']))
	{
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono_p=$_POST['telefono_p'];
		$direccion_p=$_POST['direccion_p'];
	}
	else
	{
		$nombre='';
		$apellido='';
		$telefono_p='';
		$direccion_p='';
	}
	if (!empty($_POST['rif']))
	{
		$rif=$_POST['rif'];
		$razon=$_POST['razon'];
		$telefono_e=$_POST['telefono_e'];
		$direccion_e=$_POST['direccion_e'];
	}
	else
	{
		$rif='';
		$razon='';
		$telefono_e='';
		$direccion_e='';
	}
	include ('../modelo/clase_clientes.php');
	$obj=new clientes($cedula,$nombre,$apellido,$telefono_p,$direccion_p,'',$rif,$razon,$telefono_e,$direccion_e);
	$obj->modificar($key_ci,$key_rif,$conectar->conectar());
}

elseif($_SESSION['login']==True)
{
	echo "<script>window.location='../vista/inicio';</script>";
}
?>