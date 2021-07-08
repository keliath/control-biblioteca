<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaCategorias
{

    public function mostrarTabla()
    {

        $item = null;
        $valor = null;
        $categorias = ControladorCategorias::ctrMostrarCategoria($item, $valor);

        if (count($categorias) == 0) {

            echo '{ "data":[]}';

            return;
        }


        $datosJson = '{"data":[';

        foreach ($categorias as $key => $value) {

            $idCategoria = $value['id_categoria'];

            $botonMoficar = "<div class='d-flex w-100'>";
            $botonMoficar .= "<a type='submit' onclick=modificarCategoria($idCategoria) data-toggle='modal' data-target='#modificarCategoria' name='modificarCategoria' class='btn btn-warning btn-sm mx-auto w-50 my-1'>Modificar</a>";
            $botonMoficar .= "</div>";

            $key += 1;
            $datosJson .= '[

					   ' . $key . ',
				       "' . $value["cat_categoria"] . '",
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

$activarTabla = new TablaCategorias();
$activarTabla->mostrarTabla();
