"use strict";

/*=============================================
ANIMACIONES SCROLL HEADER
=============================================*/

$(window).scroll(function() {

    var posY = window.pageYOffset;

    if (posY > 10) {

        $(".encabezado").css({
            "background": "#043248",
            "transition": ".3s all"
        })


    } else {

        $(".encabezado").css({
            "background": "rgba(0,0,0,.1)",
            "transition": ".3s all"
        })

    }

})

/*=============================================
MENÚ MÓVIL
=============================================*/

$(".logotipo .fa-bars").click(function() {

    $(".menuMovil").show("fast");

})

$(".menuMovil ul li .fa-times, .click").click(function() {

    $(".menuMovil").hide("fast");

})


/*=============================================
DESPLAZAMIENTO MENÚ
=============================================*/

if (window.matchMedia("(max-width:768px)").matches) {

    $(".menuMovil ul li a .click").click(function(e) {

        $(".menuMovil").slideToggle('fast');

        e.preventDefault();

        var vinculo = $(this).attr("href");

        $("html, body").animate({

            scrollTop: $(vinculo).offset().top - 60

        }, 2000, "easeOutQuint")

    })


} else {

    $(".botonera .desplazar").click(function(e) {

        e.preventDefault();

        var vinculo = $(this).attr("href");

        $(".menuMovil").hide("fast");

        $("html, body").animate({

            scrollTop: $(vinculo).offset().top - 60

        }, 2000, "easeOutQuint")

    })

}

/* ============================================
ACTIVE DE LOS LINKS
============================================= */

$(function() {

    // elementos de la lista
    var menues = $(".nav li");

    // manejador de click sobre todos los elementos
    menues.click(function() {
        // eliminamos active de todos los elementos
        menues.removeClass("active");
        // activamos el elemento clicado.
        $(this).addClass("active");
    });

});

/*=============================================
SCROLL UP
=============================================*/

$.scrollUp({
    scrollText: "",
    scrollSpeed: 2000,
    easingType: "easeOutQuint"
})

/*=============================================
PRELOAD
=============================================*/
var incremento = 0;

$('body').nitePreload({
    srcAttr: 'data-nite-src',
    onProgress: function(a) {

        $("body").css({
            "overflow-y": "hidden"
        });

        incremento = Math.floor(a.percentage);

        $("#porcentajeCarga").html(incremento + "%");

        $("#rellenoCarga").css({
            "width": incremento + "%"
        })

        if (incremento >= 100) {

            $("#preload").delay(350).fadeOut("slow");
            $("body").delay(350).css({
                "overflow-y": "scroll"
            })

        }

    }
});

/* ==========================
Borrar alertas
=========================== */

$("input[name='registroEmail'], #politicas, input[name='registroCedula']").change(function() {

    $(".alert").remove();

})

/* ==========================
VALIDACION DE CORREO DUPLICADO
=========================== */

var ruta = $("#ruta").val();

$("input[name='registroEmail']").change(function() {

    var email = $(this).val();
    console.log(email);

    var datos = new FormData();
    datos.append("validarEmail", email);

    $.ajax({
        url: ruta + "admin/ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if (respuesta) {

                $("input[name='registroEmail']").val("");
                $("input[name='registroEmail']").after(`

						<div class="alert alert-warning">
						<strong>ERROR:</strong>
						El correo electrónico ingresado ya esta registrado
						</div>
						
                    `);

                return;
            }

        }

    })

})


/* ==========================
Igualar tamanos fondos de ingreso y registro
=========================== */
// $(".fotoIngreso, .fotoRegistro").css({ "height": $(".formulario").height() + 2 + "px" })


/* ====================================================
LLENADO DEL MODAL FORMULARIO PARA LA SOLICITUD DE LIBROS
===================================================== */

function llenarSolicitud(titulo, idLibro, portada, autor, descripcion, isbn, edicion, estado) {
    $("#idLibroSolicitud").val(idLibro);
    $("#estadoLibroSolicitud").val(estado);
    console.log(idLibro);
    if (estado == 1) {
        $(".botonSoli").html('<button type="submit" class="btn btn-success btn-lg" value="">Solicitar Líbro</button>');
    } else {
        $(".botonSoli").html('<a class="btn btn-lg border border-black">Libro ya Solicitado</a>');
    }


    titulo = 'Solicitud de Prestamo: ' + titulo;
    $("#tituloLibro").text(titulo);
    $("#portadaLibro").attr('src', portada);

    if (descripcion == '') {
        descripcion = '<br> --- Sin Descripción ---';
    }

    let re = new RegExp('/\r?\n|\r/g');
    descripcion = descripcion.replace(/(\r\n|\n|\r)/gm, "<br>");

    $("#descipcionLibro").html(descripcion);
    $("#autorLibro").text(autor);
    $("#edicionLibro").text(edicion);
    $("#isbnLibro").text(isbn);


}

/* ====================================================
VALIDAR CEDULA
===================================================== */
var cedula = document.getElementById("registroCedula");

$(cedula).change(function() {
    console.log('cambio');
    validar();
});

function validar() {
    var cad = document.getElementById("registroCedula").value.trim();
    console.log(cad);
    var total = 0;
    var longitud = cad.length;
    var longcheck = longitud - 1;

    const pattern = new RegExp('^[0-9]+$');

    if (cad !== "" && longitud === 10 && pattern.test(cad) && cad !== '0000000000') {
        for (i = 0; i < longcheck; i++) {
            if (i % 2 === 0) {
                var aux = cad.charAt(i) * 2;
                if (aux > 9) aux -= 9;
                total += aux;
            } else {
                total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
            }
        }

        total = total % 10 ? 10 - total % 10 : 0;

        if (cad.charAt(longitud - 1) == total) {
            console.log("Cedula Válida");
        } else {
            console.log("Cedula inVálida");
            $("input[name='registroCedula']").val("");
            $("input[name='registroCedula']").after(`

						<div class="alert alert-warning">
						<strong>ERROR:</strong>
						Cedula Invalida
						</div>
						
                    `);
            return;
        }
    } else {
        console.log("Cedula inVálida");
        $("input[name='registroCedula']").val("");
        $("input[name='registroCedula']").after(`

						<div class="alert alert-warning">
						<strong>ERROR:</strong>
						Cedula Invalida
						</div>
						
                    `);
        return;
    }
}