<?php


if (isset($_GET['ex'])) {
    echo '<script>
    swal({
        type:"success",
        title:"Exito",
        text: "Se ha realizado la solicitud!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"

    }).then(function(result){
        if(result.value){
            window.location = "' . $ruta . 'biblioteca";
        }
    });
</script>';
}


include('modulos/header.php');


?>
<div class="wrapper">

    <?php

    include('modulos/biblioteca/menu-biblioteca.php');
    ?>


    <?php
    include("modulos/biblioteca/lista-libros.php")
    ?>



</div>

<!-- ==============================
VENTANA MODAL SOLICITAR LIBRO
================================ -->

<!-- The Modal -->
<div class="modal" id="solicitarLibro">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="tituloLibro">Solicitud de Prestamo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="post">
                <!-- Modal body -->
                <div class="modal-body">


                    <div class="container-fluid">

                        <div class="row">

                            <div class="d-none d-lg-block col-4 ">
                                <img src="vistas/img/libro1.jpg" id="portadaLibro" alt="Portada del libro" class="img-fluid libro-portada">
                            </div>

                            <div class="col-12 col-lg-8 pl-4">

                                <div class="container">
                                    <div class="row">
                                        <h4>Descripción</h4>
                                        <p class="text-justify" id="descipcionLibro">Selecciona un libro de nuestro catálogo para ver su descripción completa, información del autor, edición y detalles de disponibilidad. Nuestra biblioteca cuenta con una amplia variedad de géneros literarios para todos los gustos.</p>
                                    </div>

                                    <div class="row">

                                        <div class="col-6">
                                            <h4>Autor</h4>
                                            <p id="autorLibro">Autor no seleccionado</p>
                                        </div>

                                        <div class="col-6">
                                            <h4>Edición</h4>
                                            <p id="edicionLibro">Edición no seleccionada</p>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <h4>ISBN</h4>
                                            <p id="isbnLibro">84654654135169</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="tiempoPrestamo" class="control-label">
                                                    <h4>Días de Prestamo</h4>
                                                </label>
                                                <?php if (isset($_SESSION['id'])) : ?>
                                                    <input type="text" name="idUsuario" value="<?php echo $_SESSION['id']; ?>" hidden required>
                                                <?php endif ?>
                                                <input type="text" name="estadoLibroSolicitud" id="estadoLibroSolicitud" value="" hidden  required>
                                                <input type="text" name="idLibroSolicitud" id="idLibroSolicitud" value="" hidden  required>
                                                <input type="number" min="1" max="5" class="form-control" placeholder="Dias" name="tiempoPrestamo" id="tiempoPrestamo" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                        <?php if (isset($_SESSION["validarSesion"]) && $_SESSION["validarSesion"] == "ok") : ?>

                            <div class="botonSoli"></div>

                        <?php else : ?>

                            <a href="<?php echo $ruta; ?>ingreso" class="btn btn-info btn-lg px-3">Iniciar Sesión</a>

                        <?php endif ?>


                </div>

                <?php

                $solicitarLibro = new ControladorPrestamos();
                $solicitarLibro->ctrSolicitarPrestamos();

                ?>

            </form>

        </div>
    </div>
</div>



<script>
    $(document).ready(function() {

        // $("#sidebarCollapse").overlayScrollbars({
        //     className: "os-theme-dark",
        //     resize: "none",
        //     sizeAutoCapable: true,
        //     clipAlways: true,
        //     normalizeRTL: true,
        //     paddingAbsolute: false,
        //     autoUpdate: null,
        //     autoUpdateInterval: 33,
        //     updateOnLoad: ["img"],
        //     nativeScrollbarsOverlaid: {
        //         showNativeScrollbars: false,
        //         initialize: true
        //     },
        //     overflowBehavior: {
        //         x: "scroll",
        //         y: "scroll"
        //     },
        //     scrollbars: {
        //         visibility: "auto",
        //         autoHide: "never",
        //         autoHideDelay: 800,
        //         dragScrolling: true,
        //         clickScrolling: false,
        //         touchSupport: true,
        //         snapHandle: false
        //     },
        //     textarea: {
        //         dynWidth: false,
        //         dynHeight: false,
        //         inheritedAttrs: ["style", "class"]
        //     },
        //     callbacks: {
        //         onInitialized: null,
        //         onInitializationWithdrawn: null,
        //         onDestroyed: null,
        //         onScrollStart: null,
        //         onScroll: null,
        //         onScrollStop: null,
        //         onOverflowChanged: null,
        //         onOverflowAmountChanged: null,
        //         onDirectionChanged: null,
        //         onContentSizeChanged: null,
        //         onHostSizeChanged: null,
        //         onUpdated: null
        //     }
        // });

        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('activeSidebar');
            $(this).toggleClass('activeSidebar');
            // console.log(this);
        });

        $(function() {

            // elementos de la lista
            var menues = $(".clck");

            // manejador de click sobre todos los elementos
            menues.click(function() {
                // eliminamos active de todos los elementos
                menues.removeClass("activeSidebar");
                // activamos el elemento clicado.
                $(this).addClass("activeSidebar");
            });

        });

        // $('#sidebarCollapse, #sidebarCollapse2').on('click', function() {
        //     $('#sidebar').toggleClass('active');

        //     // close dropdowns
        //     $('.collapse.in').toggleClass('in');
        //     // and also adjust aria-expanded attributes we use for the open/closed arrows
        //     // in our CSS
        //     $('a[aria-expanded=true]').attr('aria-expanded', 'false');

        //     if ($('#sidebarCollapse i').hasClass('fa-chevron-left')) {
        //         $('#sidebarCollapse i').removeClass('fa-chevron-left');
        //         $('#sidebarCollapse i').addClass('fa-chevron-right');
        //     } else {
        //         $('#sidebarCollapse i').removeClass('fa-chevron-right');
        //         $('#sidebarCollapse i').addClass('fa-chevron-left');
        //     }
        // });

    });
</script>