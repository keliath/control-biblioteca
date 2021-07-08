<?php

/* ============================================
    BLOQUE DE REPORTES
============================================== */



if ($_GET['pagina'] == 'reporte-general') {
    
    if ($usuario["usu_perfil"] != "admin") {

        echo "<script>
        window.location = 'inicio';
        </script>";
    
        return;
    }
    include("vistas/paginas/modulos/reportes/reporte-general.php");
}

if ($_GET['pagina'] == 'mi-reporte') {
    include("vistas/paginas/modulos/reportes/mi-reporte.php");
}



?>