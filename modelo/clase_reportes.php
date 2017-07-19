<?php
	class reportes
	{	
		public $cedula;
		public $nombre;
		public $telefono_p;
		public $direccion_p;
		public $rif;
		public $razon;
		public $telefono_e;
		public $direccion_e;
		public $numero;
		public $serie;
		public $fecha_i;
		public $fecha_f;
		public $monto;
		public $contenido_neto;
		public $envase;
		public $cantidad;
		public $codigo;
		public $fecha_vencimiento;
		public $compras;
		public $ventas;
		public $sql;
		public $ejecutar;
		public $sql_aux;
		public $ejecutar_aux;

		public function cuentas_por_pagar ($conectar)
		{
			$this->sql = "SELECT * FROM cuentas_por_pagar";
			$this->ejecutar = mysqli_query($conectar,$this->sql);
			while ($row = mysqli_fetch_assoc($this->ejecutar))
			{
				$this->numero=$row['numero'];
				$this->serie=$row['serie'];
				$this->fecha_i=$row['fecha_i'];
				$this->monto=$row['monto'];
				$this->fecha_f=$row['fecha_f'];
				$this->rif=$row['rif'];
				$this->telefono=$row['telefono'];
				$this->direccion=$row['direccion'];
				$this->nombre=$row['razon'];
				$tiempo_restante=$row['tiempo_restante'];
				$tiempo_restante=($tiempo_restante<=0)?"Vencida":"Vence en $tiempo_restante días";
				echo"
								<tr>
									<td>$this->serie $this->numero</td>
									<td>$this->fecha_i</td>
									<td>$this->nombre</td>
									<td>$this->monto</td>
									<td title='$tiempo_restante' data-toggle='tooltip' data-placement='bottom' data-trigger='hover'>$this->fecha_f</td>
									<td>$this->rif</td>
									<td>$this->telefono</td>
									<td>$this->direccion</td>
						";
				if ($_SESSION['privilegio']=='2')
				{
		      echo "
		         			<form action='../../controlador/facturas.php' name='opciones' method='POST'>
						          <td>
						         	<input type='hidden' name='key1' value='".$this->numero."'>
						         	<input type='hidden' name='key2' value='".$this->serie."'>
						         	<input type='hidden' name='reporte' value='compra'>
						         	<div class='dropdown'>
							         	<button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
							          Opciones
							         	</button>
								        <div class='dropdown-menu' aria-labelledby='opciones'>
								         	<button class='confirmacion dropdown-item' name='anular_compra' type='submit'>
								         		<i class='fa fa-window-close fa-fw'></i> Anular
								         	</button>
							           	<button class='confirmacion dropdown-item' name='pagar_compra' type='submit'>
														<i class='fa fa-check-circle fa-fw'></i> Pagar
							           	</button>                          
							          </div>
					            </div>
					          </td>
				          </form>
					    ";
				}
				echo "</tr>";
			}
		}

		public function cuentas_por_cobrar($conectar)
		{
			$this->sql = "SELECT * FROM cuentas_por_cobrar";
			$this->ejecutar = mysqli_query($conectar,$this->sql);
			while ($row = mysqli_fetch_assoc($this->ejecutar))
			{
				$this->numero=$row['numero'];
				$this->serie=$row['serie'];
				$this->fecha_i=$row['fecha_i'];
				$this->monto=$row['monto'];
				$this->fecha_f=$row['fecha_f'];
				switch( $row['persona_natural'])
				{
					case 'S':
						$this->rif=$row['cedula'];
						$this->nombre=$row['nombre']." ".$row['apellido'];
						$this->telefono=$row['telefono_p'];
						$this->direccion=$row['direccion_p'];
					break;
					case 'N':
						$this->rif=$row['rif'];
						$this->nombre=$row['razon'];
						$this->telefono=$row['telefono_e'];
						$this->direccion=$row['direccion_e'];
					break;
				}
				$tiempo_restante=$row['tiempo_restante'];
				$tiempo_restante=($tiempo_restante<=0)?"Vencida":"Vence en $tiempo_restante días";
				echo"
								<tr>
									<td>$this->serie $this->numero</td>
									<td>$this->fecha_i</td>
									<td>$this->nombre</td>
									<td>$this->monto</td>
									<td title='$tiempo_restante' data-toggle='tooltip' data-placement='bottom' data-trigger='hover'>$this->fecha_f</td>
									<td>$this->rif</td>
									<td>$this->telefono</td>
									<td>$this->direccion</td>
						";
				if ($_SESSION['privilegio']=='2')
				{
		      echo "
		         			<form action='../../controlador/facturas.php' name='opciones' method='POST'>
						          <td>
						         	<input type='hidden' name='key1' value='".$this->numero."'>
						         	<input type='hidden' name='key2' value='".$this->serie."'>
						         	<input type='hidden' name='reporte' value='venta'>
						         	<div class='dropdown'>
							         	<button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
							          Opciones
							         	</button>
								        <div class='dropdown-menu' aria-labelledby='opciones'>
								         	<button class='confirmacion dropdown-item' name='anular_venta' type='submit'>
								         		<i class='fa fa-window-close fa-fw'></i> Anular
								         	</button>
							           	<button class='confirmacion dropdown-item' name='pagar_venta' type='submit'>
														<i class='fa fa-check-circle fa-fw'></i> Pagar
							           	</button>                          
							          </div>
					            </div>
					          </td>
				          </form>
					    ";
				}
				echo "</tr>";
			}
		}

		public function ganancia_neta($conectar)
		{
			date_default_timezone_set("America/Caracas");
			include('../../modelo/funciones_adicionales.php');
			$fecha_final = strtotime('today');
			$fecha_inicial = strtotime('-7 days');
			$dia = generar_arreglo_fechas($fecha_inicial,$fecha_final);
			$i=0;
			while ($i < 7)
			{
				// Extraer el monto de ventas por día
				$this->sql="SELECT * FROM ventas_totales
										WHERE fecha=STR_TO_DATE('".$dia["$i"]."','%d/%m/%Y')";
				$this->ejecutar=mysqli_query($conectar,$this->sql);
				$row = mysqli_fetch_assoc($this->ejecutar);
				$this->ventas=empty($row['ventas'])?0:$row['ventas'];
				// Extraer el monto de compras por día
				$this->sql_aux="SELECT * FROM compras_totales
												WHERE fecha=STR_TO_DATE('".$dia["$i"]."','%d/%m/%Y')";
				$this->ejecutar_aux=mysqli_query($conectar,$this->sql_aux);
				$row = mysqli_fetch_assoc($this->ejecutar_aux);
				$this->compras=empty($row['compras'])?0:$row['compras'];
				echo"
							<tr>
								<td>$dia[$i]</td>
								<td>$this->ventas</td>
								<td>$this->compras</td>
							</tr>
						";
				$i++;
			}
			$this->sql="SELECT SUM(a.total) AS v_neta FROM factura_venta AS a
									WHERE (a.fecha_i BETWEEN STR_TO_DATE('".$dia["0"]."','%d/%m/%Y') AND STR_TO_DATE('".$dia["6"]."','%d/%m/%Y') AND a.estado='A')";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			$this->sql_aux="SELECT SUM(b.total) AS c_neta FROM comprobante_compra AS b
									WHERE (b.fecha_i BETWEEN STR_TO_DATE('".$dia["0"]."','%d/%m/%Y') AND STR_TO_DATE('".$dia["6"]."','%d/%m/%Y') AND b.estado='A')";
			$this->ejecutar_aux=mysqli_query($conectar,$this->sql_aux);
			global $t;
			$aux1=mysqli_fetch_assoc($this->ejecutar);
			$aux2=mysqli_fetch_assoc($this->ejecutar_aux);
			$t=$aux1['v_neta']-$aux2['c_neta'];			
		}

		public function productos_populares_compra($conectar)
		{
			$this->fecha_i=date("d/m/Y",(strtotime("-31 days")));
			$this->fecha_f=date("d/m/Y",(strtotime("today")));
			$this->sql="SELECT * FROM top_compras
									WHERE fecha_i BETWEEN STR_TO_DATE('$this->fecha_i','%d/%m/%Y') AND STR_TO_DATE('$this->fecha_f','%d/%m/%Y') LIMIT 10";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			while($row = mysqli_fetch_assoc($this->ejecutar))
			{
				$this->codigo=$row['codigo'];
				$this->nombre=$row['nombre'];
				$this->contenido_neto=$row['contenido'];
				$this->envase=$row['envase'];
				$this->cantidad=$row['cantidad'];
				echo"
							<tr>
								<td>$this->nombre $this->contenido_neto &#010; $this->envase</td>
								<td>$this->cantidad cajas</td>
							</tr>
						";
			}
		}

		public function productos_populares_venta($conectar)
		{
			$this->fecha_i=date("d/m/Y",(strtotime("-31 days")));
			$this->fecha_f=date("d/m/Y",(strtotime("today")));
			$this->sql="SELECT * FROM top_ventas
									WHERE fecha_i BETWEEN STR_TO_DATE('$this->fecha_i','%d/%m/%Y') AND STR_TO_DATE('$this->fecha_f','%d/%m/%Y') LIMIT 10";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			while($row = mysqli_fetch_assoc($this->ejecutar))
			{
				$this->codigo=$row['codigo'];
				$this->nombre=$row['nombre'];
				$this->contenido_neto=$row['contenido'];
				$this->envase=$row['envase'];
				$this->cantidad=$row['cantidad'];
				echo"
							<tr>
								<td>$this->nombre $this->contenido_neto &#010; $this->envase</td>
								<td>$this->cantidad cajas</td>
							</tr>
						";
			}
		}

		public function historial($conectar)
		{
			$this->sql="SELECT * FROM historial_usuario";
			$this->ejecutar=mysqli_query($conectar,$this->sql);
			while($row = mysqli_fetch_assoc($this->ejecutar))
			{
				$fecha=$row['fecha'];
				$hora=$row['hora'];
				$usuario=$row['usuario'];
				$accion=$row['accion'];
				$modulo=$row['modulo'];
				echo"
							<tr>
								<td>$fecha</td>
								<td>$hora</td>
								<td>$usuario</td>
								<td>$accion $modulo</td>
							</tr>
						";
			}
		}
	}
?>