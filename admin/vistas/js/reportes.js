/*=============================================
    SCRIPT OPCIONES DE REPORTES
    =============================================
    BLOQUE REPORTES
    =============================================*/

if (paginaActual == "reporte-general") {


    /*=============================================
    TABLA REPORTES-GENERAL
    =============================================*/

    $.ajax({

        url: "ajax/tabla-reporte-general.ajax.php",
        success: function(respuesta) {}

    });

    $(".tablaReporteGeneral").DataTable({
        "ajax": "ajax/tabla-reporte-general.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "language": {

            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        }

    });



}





/*=============================================
    TABLA MI-REPORTE
    =============================================*/

// if (paginaActual == "mi-reporte") {

//     $.ajax({

//         url: "ajax/tabla-mi-reporte.ajax.php",
//         type: "POST",
//         data: {
//             'inicio': 'ads',
//             'final': 'final'
//         },
//         success: function(respuesta) {

//         }

//     });

// }

$(".tablaMiReporte").DataTable({
    "ajax": {
        "url": "ajax/tabla-mi-reporte.ajax.php",
        "type": "post",
        "data": function(d) {
            d.idUsuario = $('#idUsuario').val();
        }
    },
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    },

});