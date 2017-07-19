<?php
  class facturas
  {
    public $numero;
    public $serie;
    public $ci_rif;
    public $tipo;
    public $fecha_i;
    public $fecha_f;
    public $ci_vendedor;
    public $subtotal;
    public $iva;
    public $total;
    public $factura;
    public $sql;
    public $conectar;
    public $accion;
    public $codigo;
    public $fecha_fabricacion;
    public $fecha_vencimiento;
    public $precio_compra;
    public $precio_venta;
    public $cantidad;

    function __construct($numero,$serie,$ci_rif,$tipo,$fecha_i,$fecha_f,$ci_vendedor,$subtotal,$iva,$total)
    {
      $this->numero=$numero;
      $this->serie=$serie;
      $this->ci_rif=$ci_rif;
      $this->tipo=$tipo;
      $this->fecha_i=$fecha_i;
      $this->fecha_f=$fecha_f;
      $this->ci_vendedor=$ci_vendedor;
      $this->subtotal=$subtotal;
      $this->iva=$iva;
      $this->total=$total;
    }

    public function registrar($conectar,$factura,$usuario,$natural)
    {
      $this->usuario=$usuario;
      $this->factura=$factura;
      $this->natural=$natural;
      $tempArr=explode('/', $this->fecha_i);
      $fechaI = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));
      $tempArr=explode('/', $this->fecha_f);
      $fechaF = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));
      if(strtotime($fechaI) > strtotime($fechaF))
      {
        echo "<script>alert('La fecha de emision no puede ser mayor a la fecha de vencimiento');</script>";
        $this->ejecutar=False;
      }
      else
      {
        $this->sql="CALL insertar_factura('$this->numero','$this->serie','$this->ci_rif','$this->natural','$this->tipo',STR_TO_DATE('$this->fecha_i','%d/%m/%Y'),STR_TO_DATE('$this->fecha_f','%d/%m/%Y'),'$this->ci_vendedor','$this->subtotal','$this->iva','$this->total','$this->factura','$this->usuario')";
        $this->ejecutar=mysqli_query($conectar,$this->sql);
      }

      if(($this->ejecutar) && ($this->factura=='compra') && (mysqli_affected_rows($conectar) > 0))
      {
        echo"<script>alert('Por favor registre los lotes')</script>
        <form action='../vista/facturas/registrar_concepto.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='agregar_concepto'>
        </form>
        <script>document.datos_almacenados.submit()</script>";
      }
      elseif(($this->ejecutar) && ($this->factura=='venta') && (mysqli_affected_rows($conectar) > 0))
      {
        echo"<script>alert('Por favor seleccione los lotes')</script>
        <form action='../vista/facturas/seleccionar_concepto.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='agregar_concepto'>
        </form>
        <script>document.datos_almacenados.submit()</script>";
      }
      else
      {
        //Posibles mensajes de error - Comprobante de Compra
        if ($this->factura == 'compra')
        {
          $this->sql = "SELECT * FROM comprobante_compra WHERE serie_comprobante='$this->serie' AND numero_comprobante='$this->numero'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows>=1)?"<script>alert('Ya existe una factura con la combinación Serie/Número dada');</script>":"";
          $this->sql = "SELECT * FROM proveedor WHERE rif='$this->ci_rif'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows<1)?"<script>alert('No existe el proveedor, por favor verifique la información que introdujo');</script>":"";
        }
        //Posibles mensajes de error - Factura de Venta
        elseif ($this->factura == 'venta')
        {
          $this->sql = "SELECT * FROM factura_venta WHERE serie_factura='$this->serie' AND numero_factura='$this->numero'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows>=1)?"<script>alert('Ya existe una factura con la combinación Serie/Número dada');</script>":"";
          $this->sql = ($this->natural == 'N')?"SELECT * FROM clientes WHERE rif='$this->ci_rif'":"SELECT * FROM clientes WHERE cedula='$this->ci_rif'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows<1)?"<script>alert('No existe el cliente, por favor verifique la información que introdujo');</script>":"";
          $this->sql = "SELECT * FROM persona INNER JOIN datos_laborales USING(cedula) WHERE cedula='$this->ci_vendedor'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows<1)?"<script>alert('No existe el vendedor, por favor verifique la información que introdujo');</script>":"";
        }
        echo"
              <form action='../vista/facturas/registrar.php' name='datos_almacenados' method='POST'>
                <input type='hidden' value='$this->numero' name='numero'>
                <input type='hidden' value='$this->serie' name='serie'>
                <input type='hidden' value='$this->ci_rif' name='ci_rif'>
                <input type='hidden' value='$this->tipo' name='tipo'>
                <input type='hidden' value='$this->fecha_i' name='fecha_i'>
                <input type='hidden' value='$this->fecha_f' name='fecha_f'>
                <input type='hidden' value='$this->ci_vendedor' name='ci_vendedor'>
                <input type='hidden' value='$this->subtotal' name='subtotal'>
                <input type='hidden' value='$this->iva' name='iva'>
                <input type='hidden' value='$this->factura' name='factura'>
              </form>
              <script>document.datos_almacenados.submit()</script>
            ";
      }
    }

    public function listar_compra($conectar)
    {
      $this->sql="SELECT * FROM comprobante_compra WHERE estado NOT LIKE 'T'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar->num_rows>0)
      {
        $i=1;
        while($row = mysqli_fetch_assoc($this->ejecutar))
        {
          $this->numero_comprobante=$row['numero_comprobante'];
          $this->serie_comprobante=$row['serie_comprobante'];
          $this->rif_proveedor=$row['rif_proveedor'];
          $this->tipo=$row['tipo'];
          $this->fecha_i=date('d/m/Y',strtotime($row['fecha_i']));
          $this->fecha_f=date('d/m/Y',strtotime($row['fecha_f']));
          $this->sub_total=$row['sub_total'];
          $this->iva=$row['iva'];
          $this->total=$row['total'];
          $this->estado=$row['estado'];
          switch ($this->estado) {
            case 'A' :
              $this->estado='Activo';
              $accion='Anular';
              $icono="<i class='fa fa-eye-slash fa-fw'></i>";
              break;
            
            case 'I' :
              $this->estado='Anulado';
              $accion='Activar';
              $icono="<i class='fa fa-eye fa-fw'></i>";
              break;

            case 'N' :
              $this->estado='Anulado';
              $accion='Activar';
              $icono="<i class='fa fa-eye fa-fw'></i>";
              break;

            case 'P' :
              $this->estado='Pendiente';
              $accion='Anular';
              $icono="<i class='fa fa-eye-slash fa-fw'></i>";
          }

          switch ($this->tipo) {
            case 'P' :
              $this->tipo='Credito';
              break;

            case 'C' :
              $this->tipo='Contado';
              $this->fecha_f='NO APLICA';
              break;
          }

          echo "
                    <tr>
                      <td>$this->numero_comprobante</td>
                      <td>$this->serie_comprobante</td>
                      <td>$this->rif_proveedor</td>
                      <td>$this->tipo</td>
                      <td>$this->fecha_i</td>
                      <td>$this->fecha_f</td>
                      <td>$this->sub_total</td>
                      <td>$this->iva</td>
                      <td>$this->total</td>
                      <td>$this->estado</td>
              ";
                echo "
                        <form action='../../controlador/facturas.php' name='opciones' method='POST'>
                          <td>
                            <input type='hidden' name='key1' value='".$this->numero_comprobante."'>
                            <input type='hidden' name='key2' value='".$this->serie_comprobante."'>
                            <div class='dropdown'>
                              <button class='btn btn-secondary dropdown-toggle' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              Opciones
                              </button>
                              <div class='dropdown-menu' aria-labelledby='opciones'>
                                <button type='button' class='dropdown-item' name='detalles' data-toggle='modal' data-target='#detalles".$i."'>
                                  <i class='fa fa-th-list fa-fw'></i> Detalles
                                </button>";
                                if ($_SESSION['privilegio']>='2')
                                {
                                echo "<button class='confirmacion dropdown-item' name='modificar_compra' type='submit'>
                                  <i class='fa fa-edit fa-fw'></i> Modificar
                                </button>
                                <button class='dropdown-item confirmacion' name='".strtolower($accion)."_compra' type='submit'>".
                                  $icono." ".$accion
                                ."</button>"; 
                                }                         
                              echo "</div>
                            </div>
                          </td>                        
                        </form>
                        
                        <div class='modal fade' id='detalles".$i."' tabindex='-1' role='dialog' aria-labelledby='detallesFactura' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>
                                  Detalles de Comprobante: <br>
                                  Numero: ".$this->numero_comprobante." Serie: ".$this->serie_comprobante."
                                </h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                              <div class='modal-body'>";
                              $this->sql="SELECT * FROM concepto_compra WHERE numero_comprobante='$this->numero_comprobante' AND serie_comprobante='$this->serie_comprobante'";
                              $this->ejecutar2=mysqli_query($conectar,$this->sql);
                              $j=1;
                              while($concepto=mysqli_fetch_assoc($this->ejecutar2))
                              {
                                echo"
                                <h6><b>Concepto ".$j."</b></h6>
                                <ul class='lista-modal'>
                                  <li>
                                    Codigo de Producto: ".$concepto['codigo_producto']."
                                  </li>
                                  <li>
                                    Fecha de Vencimiento: ".$concepto['fecha_vencimiento']."
                                  </li>
                                  <li>
                                    Cantidad: ".$concepto['cantidad']."
                                  </li>
                                </ul>
                                <hr>";
                                $j++;
                              }
                              echo"</div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                ";
              echo "</tr>";
              $i++;
        }
      }
      else {
        echo "<script>alert('No hay datos disponibles para mostrar'); window.location='../inicio/'</script>";
      }
    }

    public function modificar_compra($key1,$key2,$conectar)
    {
      $this->key1=$key1;
      $this->key2=$key2;
      //Si se presionó la opción "Modificar" en la lista.
      if(isset($_POST['modificar_compra']))
      {
        $this->sql="SELECT * FROM comprobante_compra WHERE numero_comprobante='$this->key1' AND serie_comprobante='$this->key2'";
        $this->ejecutar=mysqli_query($conectar,$this->sql);
        if ($row=mysqli_fetch_assoc($this->ejecutar))//Carga un array con los datos del comprobante compra a partir de la serie y el numero del comprobante
        {
          echo"<form action='../vista/facturas/modificar_compra.php' name='datos_almacenados' method='POST'>
              <input type='hidden' value=".$row['numero_comprobante']." name='numero'>
              <input type='hidden' value=".$row['serie_comprobante']." name='serie'>
              <input type='hidden' value=".$row['tipo']." name='tipo'>
              <input type='hidden' value=".date('d/m/Y',strtotime($row['fecha_i']))." name='fecha_i'>
              <input type='hidden' value=".date('d/m/Y',strtotime($row['fecha_f']))." name='fecha_f'>
              <input type='hidden' value=".$row['sub_total']." name='subtotal'>
              <input type='hidden' value=".$row['iva']." name='iva'>
              <input type='hidden' value=".$row['total']." name='total'>
              <input type='hidden' value=".$row['rif_proveedor']." name='ci_rif'>
              <input type='hidden' value=".$this->key1." name='key1'>
              <input type='hidden' value=".$this->key2." name='key2'>
            </form>
            <script>document.datos_almacenados.submit()</script>";
          //Se envían los datos del array hacia el formulario de modficación a través de un formulario oculto.
        }
      }

      if (isset($_POST['registrar_cambios_compra']))
      {
        $tempArr=explode('/', $this->fecha_i);
        $fechaI = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));
        $tempArr=explode('/', $this->fecha_f);
        $fechaF = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));
        if(strtotime($fechaI) > strtotime($fechaF))
        {
          echo "<script>alert('La fecha de emision no puede ser mayor a la fecha de vencimiento');</script>";
          $this->ejecutar=False;
        }
        else
        {
          $this->sql="UPDATE comprobante_compra SET numero_comprobante='$this->numero', serie_comprobante='$this->serie', tipo='$this->tipo', fecha_i=STR_TO_DATE('$this->fecha_i','%d/%m/%Y'), fecha_f=STR_TO_DATE('$this->fecha_f','%d/%m/%Y'), sub_total='$this->subtotal', iva='$this->iva', total='$this->total', rif_proveedor='$this->ci_rif' WHERE numero_comprobante='$this->key1' AND serie_comprobante='$this->key2'";
          $this->ejecutar=mysqli_query($conectar,$this->sql);
          echo mysqli_error($conectar);
        }
        if($this->ejecutar)
        {
          $conectar=$_SESSION['cedula'];
          mysqli_query($conectar,"CALL entrada_historial('$cedula','Modificación de','factura')");
          echo"<script>alert('Comprobante de compra modificado satisfactoriamente')</script>
          <script>window.location='../vista/facturas/listar_compra.php'</script>";
        }
        else
        {
          $this->sql = "SELECT * FROM comprobante_compra WHERE serie_comprobante='$this->serie' AND numero_comprobante='$this->numero'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows>=1)?"<script>alert('Ya existe un comprobante con la combinación Serie/Número dada o no ha cambiado ningún dato en el formulario');</script>":"";
          $this->sql = "SELECT * FROM proveedor WHERE rif='$this->ci_rif'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows<1)?"<script>alert('No existe el proveedor, por favor verifique la información que introdujo');</script>":"";

          echo"<form action='../vista/facturas/modificar_compra.php' name='datos_almacenados' method='POST'>
              <input type='hidden' value=".$this->numero." name='numero'>
              <input type='hidden' value=".$this->serie." name='serie'>
              <input type='hidden' value=".$this->tipo." name='tipo'>
              <input type='hidden' value=".$this->fecha_i." name='fecha_i'>
              <input type='hidden' value=".$this->fecha_f." name='fecha_f'>
              <input type='hidden' value=".$this->subtotal." name='subtotal'>
              <input type='hidden' value=".$this->iva." name='iva'>
              <input type='hidden' value=".$this->total." name='total'>
              <input type='hidden' value=".$this->ci_rif." name='ci_rif'>
              <input type='hidden' value=".$this->key1." name='key1'>
              <input type='hidden' value=".$this->key2." name='key2'>
            </form>
            <script>document.datos_almacenados.submit()</script>";
        }
        $this->ejecutar->close();
      }
    }

    public function listar_venta($conectar)
    {
      $this->sql="SELECT * FROM factura_venta WHERE estado NOT LIKE 'T'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar->num_rows>0)
      {
        $i=1;
        while($row = mysqli_fetch_assoc($this->ejecutar))
        {
          $this->numero_factura=$row['numero_factura'];
          $this->serie_factura=$row['serie_factura'];
          $this->ci_cliente=$row['ci_cliente'];
          $this->tipo=$row['tipo'];
          $this->fecha_i=date('d/m/Y',strtotime($row['fecha_i']));
          $this->fecha_f=date('d/m/Y',strtotime($row['fecha_f']));
          $this->cedula_vendedor=$row['cedula_vendedor'];
          $this->sub_total=$row['sub_total'];
          $this->iva=$row['iva'];
          $this->total=$row['total'];
          $this->natural=$row['persona_natural'];
          $this->estado=$row['estado'];
          switch ($this->estado) {
            case 'A' :
              $this->estado='Activo';
              $accion='Anular';
              $icono="<i class='fa fa-eye-slash fa-fw'></i>";
              break;
            
            case 'I' :
              $this->estado='Anulado';
              $accion='Activar';
              $icono="<i class='fa fa-eye fa-fw'></i>";
              break;

            case 'N' :
              $this->estado='Anulado';
              $accion='Activar';
              $icono="<i class='fa fa-eye fa-fw'></i>";
              break;

            case 'P' :
              $this->estado='Pendiente';
              $accion='Anular';
              $icono="<i class='fa fa-eye-slash fa-fw'></i>";
          }

          switch ($this->tipo) {
            case 'P' :
              $this->tipo='Credito';
              break;

            case 'C' :
              $this->tipo='Contado';
              $this->fecha_f='NO APLICA';
              break;
          }

          if($this->natural=='N')
          {
            $this->sql="SELECT rif FROM empresa_firma WHERE ci_representante='$this->ci_cliente'";
            $this->ejecutar2=mysqli_query($conectar,$this->sql);
            $rif = mysqli_fetch_assoc($this->ejecutar2);
            $this->ci_cliente=$rif['rif'];
          }

          echo "
                    <tr>
                      <td>$this->numero_factura</td>
                      <td>$this->serie_factura</td>
                      <td>$this->ci_cliente</td>
                      <td>$this->tipo</td>
                      <td>$this->fecha_i</td>
                      <td>$this->fecha_f</td>
                      <td>$this->cedula_vendedor</td>
                      <td>$this->sub_total</td>
                      <td>$this->iva</td>
                      <td>$this->total</td>
                      <td>$this->estado</td>
              ";
                echo "
                        <form action='../../controlador/facturas.php' name='opciones' method='POST'>
                          <td>
                            <input type='hidden' name='key1' value='".$this->numero_factura."'>
                            <input type='hidden' name='key2' value='".$this->serie_factura."'>
                            <input type='hidden' name='factura' value='venta'>
                            <div class='dropdown'>
                              <button class='btn btn-secondary dropdown-toggle' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              Opciones
                              </button>
                              <div class='dropdown-menu' aria-labelledby='opciones'>
                                <button type='button' class='dropdown-item' name='detalles' data-toggle='modal' data-target='#detalles".$i."'>
                                  <i class='fa fa-th-list fa-fw'></i> Detalles
                                </button>";
                                if ($_SESSION['privilegio']>='2')
                                {
                                echo "<button class='confirmacion dropdown-item' name='modificar_venta' type='submit'>
                                  <i class='fa fa-edit fa-fw'></i> Modificar
                                </button>
                                <button class='dropdown-item confirmacion' name='".strtolower($accion)."_venta' type='submit'>".
                                  $icono." ".$accion
                                ."</button>";
                                }                 
                              echo "</div>
                            </div>
                          </td>
                        </form>

                        <div class='modal fade' id='detalles".$i."' tabindex='-1' role='dialog' aria-labelledby='detallesFactura' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>
                                  Detalles de Factura: <br>
                                  Numero: ".$this->numero_factura." Serie: ".$this->serie_factura."
                                </h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                              <div class='modal-body'>";
                              $this->sql="SELECT * FROM concepto_venta WHERE numero_factura='$this->numero_factura' AND serie_factura='$this->serie_factura'";
                              $this->ejecutar2=mysqli_query($conectar,$this->sql);
                              $j=1;
                              while($concepto=mysqli_fetch_assoc($this->ejecutar2))
                              {
                                echo"
                                <h6><b>Concepto ".$j."</b></h6>
                                <ul class='lista-modal'>
                                  <li>
                                    Codigo de Producto: ".$concepto['codigo_producto']."
                                  </li>
                                  <li>
                                    Fecha de Vencimiento: ".$concepto['fecha_vencimiento']."
                                  </li>
                                  <li>
                                    Cantidad: ".$concepto['cantidad']."
                                  </li>
                                </ul>
                                <hr>";
                                $j++;
                              }
                              echo"</div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                ";
              echo "</tr>";
              $i++;
        }
      }
      else {
        echo "<script>alert('No hay datos disponibles para mostrar'); window.location='../inicio/'</script>";
      }
    }

    public function modificar_venta($natural,$key1,$key2,$conectar)
    {
      $this->natural=$natural;
      $this->key1=$key1;
      $this->key2=$key2;
      //Si se presionó la opción "Modificar" en la lista.
      if(isset($_POST['modificar_venta']))
      {
        $this->sql="SELECT * FROM factura_venta WHERE numero_factura='$this->key1' AND serie_factura='$this->key2'";
        $this->ejecutar=mysqli_query($conectar,$this->sql);
        if ($row=mysqli_fetch_assoc($this->ejecutar))//Carga un array con los datos del comprobante compra a partir de la serie y el numero del comprobante
        {
          echo"<form action='../vista/facturas/modificar_venta.php' name='datos_almacenados' method='POST'>
              <input type='hidden' value=".$row['numero_factura']." name='numero'>
              <input type='hidden' value=".$row['serie_factura']." name='serie'>
              <input type='hidden' value=".$row['tipo']." name='tipo'>
              <input type='hidden' value=".$row['cedula_vendedor']." name='ci_vendedor'>
              <input type='hidden' value=".date('d/m/Y',strtotime($row['fecha_i']))." name='fecha_i'>
              <input type='hidden' value=".date('d/m/Y',strtotime($row['fecha_f']))." name='fecha_f'>
              <input type='hidden' value=".$row['sub_total']." name='subtotal'>
              <input type='hidden' value=".$row['iva']." name='iva'>
              <input type='hidden' value=".$row['total']." name='total'>              
              <input type='hidden' value=".$row['persona_natural']." name='natural'>
              <input type='hidden' value=".$this->key1." name='key1'>
              <input type='hidden' value=".$this->key2." name='key2'>";
              
              if($row['persona_natural']=='N')
              {
                $this->ci_rif=$row['ci_cliente'];
                $this->sql="SELECT rif FROM empresa_firma WHERE ci_representante='$this->ci_rif'";
                $this->ejecutar=mysqli_query($conectar,$this->sql);
                $row=mysqli_fetch_assoc($this->ejecutar);
                echo"<input type='hidden' value=".$row['rif']." name='ci_rif'>";
              }
              else
              {
                echo "<input type='hidden' value=".$row['ci_cliente']." name='ci_rif'>";
              }

            echo"</form>
            <script>document.datos_almacenados.submit()</script>";
          //Se envían los datos del array hacia el formulario de modficación a través de un formulario oculto.
        }
      }

      if (isset($_POST['registrar_cambios_venta']))
      {
        $tempArr=explode('/', $this->fecha_i);
        $fechaI = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));
        $tempArr=explode('/', $this->fecha_f);
        $fechaF = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));
        if(strtotime($fechaI) > strtotime($fechaF))
        {
          echo "<script>alert('La fecha de emision no puede ser mayor a la fecha de vencimiento');</script>";
          $this->ejecutar=False;
        }
        else
        {
          $this->sql="CALL modificar_factura_venta('$this->numero','$this->serie','$this->ci_rif','$this->tipo',STR_TO_DATE('$this->fecha_i','%d/%m/%Y'),STR_TO_DATE('$this->fecha_f','%d/%m/%Y'),'$this->ci_vendedor','$this->subtotal','$this->iva','$this->total','$this->natural','$this->key1','$this->key2')";
          $this->ejecutar=mysqli_query($conectar,$this->sql);
          echo mysqli_error($conectar);
        }
        if($this->ejecutar)
        {
          $cedula=$_SESSION['cedula'];
          mysqli_query($conectar,"CALL entrada_historial('$cedula','Modificación de','factura')");
          echo"<script>alert('Factura de venta modificada satisfactoriamente')</script>
          <script>window.location='../vista/facturas/listar_venta.php'</script>";
        }
        else
        {
          $this->sql = "SELECT * FROM factura_venta WHERE serie_factura='$this->serie' AND numero_factura='$this->numero'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows>=1)?"<script>alert('Ya existe una factura con la combinación Serie/Número dada o no ha cambiado ningún dato en el formulario');</script>":"";
          $this->sql = ($this->natural == 'N')?"SELECT * FROM clientes WHERE rif='$this->ci_rif'":"SELECT * FROM clientes WHERE cedula='$this->ci_rif'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows<1)?"<script>alert('No existe el cliente, por favor verifique la información que introdujo');</script>":"";
          $this->sql = "SELECT * FROM persona INNER JOIN datos_laborales USING(cedula) WHERE cedula='$this->ci_vendedor'";
          $this->ejecutar= mysqli_query($conectar,$this->sql);
          echo ($this->ejecutar->num_rows<1)?"<script>alert('No existe el vendedor, por favor verifique la información que introdujo');</script>":"";

          echo"<form action='../vista/facturas/modificar_venta.php' name='datos_almacenados' method='POST'>
              <input type='hidden' value=".$this->numero." name='numero'>
              <input type='hidden' value=".$this->serie." name='serie'>
              <input type='hidden' value=".$this->tipo." name='tipo'>
              <input type='hidden' value=".$this->fecha_i." name='fecha_i'>
              <input type='hidden' value=".$this->fecha_f." name='fecha_f'>
              <input type='hidden' value=".$this->subtotal." name='subtotal'>
              <input type='hidden' value=".$this->ci_vendedor." name='ci_vendedor'>
              <input type='hidden' value=".$this->iva." name='iva'>
              <input type='hidden' value=".$this->total." name='total'>
              <input type='hidden' value=".$this->ci_rif." name='ci_rif'>
              <input type='hidden' value=".$this->natural." name='natural'>
              <input type='hidden' value=".$this->key1." name='key1'>
              <input type='hidden' value=".$this->key2." name='key2'>
            </form>
            <script>document.datos_almacenados.submit()</script>";
        }
      }
    }

    /*Funciones para facturas de compra*/
    public function registrar_concepto_compra($conectar,$codigo,$fecha_vencimiento,$precio_compra,$precio_venta,$cantidad)
    {
      $this->codigo=$codigo;
      $this->fecha_vencimiento=$fecha_vencimiento;
      $this->precio_compra=$precio_compra;
      $this->precio_venta=$precio_venta;
      $this->cantidad=$cantidad;
      $this->usuario=$_SESSION['cedula'];

      $this->sql="CALL insertar_concepto_compra($this->codigo,STR_TO_DATE('$this->fecha_vencimiento','%d/%m/%Y'),$this->precio_compra,$this->precio_venta,$this->cantidad,'$this->usuario',0)";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar){
        echo "<form action='../vista/facturas/mostrar_concepto_compra.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_compra'>
          </form>
          <script>alert('Lote registrado correctamente'); document.datos_almacenados.submit();</script>";
      }
      else{
        echo "<form action='../vista/facturas/registrar_concepto.php' name='datos_almacenados' method='POST'>
            <input type='hidden' value='$this->codigo' name='codigo'>            
            <input type='hidden' value='$this->fecha_vencimiento' name='fecha_vencimiento'>
            <input type='hidden' value='$this->precio_compra' name='precio_compra'>
            <input type='hidden' value='$this->precio_venta' name='precio_venta'>
            <input type='hidden' value='$this->cantidad' name='cantidad'>
            <input type='hidden' name='agregar_concepto'>
          </form>
          <script>alert('Problemas al registrar'); document.datos_almacenados.submit();</script>";
          echo mysqli_error($conectar);
      }
    }

    public function mostrar_concepto_compra($conectar)
    {
      $this->usuario=$_SESSION['cedula'];

      $this->sql="SELECT * FROM t_concepto_compra WHERE cedula_usuario='$this->usuario'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);

      while($row = mysqli_fetch_assoc($this->ejecutar))
      {
        $this->key=$row['id'];
        $this->codigo_producto=$row['codigo_producto'];
        $this->fecha_vencimiento=strtotime($row['fecha_vencimiento']);
        $this->precio_compra=$row['precio_compra'];
        $this->precio_venta=$row['precio_venta'];
        $this->cantidad=$row['cantidad'];

        echo "
                  <tr>
                    <td>$this->codigo_producto</td>
                    <td>".date('d/m/Y',$this->fecha_vencimiento)."</td>
                    <td>$this->precio_compra</td>
                    <td>$this->precio_venta</td>
                    <td>$this->cantidad</td>";
                    if($_SESSION['privilegio']>=1)
                    {
                    echo" <form action='../../controlador/facturas.php' name='opciones' method='POST'>
                      <td>
                        <input type='hidden' name='key' value='".$this->key."'>
                        <div class='dropdown'>
                          <button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Opciones
                          </button>
                          <div class='dropdown-menu' aria-labelledby='opciones'>
                            <button class='confirmacion dropdown-item' name='eliminar_concepto_compra' type='submit'>Eliminar</button>                        
                          </div>
                        </div>
                      </td>
                    </form>";
                    }
                  echo "</tr>";
      }
    }

    public function confirmar_factura_compra($conectar)
    {
      $this->cedula_usuario=$_SESSION['cedula'];
      $this->sql="CALL insertar_concepto_compra('','','','','','$this->cedula_usuario',1)";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar)
      {
        echo "<script>alert('Factura confirmada exitosamente'); window.location='../vista/facturas/registrar.php';</script>";
      }
      else{
        echo "<form action='../vista/facturas/mostrar_concepto_compra.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_compra'>
          </form>
          <script>alert('¡Ha ocurrido un error!'); document.datos_almacenados.submit();</script>";
      }
    }

    public function cancelar_factura_compra($conectar)
    {
      $this->cedula_usuario=$_SESSION['cedula'];
      $this->sql="DELETE FROM comprobante_compra WHERE cedula_usuario='$this->cedula_usuario' AND estado='T'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar)
      {
        echo "<script>alert('Factura cancelada exitosamente'); window.location='../vista/facturas/registrar.php';</script>";
      }
      else{
        echo "<form action='../vista/facturas/mostrar_concepto_compra.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_compra'>
          </form>
          <script>alert('¡Ha ocurrido un error!'); document.datos_almacenados.submit();</script>";
      }
    }

    public function eliminar_concepto_compra($conectar,$key)
    {
      $this->key=$key;
      $this->sql="DELETE FROM t_concepto_compra WHERE id='$this->key'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar)
      {
        echo "<form action='../vista/facturas/mostrar_concepto_compra.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_compra'>
          </form>
        <script>alert('Concepto eliminado satisfactoriamente'); document.datos_almacenados.submit();</script>";
      }
      else{
        echo "<form action='../vista/facturas/mostrar_concepto_compra.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_compra'>
          </form>
          <script>alert('¡Ha ocurrido un error!'); document.datos_almacenados.submit();</script>";
      }
    }

    /*Funcion para facturas de venta*/
    public function registrar_concepto_venta($conectar,$codigo,$fecha_vencimiento,$cantidad)
    {
      $this->codigo=$codigo;
      $this->fecha_vencimiento=$fecha_vencimiento;
      $this->cantidad=$cantidad;
      $this->usuario=$_SESSION['cedula'];

      $this->sql="CALL insertar_concepto_venta('$this->codigo','$this->fecha_vencimiento','$this->cantidad','$this->usuario',0)";
      $this->ejecutar=mysqli_query($conectar,$this->sql);

      if($this->ejecutar){
        echo "<form action='../vista/facturas/mostrar_concepto_venta.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_venta.php'>
          </form>
          <script>alert('Lote registrado correctamente'); document.datos_almacenados.submit();</script>";
      }
      else {
        echo "<form action='../vista/facturas/seleccionar_concepto.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='seleccionar_concepto_venta'>
          </form>
          <script>alert('Error al registrar el lote'); document.datos_almacenados.submit();</script>";
      }
    }

    public function seleccionar_concepto_venta($conectar)
    {
      $usuario=$_SESSION['cedula'];
      $this->sql="SELECT c.codigo_producto, c.fecha_vencimiento, a.tipo_bebida, a.nombre, a.contenido_neto, a.envase, c.precio_compra, c.precio_venta, c.cantidad 
                  FROM producto AS a,existencias AS c
                  LEFT JOIN t_concepto_venta AS b ON (c.codigo_producto = b.codigo_producto AND c.fecha_vencimiento = b.fecha_vencimiento AND b.cedula_usuario NOT LIKE '$usuario')
                  WHERE a.codigo = c.codigo_producto
                  AND a.estado LIKE 'A'
                  AND c.cantidad > 0;";
                  
      $this->ejecutar=mysqli_query($conectar,$this->sql);

      while($row = mysqli_fetch_assoc($this->ejecutar))
      {
        $this->codigo=$row['codigo_producto'];
        $this->fecha_vencimiento=$row['fecha_vencimiento'];
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
                  <form action='../../controlador/facturas.php' name='opciones' method='POST'>
                    <td>
                      <input type='hidden' name='codigo' value='".$this->codigo."'>
                      <input type='hidden' name='fecha_vencimiento' value='".$this->fecha_vencimiento."'>
                      <div class='input-group input-group-sm cantidad'>
                        <input max='$this->cantidad' class='form-control form-control-sm input-cantidad' type='number' name='cantidad' placeholder='Cantidad' max-length='6' autocomplete='off'
                        pattern='[0-9]+' required>
                        <span class='input-group-addon'><button name='registrar_concepto_venta' class='btn btn-primary btn-block' type='submit'>Seleccionar</button></span>
                      </div>  
                    </td>
                  </form>
              ";            

          echo"
                  </tr>
              ";
      }
    }

    public function mostrar_concepto_venta($conectar)
    {
      $this->usuario=$_SESSION['cedula'];

      $this->sql="SELECT * FROM t_concepto_venta WHERE cedula_usuario='$this->usuario'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);

      while($row = mysqli_fetch_assoc($this->ejecutar))
      {
        $this->key=$row['id'];
        $this->codigo_producto=$row['codigo_producto'];
        $this->fecha_vencimiento=strtotime($row['fecha_vencimiento']);
        $this->cantidad=$row['cantidad'];

        echo "
                  <tr>
                    <td>$this->codigo_producto</td>
                    <td>".date('d/m/Y',$this->fecha_vencimiento)."</td>
                    <td>$this->cantidad</td>";
                    if($_SESSION['privilegio']>=1)
                    {
                    echo" <form action='../../controlador/facturas.php' name='opciones' method='POST'>
                      <td>
                        <input type='hidden' name='key' value='".$this->key."'>
                        <div class='dropdown'>
                          <button class='btn btn-secondary dropdown-toggle' type='button' id='opciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Opciones
                          </button>
                          <div class='dropdown-menu' aria-labelledby='opciones'>
                            <button class='confirmacion dropdown-item' name='eliminar_concepto_venta' type='submit'>Eliminar</button>                        
                          </div>
                        </div>
                      </td>
                    </form>";
                    }
                  echo "</tr>";
      }
    }

    public function confirmar_factura_venta($conectar)
    {
      $this->cedula_usuario=$_SESSION['cedula'];
      $this->sql="CALL insertar_concepto_venta('','','','$this->cedula_usuario',1)";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      echo mysqli_error($conectar);
      if($this->ejecutar)
      {
        echo "<script>alert('Factura confirmada exitosamente'); window.location='../vista/facturas/registrar.php';</script>";
      }
      else{
        echo "<form action='../vista/facturas/mostrar_concepto_venta.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_compra'>
          </form>
          <script>alert('¡Ha ocurrido un error!'); document.datos_almacenados.submit();</script>";
      }
    }

    public function cancelar_factura_venta($conectar)
    {
      $this->cedula_usuario=$_SESSION['cedula'];
      $this->sql="DELETE FROM factura_venta WHERE cedula_usuario='$this->cedula_usuario' AND estado='T'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar)
      {
        echo "<script>alert('Factura cancelada exitosamente'); window.location='../vista/facturas/registrar.php';</script>";
      }
      else{
        echo "<form action='../vista/facturas/mostrar_concepto_venta.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_venta'>
          </form>
          <script>alert('¡Ha ocurrido un error!'); document.datos_almacenados.submit();</script>";
      }
    }

    public function eliminar_concepto_venta($conectar,$key)
    {
      $this->key=$key;
      $this->sql="DELETE FROM t_concepto_venta WHERE id='$this->key'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar)
      {
        echo "<form action='../vista/facturas/mostrar_concepto_venta.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_compra'>
          </form>
        <script>alert('Concepto eliminado satisfactoriamente'); document.datos_almacenados.submit();</script>";
      }
      else{
        echo "<form action='../vista/facturas/mostrar_concepto_venta.php' name='datos_almacenados' method='POST'>
          <input type='hidden' name='mostrar_concepto_compra'>
          </form>
          <script>alert('¡Ha ocurrido un error!'); document.datos_almacenados.submit();</script>";
      }
    }

    public function activar_desactivar_venta($conectar,$key1,$key2)
    {
      $this->key1=$key1;
      $this->key2=$key2;
      if(isset($_POST['reporte']))
      {
        $this->direccion="../vista/reportes/cuentas_por_cobrar.php";
      }
      else{
        $this->direccion="../vista/facturas/listar_venta.php";
      }
      $this->sql="CALL activar_desactivar_venta('$this->key1','$this->key2')";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      echo $this->ejecutar?"<script>alert('Factura actualizada');window.location.href='".$this->direccion."'</script>":"<script>alert('Fallo al actualizar');window.location.href='".$this->direccion."'</script>";
    }
    
    public function activar_desactivar_compra($conectar,$key1,$key2)
    {
      if(isset($_POST['reporte']))
      {
        $this->direccion="../vista/reportes/cuentas_por_pagar.php";
      }
      else{
        $this->direccion="../vista/facturas/listar_compra.php";
      }
      $this->key1=$key1;
      $this->key2=$key2;
      $this->sql="CALL activar_desactivar_compra('$this->key1','$this->key2')";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      echo $this->ejecutar?"<script>alert('Comprobante actualizado');window.location.href='".$this->direccion."'</script>":"<script>alert('Fallo al actualizar');window.location.href='".$this->direccion."'</script>";
    }

    public function pagar_compra($conectar,$key1,$key2)
    {
      $this->key1=$key1;
      $this->key2=$key2;
      $this->sql="UPDATE comprobante_compra SET estado='A' WHERE numero_comprobante='$this->key1' AND serie_comprobante='$this->key2' AND estado='P'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      echo $this->ejecutar?"<script>alert('Comprobante pagado');window.location.href='../vista/reportes/cuentas_por_pagar.php'</script>":"<script>alert('¡Ha ocurrido un error!');window.location.href='../vista/reportes/cuentas_por_pagar.php'</script>";
    }

    public function pagar_venta($conectar,$key1,$key2)
    {
      $this->key1=$key1;
      $this->key2=$key2;
      $this->sql="UPDATE factura_venta SET estado='A' WHERE numero_factura='$this->key1' AND serie_factura='$this->key2' AND estado='P'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      echo $this->ejecutar?"<script>alert('Factura pagada');window.location.href='../vista/reportes/cuentas_por_cobrar.php'</script>":"<script>alert('¡Ha ocurrido un error!');window.location.href='../vista/reportes/cuentas_por_cobrar.php'</script>";
    }

  }
?>