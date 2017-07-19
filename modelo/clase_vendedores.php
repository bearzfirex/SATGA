<?php

  class vendedores
  {
    public $cedula;
    public $nombre;
    public $apellido;
    public $telefono;
    public $direccion;
    public $key;
    public $sql;
    public $ejecutar;

    function __construct($cedula,$nombre,$apellido,$telefono,$direccion,$fecha_ingreso,$cargo)
    {
      $this->cedula=$cedula;
      $this->nombre=$nombre;
      $this->apellido=$apellido;
      $this->telefono=$telefono;
      $this->direccion=$direccion;
      $this->fecha_ingreso=$fecha_ingreso;
      $this->cargo=$cargo;
    }

    public function registrar($conectar)
    {
      $this->sql="CALL insertar_persona('$this->cedula','$this->nombre','$this->apellido','$this->telefono','$this->direccion','','','','',STR_TO_DATE('$this->fecha_ingreso','%d/%m/%Y'),'$this->cargo','v')";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if(($this->ejecutar)&&(mysqli_affected_rows($conectar)>0))
      {
        $cedula=$_SESSION['cedula'];
        mysqli_query($conectar,"CALL entrada_historial('$cedula','Registro de','vendedor')");
        echo"<script>alert('Vendedor registrado satisfactoriamente')</script>
        <script>window.location='../vista/vendedores/registrar.php'</script>";
      }

      else
      {
        $this->sql="SELECT * FROM persona, datos_laborales WHERE persona.cedula='$this->cedula' AND persona.cedula=datos_laborales.cedula GROUP BY datos_laborales.cedula";
        $this->ejecutar=mysqli_query($conectar,$this->sql);
        if($this->ejecutar->num_rows>=1)
        {
          echo"<script>alert('Ya hay un vendedor registrado con la cédula dada')</script>
          <form action='../vista/vendedores/registrar.php' name='datos_almacenados' method='POST'>
            <input type='hidden' value='$this->cedula' name='cedula'>
            <input type='hidden' value='$this->nombre' name='nombre'>
            <input type='hidden' value='$this->apellido' name='apellido'>
            <input type='hidden' value='$this->telefono' name='telefono'>
            <input type='hidden' value='$this->direccion' name='direccion'>
            <input type='hidden' value='$this->fecha_ingreso' name='fecha_ingreso'>
            <input type='hidden' value='$this->cargo' name='cargo'>
          </form>
          <script>document.datos_almacenados.submit()</script>";
        }
        else
        {
          echo"<script>alert('Problemas al registrar')</script>
          <form action='../vista/vendedores/registrar.php' name='datos_almacenados' method='POST'>
            <input type='hidden' value='$this->cedula' name='cedula'>
            <input type='hidden' value='$this->nombre' name='nombre'>
            <input type='hidden' value='$this->apellido' name='apellido'>
            <input type='hidden' value='$this->telefono' name='telefono'>
            <input type='hidden' value='$this->direccion' name='direccion'>
            <input type='hidden' value='$this->fecha_ingreso' name='fecha_ingreso'>
            <input type='hidden' value='$this->cargo' name='cargo'>
          </form>
          <script>//document.datos_almacenados.submit()</script>";
        }
      }
      $this->ejecutar->close();
    }

    public function listar($conectar,$buscar)
    {
      $this->buscar=$buscar;
      $this->sql="SELECT * FROM persona, datos_laborales WHERE ((persona.cedula LIKE '%$this->buscar%' AND datos_laborales.cedula LIKE '%$this->buscar%') OR nombre LIKE '%$this->buscar%' OR apellido LIKE '%$this->buscar%' OR telefono LIKE '%$this->buscar%' OR direccion LIKE '%$this->buscar%' OR cargo LIKE '%$this->buscar%') AND (tipo='pv' OR tipo='pev' OR tipo='v') AND (persona.cedula=datos_laborales.cedula) GROUP BY datos_laborales.cedula";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      if($this->ejecutar->num_rows>0)
      {
        while($row = mysqli_fetch_assoc($this->ejecutar))
        {
          $this->cedula=$row['cedula'];
          $this->nombre=$row['nombre'];
          $this->apellido=$row['apellido'];
          $this->telefono=$row['telefono'];
          $this->direccion=$row['direccion'];
          $this->fecha_ingreso=date('d/m/Y',strtotime($row['fecha_ingreso']));
          $this->cargo=$row['cargo'];
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
                      <td>$this->cedula</td>
                      <td>$this->nombre</td>
                      <td>$this->apellido</td>
                      <td>$this->telefono</td>
                      <td>$this->direccion</td>
                      <td>$this->fecha_ingreso</td>
                      <td>$this->cargo</td>
                      <td>$this->estado</td>";
                      if($_SESSION['privilegio']>=2)
                      {
                      echo" <form action='../../controlador/vendedores.php' name='opciones' method='POST'>
                        <td>
                          <input type='hidden' name='key' value='$this->cedula'>
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
      else
      {
        echo"<script>
          alert('No se han encontrado coincidencias');
          window.location='listar.php';
        </script>";
      }
    }

    public function modificar ($key,$conectar)
    {
      $this->key=$key;
      //Si se presionó la opción "Modificar" en la lista.
      if(isset($_POST['modificar']))
      {
        $this->sql="SELECT * FROM persona, datos_laborales WHERE persona.cedula='$this->key' AND persona.cedula=datos_laborales.cedula GROUP BY datos_laborales.cedula";
        $this->ejecutar=mysqli_query($conectar,$this->sql);
        if ($row=mysqli_fetch_assoc($this->ejecutar))//Carga un array con los datos del vendedor a partir de la cedula
        {
          echo"<form action='../vista/vendedores/modificar.php' name='datos_almacenados' method='POST'>
              <input type='hidden' value='".$row['cedula']."' name='cedula'>
              <input type='hidden' value='".$row['nombre']." 'name='nombre'>
              <input type='hidden' value='".$row['apellido']."' name='apellido'>
              <input type='hidden' value='".$row['telefono']."' name='telefono'>
              <input type='hidden' value='".$row['direccion']."' name='direccion'>
              <input type='hidden' value='".$row['fecha_ingreso']."' name='fecha_ingreso'>
              <input type='hidden' value='".$row['cargo']."' name='cargo'>
              <input type='hidden' value='".$this->key."' name='key'>
              <input type='hidden' value='TRUE' name='modificar'>
            </form>
            <script>document.datos_almacenados.submit()</script>";
          //Se envían los datos del array hacia el formulario de modficación a través de un formulario oculto.
        }
      }

      if (isset($_POST['registrar_cambios']))
      {
        $this->sql="
                    UPDATE persona SET cedula='$this->cedula', nombre='$this->nombre', apellido='$this->apellido', telefono='$this->telefono', direccion='$this->direccion' WHERE cedula='$this->key';
                    UPDATE datos_laborales SET fecha_ingreso=STR_TO_DATE('$this->fecha_ingreso','%d/%m/%Y'), cargo='$this->cargo' WHERE cedula='$this->key';
                   ";
        $this->ejecutar=mysqli_multi_query($conectar,$this->sql);
        if($this->ejecutar)
        {
          $cedula=$_SESSION['cedula'];
          mysqli_query($conectar,"CALL entrada_historial('$cedula','Modificación de','vendedor')");
          echo"<script>alert('Vendedor modificado satisfactoriamente')</script>
          <script>window.location='../vista/vendedores/listar.php'</script>";
          echo mysqli_error($conectar);
          echo $this->ejecutar;
          echo $this->sql;
        }
        else
        {
          $this->sql="SELECT * FROM persona WHERE persona.cedula='$this->cedula'";
          $this->ejecutar=mysqli_query($conectar,$this->sql);
          if($this->ejecutar->num_rows>=1)
          {
            echo"<script>alert('Ya hay una persona registrada con la cédula dada o no ha cambiado ningún dato en el formulario')</script>";
          }
          else
          {
            echo"<script>alert('Problemas al actualizar')</script>";
          }
          echo"<form action='../vista/vendedores/modificar.php' name='datos_almacenados' method='POST'>
              <input type='hidden' value='$this->cedula' name='cedula'>
              <input type='hidden' value='$this->nombre' name='nombre'>
              <input type='hidden' value='$this->apellido' name='apellido'>
              <input type='hidden' value='$this->telefono' name='telefono'>
              <input type='hidden' value='$this->direccion' name='direccion'>
              <input type='hidden' value='$this->fecha_ingreso' name='fecha_ingreso'>
              <input type='hidden' value='$this->cargo' name='cargo'>
              <input type='hidden' value=".$this->key." name='key'>
            </form>
            <script>document.datos_almacenados.submit()</script>";

        }
      }
    }

    public function activar_desactivar ($key,$conectar)
    {
      $valor=isset($_POST['activar'])?'A':'I';
      $accion=($valor=='A')?'Activar':'Desactivar';
      $cedula=$_SESSION['cedula'];
      mysqli_query($conectar,"CALL entrada_historial('$cedula','$accion','vendedor')");
      $this->sql="UPDATE datos_laborales SET estado='$valor' WHERE cedula='$key'";
      $this->ejecutar=mysqli_query($conectar,$this->sql);
      echo $this->ejecutar?"<script>alert('Vendedor actualizado');window.location.href='../vista/vendedores/listar.php'</script>":"<script>alert('Fallo al actualizar');window.location.href='../vista/vendedores/listar.php'</script>";

    }
  }
?>
