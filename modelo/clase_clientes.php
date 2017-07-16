<?php

	class clientes
	{
		public $cedula;
		public $nombre;
		public $apellido;
		public $telefono_p;
		public $direccion_p;
		public $tipo;
		public $rif;
		public $razon;
		public $telefono_e;
		public $direccion_e;
		public $key;
		public $empresa;
		public $sql;
		public $ejecutar;

		function __construct($cedula,$nombre,$apellido,$telefono_p,$direccion_p,$tipo,$rif,$razon,$telefono_e,$direccion_e)
		{
			$this->cedula=mb_strtoupper($cedula);
			$this->nombre=mb_strtoupper($nombre);
			$this->apellido=mb_strtoupper($apellido);
			$this->telefono_p=$telefono_p;
			$this->direccion_p=mb_strtoupper($direccion_p);
			$this->tipo=$tipo;
			$this->rif=mb_strtoupper($rif);
			$this->razon=mb_strtoupper($razon);
			$this->telefono_e=$telefono_e;
			$this->direccion_e=mb_strtoupper($direccion_e);
		}

		public function registrar($conectar,$key,$empresa)
		{
			$this->key=$key;
			//Si viene a verificar la existencia del cliente
			if(isset($_POST['continuar_registro']))
			{
				$this->empresa=empty($empresa)?'n':'s';
				$input_extra=$this->empresa=='s'?"<input type='hidden' name='empresa' value='true'>":""; //Para añadir un input para la informacion de la empresa
				$this->sql="CALL verificar_persona('$this->key','$this->empresa',@result);";
				$this->ejecutar=mysqli_query($conectar,$this->sql);
				if ($this->ejecutar)
				{
					$this->sql="SELECT @result AS resultado;";
					$this->ejecutar=mysqli_query($conectar,$this->sql);
					$row = mysqli_fetch_assoc($this->ejecutar);
				}

				switch ($row['resultado'])
				{
					case "existe":
						echo"
										<form action='../vista/clientes/buscar.php' name='datos_almacenados' method='POST'>
										<input type='hidden' value='$this->key' name='cedula'>
										</form>
										<script>alert('Este cliente ya se encuentra registrado o es representante legal de una empresa registrada, búsquelo en el siguiente apartado');
												document.datos_almacenados.submit();
										</script>
								";
						break;

					case "nuevo":
						echo"
										<form action='../vista/clientes/registrar.php' name='datos_almacenados' method='POST'>
										<input type='hidden' value='nuevo' name='find'>
										<input type='hidden' value='$this->key' name='cedula'>".
											$input_extra
										."</form><script>document.datos_almacenados.submit();</script>
								";
						break;

					case "v-c":
						echo"
										<script>
											alert('El vendedor ".$this->key." se marcó como cliente satisfactoriamente');
											window.location='../vista/clientes/registrar.php';
										</script>
								";
						break;

					default:
						echo"
										<form action='../vista/clientes/registrar.php' name='datos_almacenados' method='POST'>
										<input type='hidden' value='true' name='find'>
										<input type='hidden' value='".$this->key."' name='cedula'>
										<input type='hidden' value='true' name='existente'>".
											$input_extra
										."</form><script>document.datos_almacenados.submit();</script>
								";
						break;
				}
			}
			//Si viene a registrar el cliente
			if (isset($_POST['registrar']))
			{
				//Si el formulario no envia un nombre, significa que el cliente está registrado
				if (empty($this->nombre))
				{
					//Verificaremos si se trata de un cliente comun, un vendedor o un vendedor-cliente
					$this->sql = "SELECT tipo FROM persona WHERE cedula='$this->cedula';";
					$this->ejecutar = mysqli_query($conectar,$this->sql);
					$row = mysqli_fetch_assoc($this->ejecutar);
					echo mysqli_error($conectar);
					//Si solo es un cliente y el formulario envió un rif, se le asignara una empresa;
					if (($row['tipo']=='p')&&(!empty($this->rif))){$this->tipo='pe';}
					//Si era vendedor o vendedor-cliente y hay un rif, se le asignará una empresa
					elseif ((($row['tipo']=='pv')||($row['tipo']=='v'))&&(!empty($this->rif))){$this->tipo='pev';}
				}
				//Si el formulario envia un nombre, se va a registrar un cliente nuevo
				else
				{
					//Si no hay un rif, se registrará un cliente común
					if(empty($this->rif)){$this->tipo='p';}
					//Si por el contrario hay un rif, se le asignará además la empresa
					else{$this->tipo='pe';}
				}
				if (!empty($this->tipo))
				{
					$this->sql = "CALL insertar_persona ('$this->cedula', '$this->nombre', '$this->apellido', '$this->telefono_p', '$this->direccion_p', '$this->rif', '$this->razon', '$this->telefono_e', '$this->direccion_e','','','$this->tipo')";
					$this->ejecutar=mysqli_query($conectar,$this->sql);
					if (($this->ejecutar) && (mysqli_affected_rows($conectar))>0)
					{
						$cedula=$_SESSION['cedula'];
						mysqli_query($conectar,"CALL entrada_historial('$cedula','Registro de','cliente')");
						echo"<script>
										alert('Cliente registrado exitosamente');
										window.location='../vista/clientes/registrar.php';
									</script>";
					}
					else
					{
						$input_extra=empty($this->rif?"":"<input type='hidden' name='empresa' value='true'>");
						echo"
									<form action='../vista/clientes/registrar.php' method='POST'>
										<input type='hidden' name='cedula' value='$this->cedula'>
										<input type='hidden' name='nombre' value='$this->nombre'>
										<input type='hidden' name='apellido' value='$this->apellido'>
										<input type='hidden' name='telefono_p' value='$this->telefono_p'>
										<input type='hidden' name='direccion_p' value='$this->direccion_p'>
										<input type='hidden' name='rif' value='$this->rif'>
										<input type='hidden' name='razon' value='$this->razon'>
										<input type='hidden' name='telefono_e' value='$this->telefono_e'>
										<input type='hidden' name='direccion_e' value='$this->direccion_e'>
										<input type='hidden' name='find' value='true'>
										".$input_extra."
									</form>
								";
					}
				}
			}
		}

		public function buscar_persona($conectar,$buscar)
		{
			$this->buscar=$buscar;
			$this->sql="SELECT * FROM clientes
									WHERE tipo LIKE 'p%' AND (cedula LIKE '%$buscar%'
									OR direccion_p LIKE '%$buscar%'
									OR nombre LIKE '%$buscar%')";

			$this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar->num_rows>0)
      {
  			while ($row = mysqli_fetch_assoc($this->ejecutar))
  			{
  				$this->cedula = $row['cedula'];
          $this->tipo = $row['tipo'];
          $this->nombre = $row['nombre'];
          $this->apellido = $row['apellido'];
          $this->telefono_p = $row['telefono_p'];
          $this->direccion_p = $row['direccion_p'];

          switch ($row['estado'])
          {
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
          echo "
                    <tr>
                      <td>$this->cedula</td>
                      <td>$this->nombre $this->apellido</td>
                      <td>$this->telefono_p</td>
                      <td>$this->direccion_p</td>
                      <td>$this->estado</td>";
                      if($_SESSION['privilegio']>=2)
                      {
                      echo" <form action='../../vista/clientes/modificar.php' name='opciones' method='POST'>
                        <td>
                          <input type='hidden' name='key' value='$this->cedula'>
                          <input type='hidden' name='cedula' value='$this->cedula'>
                          <input type='hidden' name='nombre' value='$this->nombre'>
                          <input type='hidden' name='apellido' value='$this->apellido'>
                          <input type='hidden' name='telefono_p' value='$this->telefono_p'>
                          <input type='hidden' name='direccion_p' value='$this->direccion_p'>
                          <input type='hidden' name='mod_p' value='true'>
                          <div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              Opciones
                            </button>
                            <div class='dropdown-menu' aria-labelledby='opciones'>
                              <button class='confirmacion dropdown-item' name='modificar_persona' type='submit'>
                              <i class='fa fa-edit fa-fw'></i> Modificar
                              </button>
                              <button formaction='../../controlador/clientes.php' class='confirmacion dropdown-item' name='".strtolower($accion)."' type='submit'>".
                                $icono." ".$accion
                              ."</button>
                            </div>
                          </div>
                        </td>
                      </form>";
                      }
          echo "</tr>";
  			}
      }
      else
      {
        echo"<script>
          alert('No se han encontrado coincidencias');
          window.location='buscar.php';
        </script>";
      }
		}

		public function buscar_empresa($conectar,$buscar)
		{
			$this->buscar=$buscar;
			$this->sql="SELECT * FROM clientes
									WHERE tipo LIKE '%e%' AND (rif LIKE '%$buscar%'
									OR direccion_e LIKE '%$buscar%'
									OR razon LIKE '%$buscar%')";

			$this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar->num_rows>0)
      {
  			while ($row = mysqli_fetch_assoc($this->ejecutar))
  			{
  				$this->rif = $row['rif'];
          $this->tipo = $row['tipo'];
          $this->razon = $row['razon'];
          $this->telefono_e = $row['telefono_e'];
          $this->direccion_e = $row['direccion_e'];
  				$this->cedula = $row['cedula'];
          $this->nombre = $row['nombre'];
          $this->apellido = $row['apellido'];
          $this->telefono_p = $row['telefono_p'];
          $this->direccion_p = $row['direccion_p'];

          switch ($row['estado'])
          {
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
          echo "
                    <tr>
                      <td>$this->rif</td>
                      <td>$this->razon</td>
                      <td>$this->telefono_e</td>
                      <td>$this->direccion_e</td>
                      <td> </td>
                      <td>$this->cedula</td>
                      <td>$this->nombre $this->apellido</td>
                      <td>$this->telefono_p</td>
                      <td>$this->direccion_p</td>
                      <td>$this->estado</td>";
                      if($_SESSION['privilegio']>=2)
                      {
                      echo" <form action='../../vista/clientes/modificar.php' name='opciones' method='POST'>
                        <td>
                          <input type='hidden' name='key' value='$this->cedula'>
                          <input type='hidden' name='rif' value='$this->rif'>
                          <input type='hidden' name='razon' value='$this->razon'>
                          <input type='hidden' name='telefono_e' value='$this->telefono_e'>
                          <input type='hidden' name='direccion_e' value='$this->direccion_e'>
                          <input type='hidden' name='mod_e' value='true'>
                          <div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              Opciones
                            </button>
                            <div class='dropdown-menu' aria-labelledby='opciones'>
                              <button class='confirmacion dropdown-item' name='modificar_empresa' type='submit'>
                              <i class='fa fa-edit fa-fw'></i> Modificar
                              </button>
                              <button formaction='../../controlador/clientes.php' class='confirmacion dropdown-item' name='".strtolower($accion)."' type='submit'>".
                                $icono." ".$accion
                              ."</button>
                            </div>
                          </div>
                        </td>
                      </form>";
                      }
          echo "</tr>";
  			}
      }
      else
      {
        echo"<script>
          alert('No se han encontrado coincidencias');
          window.location='buscar.php';
        </script>";
      }
		}

		public function modificar ($key_ci,$key_rif,$conectar)
		{
			if($key_rif == '')
			{
        $this->key=$key_ci;
        $this->mod="mod_p";
				$this->sql="UPDATE persona SET cedula='$this->cedula', nombre='$this->nombre', apellido='$this->apellido', telefono='$this->telefono_p', direccion='$this->direccion_p' WHERE cedula='$key_ci'";
			}
			else
			{
        $this->key=$key_rif;
        $this->mod="mod_e";        
				$this->sql="UPDATE empresa_firma SET rif='$this->rif', razon_social='$this->razon', direccion='$this->direccion_e', telefono='$this->telefono_e' WHERE ci_representante='$key_ci' AND rif='$key_rif'";
				
			}
			$this->ejecutar=mysqli_query($conectar,$this->sql);

			if(($this->ejecutar) && (mysqli_affected_rows($conectar))>0)
			{
        $cedula=$_SESSION['cedula'];
        mysqli_query($conectar,"CALL entrada_historial('$cedula','Modificación de','cliente')");
				echo"<script>alert('Cliente modificado satisfactoriamente');</script>
					<script>window.location='../vista/clientes/buscar.php';</script>";
			}
			else
			{
				echo"<script>alert('Ha habido un problema o no ha cambiado ningún dato en el formulario, por favor revise la información que intentó actualizar.');</script>";
				echo"
							<form action='../vista/clientes/modificar.php' name='datos_almacenados' method='POST'>
							<input type='hidden' value='".$this->cedula."' name='cedula'>
							<input type='hidden' value='".$this->nombre."' name='nombre'>
							<input type='hidden' value='".$this->apellido."' name='apellido'>
							<input type='hidden' value='".$this->telefono_p."' name='telefono_p'>
							<input type='hidden' value='".$this->direccion_p."' name='direccion_p'>
							<input type='hidden' value='".$this->rif."' name='rif'>
							<input type='hidden' value='".$this->razon."' name='razon'>
							<input type='hidden' value='".$this->telefono_e."' name='telefono_e'>
							<input type='hidden' value='".$this->direccion_e."' name='direccion_e'>
              <input type='hidden' value='".$this->key."' name='key'>
              <input type='hidden' value='true' name='".$this->mod."'>
						";
					if($key_rif == '')
					{
						echo "<input type='hidden' name='mod_p' value='true'";
					}
					else
					{
						echo"<input type='hidden' name='mod_e' value='true'";
					}
					echo"</form>
					<script>document.datos_almacenados.submit();</script>";
			}
		}

		public function activar_desactivar ($conectar,$key)
		{
			$valor=isset($_POST['activar'])?'A':'I';
      $accion=($valor=='A')?'Activar':'Desactivar';
      $cedula=$_SESSION['cedula'];
      mysqli_query($conectar,"CALL entrada_historial('$cedula','$accion','usuario')");
			$this->sql="UPDATE persona SET estado='$valor' WHERE cedula='$key'";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			echo $this->ejecutar?"<script>alert('Cliente actualizado');window.location.href='../vista/clientes/buscar.php';</script>":"<script>alert('Fallo al actualizar');window.location.href='../vista/clientes/buscar.php';</script>";

		}
	}
?>
