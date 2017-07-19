<?php
	
	class producto
	{
		public $codigo;
		public $nombre;
		public $detalle;
		public $tipo_bebida;
		public $contenido_neto;
		public $envase;
		public $fecha_vencimiento;
		public $fecha_desincorporacion;
		public $razon;
		public $precio_compra;
		public $precio_venta;
		public $cantidad;
		public $key;
		public $sql;

		function __construct($codigo,$nombre,$tipo_bebida,$contenido_neto,$envase)
		{
			$this->codigo=$codigo;
			$this->nombre=$nombre;
			$this->tipo_bebida=$tipo_bebida;
			$this->contenido_neto=$contenido_neto;
			$this->envase=$envase;
		}

		public function registrar($conectar)
		{			
			$this->sql="CALL insertar_producto('$this->codigo','$this->nombre','$this->tipo_bebida','$this->contenido_neto','$this->envase')";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			if($this->ejecutar)
			{
	      $cedula=$_SESSION['cedula'];
	      mysqli_query($conectar,"CALL entrada_historial('$cedula','Registro de','producto')");
				echo"<script>alert('Producto registrado satisfactoriamente')</script>
				<script>window.location='../vista/productos/registrar.php'</script>";
			}
			else
			{
				$this->sql="SELECT * FROM producto WHERE codigo='$this->codigo'";
				$this->ejecutar=mysqli_query($conectar,$this->sql);
				if($this->ejecutar->num_rows>=1)
				{
					echo"<script>alert('Ya hay un producto registrado con el codigo dado')</script>
					<form action='../vista/productos/registrar.php' name='datos_almacenados' method='POST'>
						<input type='hidden' value='$this->codigo' name='codigo'>
						<input type='hidden' value='$this->nombre' name='nombre'>
						<input type='hidden' value='$this->tipo_bebida' name='tipo_bebida'>
						<input type='hidden' value='$this->contenido_neto' name='contenido_neto'>
						<input type='hidden' value='$this->envase' name='envase'>
					</form>
					<script>document.datos_almacenados.submit()</script>";
				}
				else
				{
					echo"<script>alert('Problemas al registrar')</script>
					<form action='../vista/productos/registrar.php' name='datos_almacenados' method='POST'>
						<input type='hidden' value='$this->codigo' name='codigo'>
						<input type='hidden' value='$this->nombre' name='nombre'>
						<input type='hidden' value='$this->tipo_bebida' name='tipo_bebida'>
						<input type='hidden' value='$this->contenido_neto' name='contenido_neto'>
						<input type='hidden' value='$this->envase' name='envase'>
					</form>
					<script></script>";
				}
			}
			$this->ejecutar->close();
		}

		public function listar($conectar)
		{
			$this->sql="SELECT * FROM producto";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			if($this->ejecutar->num_rows>0)
			{
				while($row = mysqli_fetch_assoc($this->ejecutar))
				{
					$this->codigo=$row['codigo'];
					$this->nombre=$row['nombre'];
					$this->tipo_bebida=$row['tipo_bebida'];
					$this->contenido_neto=$row['contenido_neto'];
					$this->envase=$row['envase'];
					$this->estado=$row['estado'];
					switch ($this->estado)
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
											<td>$this->codigo</td>
											<td>$this->nombre</td>
											<td>$this->tipo_bebida</td>
											<td>$this->contenido_neto</td>
											<td>$this->envase</td>
											<td>$this->estado</td>
							";

					if ($_SESSION['privilegio']=='2')
					{
			      echo "
			         			<form action='../../controlador/productos.php' name='opciones' method='POST'>
							          <td>
							         	<input type='hidden' name='key' value='".$this->codigo."'>
							         	<div class='dropdown'>
								         	<button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								          Opciones
								         	</button>
									        <div class='dropdown-menu' aria-labelledby='opciones'>
									         	<button class='confirmacion dropdown-item' name='modificar' type='submit'>
									         		<i class='fa fa-edit fa-fw'></i>Modificar
									         	</button>
								           	<button class='confirmacion dropdown-item' name='".strtolower($accion)."' type='submit'>".
								           		$icono." ".$accion
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
				$this->sql="SELECT * FROM producto WHERE codigo='$this->key'";
				$this->ejecutar=mysqli_query($conectar,$this->sql);
				if ($row=mysqli_fetch_assoc($this->ejecutar))//Carga un array con los datos del producto a partir del codigo
				{
					echo"
						<form action='../vista/productos/modificar.php' name='datos_almacenados' method='POST'>
							<input type='hidden' value='".$row['codigo']."' name='codigo'>
							<input type='hidden' value='".$row['nombre']."' name='nombre'>
							<input type='hidden' value='".$row['tipo_bebida']."' name='tipo_bebida'>
							<input type='hidden' value='".$row['contenido_neto']."' name='contenido_neto'>
							<input type='hidden' value='".$row['envase']."' name='envase'>
							<input type='hidden' value='".$this->key."' name='key'>
							<input type='hidden' value='TRUE' name='modificar'>
						</form>
						<script>document.datos_almacenados.submit()</script>";
					//Se envían los datos del array hacia el formulario de modficación a través de un formulario oculto.
				}
			}

			if (isset($_POST['registrar_cambios']))
			{
				$this->sql="CALL modificar_producto('$this->codigo','$this->nombre','$this->tipo_bebida','$this->contenido_neto','$this->envase','$this->key')";
				$this->ejecutar=mysqli_query($conectar,$this->sql);
				if($this->ejecutar)
				{
		      $cedula=$_SESSION['cedula'];
		      mysqli_query($conectar,"CALL entrada_historial('$cedula','Modificación de','producto')");
					echo"<script>alert('Producto modificado satisfactoriamente')</script>
					<script>window.location='../vista/productos/listar.php'</script>";
				}
				else
				{
					$this->sql="SELECT * FROM producto WHERE codigo='$this->codigo'";
					$this->ejecutar=mysqli_query($conectar,$this->sql);
					if($this->ejecutar->num_rows>=1)
					{
						echo"<script>alert('Ya hay un producto registrado con el codigo dado o no ha cambiado ningún dato en el formulario')</script>";
					}
					else
					{
						echo"<script>alert('Problemas al actualizar')</script>";
					}
					echo"<form action='../vista/productos/modificar.php' name='datos_almacenados' method='POST'>
							<input type='hidden' value='".$this->codigo."' name='codigo'>
							<input type='hidden' value='".$this->nombre."' name='nombre'>
							<input type='hidden' value='".$this->tipo_bebida."' name='tipo_bebida'>
							<input type='hidden' value='".$this->contenido_neto."' name='contenido_neto'>
							<input type='hidden' value='".$this->envase."' name='envase'>
							<input type='hidden' value='".$this->key."' name='key'>
							<input type='hidden' value='TRUE' name='modificar'>
						</form>
						<script>document.datos_almacenados.submit()</script>";
				}
				$this->ejecutar->close();
			}
		}
		
		public function activar_desactivar ($key,$conectar)
		{
			$valor=isset($_POST['activar'])?'A':'I';
      $accion=($valor=='A')?'Activar':'Desactivar';
      $cedula=$_SESSION['cedula'];
      mysqli_query($conectar,"CALL entrada_historial('$cedula','$accion','producto')");
			$this->sql="UPDATE producto SET estado='$valor' WHERE codigo='$key'";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			echo $this->ejecutar?"<script>alert('Producto actualizado');window.location.href='../vista/productos/listar.php';</script>":"<script>alert('Fallo al actualizar');window.location.href='../vista/productos/listar.php'</script>";

		}

		public function listar_existencias($conectar)
		{
			$this->sql="SELECT * FROM producto,existencias WHERE producto.codigo=codigo_producto AND producto.estado LIKE 'A' AND existencias.cantidad>0 ORDER BY producto.codigo ASC, existencias.fecha_vencimiento ASC";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			if($this->ejecutar->num_rows>0)
			{
				while($row = mysqli_fetch_assoc($this->ejecutar))
				{
					$this->codigo=$row['codigo_producto'];
					$this->fecha_vencimiento=date('d/m/Y',strtotime($row['fecha_vencimiento']));
					$this->detalle=$row['tipo_bebida']." ".$row['nombre']." ".$row['contenido_neto']." ".$row['envase'];
					$this->precio_compra=$row['precio_compra'];
					$this->precio_venta=$row['precio_venta'];
					$this->cantidad=$row['cantidad'];			

					echo "
										<tr>
											<td>$this->codigo</td>
											<td>$this->detalle</td>
											<td>$this->fecha_vencimiento</td>
											<td>$this->precio_compra</td>
											<td>$this->precio_venta</td>
											<td>$this->cantidad</td>
								";

					if ($_SESSION['privilegio']=='2')
					{
			      echo "
			         			<form action='../../vista/productos/desincorporar.php' name='opciones' method='POST'>
							          <td>
							         	<input type='hidden' name='key1' value='".$this->codigo."'>
							         	<input type='hidden' name='key2' value='".$this->fecha_vencimiento."'>
							         	<input type='hidden' name='cantidad_max' value='".$this->cantidad."'>
							         	<div class='dropdown'>
								         	<button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								          Opciones
								         	</button>
									        <div class='dropdown-menu' aria-labelledby='opciones'>
									         	<!--<button class='dropdown-item' name='modificar' type='submit'>
									         		<i class='fa fa-edit fa-fw'></i>Modificar
									         	</button>-->
								           	<button class='dropdown-item' name='desincorporar' type='submit'>
								           		<i class='fa fa-trash fa-fw'></i>Desincorporar
								           	</button>                          
								          </div>
						            </div>
						          </td>
					          </form>
						    ";
					}							

						echo"
										</tr>
								";
				}
			}
			else {
				echo "<script>alert('No hay datos disponibles para mostrar'); window.location='../inicio/'</script>";
			}				
		}

		public function desincorporar($conectar,$fecha_v,$cantidad,$razon)
		{
			$this->fecha_vencimiento=$fecha_v;
			$this->razon=mb_strtoupper($razon);
			$this->cantidad=$cantidad;
			$this->sql="CALL desincorporar('$this->codigo',STR_TO_DATE('$this->fecha_vencimiento','%d/%m/%Y'),'$this->cantidad','$this->razon',@resultado)";
			mysqli_query($conectar,$this->sql);
			echo mysqli_error($conectar);
			$this->sql="SELECT @resultado AS resultado";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			$row = mysqli_fetch_assoc($this->ejecutar);
			if($row['resultado']=='exito')
			{
				$cedula=$_SESSION['cedula'];
				mysqli_query($conectar,"CALL entrada_historial('$cedula','Desincorporación de','existencia')");
				echo"<script>
								alert('Desincorporación exitosa');
								window.location='../vista/productos/existencias.php';
				     </script>";
			}
			else
			{
				echo"
							<form name='datos_almacenados' action='../vista/productos/desincorporar.php' method='POST'>
								<input type='hidden' name='key1' value='$this->codigo'>
								<input type='hidden' name='key2' value='$this->fecha_vencimiento'>
								<input type='hidden' name='cantidad' value='$this->cantidad'>
								<input type='hidden' name='razon' value='$this->detalle'>
								<input type='hidden' name='cantidad_max' value='".$_POST['cantidad_max']."'
							</form>
							<script>
								alert('Está intentando desincorporar más productos que los existentes');
								document.datos_almacenados.submit();
							</script>
						";
			}
		}

		public function desincorporados ($conectar)
		{
			$this->sql="SELECT * FROM producto AS a,existencias AS b INNER JOIN desincorporaciones AS c ON (b.codigo_producto=c.codigo_producto AND b.fecha_vencimiento=c.fecha_vencimiento) WHERE a.codigo=b.codigo_producto AND a.estado LIKE 'A' ORDER BY a.codigo ASC, b.fecha_vencimiento ASC";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			if($this->ejecutar->num_rows>0)
			{
				while($row = mysqli_fetch_assoc($this->ejecutar))
				{
					$this->codigo=$row['codigo'];
					$this->fecha_desincorporacion=date('d/m/Y',strtotime($row['fecha']));
					$this->razon=$row['razon'];
					$this->fecha_vencimiento=date('d/m/Y',strtotime($row['fecha_vencimiento']));
					$this->detalle=$row['tipo_bebida']." ".$row['nombre']." ".$row['contenido_neto']." ".$row['envase'];
					$this->precio_compra=$row['precio_compra'];
					$this->precio_venta=$row['precio_venta'];
					$this->cantidad=$row['cantidad'];			

					echo "
										<tr>
											<td>$this->codigo</td>
											<td>$this->detalle</td>
											<td>$this->razon</td>
											<td>$this->fecha_desincorporacion</td>
											<td>$this->fecha_vencimiento</td>
											<td>$this->precio_compra</td>
											<td>$this->precio_venta</td>
											<td>$this->cantidad</td>
								";

					if ($_SESSION['privilegio']=='2')
					{
			      echo "
			         			<form action='../../controlador/productos.php' name='opciones' method='POST'>
							          <td>
							         	<input type='hidden' name='id' value=".$row['id'].">
												<div class='dropdown'>
								         	<button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								          Opciones
								         	</button>
									        <div class='dropdown-menu' aria-labelledby='opciones'>
									          	<button class='dropdown-item' name='reincorporar' type='submit'>
								           		<i class='fa fa-mail-reply fa-fw'></i>Reincorporar
								           	</button>                          
								          </div>
						            </div>
						          </td>
					          </form>
						    ";
					}							

						echo"
										</tr>
								";
				}
			}
			else {
				echo "<script>alert('No hay datos disponibles para mostrar'); window.location='../inicio/'</script>";
			}					
		}

		public function reincorporar ($conectar,$id)
		{
			$this->key=$id;
			$this->sql="CALL reincorporar($this->key);";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			if($this->ejecutar)
			{
			echo $id;
				$cedula=$_SESSION['cedula'];
				mysqli_query($conectar,"CALL entrada_historial('$cedula','Reincorporación de','existencia')");
				echo"<script>
								alert('Reincorporación exitosa');
								window.location='../vista/productos/desincorporados.php';
				     </script>";
			}
			else
			{
				echo"<script>
								alert('Fallo al reincorporar');
								window.location='../vista/productos/desincorporados.php';
				     </script>";
			}
		}
	}
?>