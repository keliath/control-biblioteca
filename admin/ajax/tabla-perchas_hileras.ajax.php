<?php

require_once "../controladores/perchas-hileras.controlador.php";
require_once "../modelos/perchas-hileras.modelo.php";

class TablaPerchasHileras
{

    public function mostrarTabla()
    {

        $item = null;
        $valor = null;
        $perchashileras = ControladorPerchasHileras::ctrMostrarPerchaHilera($item, $valor);

        if (count($perchashileras) == 0) {

            echo '{ "data":[]}';

            return;
        }


        $datosJson = '{"data":[';

        foreach ($perchashileras as $key => $value) {

            $idUbicacion = $value['id_ubicacion'];

            $botonMoficar = "<div class='d-flex w-100'>";
            $botonMoficar .= "<a type='submit' onclick=modificarUbicacion($idUbicacion) data-toggle='modal' data-target='#ModificarPerchaHilera' name='ModificarPerchaHilera' class='btn btn-warning btn-sm mx-auto w-50 my-1'>Modificar</a>";
            $botonMoficar .= "</div>";

            $key += 1;
            $datosJson .= '[

					   ' . $key . ',
				       "' . $value["ubi_percha"] . '",
				       "' . $value["ubi_hilera"] . '",
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

$activarTabla = new TablaPerchasHileras();
$activarTabla->mostrarTabla();
