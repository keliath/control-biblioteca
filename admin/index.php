<?php

include("controladores/plantilla.controlador.php");
include("controladores/general.controlador.php");
include("controladores/usuarios.controlador.php");
include("controladores/autores.controlador.php");
include("controladores/editoriales.controlador.php");
include("controladores/categorias.controlador.php");
include("controladores/perchas-hileras.controlador.php");
include("controladores/libros.controlador.php");
include("controladores/prestamos.controlador.php");

include("modelos/usuarios.modelo.php");
include("modelos/autores.modelo.php");
include("modelos/editoriales.modelo.php");
include("modelos/categorias.modelo.php");
include("modelos/perchas-hileras.modelo.php");
include("modelos/libros.modelo.php");
include("modelos/prestamos.modelo.php");



$plantilla = new ControladorPlantilla;
$plantilla -> ctrPlantilla();

?>