<?php

require_once "../controladores/prestamos.controlador.php";
require_once "../modelos/prestamos.modelo.php";

/* ==========================================
    CONSULTAS TOMADAS DEL CONTROLADOR DE PRESTAMOS
    =========================================== */

class TablaPrestamosPendientes
{

    public function mostrarTabla()
    {

        $item = "pre_estado";
        $valor = 2;
        $editoriales = ControladorPrestamos::ctrMostrarSolicitudes($item, $valor);

        if (count($editoriales) == 0) {

            echo '{ "data":[]}';

            return;
        }


        $datosJson = '{"data":[';

        foreach ($editoriales as $key => $value) {

            $foto = "<img src='vistas/img/libros/" . $value["id_libro"] . "/" . $value["lib_portada"] . "' class='img-fluid rounded' width='30px'>";

            $botonAceptar = "<form action='' method='post'>";
            $botonAceptar .= "<input type='text' name='idLibro' value='".$value['id_libro']."' hidden>";
            $botonAceptar .= "<input type='text' name='idPrestamo' value='".$value['id_prestamo']."' hidden>";
            $botonAceptar .= "<input type='text' name='diasPrestamo' value='".$value['pre_prestamo']."' hidden>";
            $botonAceptar .= "<button type='submit' name='devolucion' class='btn btn-success btn-sm w-100 my-1'>Devolucion</button>";
            $botonAceptar .= "</form>";

            $botonNegar = "<form action='' method='post'>";
            $botonNegar .= "<input type='text' name='idLibro' value='".$value['id_libro']."' hidden>";
            $botonNegar .= "<input type='text' name='idPrestamo' value='".$value['id_prestamo']."' hidden>";
            $botonNegar .= "<input type='text' name='diasPrestamo' value='".$value['pre_prestamo']."' hidden>";
            $botonNegar .= "<button type='submit' name='perdida' class='btn btn-danger btn-sm w-100 my-1'>Perdida</button>";
            $botonNegar .= "</form>";


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
				       "' . $botonAceptar.$botonNegar . '"

				],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']}';

        echo $datosJson;
    }
    // cierre metodo


}
// cierre clase

$activarTabla = new TablaPrestamosPendientes();
$activarTabla->mostrarTabla();
