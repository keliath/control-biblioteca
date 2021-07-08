<?php

require_once "../controladores/autores.controlador.php";
require_once "../modelos/autores.modelo.php";

class TablaAutores
{

    public function mostrarTabla()
    {

        $item = null;
        $valor = null;
        $autores = ControladorAutores::ctrMostrarAutores($item, $valor);

        if (count($autores) == 0) {

            echo '{ "data":[]}';

            return;
        }

        $datosJson = '{"data":[';

        foreach ($autores as $key => $value) {

            $idAutor = $value["id_autor"];
            $nombreAutor = $value["aut_autor"];


            $botonMoficar = "<div class='d-flex w-100'>";
            $botonMoficar .= "<a type='submit' onclick=modificarAutor($idAutor) data-toggle='modal' data-target='#modificarAutor' name='modificarAutor' class='btn btn-warning btn-sm mx-auto w-50 my-1'>Modificar</a>";
            $botonMoficar .= "</div>";


            $key += 1;
            $datosJson .= '[

					   ' . $key . ',
				       "' . $nombreAutor . '",
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

$activarTabla = new TablaAutores();
$activarTabla->mostrarTabla();
