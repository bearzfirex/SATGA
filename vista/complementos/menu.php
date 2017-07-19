        <nav class="contenedor-menu">
          <a href="#" class="btn-menu">Menu<i class="icono fa fa-bars fa-fw"></i></a>
          <ul class="menu">
            <li><a href="../inicio"><i class="icono izquierda fa fa-home fa-fw"></i>Inicio</a></li>
            <li><a href="#"><i class="icono izquierda fa fa-address-book fa-fw"></i>Clientes<i class="icono derecha fa fa-chevron-down fa-fw"></i></a>
              <ul>
                <li><a href="../clientes/registrar.php">Registrar<i class="icono derecha fa fa-plus fa-fw"></i></a></li>
                <li><a href="../clientes/buscar.php">Buscar<i class="icono derecha fa fa-search fa-fw"></i></a></li>
              </ul>
            </li>
            <li><a href="#"><i class="icono izquierda fa fa-address-card fa-fw"></i>Proveedores<i class="icono derecha fa fa-chevron-down fa-fw"></i></a>
              <ul>
                <li><a href="../proveedores/registrar.php">Registrar<i class="icono derecha fa fa-plus fa-fw"></i></a></li>
                <li><a href="../proveedores/listar.php">Listar<i class="icono derecha fa fa-th-list fa-fw"></i></a></li>
              </ul>
            </li>
            <li><a href="#"><i class="icono izquierda fa fa-cart-plus fa-fw"></i>Productos<i class="icono derecha fa fa-chevron-down fa-fw"></i></a>
              <ul>
                <li><a href="../productos/registrar.php">Registrar<i class="icono derecha fa fa-plus fa-fw"></i></a></li>
                <li><a href="../productos/listar.php">Listar<i class="icono derecha fa fa-th-list fa-fw"></i></a></li>
                <li><a href="../productos/existencias.php">Existencias<i class="icono derecha fa fa-shopping-basket fa-fw"></i></a></li>
                <li><a href="../productos/desincorporados.php">Desincorporados<i class="icono derecha fa fa-trash fa-fw"></i></a></li>
              </ul>
            </li>
            <li><a href="#"><i class="icono izquierda fa fa-file-text fa-fw"></i>Facturas<i class="icono derecha fa fa-chevron-down fa-fw"></i></a>
              <ul>
                <li><a href="../facturas/registrar.php">Registrar<i class="icono derecha fa fa-plus fa-fw"></i></a></li>
                <li><a href="../facturas/listar.php">Listar<i class="icono derecha fa fa-th-list fa-fw"></i></a></li>
              </ul>
            </li>
            
            <li><a href="#"><i class="icono izquierda fa fa-users fa-fw"></i>Vendedores<i class="icono derecha fa fa-chevron-down fa-fw"></i></a>
              <ul>
                <li><a href="../vendedores/registrar.php">Registrar<i class="icono derecha fa fa-plus fa-fw"></i></a></li>
                <li><a href="../vendedores/listar.php">Buscar<i class="icono derecha fa fa-search fa-fw"></i></a></li>
              </ul>
            </li>
            <li><a href="#"><i class="icono izquierda fa fa-book fa-fw"></i>Reportes<i class="icono derecha fa fa-chevron-down fa-fw"></i></a>
              <ul>
                </li>
                <li><a href="../reportes/cuentas_por_pagar.php">Cuentas por Pagar<i class="icono derecha fa fa-credit-card fa-fw"></i></a></li>
                <li><a href="../reportes/cuentas_por_cobrar.php">Cuentas por Cobrar<i class="icono derecha fa fa-money fa-fw"></i></a></li>
                <li><a href="../reportes/ganancia_neta.php">Ganancia Neta<i class="icono derecha fa fa-bank fa-fw"></i></a></li>
                <li><a href="../reportes/productos_populares.php">Productos Populares<i class="icono derecha fa fa-line-chart fa-fw"></i></a></li>
                
              </ul>
            </li>
            <?php
            if(isset($_SESSION['login']) && $_SESSION['privilegio']>1)
            {
              echo "<li><a href='#'><i class='icono izquierda fa fa-users fa-fw'></i>Usuarios<i class='icono derecha fa fa-chevron-down fa-fw'></i></a>
              <ul>
                <li><a href='../usuarios/registrar.php'>Registrar<i class='icono derecha fa fa-plus fa-fw'></i></a></li>
                <li><a href='../usuarios/listar.php'>Listar<i class='icono derecha fa fa-th-list fa-fw'></i></a></li>
              </ul>
            </li>";
            }
            
            if(isset($_SESSION['login']) && $_SESSION['privilegio']<2)
            {
              echo "<li><a><i class='icono izquierda fa fa-users fa-fw'></i>Usuarios<i class='icono derecha fa fa-lock fa-fw'></i></a></li>";
            }
            ?>
            <li><a href="../reportes/historial.php"><i class="icono izquierda fa fa-history fa-fw"></i>Historial</a></li>
            <li><a href="../complementos/Manual de Usuario.pdf"><i class="icono izquierda fa fa-question fa-fw"></i>Ayuda</a></li>
            <li><a href="../../controlador/sesiones.php" class="confirmacion"><i class="icono izquierda fa fa-sign-out fa-fw"></i>Salir</a></li>
          </ul>
        </nav>