<?php
    require_once("./controladores/plantilla.controlador.php");
    require_once("./controladores/ruta.controlador.php");

    require_once("admin/controladores/usuarios.controlador.php");
    require_once("admin/controladores/libros.controlador.php");
    require_once("admin/controladores/categorias.controlador.php");
    require_once("admin/controladores/prestamos.controlador.php");

    require_once("admin/modelos/usuarios.modelo.php");
    require_once("admin/modelos/libros.modelo.php");
    require_once("admin/modelos/categorias.modelo.php");
    require_once("admin/modelos/prestamos.modelo.php");

    require_once("admin/extensiones/vendor/autoload.php");

        $plantilla = new ControladorPlantilla;
        $plantilla -> ctrPlantilla();
    ?>