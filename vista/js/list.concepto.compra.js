$(document).ready( function () {
    var lista = $('#list').DataTable( {
      pageLength: 5,
      language: {
        processing:     "Procesando...",
        lengthMenu:     "Mostrar _MENU_ registros",
        zeroRecords:    "No se encontraron resultados",
        emptyTable:     "No hay ningún dato disponible",
        info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
        infoFiltered:   "(filtrado de un total de _MAX_ registros)",
        infoPostFix:    "",
        search:         "Buscar:",
        url:            "",
        infothousands:  ",",
        loadingRecords: "Cargando...",
        paginate: {
          first:    "Primero",
          last:     "Último",
          next:     "Siguiente",
          previous: "Anterior"
        },
        aria: {
          sortAscending:  ": Activar para ordenar la columna de manera ascendente",
          sortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    },
      lengthChange: false,
        buttons: [
          { 
            text: 'Confirmar Factura',
            action: function(){
              if(confirm('¿Esta seguro que desea CONFIRMAR la factura?'))
              {
                var newForm = jQuery('<form>', {
                    'action': '../../controlador/facturas.php',
                    'method': 'POST'
                }).append(jQuery('<input>', {
                    'name': 'confirmar_factura_compra',
                    'value': 'True',
                    'type': 'hidden'
                }));
                newForm.hide().appendTo("body").submit();
              }
            }                      
          },
          {
            text: 'Agregar Concepto',
            action: function(){
              var newForm = jQuery('<form>', {
                  'action': '../facturas/registrar_concepto.php',
                  'method': 'POST'
              }).append(jQuery('<input>', {
                  'name': 'agregar_concepto',
                  'value': 'True',
                  'type': 'hidden'
              }));
              newForm.hide().appendTo("body").submit();
            }
          },
          {
            text: 'Cancelar Factura',
            action: function(){
              if(confirm('¿Esta seguro que desea CANCELAR la factura?'))
              {
                var newForm = jQuery('<form>', {
                    'action': '../../controlador/facturas.php',
                    'method': 'POST'
                }).append(jQuery('<input>', {
                    'name': 'cancelar_factura_compra',
                    'value': 'True',
                    'type': 'hidden'
                }));
                newForm.hide().appendTo("body").submit();
              }
            }
          }
        ]
    } );

    lista.buttons().container()
        .appendTo( '#list_wrapper .col-md-6:eq(0)' );

} );