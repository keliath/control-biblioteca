/*=============================================
    SCRIPT OPCIONES DE LA BIBLIOTECA
    =============================================
    BLOQUE LIBROS
    =============================================*/

if (paginaActual == "libros") {


    /*=============================================
    TABLA LIBROS
    =============================================*/

    $.ajax({

        url: "ajax/tabla-libros.ajax.php",
        success: function(respuesta) {}

    });

    function modificarLibro(idLibro) {
        parcheAjax('ajax/ajax-parche/parcheModLibro.php', 'modificarLibroContent', idLibro);
    }

    $(".tablaLibros").DataTable({
        "ajax": "ajax/tabla-libros.ajax.php",
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
    TABLA AUTORES
    =============================================*/

if (paginaActual == "autores") {

    // $.ajax({

    //     url: "ajax/tabla-autores.ajax.php",
    //     success: function(respuesta) {

    //     }

    // });

}

//parche ajax no-jquery para modificar tablas por no poder imprimir el boton con los datos ya impresos en el datatable
function modificarAutor(idAutor) {
    parcheAjax('ajax/ajax-parche/parcheModAutor.php', 'modificarAutorContent', idAutor);
}

$(".tablaAutores").DataTable({
    "ajax": "ajax/tabla-autores.ajax.php",
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


/*=============================================
    TABLA EDITORIALES
    =============================================*/

if (paginaActual == "editoriales") {

    $.ajax({

        url: "ajax/tabla-editoriales.ajax.php",
        success: function(respuesta) {

        }

    });

}

function modificarEditorial(idEditorial) {
    parcheAjax('ajax/ajax-parche/parcheModEditorial.php', 'modificarEditorialContent', idEditorial);
}

$(".tablaEditoriales").DataTable({
    "ajax": "ajax/tabla-editoriales.ajax.php",
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


/*=============================================
    TABLA CATEGORIAS
    =============================================*/

if (paginaActual == "categorias") {

    $.ajax({

        url: "ajax/tabla-categorias.ajax.php",
        success: function(respuesta) {

        }

    });

}

function modificarCategoria(idCategoria) {
    parcheAjax('ajax/ajax-parche/parcheModCategoria.php', 'modificarCategoriaContent', idCategoria);
}


$(".tablaCategorias").DataTable({
    "ajax": "ajax/tabla-categorias.ajax.php",
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

/*=============================================
    TABLA PERCHAS-HILERAS
    =============================================*/

if (paginaActual == "perchas-hileras") {

    $.ajax({

        url: "ajax/tabla-perchas_hileras.ajax.php",
        success: function(respuesta) {

        }

    });

}

function modificarUbicacion(idUbicacion) {
    parcheAjax('ajax/ajax-parche/parcheModUbicacion.php', 'modificarUbicacionContent', idUbicacion);
}

$(".tablaPerchasHileras").DataTable({
    "ajax": "ajax/tabla-perchas_hileras.ajax.php",
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