<?php session_start(); 
if(!isset($_SESSION['login']) || $_SESSION['login']==False)
{
  echo "<script>alert('Debe iniciar sesion para entrar al sistema'); window.location='../../'</script>";
}
?>
      <!-- Banner -->
      <div class="col-12 banner hidden-sm-down">
        <img src="../complementos/banner.png" class="img-fluid" alt="Banner de la empresa" />
      </div>
      <!-- Informacion de Sesion -->
      <div class="col-12 session">
        <div class="container-fluid">
          <div class="row">
            <!-- Datos de Usuario -->
            <div class="col-12 col-md-3 text-center text-md-left">
              <i class="fa fa-user"></i> <?php echo $_SESSION['usuario'];?> &ensp;&ensp;<br class="hidden-sm-down" />
              <i class="fa fa-black-tie"></i> <?php echo $_SESSION['privilegio'] == 1? "Usuario":"Administrador"; ?>
            </div>
            <!-- Boton de Ocultar -->
            <div class="col-md-6 hidden-sm-down text-center">
              <button id="ocultarBanner" type="button" class="btn btn-secondary">
                <i class="fa fa-angle-double-up"></i> Ocultar Banner <i class="fa fa-angle-double-up"></i>
              </button>
            </div>
            <!-- Fecha y Hora actual -->
            <div class="col-12 col-md-3 text-center text-md-right reloj">
              <i class="fa fa-calendar fa-fw"></i><span id="fecha"></span><br class="hidden-sm-down">&ensp;&ensp;<i class="fa fa-clock-o fa-fw"></i><span id="hora"></span>

            </div>
          </div>
        </div>
      </div>
      <div class="notification-nav">
        <input type="checkbox" id="navtoggle"/>
        <input type="checkbox" id="deletetoggle"/>
        <div class="toggleNotifications">
          <div class="count">
            <div class="num"></div>
          </div>
          <label class="show" for="navtoggle"><i class="fa fa-bell-o"></i></label>
          <div class="notifications">
            <div class="btnbar">
              <div class="text full">Hay notificaciones</div>
              <div class="text empty">No hay notificaciones</div>
              <label class="delete" for="deletetoggle">
                <i class="fa fa-eye-slash full"></i>
                <i class="fa fa-eye empty"></i>
              </label>
            </div>
            <div class="groupofnotes">
              <?php
              include('../../modelo/notificaciones.php');
              ?>
            </div>
          </div>
        </div>
      </div>  