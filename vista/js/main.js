$(document).ready(function () {
  //Muestra la cantidad de notificaciones
  var notificaciones = $('.note').length;
  if(notificaciones > 0)
  {
    $('.num').text(notificaciones);
  }
  
  //Funcion para detectar cookies
  function getCookie(cname) {
    var name = cname + '=';
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }

      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }

    return '';
  }

  //Verifica si el banner ha sido ocultado con anterioridad
  var banner = getCookie('banner');
  if (banner == "oculto") {
    $(".banner").slideToggle(0);   //Se ocultar el banner
    $(".banner").toggleClass("hidden"); //Se le agrega una clase como futuro identificador
    $("#ocultarBanner").empty();
    $("#ocultarBanner").append("<i class='fa fa-angle-double-down'></i> Mostrar Banner <i class='fa fa-angle-double-down'></i>");
  }

  //Funcion al ocultar el banner
  $("#ocultarBanner").click(function(){
    //Se crean dos variables con los lementos html y texto para intercalar al ocultar y mostrar el banner
    var oculto = "<i class='fa fa-angle-double-down'></i> Mostrar Banner <i class='fa fa-angle-double-down'></i>";
    var activo = "<i class='fa fa-angle-double-up'></i> Ocultar Banner <i class='fa fa-angle-double-up'></i>";

    $(".banner").slideToggle();   //Se ocultar y se muestra segun sea el caso
    $(".banner").toggleClass("hidden"); //Se le agrega una clase como futuro identificador

    $("#ocultarBanner").empty(); //elimina todos los elementos hijos del boton

    if ($(".banner").hasClass('hidden')){  //agrega los elementos correspondientes segun sea si esta oculto o activo
      $("#ocultarBanner").append(oculto);
      document.cookie = "banner=oculto; path=/";
    } else {
      $("#ocultarBanner").append(activo);
      document.cookie = "banner=activo; path=/";
    }
  });

  setInterval(function(){ //Funcion para el reloj en la cabecera
    var date = new Date(); //obtener fecha local y almacenarla cada dato
    var d = date.getDate(); //Dia
    var m = date.getMonth()+1; //Mes
    var a = date.getFullYear(); //Año
    var h = date.getHours(); //Hora
    var mi = date.getMinutes(); //Minutos
    var s = date.getSeconds(); //Segundos

    if (h > 12) { //Se configura la hora para que sea de 12 horas y se agrega pm y am segun corresponda
      h = h - 12;
      var momento = 'p.m.';
    }

    else{
      var momento = 'a.m.';
    }

    str_hora = new String(h);
    if (str_hora.length == 1) { //Se le agrega un 0 a la hora en caso de que sea menor a 10
        h = '0' + h;
    }

    str_minuto = new String(mi);
    if (str_minuto.length == 1) { //Se le agrega un 0 a los minutos en caso de que sea menor a 10
        mi = '0' + mi;
    }

    str_segundo = new String(s); //Se le agrega un 0 a los segundos en caso de que sea menor a 10
    if (str_segundo.length == 1) {
        s = '0' + s;
    }

    str_dia = new String(d); //Se le agrega un 0 a los dias en caso de que sea menor a 10
    if (str_dia.length == 1) {
        d = '0' + d;
    }

    str_mes = new String(m); //Se le agrega un 0 a los meses en caso de que sea menor a 10
    if (str_mes.length == 1) {
        m = '0' + m;
    }
    var fecha = d + "/" + m + "/" + a; //Se crea la cadena a mostrar en la interfaz para la fecha
    var hora = h + ":" + mi + ":" + s + " " + momento; //Se crea la cadena a mostrar en la interfaz para la hora
    $('#fecha').text(fecha); //Se inserta la fecha y la hora en la interfaz
    $('#hora').text(hora);

  }, 1000);

  //Desplegable del menu
  $('.menu li:has(ul)').click(function(abrirsubmenu){
    abrirsubmenu.preventDefault(); //Se previene la funcion por defecto de los tags a

    if ($(this).hasClass('activado')){ //Condicion para ocultar si clickea un submenu que se encuentre abierto

        $(this).removeClass('activado');
        $(this).children('ul').slideUp();

    } else { //Oculta todos los submenus que esten abiertos y muestra al que se clickea
        $('.menu li ul').slideUp();
        $('.menu li').removeClass('activado');
        $(this).addClass('activado');
        $(this).children('ul').slideDown();
    }
  });

  $('.btn-menu').click(function(abrirmenu){ //Mostrar el menu en dispositivos moviles
    abrirmenu.preventDefault();
    $('.contenedor-menu .menu').slideToggle();
    $('.contenedor-menu').toggleClass('menu-index');
  });

  $(window).resize(function(){ //Fixes por si la pantalla cambia de tamaño
        if ($(document).width() >= 767){ //se muestra el menu si la pantalla es grande
            $('.contenedor-menu .menu').css({'display' : 'block'});
        }

        if ($(document).width() <= 767){ //Se oculta el menu se la pantalla es pequeña y se desactivan los submenus abiertos
            $('.contenedor-menu .menu').css({'display' : 'none'});
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
        }
  });

  $('.menu li ul li a').click(function(){
        window.location.href = $(this).attr("href"); //Reactiva el HREF para los sub menu//
  });

  $('.confirmacion').click(function(confirmar){
    var accion = $(this).text();
    if(!confirm('¿Esta seguro de que desea '+accion.toLowerCase()+'?'))
    {
      confirmar.preventDefault();
    }
  });
});
