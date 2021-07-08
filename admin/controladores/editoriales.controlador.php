<?php

class ControladorEditoriales
{


    /* ==========================================
    AGREGAR EDITORIAL
    =========================================== */

    public function ctrAgregarEditorial()
    {
        if (isset($_POST['inputNombreEditorial'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputNombreEditorial"]) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputCiudadEditorial"])

            ) {

                $nombreEditorial = trim($_POST["inputNombreEditorial"]);
                $ciudadEditorial = trim($_POST["inputCiudadEditorial"]);
                $detalleEditorial = trim($_POST["inputDetalleEditorial"]);
                $pais = explode(',', $_POST['inputPais']);

                $tabla = 'editoriales';
                $datos = array(
                    "edi_editorial" => $nombreEditorial,
                    "edi_pais" => $pais[0],
                    "edi_ciudad" => $ciudadEditorial,
                    "edi_detalle" => $detalleEditorial
                );

                $respuesta = ModeloEditoriales::mdlAgregarEditorial($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>
                                window.location = "' . $ruta . 'admin/editoriales?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar a la editorial",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
                }
            } else {

                echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se permiten caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
            }
        }
    }


    /* ==========================================
    MOSTRAR EDITORIAL
    =========================================== */

    static public function ctrMostrarEditorial($item, $valor)
    {
        $tabla = "editoriales";

        $respuesta = ModeloEditoriales::mdlMostrarEditorial($tabla, $item, $valor);

        return $respuesta;
    }


    /* ==========================================
    AGREGAR EDITORIAL
    =========================================== */

    public function ctrActualizarEditorial()
    {
        if (isset($_POST['idModificarEditorial']) && isset($_POST['modNombreEditorial']) && isset($_POST['inputModPais'])
        && isset($_POST['inputModCiudad']) && isset($_POST['inputModDetalle'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["modNombreEditorial"]) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputModCiudad"])

            ) {

                $idEditorial = $_POST['idModificarEditorial'];
                $nombreEditorial = trim($_POST["modNombreEditorial"]);
                $ciudadEditorial = trim($_POST["inputModCiudad"]);
                $detalleEditorial = trim($_POST["inputModDetalle"]);
                $pais = $_POST['inputModPais'];

                $tabla = 'editoriales';
                $datos = array(
                    "id_editorial" => $idEditorial,
                    "edi_editorial" => $nombreEditorial,
                    "edi_pais" => $pais,
                    "edi_ciudad" => $ciudadEditorial,
                    "edi_detalle" => $detalleEditorial
                );

                $respuesta = ModeloEditoriales::mdlActualizarEditorial($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>
                                window.location = "' . $ruta . 'admin/editoriales?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar la editorial",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
                }
            } else {

                echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se permiten caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
            }
        }
    }



    /* ==========================================
    FIN DE LA CLASE
    =========================================== */
}
