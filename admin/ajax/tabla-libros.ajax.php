<?php

require_once "../controladores/libros.controlador.php";
require_once "../modelos/libros.modelo.php";

class TablaLibros
{

    public function mostrarTabla()
    {

        $item = null;
        $valor = null;
        $libros = ControladorLibros::ctrMostrarLibrosJoin($item, $valor);

        if (count($libros) == 0) {

            echo '{ "data":[]}';

            return;
        }


        $datosJson = '{"data":[';

        foreach ($libros as $key => $value) {

            $idLibro = $value['id_libro'];

            $botonMoficar = "<div class='d-flex w-100'>";
            $botonMoficar .= "<a type='submit' onclick=modificarLibro($idLibro) data-toggle='modal' data-target='#modificarLibro' name='modificarLibro' class='btn btn-warning btn-sm mx-auto w-100 my-1'>Modificar</a>";
            $botonMoficar .= "</div>";

            $foto = "<img src='vistas/img/libros/" . $value["id_libro"] . "/" . $value["lib_portada"] . "' class='img-fluid rounded' width='30px'>";
            $ubicacion = $value["ubi_percha"] . "/" . $value["ubi_hilera"];
            $descripcion = str_replace(PHP_EOL, "<br>", $value["lib_descripcion"]);
            $descripcion = preg_replace('/(\r\n)|\r|\n/', "<br>", $descripcion);
            $key += 1;
            $datosJson .= '[

					   ' . $key . ',
				       "' . $foto . '",
				       "' . $value["lib_titulo"] . '",
				       "' . $value["cat_categoria"] . '",
				       "' . $value["aut_autor"] . '",
				       "' . $value["lib_year"] . '",
				       "' . $value["lib_edicion"] . '",
				       "' . $value["edi_editorial"] . '",
				       "' . $ubicacion . '",
				       "' . $value["lib_isbn"] . '",
				       "' . $value["lib_estado"] . '",
				       "' . $descripcion . '",
				       "' . $botonMoficar . '"

				],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']}';

        echo $datosJson;
    }
    // cierre metodo


}
// cierre clase

$activarTabla = new TablaLibros();
$activarTabla->mostrarTabla();
