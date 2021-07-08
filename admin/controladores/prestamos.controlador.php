<?php

class ControladorPrestamos
{



    /* =========================================
    SOLICITAR PRESTAMOS
    ============================================*/

    public function ctrSolicitarPrestamos()
    {
        $ruta = ControladorRuta::ctrRuta();

        if (isset($_POST['tiempoPrestamo']) && isset($_POST['idLibroSolicitud']) && isset($_POST['idUsuario'])) {

            if (preg_match('/^[0-9]+$/', $_POST["tiempoPrestamo"]) && $_POST['tiempoPrestamo'] > 0 && $_POST['tiempoPrestamo'] < 6) {

                date_default_timezone_set("America/Guayaquil");
                $date = date("Y-m-d H:i:s");

                //el estado de solicitud variara siendo 0:negada 1:en proceso 2:prestada 3:devolucion

                $tabla = 'prestamos';
                $datos = [
                    "id_libro" => $_POST['idLibroSolicitud'],
                    "id_usuario" => $_POST['idUsuario'],
                    "pre_prestamo" => $_POST['tiempoPrestamo'],
                    "pre_fechaPedido" => $date,
                    "pre_estado" => 1
                ];

                echo '<script>
                                console.log("adsa");
                             </script>';
                $respuesta = ModeloPrestamos::mdlSolicitarPrestamo($tabla, $datos);

                $tablaAc = "libros";
                $itemAc = "lib_estado";
                $valor = 2;

                $respuestaActualizacion = ModeloLibros::mdlActualizarPrestamoLibro($tablaAc, $_POST['idLibroSolicitud'], $itemAc, $valor);

                if ($respuesta == 'ok' && $respuestaActualizacion == 'ok') {

                    echo '<script>
                                window.location = "' . $ruta . 'biblioteca?ex";
                             </script>';
                    return;
                } else {
                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido registrar la solicitud",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
                    return;
                }
            } else {

                echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "Campos invalidos!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
                return;
            }
        }
    }


    /* =========================================
    MOSTAR PRESTAMOS
    ============================================*/

    // static public function ctrMostrarPrestamos($item, $valor)
    // {

    //     $tabla = "prestamos";

    //     $respuesta = ModeloPrestamos::mdlMostrarSolicitudes($tabla, $item, $valor);

    //     return $respuesta;
    // }

    /* ==========================
    MOSTRAR LISTA DE SOLICITUDES
    =========================== */

    static public function ctrMostrarSolicitudes($item, $valor)
    {

        $tabla = "prestamos";

        $respuesta = ModeloPrestamos::mdlMostrarSolicitudes($tabla, $item, $valor);

        return $respuesta;
    }

    /* =========================================
    ACTUALIZAR PRESTAMO
    ============================================*/

    public function ctrActualizarPrestamo()
    {

        $ruta = ControladorGeneral::ctrRuta();

        if (isset($_POST['idLibro'])) {

            date_default_timezone_set("America/Guayaquil");
            $date = date("Y-m-d H:i:s");

            $prestamo = strtotime('+' . $_POST['diasPrestamo'] . ' day', strtotime($date));
            $prestamo = date('Y-m-d H:i:s', $prestamo);

            $tabla = "prestamos";
            $item = null;

            $tablaLibro = "libros";

            $idLibro = $_POST['idLibro'];
            $itemLibro = "lib_estado";

            $prestamoEstado = 2;
            $valorLibro = 3;

            $rutaFinal = "solicitudes";

            if (isset($_POST['negar'])) {
                $prestamoEstado = 4;
                $valorLibro = 1;
                $prestamo = null;
            }

            if (isset($_POST['devolucion'])) {
                $prestamoEstado = 3;
                $valorLibro = 1;
                $prestamo = $date;
                $rutaFinal = 'prestamos';
            }

            if (isset($_POST['perdida'])) {
                $prestamoEstado = 0;
                $valorLibro = 0;
                $prestamo = $date;
                $rutaFinal = 'prestamosss'; 
            }

            $valorPrestamo = [
                "id_prestamo" => $_POST['idPrestamo'],
                "pre_estado" => $prestamoEstado,
                "pre_fechaPrestamo" => $prestamo
            ];

            


            $respuesta = ModeloPrestamos::mdlActualizarPrestamo($tabla, $item, $valorPrestamo);
            $respuestaLibro = ModeloLibros::mdlActualizarPrestamoLibro($tablaLibro, $idLibro, $itemLibro, $valorLibro);

            if ($respuesta == 'ok' && $respuestaLibro == 'ok') {

                echo '<script>
                                window.location = "' . $ruta . 'admin/'.$rutaFinal.'?ex";
                             </script>';
                return;
            } else {
                echo '<script>
                        swal({
                            type:"error",
                            title:"Solicitud no procesada",
                            text: "se ha producido un error en el proceso de la solicitud!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
                return;
            }
        }
    }

    /* =========================================
    FIN DE CLASE
    ============================================*/
}
