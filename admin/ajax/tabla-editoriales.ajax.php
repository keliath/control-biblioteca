<?php

require_once "../controladores/editoriales.controlador.php";
require_once "../modelos/editoriales.modelo.php";

class TablaEditoriales
{

    public function mostrarTabla()
    {

        $item = null;
        $valor = null;
        $editoriales = ControladorEditoriales::ctrMostrarEditorial($item, $valor);

        if (count($editoriales) == 0) {

            echo '{ "data":[]}';

            return;
        }


        $datosJson = '{"data":[';

        foreach ($editoriales as $key => $value) {

            $idEditorial = $value['id_editorial'];

            $botonMoficar = "<div class='d-flex w-100'>";
            $botonMoficar .= "<a type='submit' onclick=modificarEditorial($idEditorial) data-toggle='modal' data-target='#modificarEditorial' name='modificarEditorial' class='btn btn-warning btn-sm mx-auto w-100 my-1'>Modificar</a>";
            $botonMoficar .= "</div>";

            $detalle = str_replace(PHP_EOL, "<br>", $value["edi_detalle"]);
            $key += 1;
            $datosJson .= '[

					   ' . $key . ',
				       "' . $value["edi_editorial"] . '",
				       "' . $value["edi_pais"] . '",
				       "' . $value["edi_ciudad"] . '",
				       "' . $detalle . '",
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

$activarTabla = new TablaEditoriales();
$activarTabla->mostrarTabla();
