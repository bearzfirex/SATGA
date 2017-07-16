<?php
	class sesiones
	{
		public $cedula;
		public $nombre;
		public $apellido;
		public $usuario;
		public $contrasena;
		public $privilegio;
		public $estado;
		public $sql;
		public $ejecutar;

		public function __construct($usuario,$contrasena)
		{
			$this->usuario = $usuario;
			$this->contrasena = $contrasena;
		}

		public function iniciar_sesion($conectar)
		{
			$this->sql = "SELECT * FROM usuario WHERE usuario='$this->usuario' AND contrasena='$this->contrasena'";
			$this->ejecutar = mysqli_query($conectar,$this->sql);
			if($this->ejecutar->num_rows>0)
			{
				if($row = mysqli_fetch_assoc($this->ejecutar))
				{
					if($row['estado'] == 'I')
					{
						echo"<script>alert('Este usuario se encuentra desactivado temporalmente. Contacte con el administrador del sistema para obtener más información')</script>
							<script>window.location='../index.php'</script>";
					}
					else
					{
						$_SESSION['login'] = true;
						$_SESSION['usuario'] = $row['usuario'];
						$_SESSION['cedula'] = $row['cedula'];
						$_SESSION['nombre'] = $row['nombre'];
						$_SESSION['apellido'] = $row['apellido'];
						$_SESSION['privilegio'] = $row['privilegio'];
						$cedula=$_SESSION['cedula'];
						mysqli_query($conectar,"CALL entrada_historial('$cedula','Inicio de','sesión')");
						echo"<script>window.location='../vista/inicio';</script>";
					}
				}
			}
			else
			{
				echo"<script>alert('Usuario o contraseña inválidos')</script>
					<script>window.location='../index.php'</script>";
			}
		}

		public function cerrar_sesion($conectar)
		{
			$cedula=$_SESSION['cedula'];
			mysqli_query($conectar,"CALL entrada_historial('$cedula','Cierre de','sesión')");
			$_SESSION['login']=False;
			session_unset();
			session_destroy();
			echo"<script>window.location='../'</script>";
		}

	}
?>