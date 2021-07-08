<?php

class ControladorPerchasHileras
{


    /* ==========================================
    AGREGAR PERCHA-HILERA
    =========================================== */

    public function ctrAgregarPerchaHilera()
    {
        if (isset($_POST['inputNombrePercha'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputNombrePercha"]) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputNombreHilera"])
            ) {

                $percha = trim($_POST["inputNombrePercha"]);
                $hilera = trim($_POST["inputNombreHilera"]);

                $tabla = 'ubicaciones';
                $datos = array(
                    "ubi_percha" => $percha,
                    "ubi_hilera" => $hilera
                );


                $respuesta = ModeloPerchasHileras::mdlAgregarPerchaHilera($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>
                                window.location = "' . $ruta . 'admin/perchas-hileras?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar a la PerchaHilera",
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
    MOSTRAR PERCHAS-HILERAS
    =========================================== */

    static public function ctrMostrarPerchaHilera($item, $valor)
    {
        $tabla = "ubicaciones";

        $respuesta = ModeloPerchasHileras::mdlMostrarPerchaHilera($tabla, $item, $valor);

        return $respuesta;
    }


    /* ==========================================
    AGREGAR PERCHA-HILERA
    =========================================== */

    public function ctrActualizarPerchaHilera()
    {
        if (isset($_POST['idModificarUbicacion']) && isset($_POST['inputPerchaMod']) && isset($_POST['inputHileraMod'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputPerchaMod"]) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputHileraMod"])
            ) {

                $percha = trim($_POST["inputPerchaMod"]);
                $hilera = trim($_POST["inputHileraMod"]);

                $tabla = 'ubicaciones';
                $datos = array(
                    "id_ubicacion" => $_POST['idModificarUbicacion'],
                    "ubi_percha" => $percha,
                    "ubi_hilera" => $hilera
                );


                $respuesta = ModeloPerchasHileras::mdlActualizarPerchaHilera($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>
                                window.location = "' . $ruta . 'admin/perchas-hileras?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar la PerchaHilera",
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
