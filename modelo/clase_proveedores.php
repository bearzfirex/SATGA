<?php
  
  class proveedores
  {
    public $rif;
    public $razon_social;
    public $telefono;
    public $direccion;
    public $key;
    public $sql;
    public $ejecutar;

    function __construct($rif,$razon_social,$telefono,$direccion)
    {
      $this->rif=$rif;
      $this->razon_social=$razon_social;
      $this->telefono=$telefono;
      $this->direccion=$direccion;
    }

    public function registrar($conectar)
    {     
      $this->sql="CALL insertar_proveedor('$this->rif','$this->razon_social','$this->telefono','$this->direccion')";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if(($this->ejecutar) && (mysqli_affected_rows($conectar)) > 0)
      {
        $cedula=$_SESSION['cedula'];
        mysqli_query($conectar,"CALL entrada_historial('$cedula','Registro de','proveedor')");
        echo"<script>alert('Proveedor registrado satisfactoriamente')</script>
        <script>window.location='../vista/proveedores/registrar.php'</script>";
      }
      else
      {
        $this->sql="SELECT * FROM proveedor WHERE rif='$this->rif'";
        $this->ejecutar=mysqli_query($conectar,$this->sql);
        echo"
              <form action='../vista/proveedores/registrar.php' name='datos_almacenados' method='POST'>
                <input type='hidden' value='$this->rif' name='rif'>
                <input type='hidden' value='$this->razon_social' name='razon_social'>
                <input type='hidden' value='$this->telefono' name='telefono'>
                <input type='hidden' value='$this->direccion' name='direccion'>
              </form>
            ";
        if($this->ejecutar->num_rows>=1)
        {
          echo"
                <script>
                  alert('Ya hay un proveedor registrado con el rif dado');
                  document.datos_almacenados.submit();
                </script>
              ";
        }
        else
        {
          echo"
                <script>
                  alert('Problemas al registrar');
                  document.datos_almacenados.submit();
                </script>
              ";
        }
      }
      $this->ejecutar->close();
    }

    public function listar($conectar)
    {
      $this->sql="SELECT * FROM proveedor";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar->num_rows>0)
      {
        while($row = mysqli_fetch_assoc($this->ejecutar))
        {
          $this->rif=$row['rif'];
          $this->razon_social=$row['razon_social'];
          $this->telefono=$row['telefono'];
          $this->direccion=$row['direccion'];
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
                      <td>$this->rif</td>
                      <td>$this->razon_social</td>
                      <td>$this->telefono</td>
                      <td>$this->direccion</td>
                      <td>$this->estado</td>";
                      if($_SESSION['privilegio']>=2)
                      {
                      echo" <form action='../../controlador/proveedores.php' name='opciones' method='POST'>
                        <td>
                          <input type='hidden' name='key' value='$this->rif'>
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
                      </form>";
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
        $this->sql="SELECT * FROM proveedor WHERE rif='$this->key'";
        $this->ejecutar=mysqli_query($conectar,$this->sql);
        if ($row=mysqli_fetch_assoc($this->ejecutar))//Carga un array con los datos del proveedor a partir del rif
        {
          echo"
            <form action='../vista/proveedores/modificar.php' name='datos_almacenados' method='POST'>
              <input type='hidden' value=".$row['rif']." name='rif'>
              <input type='hidden' value='".$row['razon_social']."' name='razon_social'>
              <input type='hidden' value=".$row['telefono']." name='telefono'>
              <input type='hidden' value='".$row['direccion']."' name='direccion'>
              <input type='hidden' value=".$this->key." name='key'>
            </form>
            <script>document.datos_almacenados.submit()</script>";
          //Se envían los datos del array hacia el formulario de modficación a través de un formulario oculto.
        }
      }

      if (isset($_POST['registrar_cambios']))
      {
        $this->sql="CALL modificar_proveedor('$this->rif','$this->razon_social','$this->telefono','$this->direccion','$this->key')";
        echo $this->sql;
        $this->ejecutar=mysqli_query($conectar,$this->sql);
        if(($this->ejecutar) && (mysqli_affected_rows($conectar) > 0))
        {
          $cedula=$_SESSION['cedula'];
          mysqli_query($conectar,"CALL entrada_historial('$cedula','Madificación de','proveedor')");
          echo" 
                <script>
                  alert('Proveedor modificado satisfactoriamente');
                  window.location='../vista/proveedores/listar.php';
                </script>
              ";
        }
        else
        {
          $this->sql="SELECT * FROM proveedor WHERE rif='$this->rif'";
          $this->ejecutar=mysqli_query($conectar,$this->sql);
          if($this->ejecutar->num_rows>=1)
          {
            echo"<script>alert('Ya hay un proveedor registrado con el rif dado o no ha cambiado ningún dato en el formulario')</script>";
          }
          else
          {
            echo"<script>alert('Problemas al actualizar')</script>";
          }
            echo"<form action='../vista/proveedores/modificar.php' name='datos_almacenados' method='POST'>
              <input type='hidden' value=".$this->rif." name='rif'>
              <input type='hidden' value='".$this->razon_social."' name='razon_social'>
              <input type='hidden' value=".$this->telefono." name='telefono'>
              <input type='hidden' value='".$this->direccion."'' name='direccion'>
              <input type='hidden' value=".$this->key." name='key'>
              <input type='hidden' value='TRUE' name='modificar'>
            </form>
            <script>document.datos_almacenados.submit()</script>";
        }
      }
    }
    function activar_desactivar ($key,$conectar)
    {
      $valor=isset($_POST['activar'])?'A':'I';
      $accion=($valor=='A')?'Activar':'Desactivar';
      $cedula=$_SESSION['cedula'];
      mysqli_query($conectar,"CALL entrada_historial('$cedula','$accion','proveedor')");
      $this->sql="UPDATE proveedor SET estado='$valor' WHERE rif='$key'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      echo $this->ejecutar?"<script>alert('Proveedor actualizado');window.location.href='../vista/proveedores/listar.php'</script>":"<script>alert('Fallo al actualizar');window.location.href='../vista/proveedores/listar.php'</script>";
    }
  }
?>