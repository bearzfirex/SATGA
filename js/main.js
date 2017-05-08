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
  function reloj() {

  }
});