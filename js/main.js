$(document).ready(function(){
  //Funcion al ocultar el banner
  $("#ocultarBanner").click(function(){
    //Se crean dos variables con los lementos html y texto para intercalar al ocultar y mostrar el banner
    var oculto = "<i class='fa fa-angle-double-down'></i> Mostrar Banner <i class='fa fa-angle-double-down'></i>";
    var activo = "<i class='fa fa-angle-double-up'></i> Ocultar Banner <i class='fa fa-angle-double-up'></i>";

    $(".banner").slideToggle();   //Se ocultar y se muestra segun sea el caso
    $(".banner").toggleClass("hidden"); //Se le agrega una clase como futuro identificador

    $("#ocultarBanner").empty(); //elimina todos los elementos hijos del boton

    if ($(".banner").hasClass('hidden')){  //agrega los elementos correspondientes segun sea si esta oculto o activo    
      $("#ocultarBanner").append(oculto)
    } else {      
      $("#ocultarBanner").append(activo)
    }
  });

  setInterval(function(){ //Funcion para el reloj en la cabecera
    var date = new Date(); //obtener fecha local y almacenarla cada dato
    var d = date.getDate();
    var m = date.getMonth()+1;
    var a = date.getFullYear();
    var h = date.getHours();
    var mi = date.getMinutes();
    var s = date.getSeconds();

    if (h > 12) {
      h = h - 12;
      var momento = 'p.m.';
    }

    else{
      var momento = 'a.m.';
    }

    str_hora = new String(h);
    if (str_hora.length == 1) {
        h = '0' + h;
    }

    str_minuto = new String(mi);
    if (str_minuto.length == 1) {
        mi = '0' + mi;
    }

    str_segundo = new String(s);
    if (str_segundo.length == 1) {
        s = '0' + s;
    }

    str_dia = new String(d);
    if (str_dia.length == 1) {
        d = '0' + d;
    }
    
    str_mes = new String(m);
    if (str_mes.length == 1) {
        m = '0' + m;
    }
    var fecha = d + "/" + m + "/" + a;
    var hora = h + ":" + mi + ":" + s + " " + momento;
    $('#fecha').text(fecha);
    $('#hora').text(hora);
    
  }, 1000);
});