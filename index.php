<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio de Sesion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Meta viewport requerido por el grid de bootstrap -->
  <link rel="stylesheet" type="text/css" href="vista/css/bootstrap.min.css"> <!-- CSS de bootstrap -->
  <link rel="stylesheet" type="text/css" href="vista/css/font-awesome.min.css"> <!-- Fuente de iconos generales -->
  <link rel="stylesheet" type="text/css" href="vista/css/login.css"><!--Estilos personalizados para la interfaz de login -->
  <link rel="stylesheet" type="text/css" href="vista/css/outdatedbrowser.min.css">
  <!--- favicon/icono -->
  <link rel="shortcut icon" href="vista/complementos/favicon.ico">
  <link rel="icon" type="image/png" sizes="32x32" href="vista/complementos/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="vista/complementos/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="vista/complementos/favicon-16x16.png">
</head>
<body>
  <div class="container login-form">
    <div class="image"></div>
    <div class="frm">
      <h1>Inicie Sesión</h1>
      <form action="controlador/sesiones.php" method="POST">
        <div class="form-group">
          <label for="usuario">Usuario:</label>
          <input type="text" name="usuario" class="form-control" id="username" placeholder="Introduzca su usuario" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="contrasena">Contraseña:</label>
          <input type="password" name="contrasena" class="form-control" id="password" placeholder="Introduzca su contraseña" autocomplete="off" required>
        </div>
        <div class="form-group">
          <button type="submit" name='login' class="btn btn-success btn-lg">Acceder <i class="fa fa-fw fa-key" ></i></button>
        </div>
      </form>
    </div>
  </div>
  <div id="outdated"></div>
<script src="vista/js/outdatedbrowser.min.js"></script>
<script type="text/javascript">
  //event listener: DOM ready
  function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
      window.onload = func;
    } 
    else {
      window.onload = function() {
        if (oldonload) {
          oldonload();
        }
        func();
      }
    }
  }
    //call plugin function after DOM ready
  addLoadEvent(function(){
    outdatedBrowser({
      bgColor: '#f25648',
      color: '#ffffff',
      lowerThan: 'transform',
      languagePath: 'es.html'
    })
  });
</script>    
</body>
</html>