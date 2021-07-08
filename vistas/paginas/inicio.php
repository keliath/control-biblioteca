<?php

include("modulos/preload.php");

include("modulos/header.php");

if (!isset($_GET['pagina']) || $_GET["pagina"]) {
    include("modulos/menu-movil.php");
}


include("modulos/hero.php");

include("modulos/categorias.php");

include("modulos/libros-destacados.php");

include("modulos/footer.php");
