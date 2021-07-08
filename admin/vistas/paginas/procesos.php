<?php

/* ============================================
    BLOQUE DE PROCESOS ADMINISTRATIVOS
============================================== */

if ($usuario["usu_perfil"] != "admin") {

    echo "<script>
    window.location = 'inicio';
    </script>";

    return;
}

if ($_GET['pagina'] == 'solicitudes') {
    include("vistas/paginas/modulos/procesos/solicitudes.php");
}

if ($_GET['pagina'] == 'prestamos') {
    include("vistas/paginas/modulos/procesos/prestamos-admin.php");
}



?>