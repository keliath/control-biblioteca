var nombreRutaUrl = jQuery(location).attr('pathname');
nombreRutaUrl = nombreRutaUrl.split("/");
var paginaActual = nombreRutaUrl[nombreRutaUrl.length - 1];



// =====================
// BLOQUE DE SOLO EN LA PAGINA PERFIL
// =====================
if (paginaActual == "perfil" || paginaActual == "editoriales") {

    // =====================
    // listado de paises
    // =====================

    $.ajax({

        url: "vistas/js/plugins/paises.json",
        type: "GET",
        success: function(respuesta) {

            respuesta.forEach(seleccionarPais);

            function seleccionarPais(item, index) {

                var pais = item.name;
                var codPais = item.code;
                var dial = item.dial_code;

                $("#inputPais").append(

                    `<option value="` + pais + `,` + codPais + `,` + dial + `">` + pais + `</option>`
                )
            }


        }
    })

    // =====================
    // Agregar codigo Dial
    // =====================

    $("#inputPais").change(function() {

        $(".dialCode").html($(this).val().split(',')[2])

    })

}


/* ==========================
VALIDAR FORMULARIO SUSCRIPCION
=========================== */


$(".suscribirse").click(function() {

    $(".alert").remove();

    var nombre = $("#inputName").val();
    var email = $("#inputEmail").val();
    var patrocinador = $("#inputPatrocinador").val();
    var enlace_afiliado = $("#inputAfiliado").val();
    var pais = $("#inputPais").val().split(",")[0];
    var codigo_pais = $("#inputPais").val().split(",")[1];
    var telefono_movil = $("#inputPais").val().split(",")[2] + " " + $("#inputMovil").val();
    var red = $("#tipoRed").val();
    var aceptarTerminos = $("#aceptarTerminos:checked").val();

    /*=============================================
    VALIDAR
    =============================================*/
    if (nombre == "" ||
        email == "" ||
        patrocinador == "" ||
        enlace_afiliado == "" ||
        pais == "" ||
        codigo_pais == "" ||
        telefono_movil == "" ||
        red == "" ||
        aceptarTerminos != "on") {

        $(".suscribirse").before(`

				<div class="alert alert-danger">Faltan datos</div>

			`);

        return;


    } else {

        console.log("formulario listo");
    }


})

/*=============================================
    TABLA USUARIOS
    =============================================*/

if (paginaActual == "usuarios") {

    $.ajax({

        url: "ajax/tabla-usuarios.ajax.php",
        success: function(respuesta) {

            console.log("respuesta", respuesta);
        }

    });

}


$(".tablaUsuarios").DataTable({
    "ajax": "ajax/tabla-usuarios.ajax.php",
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