<?php

require_once "../controladores/prestamos.controlador.php";
require_once "../modelos/prestamos.modelo.php";

/* ==========================================
    CONSULTAS TOMADAS DEL CONTROLADOR DE PRESTAMOS
    =========================================== */

class TablaSolicitudes
{

    public function mostrarTabla()
    {

        $item = "pre_estado";
        $valor = 1;
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
            $botonAceptar .= "<button type='submit' name='aceptar' class='btn btn-success btn-sm w-100 my-1'>Aceptar</button>";
            $botonAceptar .= "</form>";

            $botonNegar = "<form action='' method='post'>";
            $botonNegar .= "<input type='text' name='idLibro' value='".$value['id_libro']."' hidden>";
            $botonNegar .= "<input type='text' name='idPrestamo' value='".$value['id_prestamo']."' hidden>";
            $botonNegar .= "<input type='text' name='diasPrestamo' value='".$value['pre_prestamo']."' hidden>";
            $botonNegar .= "<button type='submit' name='negar' class='btn btn-danger btn-sm w-100 my-1'>Negar</button>";
            $botonNegar .= "</form>";


            $ubicacion = $value["ubi_percha"] . "/" . $value["ubi_hilera"];
            $key += 1;
            $datosJson .= '[

					   ' . $key . ',
                       "' . $value["usu_nombre"] . '",
                       "' . $value["usu_cedula"] . '",
				       "' . $foto . '",
				       "' . $value["lib_titulo"] . '",
				       "' . $value["lib_edicion"] . '",
				       "' . $ubicacion . '",
				       "' . $value["lib_isbn"] . '",
				       "' . $botonAceptar . $botonNegar . '"

				],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']}';

        echo $datosJson;
    }
    // cierre metodo


}
// cierre clase

$activarTabla = new TablaSolicitudes();
$activarTabla->mostrarTabla();
