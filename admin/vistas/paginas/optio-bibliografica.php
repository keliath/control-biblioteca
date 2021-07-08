<?php


if ($usuario["usu_perfil"] != "admin") {

    echo "<script>
    window.location = 'inicio';
    </script>";

    return;
}

if ($_GET['pagina'] == 'libros') {
    include("vistas/paginas/modulos/optio-bibliografica/libros.php");
}

if ($_GET['pagina'] == 'autores') {
    include("vistas/paginas/modulos/optio-bibliografica/autores.php");
}

if ($_GET['pagina'] == 'editoriales') {
    include("vistas/paginas/modulos/optio-bibliografica/editoriales.php");
}

if ($_GET['pagina'] == 'categorias') {
    include("vistas/paginas/modulos/optio-bibliografica/categorias.php");
}

if ($_GET['pagina'] == 'perchas-hileras') {
    include("vistas/paginas/modulos/optio-bibliografica/perchas-hileras.php");
}
