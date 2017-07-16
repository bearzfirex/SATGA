'<?php
	
	class usuarios
	{
		public $cedula;
		public $nombre;
		public $apellido;
		public $usuario;
		public $contrasena;
		public $privilegio;
		public $telefono;
		public $direccion;
		public $key;
		public $sql;
		public $ejecutar;

		public function __construct($cedula,$nombre,$apellido,$usuario,$contrasena,$privilegio,$telefono,$direccion)
		{
			$this->cedula=$cedula;
			$this->nombre=$nombre;
			$this->apellido=$apellido;
			$this->usuario=$usuario;
			$this->contrasena=$contrasena;
			$this->privilegio=$privilegio;
			$this->telefono=$telefono;
			$this->direccion=$direccion;
		}

		public function registrar($conectar)
		{			
			$this->sql="CALL insertar_usuario('$this->cedula','$this->nombre','$this->apellido','$this->usuario','$this->contrasena','$this->privilegio','$this->telefono','$this->direccion')";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			if(($this->ejecutar) && (mysqli_affected_rows($conectar)>0))
			{
        $cedula=$_SESSION['cedula'];
        mysqli_query($conectar,"CALL entrada_historial('$cedula','Registro de','usuario')");
				echo"<script>alert('Usuario registrado satisfactoriamente');</script>
				<script>window.location='../vista/usuarios/registrar.php';</script>";
			}
			else
			{
				$this->sql="SELECT * FROM usuario WHERE cedula='$this->cedula' OR usuario='$this->usuario'";
				$this->ejecutar=mysqli_query($conectar,$this->sql);
				if($this->ejecutar->num_rows>=1)
				{
					echo "<script>alert('Ya hay un usuario registrado con la cédula o el alias dado');</script>";
				}
				else
				{
					echo" <script>alert('Problemas al registrar');</script>";
				}
				echo "
					<form action='../vista/usuarios/registrar.php' name='datos_almacenados' method='POST'>
						<input type='hidden' value='$this->cedula' name='cedula'>
						<input type='hidden' value='$this->nombre' name='nombre'>
						<input type='hidden' value='$this->apellido' name='apellido'>
						<input type='hidden' value='$this->usuario' name='usuario'>
						<input type='hidden' value='$this->contrasena' name='contrasena'>
						<input type='hidden' value='$this->privilegio' name='privilegio'>
						<input type='hidden' value='$this->telefono' name='telefono'>
						<input type='hidden' value='$this->direccion' name='direccion'>
					</form>
					<script>document.datos_almacenados.submit();</script>
					";
			}
		}

		public function listar($conectar)
		{
			$this->sql="SELECT * FROM usuario";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			if($this->ejecutar->num_rows>0)
			{
				while($row = mysqli_fetch_assoc($this->ejecutar))
				{
					$this->cedula=$row['cedula'];
					$this->nombre=$row['nombre'];
					$this->apellido=$row['apellido'];
					$this->usuario=$row['usuario'];
					$this->privilegio=$row['privilegio'];
					$this->telefono=$row['telefono'];
					$this->direccion=$row['direccion'];
					$this->estado=$row['estado'];
					switch ($this->estado) {
						case 'A':
							$this->estado='Activo';
							$accion='Desactivar';
							$icono="<i class='fa fa-eye-slash fa-fw'></i>";
							break;
						
						case 'I' :
							$this->estado='Inactivo';
							$accion='Activar';
							$icono="<i class='fa fa-eye fa-fw'></i>";
							break;
					}
					if ($this->privilegio=='2') {$this->privilegio='Administrador';}
					if ($this->privilegio=='1') {$this->privilegio='Usuario';}

					echo "
										<tr>
	            				<td>$this->cedula</td>
					            <td>$this->nombre</td>
					            <td>$this->apellido</td>
					            <td>$this->usuario</td>
					            <td>$this->telefono</td>
					            <td>$this->direccion</td>
					            <td>$this->privilegio</td>
						          <td>$this->estado</td>
		          ";
		          if ($_SESSION['privilegio']>='2')
		          {
			          echo "
			          				<form action='../../controlador/usuarios.php' name='opciones' method='POST'>
								          <td>
								          	<input type='hidden' name='key' value='".$this->cedula."'>
								          	<div class='dropdown'>
									          	<button class='btn btn-secondary dropdown-toggle' type='submit' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
									            Opciones
									          	</button>
										          <div class='dropdown-menu' aria-labelledby='opciones'>
										          	<button class='confirmacion dropdown-item' name='modificar' type='submit'>
										          		Modificar <i class='fa fa-edit fa-fw'></i>
										          	</button>
									            	<button class='dropdown-item confirmacion' name='".strtolower($accion)."' type='submit'>".
									             		$accion." ".$icono
									            	."</button>                          
									            </div>
							              </div>
							            </td>
						            </form>
						    ";
		          }
	            echo "</tr>";
				}
			}
			else {
				echo "<script>alert('No hay datos disponibles para mostrar'); window.location='../inicio/'</script>";
			}
		}

		public function modificar ($key,$conectar)
		{
			$this->key=$key;
			//Si se presionó la opción "Modificar" en la lista.
			if(isset($_POST['modificar']))
			{
				$this->sql="SELECT * FROM usuario WHERE cedula='$this->key'";
				$this->ejecutar=mysqli_query($conectar,$this->sql);
				if ($row=mysqli_fetch_assoc($this->ejecutar))//Carga un array con los datos del usuario a partir de la cedula
				{
					echo"<form action='../vista/usuarios/modificar.php' name='datos_almacenados' method='POST'>
							<input type='hidden' value='".$row['cedula']."' name='cedula'>
							<input type='hidden' value='".$row['nombre']."' name='nombre'>
							<input type='hidden' value='".$row['apellido']."' name='apellido'>
							<input type='hidden' value='".$row['usuario']."' name='usuario'>
							<input type='hidden' value='".$row['contrasena']."' name='contrasena'>
							<input type='hidden' value='".$row['privilegio']."' name='privilegio'>
							<input type='hidden' value='".$row['telefono']."' name='telefono'>
							<input type='hidden' value='".$row['direccion']."' name='direccion'>
							<input type='hidden' value='".$this->key."' name='key'>
						</form>
						<script>document.datos_almacenados.submit()</script>";
					//Se envían los datos del array hacia el formulario de modficación a través de un formulario oculto.
				}
			}

			if (isset($_POST['registrar_cambios']))
			{
				if (($this->privilegio != $_SESSION['privilegio']) && ($this->key == $_SESSION['cedula']))
				{
					echo"
								<script>
									alert('¡No puede modificar sus propios privilegios!');
									window.location='../vista/usuarios/listar.php'
								</script>
							";
				}
				else
				{
					$this->sql="CALL modificar_usuario('$this->cedula','$this->nombre','$this->apellido','$this->usuario','$this->contrasena','$this->privilegio','$this->telefono','$this->direccion','$this->key')";
					$this->ejecutar=mysqli_query($conectar,$this->sql);
					if($this->ejecutar)
					{
						$cedula=$_SESSION['cedula'];
        		mysqli_query($conectar,"CALL entrada_historial('$cedula','Modificación de','usuario')");
						echo"<script>alert('Usuario modificado satisfactoriamente')</script>
						<script>window.location='../vista/usuarios/listar.php'</script>";
					}
					else
					{
						$this->sql="SELECT * FROM usuario WHERE cedula='$this->cedula' OR usuario='$this->usuario'";
						$this->ejecutar=mysqli_query($conectar,$this->sql);
						if($this->ejecutar->num_rows>=1)
						{
							echo"<script>alert('Ya hay un usuario registrado con la cédula o el alias dado o no ha cambiado ningún dato en el formulario')</script>";
						}
						else
						{
							echo"<script>alert('Problemas al actualizar')</script>";
						}
						echo"<form action='../vista/usuarios/modificar.php' name='datos_almacenados' method='POST'>
								<input type='hidden' value='".$this->cedula."' name='cedula'>
								<input type='hidden' value='".$this->nombre."' name='nombre'>
								<input type='hidden' value='".$this->apellido."' name='apellido'>
								<input type='hidden' value='".$this->usuario."' name='usuario'>
								<input type='hidden' value='".$this->contrasena."' name='contrasena'>
								<input type='hidden' value='".$this->privilegio."' name='privilegio'>
								<input type='hidden' value='".$this->telefono."' name='telefono'>
								<input type='hidden' value='".$this->direccion."' name='direccion'>
								<input type='hidden' value='".$this->key."' name='key'>
								<input type='hidden' value='TRUE' name='modificar'>
							</form>
							<script>document.datos_almacenados.submit()</script>";
					}
				}
			}
		}

		public function activar_desactivar ($key,$conectar)
		{
			if ($key == $_SESSION['cedula'])
			{
				echo"
							<script>
								alert('¡No puede modificar su propio estado!');
								window.location='../vista/usuarios/listar.php'
							</script>
						";
			}
			else
			{
				$valor=isset($_POST['activar'])?'A':'I';
				$accion=($valor=='A')?'Activar':'Desactivar';
        $cedula=$_SESSION['cedula'];
        mysqli_query($conectar,"CALL entrada_historial('$cedula','$accion','usuario')");
				$this->sql="UPDATE usuario SET estado='$valor' WHERE cedula='$key'";
				$this->ejecutar=mysqli_query($conectar,$this->sql);
				echo $this->ejecutar?"<script>alert('Usuario actualizado');window.location.href='../vista/usuarios/listar.php'</script>":"<script>alert('Fallo al actualizar');window.location.href='../vista/usuarios/listar.php'</script>";
			}

		}
	}
?>