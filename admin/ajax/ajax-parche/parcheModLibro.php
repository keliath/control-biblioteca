<?php

require_once "../../controladores/libros.controlador.php";
require_once "../../modelos/libros.modelo.php";

require_once "../../controladores/autores.controlador.php";
require_once "../../modelos/autores.modelo.php";

require_once "../../controladores/categorias.controlador.php";
require_once "../../modelos/categorias.modelo.php";

require_once "../../controladores/editoriales.controlador.php";
require_once "../../modelos/editoriales.modelo.php";

require_once "../../controladores/perchas-hileras.controlador.php";
require_once "../../modelos/perchas-hileras.modelo.php";

class ModLibro
{

    public function mostrarLista()
    {

        $item = "id_libro";
        $valor = $_POST['dato'];
        $libro = ControladorLibros::ctrMostrarLibrosJoin($item, $valor);

        $idLibro = $libro["id_libro"];
        $nombreLibro = $libro["lib_titulo"];
        $portadaLibro = $libro["lib_portada"];
        $yearLibro = $libro['lib_year'];
        $edicionLibro = $libro['lib_edicion'];
        $isbnLibro = $libro['lib_isbn'];
        $descripcionLibro = $libro["lib_descripcion"];
        $idAutorLibro = $libro["id_autor"];
        $idEditorialLibro = $libro["id_editorial"];
        $idCategoriaLibro = $libro["id_categoria"];
        $idUbicacionLibro = $libro["id_ubicacion"];

        echo "
        <div class='row'>
            <div class='col border-right'>

                <input type='text' name='idLibro' value='$idLibro' hidden required>
                <input type='text' name='portadaActual' value='$portadaLibro' hidden required>

                <div class='form-group'>
                    <label for='inputModTitulo' class='control-label'>Líbro</label>
                    <input type='text' class='form-control' placeholder='Título del Líbro' name='inputModTitulo' id='inputModTitulo' value='$nombreLibro' required>
                </div>

                <div class='form-group'>
                    <label for='inputModPortada' class='control-label'>Portada</label>
                    <input type='file' class='form-control-file border' name='inputModPortada'>
                </div>

                <div class='form-group'>
                    <div class='row'>
                        <div class='col'>
                            <label for='inputModYear' class='control-label'>Año</label>
                            <input type='text' class='form-control' name='inputModYear' id='inputModYear' value='$yearLibro' placeholder='ej: 2017' data-inputmask=''mask':'9999'' data-mask required>
                        </div>

                        <div class='col'>
                            <label for='inputModEdicion' class='control-label'>Edición</label>
                            <input type='text' class='form-control' placeholder='Año de edición' value='$edicionLibro' name='inputModEdicion' id='inputModEdicion' required>
                        </div>
                    </div>

                </div>

                <div class='form-group'>
                    <label for='inputModIsbn' class='control-label'>ISBN</label>
                    <input type='text' class='form-control' placeholder='ISBN del Líbro' value='$isbnLibro' name='inputModIsbn' id='inputModIsbn' required>
                </div>

                <div class='form-group'>
                    <label for='inputModDescripcion' class='control-label'>Descripición</label>
                    <textarea class='form-control' name='inputModDescripcion' id='' cols='10' rows='3' maxlength='250' placeholder='descripcion del libro'>$descripcionLibro</textarea>
                </div>

            </div>

            <div class='col border-left'>


                <!-- select de autores -->
                <div class='form-group'>
                    <label for='inputModAutor' class='control-label'>Autor</label>
                    <div>
                        <select class='form-control select2' name='inputModAutor' id='inputModAutor' required>
                            <option value=''>Nombre del Autor</option>";

        $autores = ControladorAutores::ctrMostrarAutores(null, null);

        foreach ($autores as $key => $value) {
            $idAutor = $value['id_autor'];
            $nombreAutor = $value['aut_autor'];
            $seleccionado = '';
            if ($idAutor == $idAutorLibro) {
                $seleccionado = 'selected';
            }

            echo "<option value='$idAutor' $seleccionado>$nombreAutor</option>";
        }
        echo "</select>
                    </div>
                </div>";



        echo "<!-- select de categorias-ubicacion -->
                <div class='form-group'>

                    <!-- select de categorias -->
                    <label for='inputModCategoria' class='control-label'>Categorías</label>
                    <div>
                        <select class='form-control select2' name='inputModCategoria' id='inputModCategoria' required>
                            <option value=''>Categorías del Libro</option>";

        $categorias = ControladorCategorias::ctrMostrarCategoria(null, null);

        foreach ($categorias as $key => $value) {
            $idCategoria = $value['id_categoria'];
            $nombreCategoria = $value['cat_categoria'];
            $seleccionado = '';
            if ($idCategoria == $idCategoriaLibro) {
                $seleccionado = 'selected';
            }

            echo "<option value='$idCategoria' $seleccionado>$nombreCategoria</option>";
        }

        echo "</select>
                    </div>
                </div>";


        echo "<!-- select de ubicaciones -->
        <div class='form-group'>
            <label for='inputModUbicacion' class='control-label'>Ubicación</label>
            <div>
                <select class='form-control select2' name='inputModUbicacion' id='inputModUbicacion' required>
                    <option value=''>Percha / hilera</option>";

        $ubicaciones = ControladorPerchasHileras::ctrMostrarPerchaHilera(null, null);

        foreach ($ubicaciones as $key => $value) {
            $idUbicacion = $value['id_ubicacion'];
            $nombreUbicacionP = $value['ubi_percha'];
            $nombreUbicacionH = $value['ubi_hilera'];
            $seleccionado = '';
            if ($idUbicacion == $idUbicacionLibro) {
                $seleccionado = 'selected';
            }

            echo "<option value='$idUbicacion' $seleccionado> $nombreUbicacionP -- $nombreUbicacionH </option>";
        }

        echo "</select>
                    </div>
                </div>";


        echo "<!-- select de editorial  -->
                <div class='form-group'>
                    <label for='inputModEditorial' class='control-label'>Editorial</label>
                    <div>
                        <select class='form-control select2' name='inputModEditorial' id='inputModEditorial' required>
                            <option value=''>Editorial del Libro</option>";

        $editoriales = ControladorEditoriales::ctrMostrarEditorial(null, null);

        foreach ($editoriales as $key => $value) {
            $idEditorial = $value['id_editorial'];
            $nombreEditorial = $value['edi_editorial'];
            $seleccionado = '';
            if ($idEditorial == $idEditorialLibro) {
                $seleccionado = 'selected';
            }

            echo "<option value='$idEditorial' $seleccionado> $nombreEditorial</option>";
        }

        echo "</select>
                            </div>
                        </div></div>";

        echo "</div>
        ";
    }
    // cierre metodo


}
// cierre clase

$mostrarLista = new ModLibro();
$mostrarLista->mostrarLista();
