<?php

$categoria = "Libros Categoria: Todas";

$item = null;
$valor = null;

if (isset($_GET['cat'])) {

    $item = 'id_categoria';
    $valor = $_GET['cat'];

    $categoria = ControladorCategorias::ctrMostrarCategoria($item, $valor);

    $categoria = "Libros Categoria: ". $categoria['cat_categoria'];
}

if (isset($_POST['inputBuscar']) && $_POST['inputBuscar'] != '') {

    if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\-\,\:\. ]+$/', $_POST["inputBuscar"])) {

        $item = [
            "lib_titulo" => "lib_titulo",
            "aut_autor" => "aut_autor",
            "lib_isbn" => "lib_isbn"
        ];
        $valor = $_POST['inputBuscar'];

        $categoria = "Resultado de busqueda de: " . $valor;
    }
}

$libros = ControladorLibros::ctrMostrarLibrosJoin($item, $valor);

?>
<!-- Page Content Holder -->
<div id="content">

    <div class="container-fluid pl-4">
        <div class="mt-5 pt-4 d-none d-lg-block"></div>
        <h1 class=" mt-5 pt-5 mt-lg-0 pt-lg-0"><?php echo $categoria; ?></h1>
        <hr>
        <div class="d-flex flex-row flex-wrap">

            <?php
            foreach ($libros as $key => $value) {

                $portada = "admin/vistas/img/libros/" . $value['id_libro'] . "/" . $value['lib_portada'];
                $idLibro = $value['id_libro'];
                $autor = $value['aut_autor'];
                $isbn = $value['lib_isbn'];
                $descripcion = $value['lib_descripcion'];
                $descripcion = str_replace(PHP_EOL, "<br>", $descripcion);
                $edicion = $value['lib_edicion'];
                $tituloLibro = $value['lib_titulo'];
                $estado = $value['lib_estado'];
            ?>


                <picture class="mx-auto mt-1 mb-2 image-container">
                    <a href="#" data-toggle="modal" data-target="#solicitarLibro" onclick="llenarSolicitud('<?php echo $tituloLibro ?>','<?php echo $idLibro ?>','<?php echo $portada ?>',
                    '<?php echo $autor ?>', '<?php echo $descripcion ?>', '<?php echo $isbn ?>', '<?php echo $edicion ?>','<?php echo $estado ?>')">
                        <source media="(min-width: 650px)" srcset="<?php echo $portada; ?>">
                        <img src="<?php echo $portada; ?>" alt="Portada del libro" class="img-fluid libro-portada">
                        <div class="image-content text-white text-center">
                            <h4 class="h3 mt-5"><?php echo $value['lib_titulo']; ?></h4>
                            <hr class="w-100 text-white font-weight-bold">
                            <br>
                            <h5 class="h5"><?php echo $autor  ?></h5>
                            <br>
                            <h5 class="h5"><?php echo $isbn; ?></h5>
                        </div>
                    </a>

                </picture>

            <?php
            }
            ?>

        </div>

    </div>
</div>