<?php

require_once "../controladores/prestamos.controlador.php";
require_once "../modelos/prestamos.modelo.php";

/* ==========================================
    CONSULTAS TOMADAS DEL CONTROLADOR DE PRESTAMOS
    =========================================== */

class TablaReporteGeneral
{

    public function mostrarTabla()
    {

        $prestamos = ControladorPrestamos::ctrMostrarSolicitudes(null, null);

        if (count($prestamos) == 0) {

            echo '{ "data":[]}';

            return;
        }


        $datosJson = '{"data":[';

        foreach ($prestamos as $key => $value) {

            $foto = "<img src='vistas/img/libros/" . $value["id_libro"] . "/" . $value["lib_portada"] . "' class='img-fluid rounded' width='30px'>";

            $estado = $value['pre_estado'];

            $botonEstado = "<a class='btn btn-muted btn-sm w-100 my-1'>Indefinido</a>";

            if ($estado == 0) {
                $botonEstado = "<a class='btn btn-secondary btn-sm w-100 my-1 text-white'>Perdido</a>";
            }
            if ($estado == 1) {
                $botonEstado = "<a class='btn btn-success btn-sm w-100 my-1 text-white'>Solicitado</a>";
            }
            if ($estado == 2) {
                $botonEstado = "<a class='btn btn-warning btn-sm w-100 my-1 text-white'>Prestado</a>";
            }
            if ($estado == 3) {
                $botonEstado = "<a class='btn btn-primary btn-sm w-100 my-1 text-white'>Devuelto</a>";
            }
            if ($estado == 4) {
                $botonEstado = "<a class='btn btn-danger btn-sm w-100 my-1 text-white'>Negado</a>";
            }


            $fecha = $value["pre_fechaPrestamo"];
            $key += 1;
            $datosJson .= '[

					   ' . $key . ',
                       "' . $value["usu_nombre"] . '",
                       "' . $value["usu_cedula"] . '",
				       "' . $foto . '",
				       "' . $value["lib_titulo"] . '",
				       "' . $value["lib_edicion"] . '",
				       "' . $fecha . '",
				       "' . $value["lib_isbn"] . '",
				       "' . $botonEstado . '"

				],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']}';

        echo $datosJson;
    }
    // cierre metodo


}
// cierre clase

$activarTabla = new TablaReporteGeneral();
$activarTabla->mostrarTabla();
