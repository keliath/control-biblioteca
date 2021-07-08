<?php

/* ==========================================
DATOS DE USUARIOS TOTALES
=========================================== */

$listaUsuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);
$totalUsuarios = count($listaUsuarios) - 1;

$solicitudesPendientes = ControladorPrestamos::ctrMostrarSolicitudes("pre_estado", 1);
$solicitudesPendientes = count($solicitudesPendientes);

$totalPrestamos = ControladorPrestamos::ctrMostrarSolicitudes(null, null);
$totalPrestamos = count($totalPrestamos);

$librosPerdidos = ControladorLibros::ctrMostrarLibro("lib_estado", '0');
$librosPerdidos = count($librosPerdidos);
?>


<div class="row">

    <?php
    if ($usuario["usu_perfil"] == "admin") :
    ?>
    
        <div class="col-12 col-sm-6 col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $totalUsuarios; ?></h3>

                    <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="usuarios" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-12 col-sm-6 col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3><?php echo $totalPrestamos; ?></h3>

                    <p>Total de prestamos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="reporte-general" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-12 col-sm-6 col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?php echo $solicitudesPendientes ?></h3>

                    <p>Solicitudes de Prestamos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comments"></i>
                </div>
                <a href="solicitudes" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-12 col-sm-6 col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3 class=""><?php echo $librosPerdidos; ?></h3>

                    <p>Libros perdidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-minus"></i>
                </div>
                <a href="reporte-general" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

    <?php
    endif
    ?>


</div>